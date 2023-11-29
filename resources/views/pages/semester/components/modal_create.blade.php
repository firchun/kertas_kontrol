<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Tambah Semester') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('semester.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-control-label" for="tahun">Tahun<span
                                        class="small text-danger">*</span></label>
                                <input type="number" class="form-control" name="tahun" value="{{ date('Y') }}">
                            </div>
                            <div class="form-group ">
                                <label class="form-control-label" for="semester">semester<span
                                        class="small text-danger">*</span></label>
                                <select class="form-control" name="semester">
                                    <option value="ganjil">Ganjil</option>
                                    <option value="genap">Genap</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            @foreach (App\Models\Layanan::all() as $item)
                                <div class="form-group ">
                                    <input type="hidden" name="id_layanan[]" value="{{ $item->id }}">
                                    <label class="form-control-label text-primary">{{ $item->layanan }}<span
                                            class="small text-danger">*</span></label>
                                    <div class="form-inline">
                                        <label class="mr-2">Mulai</label>
                                        <input type="date" class="form-control" name="tanggal_awal[]" required>
                                        <label class="mx-3">Sampai</label>
                                        <input type="date" class="form-control" name="tanggal_akhir[]" required>
                                    </div>
                                </div>
                            @endforeach
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
