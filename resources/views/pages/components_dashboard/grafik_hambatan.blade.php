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

        function updateChart() {
            var selectedOption = document.getElementById('option-code');
            var selectedValue = selectedOption.value;


            document.getElementById('code').innerText = selectedValue;

            if (myChart) {
                myChart.destroy();
            }

            fetch(`https://labimak-si.mixdev.id/bimbingan/chart_hambatan/${selectedValue}`)
                .then(response => response.json())
                .then(data => {
                    const chartElement = document.getElementById('myChart');
                    const dataKosongElement = document.getElementById('data_kosong');

                    if (data.length === 0) {
                        toggleDisplay(chartElement, false);
                        toggleDisplay(dataKosongElement, true);
                    } else {
                        toggleDisplay(chartElement, true);
                        toggleDisplay(dataKosongElement, false);
                    }



                    var groupedData = groupBy(data, 'id_hambatan');
                    var labels = Object.keys(groupedData).map(key => {
                        return data.find(item => item.id_hambatan == key).hambatan.jenis_hambatan;
                    });
                    var values = Object.values(groupedData).map(group => group.length);


                    // Create the chart
                    var ctx = document.getElementById('myChart').getContext('2d');
                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah',
                                data: values,
                                backgroundColor: 'rgb(255,153,174,1)',
                                borderColor: 'rgb(255,153,174,1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function toggleDisplay(element, displayValue) {
            element.style.display = displayValue ? 'block' : 'none';
        }

        var myChart;

        window.onload = updateChart;

        document.getElementById('option-code').addEventListener('change', updateChart);
    </script>
@endpush
