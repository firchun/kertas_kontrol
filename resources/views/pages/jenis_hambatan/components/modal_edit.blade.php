<div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ubah data') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('jenis_hambatan.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group ">
                            <label class="form-control-label" for="jenis_hambatan">Pilih Layanan<span
                                    class="small text-danger">*</span></label>
                            <select class="form-control" name="id_layanan" required>
                                @foreach ($layanan as $itemLayanan)
                                    <option value="{{ $itemLayanan->id }}"
                                        {{ $itemLayanan->id == $item->id_layanan ? 'selected' : '' }}>
                                        {{ $itemLayanan->layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ">
                            <label class="form-control-label" for="jenis_hambatan">jenis hambatan<span
                                    class="small text-danger">*</span></label>
                            <input type="text" class="form-control" name="jenis_hambatan"
                                placeholder="jenis hambatan" value="{{ $item->jenis_hambatan }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
