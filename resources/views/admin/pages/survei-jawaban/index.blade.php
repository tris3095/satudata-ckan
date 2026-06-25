@extends('admin.layouts.master')

@section('title', $title ?? '')

@section('content')
    <h3 class="text-xl font-semibold text-gray-800 mb-6">{{ $title ?? '' }}</h3>

    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Total Responden</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">{{ $totalResponses }}</h3>
        </div>
        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Rata-rata Skala Kepuasan</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">
                {{ $rataRataKeseluruhan ?? '-' }} <span class="text-sm text-gray-400 font-normal">/ 5</span>
            </h3>
        </div>
        @php
            $gate = collect($analitik)->first(fn($a) => $a['pertanyaan']->tipe === 'ya_tidak');
        @endphp
        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Pernah Pakai WhatsApp Halo Satu Data</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">
                {{ $gate['persentase_pernah'] ?? 0 }}%
            </h3>
        </div>
    </div>

    <!-- Analitik Per Pertanyaan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        @foreach ($analitik as $item)
            <div class="bg-white border rounded-lg p-5">
                <div class="flex items-start justify-between gap-2">
                    <p class="font-medium text-gray-800">
                        <span class="uppercase text-xs text-red-600 font-semibold">{{ $item['pertanyaan']->kode }}</span><br>
                        {{ $item['pertanyaan']->pertanyaan }}
                    </p>
                    @if ($item['pertanyaan']->tipe === 'skala')
                        <span class="shrink-0 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">
                            {{ $item['rata_rata'] ?? '-' }} / 5
                        </span>
                    @endif
                </div>

                <p class="text-xs text-gray-400 mt-1">{{ $item['total_jawaban'] }} jawaban</p>

                @if ($item['pertanyaan']->tipe === 'skala')
                    <div class="mt-4 space-y-2">
                        @for ($i = 5; $i >= 1; $i--)
                            <div class="flex items-center gap-2 text-sm">
                                <span class="w-3 text-gray-500">{{ $i }}</span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2.5">
                                    <div class="bg-red-600 h-2.5 rounded-full" style="width: {{ $item['distribusi'][$i]['percentage'] }}%"></div>
                                </div>
                                <span class="w-16 text-right text-gray-500">{{ $item['distribusi'][$i]['count'] }} ({{ $item['distribusi'][$i]['percentage'] }}%)</span>
                            </div>
                        @endfor
                    </div>
                @elseif ($item['pertanyaan']->tipe === 'ya_tidak')
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center gap-2 text-sm">
                            <span class="w-20 text-gray-500">Pernah</span>
                            <div class="flex-1 bg-gray-100 rounded-full h-2.5">
                                <div class="bg-red-600 h-2.5 rounded-full" style="width: {{ $item['persentase_pernah'] }}%"></div>
                            </div>
                            <span class="w-16 text-right text-gray-500">{{ $item['pernah'] }} ({{ $item['persentase_pernah'] }}%)</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="w-20 text-gray-500">Tidak Pernah</span>
                            <div class="flex-1 bg-gray-100 rounded-full h-2.5">
                                <div class="bg-gray-400 h-2.5 rounded-full" style="width: {{ 100 - $item['persentase_pernah'] }}%"></div>
                            </div>
                            <span class="w-16 text-right text-gray-500">{{ $item['tidak_pernah'] }} ({{ 100 - $item['persentase_pernah'] }}%)</span>
                        </div>
                    </div>
                @else
                    <div class="mt-4 max-h-48 overflow-y-auto space-y-2">
                        @forelse ($item['jawaban_teks'] as $teks)
                            <p class="text-sm bg-gray-50 rounded-md p-2 text-gray-600">{{ $teks }}</p>
                        @empty
                            <p class="text-sm text-gray-400">Belum ada kritik/saran.</p>
                        @endforelse
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Daftar Responden -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-5 py-4 border-b">
            <h4 class="font-semibold text-gray-800">Daftar Responden</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr class="text-left text-gray-600 uppercase text-xs tracking-wide">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Waktu Mengisi</th>
                        <th class="px-4 py-3">IP Address</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($datas as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $loop->iteration + ($datas->currentPage() - 1) * $datas->perPage() }}</td>
                            <td class="px-4 py-3">{{ $item->created_at->translatedFormat('d F Y, H:i') }}</td>
                            <td class="px-4 py-3">{{ $item->ip_address ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <button type="button" onclick="showDetail({{ $item->id }})"
                                    class="text-red-600 hover:text-red-700 cursor-pointer">
                                    <i class="bi bi-eye-fill"></i> Lihat Detail
                                </button>
                            </td>
                        </tr>
                        <template id="detail-template-{{ $item->id }}">
                            <p class="text-xs text-gray-400 mb-3">
                                Diisi pada {{ $item->created_at->translatedFormat('d F Y, H:i') }} dari IP {{ $item->ip_address ?? '-' }}
                            </p>
                            <div class="space-y-3">
                                @foreach ($item->detail as $detail)
                                    <div class="border-b border-gray-100 pb-2">
                                        <p class="text-sm text-gray-500">
                                            <span class="uppercase text-xs text-red-600 font-semibold">{{ $detail['kode'] }}</span>
                                            {{ $detail['pertanyaan'] }}
                                        </p>
                                        <p class="font-medium text-gray-800">{{ $detail['jawaban'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </template>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada responden survei.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4">
            {{ $datas->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="hidden fixed inset-0 z-50">
        <div class="fixed inset-0 bg-black/20" onclick="closeDetail()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[80vh] overflow-y-auto">
                <div class="flex justify-between px-6 py-4 border-b border-gray-400 sticky top-0 bg-white">
                    <h5 class="text-lg font-semibold">Detail Jawaban Survei</h5>
                    <button onclick="closeDetail()" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="detailModalContent" class="p-6"></div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        function showDetail(id) {
            const template = document.getElementById('detail-template-' + id);
            const content = document.getElementById('detailModalContent');
            content.innerHTML = '';
            content.appendChild(template.content.cloneNode(true));
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetail() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
@endpush
