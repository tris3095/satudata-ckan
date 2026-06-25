<div class="modal fade" id="cuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <form id="bannerForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger modal-error" role="alert" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label required">Judul</label>
                        <input id="title" class="form-control" name="title" type="text" autocomplete="off"
                            placeholder="Ulang tahun sumsel...">
                    </div>

                    <div class="mb-3">
                        <label for="link_url" class="form-label">Tautan</label>
                        <input id="link_url" class="form-control" name="link_url" type="url"
                            placeholder="https://..." autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="is_active" class="form-label">Status</label>
                        <select id="is_active" name="is_active" class="form-select">
                            <option value="1">Aktif</option>
                            <option value="0">Sesuai Periode</option>
                        </select>
                    </div>

                    <div id="periode-fields" style="display:none;">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input id="start_date" class="form-control" name="start_date" type="date">
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input id="end_date" class="form-control" name="end_date" type="date">
                        </div>
                    </div>

                    <input type="hidden" id="old_file" name="old_file" />

                    <label for="myDropify" class="form-label required">Gambar</label>
                    <input type="file" name="file" id="myDropify" accept="image/*" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
