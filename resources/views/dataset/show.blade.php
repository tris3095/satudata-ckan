@extends('layouts.app')

@section('content')
    {{-- <div class="bg-white shadow rounded-xl p-6">

        <h2 class="text-2xl font-bold mb-3">
            {{ $dataset['title'] ?? $dataset['name'] }}
        </h2>

        <p class="text-gray-700 mb-6">
            {{ $dataset['notes'] ?? 'No description' }}
        </p>

        <h3 class="font-semibold text-lg mb-2">Resources</h3>

        <ul class="space-y-3">
            @foreach ($dataset['resources'] as $r)
                <li class="p-3 border rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                    <a href="{{ $r['url'] }}" target="_blank" class="text-blue-600 font-medium">
                        {{ $r['name'] ?? $r['url'] }}
                    </a>
                </li>
            @endforeach
        </ul>
        <p></p><br>
        <h3 class="font-semibold text-lg mb-2">Metadata</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 border rounded-lg">
            <div class="p-3 font-semibold bg-gray-100 border rounde md:border-r">Field</div>
            <div class="p-3 font-semibold bg-gray-100 border rounded-tr-lg md:border-r ">Value</div>

            <div class="p-3 font-semibold bg-gray-100 border-b md:border-r">Source
            </div>
            <div class="p-3 border-b">{{ $dataset['organization']['title'] }}</div>
            <div class="p-3 font-semibold bg-gray-100 border-b md:border-r">State
            </div>
            <div class="p-3 border-b">{{ $dataset['organization']['state'] }}</div>
            <div class="p-3 font-semibold bg-gray-100 border-b md:border-r">Last Update
            </div>
            <div class="p-3 border-b">
                {{ \Carbon\Carbon::parse($dataset['metadata_modified'])->setTimezone('Asia/Jakarta')->format('F d, Y, h:i A') }}
                (UTC+07:00) </div>
            <div class="p-3 font-semibold bg-gray-100 border-b md:border-r">Created
            </div>
            <div class="p-3 border-b">
                {{ \Carbon\Carbon::parse($dataset['metadata_created'])->setTimezone('Asia/Jakarta')->format('F d, Y, h:i A') }}
                (UTC+07:00)
            </div>
            @foreach ($dataset['extras'] as $extra)
                <div class="p-3 font-semibold bg-gray-100 border-b md:border-r">{{ $extra['key'] }}</div>
                <div class="p-3 border-b">{{ $extra['value'] }}</div>
            @endforeach

        </div>

    </div> --}}
    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- ================= LEFT : DATASET CONTENT ================= -->
            <div class="lg:col-span-2 bg-white border rounded">

                <!-- Title & Description -->
                <div class="p-6 border-b">
                    <h1 class="text-2xl font-semibold text-gray-800 mb-2">
                        {{ $dataset['title'] ?? $dataset['name'] }}
                    </h1>

                    <p class="text-sm text-gray-600 leading-relaxed">
                        {!! nl2br(e(mask_pribadi($dataset['notes'] ?? 'No description provided.'))) !!}
                    </p>
                </div>

                <!-- Resources -->
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Resources</h3>

                    <div class="border border-gray-200 rounded overflow-hidden">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 text-gray-600">
                                <tr>
                                    <th class="px-4 py-2 text-left font-semibold">Name</th>
                                    <th class="px-4 py-2 text-left font-semibold">Format</th>
                                    <th class="px-4 py-2 text-left font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($dataset['resources'] as $r)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium text-gray-800">
                                            {{ $r['name'] ?? 'Resource' }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 uppercase">
                                            {{ $r['format'] ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('dataset.download', ['url' => $r['url']]) }}" target="_blank"
                                                class="text-blue-600 hover:underline">
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                            No resources available
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- ================= RIGHT : METADATA SIDEBAR ================= -->
            <div class="lg:col-span-1 bg-white border rounded">

                <div class="px-4 py-3 border-b bg-gray-100 font-semibold text-gray-700">
                    Dataset Information
                </div>

                <div class="divide-y text-sm">

                    <div class="px-4 py-3">
                        <div class="text-gray-500">Organization</div>
                        <div class="font-medium text-gray-800">
                            {{ $dataset['organization']['title'] ?? '-' }}
                        </div>
                    </div>

                    <div class="px-4 py-3">
                        <div class="text-gray-500">State</div>
                        <span class="inline-block mt-1 px-2 py-0.5 text-xs rounded bg-green-100 text-green-700">
                            {{ $dataset['organization']['state'] ?? '-' }}
                        </span>
                    </div>

                    <div class="px-4 py-3">
                        <div class="text-gray-500">Last Updated</div>
                        <div class="text-gray-800">
                            {{ \Carbon\Carbon::parse($dataset['metadata_modified'])->setTimezone('Asia/Jakarta')->format('F d, Y, H:i') }}
                        </div>
                    </div>

                    <div class="px-4 py-3">
                        <div class="text-gray-500">Created</div>
                        <div class="text-gray-800">
                            {{ \Carbon\Carbon::parse($dataset['metadata_created'])->setTimezone('Asia/Jakarta')->format('F d, Y, H:i') }}
                        </div>
                    </div>

                    @foreach ($dataset['extras'] as $extra)
                        <div class="px-4 py-3">
                            <div class="text-gray-500">
                                {{ $extra['key'] }}
                            </div>
                            <div class="text-gray-800 break-words">
                                {{ mask_pribadi($extra['value'], $extra['key']) }}
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
@endsection
