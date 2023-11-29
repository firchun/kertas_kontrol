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
            <form action="{{ route('semester.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group ">
                        <label class="form-control-label" for="tahun">Tahun<span
                                class="small text-danger">*</span></label>
                        <input type="number" class="form-control" name="tahun" value="{{ $item->tahun }}">
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="semester">semester<span
                                class="small text-danger">*</span></label>
                        <select class="form-control" name="semester">
                            <option value="ganjil" @if ($item->semester == 'ganjil') selected @endif>Ganjil</option>
                            <option value="genap" @if ($item->semester == 'genap') selected @endif>Genap</option>
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
