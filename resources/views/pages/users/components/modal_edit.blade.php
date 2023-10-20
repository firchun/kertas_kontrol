<div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Update Data Admin') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ route('users.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group ">
                        <label class="form-control-label" for="name">Nama<span
                                class="small text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap"
                            value="{{ $item->name }}">
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="email">Email<span
                                class="small text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="Email"
                            value="{{ $item->email }}">
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="phone">No HP<span
                                class="small text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" placeholder="No. HP"
                            value="{{ $item->phone }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
