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

        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg">

                <!-- Header -->
                <div class="flex justify-between px-6 py-4 border-b border-gray-400">
                    <h5 class="text-lg font-semibold">{{ $editId ? 'Ubah' : 'Tambah' }} Infografis</h5>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="px-6 py-4 space-y-4">
                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Judul
                            </label>
                            <input wire:model.live.debounce.500ms="title" type="text"
                                class="w-full border rounded-md p-2 pl
                                @error('title') border-red-500 @enderror"
                                placeholder="Contoh: Berita">

                            @error('title')
                                <span class="text-sm text-red-500 mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Tanggal Rilis
                            </label>
                            <input wire:model.lazy="rilis_date" type="date"
                                class="w-full border rounded-md p-2
                                @error('rilis_date') border-red-500 @enderror">
                            @error('rilis_date')
                                <span class="text-sm text-red-500 mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Deskripsi
                            </label>
                            {{-- <input id="x" value="" type="hidden" name="description"
                                wire:model.lazy="description">
                            <trix-editor input="x" wire:model.lazy="description"></trix-editor> --}}

                            <textarea wire:model.live.debounce.500ms="description" type="text" placeholder="deskripsi"
                                class="w-full border rounded-md p-2 
                            border-red-500">
                            </textarea>

                            @error('description')
                                <span class="text-sm text-red-500 mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Gambar
                            </label>
                            <input wire:model.lazy="file" type="file" accept="image/*"
                                class="w-full border rounded-md p-2
                                @error('file') border-red-500 @enderror">
                            @error('file')
                                <span class="text-sm text-red-500 mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror
                            @if ($oldImage)
                                <img src="{{ $oldImage && Storage::disk('public')->exists('brs/' . $oldImage)
                                    ? asset('storage/brs/' . $oldImage)
                                    : asset('images/default.png') }}"
                                    class="w-32 mt-2">
                            @endif
                        </div>
                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Materi
                            </label>
                            <input wire:model.lazy="materi" type="file"
                                accept="image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                class="block w-full text-sm text-gray-700
               file:mr-4 file:py-2 file:px-4
               file:rounded-md file:border-0
               file:text-sm file:font-semibold
               file:bg-blue-50 file:text-blue-700
               hover:file:bg-blue-100
               border rounded-md p-2
               @error('materi') border-red-500 @enderror">

                            <!-- Helper text -->
                            <p class="text-xs text-gray-500">
                                Format: JPG, PNG, PDF, DOC, DOCX. Maks. 5MB
                            </p>
                            @error('materi')
                                <span class="text-sm text-red-500 mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror
                            @if ($oldMateri)
                                <a href="{{ $oldMateri && Storage::disk('public')->exists('brs/' . $oldMateri)
                                    ? asset('storage/brs/' . $oldMateri)
                                    : asset('images/default.png') }}"
                                    class="w-32 mt-2">Download Materi</a>
                            @endif
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
                    <div class="flex justify-end px-6 py-4">
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
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Gambar</th>
                        <th class="px-4 py-3">Materi</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($this->datas as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $item->title }}</td>
                            <td class="px-4 py-3">{{ $item->description }}</td>
                            <td class="px-4 py-3">
                                <img src="{{ asset('storage/brs/' . $item->image_path) }}"
                                    class="w-40 rounded-md border">
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ asset('storage/brs/' . $item->materi) }}"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                    </svg>
                                    <span>Download</span>
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->is_active }}
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
