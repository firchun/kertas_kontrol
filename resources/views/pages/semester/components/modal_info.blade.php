<!-- Delete Modal-->
<div class="modal fade" id="info-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Informasi periode') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @php
                    $periodes = App\Models\LayananPeriode::where('id_semester', $item->id)->get();
                @endphp
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periodes as $periode)
                            <tr>
                                <td>{{ $periode->layanan->layanan }}</td>
                                <td>{{ \Carbon\Carbon::parse($periode->tanggal_awal)->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($periode->tanggal_akhir)->format('d F Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
            </div>
        </div>
    </div>
</div>
