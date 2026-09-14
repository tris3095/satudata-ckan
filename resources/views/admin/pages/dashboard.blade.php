@extends('admin.layouts.master')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    @php
        $stats = $datasetStats ?? [];
        $series = $stats['monthly_series'] ?? [];
        $counts = array_column($series, 'count');
        $maxCount = max($counts ?: [0]) ?: 1;
        $pointCount = count($series);

        $chartW = 700;
        $chartH = 220;
        $padX = 16;
        $padY = 28;
        $usableW = $chartW - ($padX * 2);
        $usableH = $chartH - ($padY * 2);
        $baselineY = $chartH - $padY;

        $points = [];
        foreach ($series as $i => $row) {
            $x = $pointCount > 1 ? $padX + ($usableW * $i / ($pointCount - 1)) : $padX + $usableW / 2;
            $y = $padY + $usableH - ($usableH * $row['count'] / $maxCount);
            $points[] = ['x' => round($x, 2), 'y' => round($y, 2), 'label' => $row['label'], 'count' => $row['count']];
        }

        $linePath = '';
        $areaPath = '';
        if (count($points) > 0) {
            $linePath = 'M '.$points[0]['x'].' '.$points[0]['y'];
            for ($i = 1; $i < count($points); $i++) {
                $p0 = $points[$i - 1];
                $p1 = $points[$i];
                $cx = round(($p0['x'] + $p1['x']) / 2, 2);
                $linePath .= " C {$cx} {$p0['y']}, {$cx} {$p1['y']}, {$p1['x']} {$p1['y']}";
            }
            $lastPoint = $points[count($points) - 1];
            $areaPath = $linePath." L {$lastPoint['x']} {$baselineY} L {$points[0]['x']} {$baselineY} Z";
        }

        $lastIndex = count($points) - 1;
        $maxIndex = null;
        $maxVal = -1;
        foreach ($points as $i => $pt) {
            if ($pt['count'] > $maxVal) {
                $maxVal = $pt['count'];
                $maxIndex = $i;
            }
        }
    @endphp

    <!-- Statistik Dataset (CKAN) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Total Dataset</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">
                {{ number_format($stats['total_datasets'] ?? 0, 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Total OPD</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">
                {{ number_format($stats['total_organizations'] ?? 0, 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Bulan Ini</p>
            <h3 class="mt-2 text-2xl font-semibold text-green-600">
                +{{ number_format($stats['datasets_this_month'] ?? 0, 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Tahun Ini</p>
            <h3 class="mt-2 text-2xl font-semibold text-green-600">
                +{{ number_format($stats['datasets_this_year'] ?? 0, 0, ',', '.') }}</h3>
        </div>

    </div>

    <!-- Grafik penambahan dataset per bulan -->
    <div class="bg-white border rounded-lg p-5 mb-6">
        <h3 class="text-base font-semibold text-gray-800 mb-4">Penambahan Dataset per Bulan</h3>

        @if ($pointCount > 0)
            <div id="datasetChart" class="relative" data-points='@json($points)'
                data-chart-w="{{ $chartW }}" data-chart-h="{{ $chartH }}">
                <svg viewBox="0 0 {{ $chartW }} {{ $chartH }}" preserveAspectRatio="none" class="w-full h-56 block"
                    role="img" aria-label="Grafik jumlah dataset baru per bulan">
                    @for ($g = 1; $g <= 3; $g++)
                        @php $gy = round($padY + ($usableH * $g / 4), 2); @endphp
                        <line x1="{{ $padX }}" y1="{{ $gy }}" x2="{{ $chartW - $padX }}" y2="{{ $gy }}"
                            stroke="#e5e7eb" stroke-width="1"></line>
                    @endfor
                    <line x1="{{ $padX }}" y1="{{ $baselineY }}" x2="{{ $chartW - $padX }}" y2="{{ $baselineY }}"
                        stroke="#d1d5db" stroke-width="1"></line>

                    <path d="{{ $areaPath }}" fill="#dc2626" fill-opacity="0.08" stroke="none"></path>
                    <path d="{{ $linePath }}" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>

                    <!-- crosshair, hidden until hover -->
                    <line id="datasetChartCrosshair" x1="{{ $padX }}" y1="{{ $padY }}" x2="{{ $padX }}"
                        y2="{{ $baselineY }}" stroke="#9ca3af" stroke-width="1" stroke-dasharray="3,3"
                        opacity="0"></line>

                    @foreach ($points as $i => $pt)
                        @php $labelY = $pt['y'] > 20 ? $pt['y'] - 10 : $pt['y'] + 16; @endphp
                        @if ($i === $lastIndex || $i === $maxIndex)
                            <text x="{{ $pt['x'] }}" y="{{ $labelY }}" text-anchor="middle" font-size="11"
                                font-weight="600" fill="#374151">{{ number_format($pt['count'], 0, ',', '.') }}</text>
                        @endif
                        <circle class="chart-point" data-index="{{ $i }}" cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}"
                            r="4" fill="#dc2626" stroke="#fff" stroke-width="2"></circle>
                    @endforeach
                </svg>

                <!-- transparent layer that captures hover/touch across the whole chart -->
                <div id="datasetChartHoverLayer" class="absolute inset-0 cursor-crosshair"></div>

                <div id="datasetChartTooltip"
                    class="pointer-events-none absolute z-10 hidden -translate-x-1/2 -translate-y-[calc(100%+10px)] whitespace-nowrap rounded-md bg-gray-900 px-2.5 py-1.5 text-xs shadow-lg">
                    <div id="datasetChartTooltipMonth" class="font-semibold text-white"></div>
                    <div id="datasetChartTooltipValue" class="text-gray-300"></div>
                </div>
            </div>

            <div class="mt-2 grid text-xs text-gray-500" style="grid-template-columns: repeat({{ $pointCount }}, minmax(0, 1fr));">
                @foreach ($points as $pt)
                    <span class="text-center">{{ $pt['label'] }}</span>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-400">Data belum tersedia.</p>
        @endif
    </div>

    <!-- Dataset berdasarkan OPD & Topik -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

        <div class="bg-white border rounded-lg p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-semibold text-gray-800">Dataset Berdasarkan OPD</h3>
                <a href="{{ route('instantion.index') }}"
                    class="text-xs font-medium text-red-600 hover:text-red-700">Lihat semua</a>
            </div>

            @php $maxOrg = collect($stats['by_organization'] ?? [])->max('count') ?: 1; @endphp
            @forelse ($stats['by_organization'] ?? [] as $row)
                <div class="mb-3 last:mb-0">
                    <div class="flex items-center justify-between text-sm mb-1">
                        <span class="text-gray-700 truncate pr-2">{{ $row['label'] }}</span>
                        <span class="text-gray-500 font-medium shrink-0">{{ number_format($row['count'], 0, ',', '.') }}</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-red-500 rounded-full"
                            style="width: {{ round($row['count'] / $maxOrg * 100) }}%"></div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-400">Data belum tersedia.</p>
            @endforelse

            @php $orgRest = ($stats['by_organization_total'] ?? 0) - count($stats['by_organization'] ?? []); @endphp
            @if ($orgRest > 0)
                <p class="text-xs text-gray-400 mt-3">dan {{ $orgRest }} OPD lainnya</p>
            @endif
        </div>

        <div class="bg-white border rounded-lg p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-semibold text-gray-800">Dataset Berdasarkan Topik</h3>
                <a href="{{ route('groups.list') }}"
                    class="text-xs font-medium text-red-600 hover:text-red-700">Lihat semua</a>
            </div>

            @php $maxTopic = collect($stats['by_topic'] ?? [])->max('count') ?: 1; @endphp
            @forelse ($stats['by_topic'] ?? [] as $row)
                <div class="mb-3 last:mb-0">
                    <div class="flex items-center justify-between text-sm mb-1">
                        <span class="text-gray-700 truncate pr-2">{{ $row['label'] }}</span>
                        <span class="text-gray-500 font-medium shrink-0">{{ number_format($row['count'], 0, ',', '.') }}</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-red-500 rounded-full"
                            style="width: {{ round($row['count'] / $maxTopic * 100) }}%"></div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-400">Data belum tersedia.</p>
            @endforelse

            @php $topicRest = ($stats['by_topic_total'] ?? 0) - count($stats['by_topic'] ?? []); @endphp
            @if ($topicRest > 0)
                <p class="text-xs text-gray-400 mt-3">dan {{ $topicRest }} topik lainnya</p>
            @endif
        </div>

    </div>

    <!-- Statistik Konten -->
    <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Statistik Konten</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Total Banner</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">{{ $bannerCount ?? 0 }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Total Infografis</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">{{ $infographicCount ?? 0 }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Total Pengguna</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">{{ $userCount ?? 0 }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Kunjungan Hari Ini</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">{{ number_format($todayVisitors) }}</h3>
        </div>

    </div>

@endsection

@push('plugin-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrap = document.getElementById('datasetChart');
            if (!wrap) return;

            const points = JSON.parse(wrap.dataset.points || '[]');
            if (!points.length) return;

            const chartW = parseFloat(wrap.dataset.chartW);
            const chartH = parseFloat(wrap.dataset.chartH);
            const hoverLayer = document.getElementById('datasetChartHoverLayer');
            const tooltip = document.getElementById('datasetChartTooltip');
            const tooltipMonth = document.getElementById('datasetChartTooltipMonth');
            const tooltipValue = document.getElementById('datasetChartTooltipValue');
            const crosshair = document.getElementById('datasetChartCrosshair');
            const circles = wrap.querySelectorAll('.chart-point');
            const numberFormat = new Intl.NumberFormat('id-ID');

            function nearestIndex(svgX) {
                let nearest = 0;
                let nearestDist = Infinity;
                points.forEach(function(pt, i) {
                    const dist = Math.abs(pt.x - svgX);
                    if (dist < nearestDist) {
                        nearestDist = dist;
                        nearest = i;
                    }
                });
                return nearest;
            }

            function show(index) {
                const pt = points[index];
                const rect = wrap.getBoundingClientRect();
                const scaleX = rect.width / chartW;
                const scaleY = rect.height / chartH;

                tooltipMonth.textContent = pt.label;
                tooltipValue.textContent = numberFormat.format(pt.count) + ' dataset';
                tooltip.style.left = (pt.x * scaleX) + 'px';
                tooltip.style.top = (pt.y * scaleY) + 'px';
                tooltip.classList.remove('hidden');

                crosshair.setAttribute('x1', pt.x);
                crosshair.setAttribute('x2', pt.x);
                crosshair.setAttribute('opacity', '1');

                circles.forEach(function(circle) {
                    circle.setAttribute('r', Number(circle.dataset.index) === index ? 6 : 4);
                });
            }

            function hide() {
                tooltip.classList.add('hidden');
                crosshair.setAttribute('opacity', '0');
                circles.forEach(function(circle) {
                    circle.setAttribute('r', 4);
                });
            }

            function handlePointerMove(clientX) {
                const rect = wrap.getBoundingClientRect();
                const svgX = ((clientX - rect.left) / rect.width) * chartW;
                show(nearestIndex(svgX));
            }

            hoverLayer.addEventListener('mousemove', function(e) {
                handlePointerMove(e.clientX);
            });
            hoverLayer.addEventListener('mouseleave', hide);

            hoverLayer.addEventListener('touchstart', function(e) {
                if (e.touches[0]) handlePointerMove(e.touches[0].clientX);
            }, {
                passive: true
            });
            hoverLayer.addEventListener('touchmove', function(e) {
                if (e.touches[0]) handlePointerMove(e.touches[0].clientX);
            }, {
                passive: true
            });
            hoverLayer.addEventListener('touchend', hide);
        });
    </script>
@endpush
