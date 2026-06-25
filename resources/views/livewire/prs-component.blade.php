<div>
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-semibold text-gray-800">
            {{ $titlePage ?? '' }}
        </h3>

        <button wire:click="openModal"
            class="inline-flex items-center gap-2 px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            Tambah Data
        </button>
    </div>

    @if ($showModal)
        <div class="fixed inset-0 bg-black/20 z-40"></div>

        <div class="fixed inset-0 z-50 flex items-start sm:items-center justify-center p-4 overflow-y-auto">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] my-8 sm:my-0 flex flex-col">

                <!-- Header -->
                <div class="flex justify-between px-6 py-4 border-b border-gray-400 shrink-0">
                    <h5 class="text-lg font-semibold">{{ $editId ? 'Ubah' : 'Tambah' }} Produk Statistik</h5>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="save" enctype="multipart/form-data" class="flex flex-col flex-1 min-h-0">
                    <div class="px-6 py-4 space-y-4 overflow-y-auto flex-1 min-h-0">
                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Judul
                            </label>
                            <input wire:model.live.debounce.500ms="title" type="text"
                                class="w-full border rounded-md p-2 pl
                                @error('title') border-red-500 @enderror"
                                placeholder="Contoh: Pertumbuhan...">

                            @error('title')
                                <span class="text-sm text-red-500 mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Dokumen / File
                            </label>
                            <input wire:model.lazy="document" type="file"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                                class="w-full border rounded-md p-2
                                @error('document') border-red-500 @enderror">
                            @error('document')
                                <span class="text-sm text-red-500 mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror
                            @if ($oldDocument)
                                <a href="{{ asset('storage/prs/' . $oldDocument) }}" target="_blank"
                                    class="text-sm text-blue-600 hover:underline mt-2 inline-flex items-center gap-1">
                                    <i class="bi bi-file-earmark-text"></i> Dokumen saat ini: {{ $oldDocument }}
                                </a>
                            @endif
                        </div>
                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Thumbnail
                            </label>
                            <input wire:model.lazy="thumbnail" type="file"
                                accept="image/jpeg,image/png,image/jpg,image/gif"
                                class="w-full border rounded-md p-2
                                @error('thumbnail') border-red-500 @enderror">
                            @error('thumbnail')
                                <span class="text-sm text-red-500 mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror
                            @if ($oldThumbnail)
                                <img src="{{ Storage::disk('public')->exists('prs/thumbnail/' . $oldThumbnail)
                                    ? asset('storage/prs/thumbnail/' . $oldThumbnail)
                                    : asset('images/default.png') }}"
                                    class="w-32 mt-2 rounded border">
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Keterangan
                            </label>
                            <textarea wire:model="description" rows="4"
                                class="w-full border rounded-md p-2 @error('description') border-red-500 @enderror"
                                placeholder="Tuliskan keterangan singkat..."></textarea>

                            @error('description')
                                <span class="text-sm text-red-500 mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    ISBN
                                </label>
                                <input wire:model="isbn" type="text"
                                    class="w-full border rounded-md p-2 @error('isbn') border-red-500 @enderror"
                                    placeholder="Contoh: 978-602-XXXX-XX-X">
                                @error('isbn')
                                    <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    No. Katalog
                                </label>
                                <input wire:model="no_katalog" type="text"
                                    class="w-full border rounded-md p-2 @error('no_katalog') border-red-500 @enderror"
                                    placeholder="Contoh: 1102001.16">
                                @error('no_katalog')
                                    <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Rilis
                                </label>
                                <input wire:model="tanggal_rilis" type="date"
                                    class="w-full border rounded-md p-2 @error('tanggal_rilis') border-red-500 @enderror">
                                @error('tanggal_rilis')
                                    <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>
                            <select wire:model.lazy="status"
                                class="w-full border rounded-md p-2
                                @error('status') border-red-500 @enderror">
                                <option value="">-- Pilih Status --</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>

                            @error('status')
                                <span class="text-sm text-red-500 mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end px-6 py-4 border-t border-gray-200 shrink-0">
                        <button type="submit" wire:loading.attr="disabled" wire:target="save"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700
                                   disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer
                                   flex items-center gap-2">

                            <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>

                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr class="text-left text-gray-600 uppercase text-xs tracking-wide">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Thumbnail</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3">Dokumen</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($this->datas as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3"><img src="{{ $item->thumbnail_url }}" class="w-16 rounded border">
                            </td>
                            <td class="px-4 py-3">{{ $item->title }}</td>
                            <td class="px-4 py-3 max-w-xs truncate">{{ $item->description }}</td>
                            <td class="px-4 py-3">
                                @if ($item->document_url)
                                    <a href="{{ $item->document_url }}" target="_blank"
                                        class="bg-gray-300 hover:bg-blue-300
                                        text-blue-700 font-bold py-2 px-4 rounded inline-flex items-center rounded-md
                                        border">Download</a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-3">
                                    <button wire:click="edit({{ $item->id }})"
                                        class="text-yellow-600 hover:text-yellow-700 cursor-pointer" title="Ubah"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    {{-- @if (Auth::user()->role == 'Super Admin') --}}
                                    <button wire:click="triggerDelete({{ $item->id }})"
                                        class="text-red-600 hover:text-red-700 cursor-pointer" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                    {{-- @endif --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
