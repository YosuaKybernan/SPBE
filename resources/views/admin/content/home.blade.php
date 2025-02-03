@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Beranda')

@section('page-title')
    Dashboard
@endsection

@section('breadcrumb-active')
    Dashboard
@endsection

@section('content-section')
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card info-card">
                <div class="card-body p-4">
                    <div class="row search-point">
                        <div class="col-lg-6 d-flex align-items-center">
                            <table class="table w-auto select-form-id">
                                <select class="form-select" id="formSelect" aria-label="Default select example">
                                    <option disabled selected hidden>Pilih Tahun...</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->year }}">Evaluasi SPBE {{ $year->year }}</option>
                                    @endforeach
                                </select>
                            </table>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center d-none" id="radioButton1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault1" checked>
                                <label class="form-check-label ms-3" for="flexCheckDefault1">Hasil Penilaian Mandiri</label>
                            </div>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center d-none" id="radioButton2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault2" checked>
                                <label class="form-check-label ms-3" for="flexCheckDefault2">Hasil Penilaian Akhir</label>
                            </div>
                        </div>
                    </div>
                    <div class="row search-details p-2 my-4 d-none" id="detailsTable">
                        <table class="table w-100 search-detail">
                            <tbody>
                                <tr>
                                    <th class="col-2">ID Form</th>
                                    <td class="col" id="formId">F2201</td>
                                </tr>
                                <tr>
                                    <th class="col-2">Nama Form</th>
                                    <td class="col" id="formName">Evaluasi SPBE 2022</td>
                                </tr>
                                <tr>
                                    <th class="col-2">Tahun</th>
                                    <td class="col" id="formYear">2022</td>
                                </tr>
                                <tr>
                                    <th class="col-2">Deskripsi</th>
                                    <td class="col" id="formDescription">Evaluasi SPBE 2022</td>
                                </tr>
                                <tr>
                                    <td class="py-4" colspan="2">
                                        <button class="btn btn-primary">Unduh Dokumen</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table w-100 form-detail d-none" id="chartTable">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-start">
                                        <h4><strong>Hasil Evaluasi SPBE</strong></h4>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="chartRow">
                                        <td colspan="2" class="d-flex justify-content-center">
                                            <canvas id="radarChart" style="max-height: 400px; max-width: 400px"></canvas>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
@endsection

@section('additional-script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const formSelect = document.getElementById('formSelect');
        const radioButton1 = document.getElementById('radioButton1');
        const radioButton2 = document.getElementById('radioButton2');
        const detailsTable = document.getElementById('detailsTable');
        const chartTable = document.getElementById('chartTable');
        let selfAssessment = null;
        let finalAssessment = null;

        formSelect.addEventListener('change', function() {
            const year = this.value;
            fetch(`/admin/assessment-data/${year}`)
                .then(response => response.json())
                .then(data => {
                    if (data.dashboardAssessment) {
                        document.getElementById('formId').innerText = data.dashboardAssessment.form_id;
                        document.getElementById('formName').innerText = data.dashboardAssessment.form_name;
                        document.getElementById('formYear').innerText = data.dashboardAssessment.year;
                        document.getElementById('formDescription').innerText = data.dashboardAssessment.description;

                        selfAssessment = data.selfAssessment;
                        finalAssessment = data.finalAssessment;

                        detailsTable.classList.remove('d-none');
                        radioButton1.classList.remove('d-none');
                        radioButton2.classList.remove('d-none');

                        updateCharts();
                    }
                });
        });

        const checkbox1 = document.getElementById('flexCheckDefault1');
        const checkbox2 = document.getElementById('flexCheckDefault2');

        checkbox1.addEventListener('change', updateCharts);
        checkbox2.addEventListener('change', updateCharts);

        function updateCharts() {
            const ctx = document.getElementById('radarChart').getContext('2d');

            const data = {
                labels: [
                    'Kebijakan Internal terkait Tata Kelola SPBE',
                    'Perencanaan Strategis SPBE',
                    'Teknologi Informasi dan Komunikasi',
                    'Penyelenggara SPBE',
                    'Penerapan Manajemen SPBE',
                    'Audit TIK',
                    'Layanan Administrasi Pemerintahan Berbasis Elektronik',
                    'Layanan Publik Berbasis Elektronik'
                ],
                datasets: []
            };

            if (checkbox1.checked && selfAssessment) {
                data.datasets.push({
                    label: 'Aspek SPBE Mandiri',
                    data: [
                        selfAssessment.internal_policy,
                        selfAssessment.strategic_planning,
                        selfAssessment.information_technology,
                        selfAssessment.organizer,
                        selfAssessment.management_implementation,
                        selfAssessment.it_audit,
                        selfAssessment.administration_services,
                        selfAssessment.public_services
                    ],
                    fill: true,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)'
                });
            }

            if (checkbox2.checked && finalAssessment) {
                data.datasets.push({
                    label: 'Aspek SPBE Akhir',
                    data: [
                        finalAssessment.internal_policy,
                        finalAssessment.strategic_planning,
                        finalAssessment.information_technology,
                        finalAssessment.organizer,
                        finalAssessment.management_implementation,
                        finalAssessment.it_audit,
                        finalAssessment.administration_services,
                        finalAssessment.public_services
                    ],
                    fill: true,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                    pointBackgroundColor: 'rgb(54, 162, 235)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(54, 162, 235)'
                });
            }

            if (window.myRadarChart) {
                window.myRadarChart.destroy();
            }

            window.myRadarChart = new Chart(ctx, {
                type: 'radar',
                data: data,
                options: {
                    elements: {
                        line: {
                            borderWidth: 3
                        }
                    }
                }
            });

            if (checkbox1.checked || checkbox2.checked) {
                chartTable.classList.remove('d-none');
            } else {
                chartTable.classList.add('d-none');
            }
        }
    });
</script>
@endsection

