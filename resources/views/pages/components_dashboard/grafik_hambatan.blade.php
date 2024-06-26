@push('css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
<div class="card">
    <div class="card-header">
        <strong>Grafik Hambatan Semester <span id="code"></span></strong>
        <div class="float-right d-flex">
            <select class="form-control" id="option-code">
                @foreach (App\Models\Semester::latest()->get() as $semesterItem)
                    <option value="{{ $semesterItem->code }}">{{ $semesterItem->code }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-body">
        <canvas id="myChart" style="width: 100%; max-height:300px;"></canvas>
        <h1 id="data_kosong">DATA KOSONG</h1>
    </div>
</div>
@push('js')
    <script>
        function groupBy(array, key) {
            return array.reduce((result, currentItem) => {
                (result[currentItem[key]] = result[currentItem[key]] || []).push(currentItem);
                return result;
            }, {});
        }
        var myChart;

        function updateChart() {
            var selectedOption = document.getElementById('option-code');
            var selectedValue = selectedOption.value;
            document.getElementById('code').innerText = selectedValue;

            if (myChart) {
                myChart.destroy();
            }

            fetch(`{{ url('/bimbingan/chart_hambatan/') }}/${selectedValue}`)
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    const jenisHambatan = data.jenis_hambatan;
                    const countByHambatan = data.jumlah;
                    // Check if data is empty
                    if (!jenisHambatan || jenisHambatan.length === 0 || !countByHambatan || countByHambatan.length ===
                        0) {
                        document.getElementById('myChart').style.display = 'none'; // Sembunyikan grafik
                        document.getElementById('data_kosong').style.display = 'block'; // Tampilkan pesan data kosong
                        return; // Hentikan eksekusi jika data kosong
                    }

                    // Show chart and hide empty data message
                    document.getElementById('myChart').style.display = 'block';
                    document.getElementById('data_kosong').style.display = 'none';

                    const colors = [];
                    for (let i = 0; i < jenisHambatan.length; i++) {
                        const randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                        colors.push(randomColor);
                    }

                    const newData = {
                        labels: jenisHambatan,
                        datasets: [{
                            label: 'Jumlah Mahasiswa ',
                            data: countByHambatan,
                            backgroundColor: colors,
                            borderColor: colors.map(color => color.replace('0.2',
                                '1')),
                            borderWidth: 1
                        }]
                    };

                    const config = {
                        type: 'bar',
                        data: newData,
                        options: {
                            indexAxis: 'y',
                            elements: {
                                bar: {
                                    borderWidth: 2,
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false,
                                    // position: 'right',
                                },


                            }
                        }
                    };


                    const ctx = document.getElementById('myChart').getContext('2d');
                    myChart = new Chart(ctx, config);
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat fetching data:', error);
                });
        }

        window.onload = updateChart;
        document.getElementById('option-code').addEventListener('change', updateChart);
    </script>
@endpush
