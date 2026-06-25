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
            Tambah Pertanyaan
        </button>
    </div>

    @if ($showModal)
        <div class="fixed inset-0 bg-black/20 z-40"></div>

        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg">

                <div class="flex justify-between px-6 py-4 border-b border-gray-400">
                    <h5 class="text-lg font-semibold">{{ $editId ? 'Ubah' : 'Tambah' }} Pertanyaan Survei</h5>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="save">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Kode
                            </label>
                            <input wire:model="kode" type="text" maxlength="5"
                                class="w-full border rounded-md p-2 @error('kode') border-red-500 @enderror"
                                placeholder="Contoh: a">
                            @error('kode')
                                <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Pertanyaan
                            </label>
                            <textarea wire:model="pertanyaan" rows="3"
                                class="w-full border rounded-md p-2 @error('pertanyaan') border-red-500 @enderror"
                                placeholder="Tuliskan pertanyaan survei..."></textarea>
                            @error('pertanyaan')
                                <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Tipe Jawaban
                            </label>
                            <select wire:model="tipe"
                                class="w-full border rounded-md p-2 @error('tipe') border-red-500 @enderror">
                                <option value="skala">Skala 1-5</option>
                                <option value="ya_tidak">Ya / Tidak</option>
                                <option value="teks">Teks Bebas</option>
                            </select>
                            @error('tipe')
                                <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="required block text-sm font-medium text-gray-700 mb-1">
                                Urutan
                            </label>
                            <input wire:model="urutan" type="number" min="0"
                                class="w-full border rounded-md p-2 @error('urutan') border-red-500 @enderror">
                            @error('urutan')
                                <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <input wire:model="is_conditional" type="checkbox" id="is_conditional"
                                class="rounded border-gray-300">
                            <label for="is_conditional" class="text-sm text-gray-700">
                                Hanya tampil jika pertanyaan "Ya/Tidak" sebelumnya dijawab "Ya"
                            </label>
                        </div>

                        <div class="flex items-center gap-2">
                            <input wire:model="is_required" type="checkbox" id="is_required"
                                class="rounded border-gray-300">
                            <label for="is_required" class="text-sm text-gray-700">
                                Wajib diisi
                            </label>
                        </div>

                        <div class="flex items-center gap-2">
                            <input wire:model="is_active" type="checkbox" id="is_active"
                                class="rounded border-gray-300">
                            <label for="is_active" class="text-sm text-gray-700">
                                Aktif (ditampilkan di halaman survei)
                            </label>
                        </div>
                    </div>

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
                        <th class="px-4 py-3">Urutan</th>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Pertanyaan</th>
                        <th class="px-4 py-3">Tipe</th>
                        <th class="px-4 py-3">Kondisional</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($this->datas as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $item->urutan }}</td>
                            <td class="px-4 py-3 uppercase">{{ $item->kode }}</td>
                            <td class="px-4 py-3 max-w-md">{{ $item->pertanyaan }}</td>
                            <td class="px-4 py-3">{{ $item->tipe_label }}</td>
                            <td class="px-4 py-3">
                                @if ($item->is_conditional)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Ya</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $item->is_active ? 'bg-green-300 text-green-700' : 'bg-gray-300 text-gray-700' }}">
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-3">
                                    <button wire:click="edit({{ $item->id }})"
                                        class="text-yellow-600 hover:text-yellow-700 cursor-pointer" title="Ubah">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button wire:click="triggerDelete({{ $item->id }})"
                                        class="text-red-600 hover:text-red-700 cursor-pointer" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada pertanyaan survei.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
