<div class="modal fade" id="form-hasil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Form Hasil Bimbingan') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('bimbingan.store_hasil') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_bimbingan" value="{{ $bimbingan->id }}">
                    <div>
                        <input type="hidden" name="no[]" value="1">
                        <input type="hidden" name="judul[]" value="Nama Kegiatan">
                        <input type="hidden" name="isi[]" class="form-control" value="{{ $layanan->layanan }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Tujuan Kegiatan <span class="text-danger">*</span></label>
                        <input type="hidden" name="no[]" value="2">
                        <input type="hidden" name="judul[]" value="Tujuan Kegiatan">
                        <textarea name="isi[]" class="form-control" required>{{ $layanan->layanan }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Hambatan <span class="text-danger">*</span></label>
                        <input type="hidden" name="no[]" value="3">
                        <input type="hidden" name="judul[]" value="Hambatan">
                        <textarea name="isi[]" class="form-control" required>{!! implode(', ', $hambatan->pluck('hambatan.jenis_hambatan')->toArray()) !!}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Kesimpulan & Saran <span class="text-danger">*</span></label>
                        <input type="hidden" name="no[]" value="4">
                        <input type="hidden" name="judul[]" value="Kesimpulan & Saran">
                        <textarea name="isi[]" class="form-control" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Perkembangan PKL,KKN,SEMINAR,SKRIPSI <span class="text-danger">*</span></label>
                        <input type="hidden" name="no[]" value="5">
                        <input type="hidden" name="judul[]" value="Perkembangan PKL,KKN,SEMINAR,SKRIPSI">
                        <textarea name="isi[]" class="form-control" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Rencana Kegiatan Selanjutnya <span class="text-danger">*</span></label>
                        <input type="hidden" name="no[]" value="6">
                        <input type="hidden" name="judul[]" value="Rencana Kegiatan Selanjutnya">
                        {{-- <textarea name="isi[]" class="form-control" required></textarea> --}}
                        <select name="isi[]" class="form-control" required>
                            @foreach (App\Models\Layanan::all() as $item)
                                <option value="{{ $item->layanan }}">{{ $item->layanan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
