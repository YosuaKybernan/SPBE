@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Tugas Penilaian Mandiri')

@section('page-title')
    Tugas Penilaian Mandiri
@endsection

@section('breadcrumb-active')
    Tugas Penilaian Mandiri
@endsection

@section('content-section')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-8">
                                <h5 class="card-title" id="cardTitle">Lihat Penilaian</h5>
                            </div>
                            <div class="col-sm-4 text-end">
                                <a href="{{ url('/admin/tugas-penilaian-mandiri') }}"><button
                                        class="btn btn-primary btn-sm">Lihat Dokumen Penilaian</button>
                                </a>
                            </div>
                        </div>

                        {{-- Create Form --}}
                        <form id="createForm">
                            <div class="row mb-3">
                                <label for="inputYear" class="col-sm-3 col-form-label">Tahun</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputYear" placeholder="Masukkan Tahun">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-3 col-form-label">Nama Form</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputName"
                                        placeholder="Masukkan Nama Form">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDesc" class="col-sm-3 col-form-label">Deskripsi Form</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputDesc"
                                        placeholder="Masukkan Deskripsi Form">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="uploadFile" class="col-sm-3 col-form-label">Unggah Dokumen Penilaian</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" id="uploadFile">
                                    <small id="fileWarning" class="text-danger d-none">Hanya bisa format excel</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <canvas id="radarChart" style="max-height: 400px; max-width: 400px"></canvas>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary">Unggah Dokumen</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

    <style>
        .btn-small {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
            font: inherit;
            cursor: pointer;
            color: inherit;
        }
    </style>
@endsection

@section('additional-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"
        integrity="sha512-r22gChDnGvBylk90+2e/ycr3RVrDi8DIOkIGNhJlKfuyQM4tIRAI062MaV8sfjQKYVGjOBaZBOA87z+IhZE9DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // Upload Excel Format Only
        document.addEventListener("DOMContentLoaded", function() {
            const uploadFileInput = document.getElementById('uploadFile');
            const fileWarning = document.getElementById('fileWarning');

            uploadFileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const validExtensions = [
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                ];

                if (file && !validExtensions.includes(file.type)) {
                    // Show warning
                    fileWarning.classList.remove('d-none');

                    // Clear the input
                    uploadFileInput.value = '';
                } else {
                    // Hide warning
                    fileWarning.classList.add('d-none');
                }
            });
        });

        // Upload Excel
        document.addEventListener("DOMContentLoaded", function() {
            const uploadFileInput = document.getElementById('uploadFile');
            const fileWarning = document.getElementById('fileWarning');
            const chartContainer = document.getElementById('radarChart').getContext('2d');

            let radarChart;

            uploadFileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const validExtensions = [
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                ];

                if (file && validExtensions.includes(file.type)) {
                    fileWarning.classList.add('d-none');
                    readExcelFile(file);
                } else {
                    fileWarning.classList.remove('d-none');
                    uploadFileInput.value = '';
                }
            });

            function readExcelFile(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });

                    const firstSheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[firstSheetName];

                    const selectedCells = [
                        'D11', 'D13', 'D14', 'D15',
                        'D17', 'D18', 'D20', 'D21'
                    ];

                    const json = selectedCells.map(cell => {
                        return {
                            cell,
                            value: worksheet[cell] ? worksheet[cell].v : 0
                        };
                    });

                    createChart(json);
                };
                reader.readAsArrayBuffer(file);
            }

            function createChart(data) {
                const labels = [
                    'Kebijakan Internal terkait Tata Kelola SPBE',
                    'Perencanaan Strategis SPBE',
                    'Teknologi Informasi dan Komunikasi',
                    'Penyelenggara SPBE',
                    'Penerapan Manajemen SPBE',
                    'Audit TIK',
                    'Layanan Administrasi Pemerintahan Berbasis Elektronik',
                    'Layanan Publik Berbasis Elektronik'
                ];

                const chartData = data.map(item => item.value);

                if (radarChart) {
                    radarChart.destroy();
                }

                radarChart = new Chart(chartContainer, {
                    type: 'radar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Hasil Penilaian',
                            data: chartData,
                            fill: true,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgb(54, 162, 235)',
                            pointBackgroundColor: 'rgb(54, 162, 235)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgb(54, 162, 235)'
                        }]
                    },
                    options: {
                        elements: {
                            line: {
                                borderWidth: 3
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
