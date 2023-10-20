<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Tambah Mahasiswa') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-primary border-left-primary alert-dismissible fade show my-3"
                        role="alert">
                        Password default : <strong>mahasiswa</strong>
                    </div>
                    <input type="hidden" name="role" value="mahasiswa">
                    <input type="hidden" name="password" value="mahasiswa">
                    <div class="form-group ">
                        <label class="form-control-label" for="name">Nama<span
                                class="small text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="email">Email<span
                                class="small text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="phone">No HP<span
                                class="small text-danger">*</span></label>
                        <input type="number" class="form-control" name="phone" placeholder="No. HP">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
