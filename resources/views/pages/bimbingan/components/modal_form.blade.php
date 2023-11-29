<div class="modal fade" id="form-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Form Bimbingan') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('bimbingan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_semester" value="{{ App\Models\Semester::latest()->first()->id }}">
                    <input type="hidden" name="id_mahasiswa" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="id_layanan" value="{{ $item->id }}">
                    <div class="form-group">
                        <label for="id_hambatan">Pilih Beberapa hambatan <span
                                class="small text-danger">*</span></label>
                        <select class="form-control" id="id_hambatan" name="id_hambatan[]" multiple required>
                            @foreach (App\Models\JenisHambatan::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->jenis_hambatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Isi Bimbingan <span class="small text-danger">*</span></label>
                        <textarea class="form-control" name="isi" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
