<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Tambah Data') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('penasehat_akademik.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <input type="hidden" name="id_dosen" value="{{ $dosen->id }}">
                        <label class="form-control-label" for="id_mahasiswa">Mahasiswa<span
                                class="small text-danger">*</span></label>
                        <select name="id_mahasiswa" class="form-control" required>
                            <option>Pilih mahasiswa</option>
                            @foreach (App\Models\User::where('role', 'mahasiswa')->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->npm }}</option>
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
