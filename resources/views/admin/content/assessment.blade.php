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
                                <a href="{{ url('/admin/tugas-penilaian-mandiri/buat') }}"><button
                                        class="btn btn-primary btn-sm">Unggah Dokumen Penilaian</button>
                                </a>
                            </div>
                        </div>

                        {{-- Read/Edit Form --}}
                        <form id="readForm">
                            <div class="row mb-3 px-2">
                                <div class="mb-3">
                                    <select class="form-select" id="formSelect" aria-label="Default select example">
                                        <option disabled selected hidden>Pilih ID Form</option>
                                        @foreach ($dashboardAssessments as $assessment)
                                            <option value="{{ $assessment->id }}">
                                                ({{ $assessment->form_id }})
                                                {{ $assessment->form_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <table class="table w-100 form-detail">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-start">
                                                <h4>Detail Form</h4>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="assessmentDetails">
                                        <tr>
                                            <th class="col-2">Tahun</th>
                                            <td class="col" id="yearCell">-</td>
                                        </tr>
                                        <tr>
                                            <th class="col-2">Nama Form</th>
                                            <td class="col" id="formNameCell">-</td>
                                        </tr>
                                        <tr>
                                            <th class="col-2">Deskripsi</th>
                                            <td class="col" id="descriptionCell">-</td>
                                        </tr>
                                        <tr>
                                            <th class="col-2">Status Evaluasi</th>
                                            <td class="col" id="evaluationStatusCell">-</td>
                                        </tr>
                                        <tr>
                                            <td class="py-4" colspan="2">
                                                <button class="btn btn-primary btn-sm" id="viewScoreBtn">Lihat Skor
                                                    Indeks</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table w-100 indicator-data">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="text-start">
                                                <h4>Data Indikator</h4>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="indicatorData" class="align-middle">
                                        <!-- Indicators will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
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
        document.getElementById('formSelect').addEventListener('change', function() {
            const formId = this.value;
            fetch(`/admin/assessment-details/${formId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('yearCell').innerText = data.dashboardAssessment.year;
                    document.getElementById('formNameCell').innerText = data.dashboardAssessment.form_name;
                    document.getElementById('descriptionCell').innerText = data.dashboardAssessment.description;
                    document.getElementById('evaluationStatusCell').innerText = data.dashboardAssessment
                        .evaluation_status;

                    const indicatorTable = document.getElementById('indicatorData');
                    indicatorTable.innerHTML = '';
                    data.aspects.forEach(aspect => {
                        const aspectRow = `
                            <tr>
                                <th colspan="3" class="text-start">
                                    <h5>${aspect.title}</h5>
                                </th>
                            </tr>`;
                        indicatorTable.innerHTML += aspectRow;
                        aspect.indicators.forEach((indicator, index) => {
                            const row = `
                                <tr>
                                    <th class="col-1">${index + 1}</th>
                                    <td class="col-9">${indicator.label}</td>
                                    <td class="col-2">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#indicatorModal${indicator.id}">
                                            Lihat Detail
                                        </button>
                                        <div class="modal fade" id="indicatorModal${indicator.id}" tabindex="-1"
                                            aria-labelledby="indicatorModalLabel${indicator.id}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="indicatorModalLabel${indicator.id}">
                                                            ${indicator.label}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="indicatorForm${indicator.id}">
                                                            <!-- Levels and description inputs -->
                                                            <div class="mb-3">
                                                                <label for="level${indicator.id}" class="form-label">Level</label>
                                                                <select class="form-select" id="level${indicator.id}" name="level">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description${indicator.id}" class="form-label">Deskripsi</label>
                                                                <input type="text" class="form-control" id="description${indicator.id}" name="description" value="${indicator.description}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="support${indicator.id}" class="form-label">Bukti/Dokumen Pendukung</label>
                                                                <input type="file" class="form-control" id="support${indicator.id}" name="support">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" onclick="saveIndicator(${indicator.id})">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>`;
                            indicatorTable.innerHTML += row;
                        });
                    });
                });
        });

        function saveIndicator(indicatorId) {
            const form = document.getElementById(`indicatorForm${indicatorId}`);
            const formData = new FormData(form);
            fetch(`/admin/update-indicator/${indicatorId}`, {
                    method: 'POST',
                    body: formData,
                }).then(response => response.json())
                .then(data => {
                    alert(data.message);
                });
        }
    </script>
@endsection
