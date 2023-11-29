<div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-contro   l-label" for="tahun">Tahun<span
                                        class="small text-danger">*</span></label>
                                <input type="number" class="form-control" name="tahun" value="{{ $item->tahun }}">
                            </div>
                            <div class="form-group ">
                                <label class="form-control-label" for="semester">semester<span
                                        class="small text-danger">*</span></label>
                                <select class="form-control" name="semester">
                                    <option value="ganjil" @if ($item->semester == 'ganjil') selected @endif>Ganjil
                                    </option>
                                    <option value="genap" @if ($item->semester == 'genap') selected @endif>Genap
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-8">
                            @foreach (App\Models\LayananPeriode::where('id_semester', $item->id)->get() as $list)
                                <div class="form-group">
                                    <input type="hidden" name="id_layanan[]" value="{{ $list->id_layanan }}">
                                    <label class="form-control-label text-primary">{{ $list->layanan->layanan }}<span
                                            class="small text-danger">*</span></label>
                                    <div class="form-inline">
                                        <label class="mr-2">Mulai</label>
                                        <input type="date" class="form-control" name="tanggal_awal[]"
                                            value="{{ \Carbon\Carbon::parse($list->tanggal_awal)->format('Y-m-d') }}"
                                            required>
                                        <label class="mx-3">Sampai</label>
                                        <input type="date" class="form-control" name="tanggal_akhir[]"
                                            value="{{ \Carbon\Carbon::parse($list->tanggal_akhir)->format('Y-m-d') }}"
                                            required>
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
