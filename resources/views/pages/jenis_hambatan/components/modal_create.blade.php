<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Tambah Data') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('jenis_hambatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <label class="form-control-label" for="jenis_hambatan">Pilih Layanan<span
                                class="small text-danger">*</span></label>
                        <select class="form-control" name="id_layanan" required>
                            @foreach ($layanan as $item)
                                <option value="{{ $item->id }}">{{ $item->layanan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="jenis_hambatan">Jenis Hambatan<span
                                class="small text-danger">*</span></label>
                        <input type="text" class="form-control" name="jenis_hambatan" placeholder="Jenis Hambatan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
