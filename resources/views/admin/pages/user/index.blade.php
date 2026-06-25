@extends('admin.layouts.master')

@section('title', $title ?? '')

@section('content')

    <!-- Header + Action -->
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-semibold text-gray-800">
            {{ $title ?? '' }}
        </h3>

        <button
            class="add inline-flex items-center gap-2 px-4 py-2
               bg-red-700 text-white text-sm font-semibold
               rounded-md hover:bg-red-800 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            Tambah Data
        </button>
    </div>

    <!-- Table Wrapper -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr class="text-left text-gray-600 uppercase text-xs tracking-wide">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Gambar</th>
                        <th class="px-4 py-3">Tautan</th>
                        <th class="px-4 py-3">Periode Tayang</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($datas as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-700">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $item->title }}
                            </td>

                            <td class="px-4 py-3">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-40 rounded-md border">
                            </td>

                            <td class="px-4 py-3">
                                @if ($item->link_url)
                                    <a href="{{ $item->link_url }}" target="_blank"
                                        class="text-red-700 hover:underline break-all">
                                        {{ $item->link_url }}
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">
                                        Tidak tersedia
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                <span class="block text-gray-800">
                                    {{ $item->periode_display['periode'] }}
                                </span>
                                <span class="text-xs {{ $item->periode_color }}">
                                    {{ $item->periode_display['status'] }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $item->is_active ? 'Aktif' : 'Sesuai Periode' }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-3">
                                    <button class="edit text-yellow-600 hover:text-yellow-700"
                                        data-id="{{ $item->id }}" title="Ubah">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>

                                    @if (Auth::user()->role == 'Super Admin')
                                        <button class="delete text-red-600 hover:text-red-700"
                                            data-id="{{ $item->id }}" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
