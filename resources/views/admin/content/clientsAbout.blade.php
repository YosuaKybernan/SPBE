@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Klien - Tentang')

@section('page-title')
    Klien - Tentang
@endsection

@section('content-section')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-10">
                                <h5 class="card-title" id="cardTitle">Tentang SPBE</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                                <!-- Switches di sini -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Mode Edit</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <form action="{{ route('clientsAbout.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3 px-2">
                                    <select class="form-select" aria-label="selectOption" id="optionSelect" name="type" onchange="togglePlaceholder()" required>
                                        <option disabled selected hidden>Pilih opsi disini</option>
                                        <option value="material">Materi SPBE</option>
                                        <option value="regulation">Regulasi SPBE</option>
                                    </select>
                                </div>
                            
                                <!-- FORM MATERIAL -->
                                <div class="row mb-3" id="spbeMaterial" style="display: none;">
                                    <div class="row mb-3">
                                        <label for="inputMaterialName" class="col-sm-3 col-form-label">Nama Materi</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="material_name" id="inputMaterialName" placeholder="Berikan nama materi disini...">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputMaterialFile" class="col-sm-3 col-form-label">Unggah Materi SPBE</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" name="material_file" id="inputMaterialFile">
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- FORM REGULATION -->
                                <div class="row mb-3" id="spbeRegulation" style="display: none;">
                                    <div class="row mb-3">
                                        <label for="regulationSelect" class="col-sm-3 col-form-label">Pilih Regulasi SPBE</label>
                                        <div class="col-sm-9">
                                            <select class="form-select" name="regulation_category" id="regulationSelect">
                                                <option disabled selected hidden>Pilih opsi regulasi disini</option>
                                                <option value="Peraturan Presiden">Peraturan Presiden</option>
                                                <option value="Peraturan Menteri">Peraturan Menteri</option>
                                                <option value="Keputusan Menteri">Keputusan Menteri</option>
                                                <option value="Surat Edaran Menteri">Surat Edaran Menteri</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputRegulationFile" class="col-sm-3 col-form-label">Unggah Regulasi SPBE</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" name="regulation_file" id="inputRegulationFile">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputRegulationTitle" class="col-sm-3 col-form-label">Nama Regulasi</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="regulation_title" id="inputRegulationTitle" placeholder="Berikan nama regulasi disini...">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary">Unggah</button>
                                    </div>
                                </div>
                            </form>
                            
                            <script>
                                function togglePlaceholder() {
                                    let selectOption = document.getElementById("optionSelect").value;
                                    document.getElementById("spbeMaterial").style.display = (selectOption === "material") ? "block" : "none";
                                    document.getElementById("spbeRegulation").style.display = (selectOption === "regulation") ? "block" : "none";
                                }
                            </script>
                            
                            <form action="{{ route('clientsAbout.update', $material->id ?? $regulations->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3 px-2">
                                    <select class="form-select" aria-label="selectEditOption" id="optionSelectEdit"
                                        onchange="togglePlaceholder()">
                                        <option disabled selected hidden>Pilih opsi disini</option>
                                        <option value="1">Materi SPBE</option>
                                        <option value="2">Regulasi SPBE</option>
                                    </select>
                                </div>
                                <div class="row mb-3" id="editSpbeMaterial" style="display: none;">
                                    <div class="row mb-3">
                                        <!-- Edit Materi SPBE -->
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>Nama Dokumen</th>
                                                    <th data-type="date" data-format="YYYY/DD/MM">Tanggal Dibuat
                                                    </th>
                                                    <th data-type="date" data-format="YYYY/DD/MM">Terakhir Diubah
                                                    </th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Dokumen 1</td>
                                                    <td>2005/02/11</td>
                                                    <td>1999/04/07</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editMaterialModal">Ubah
                                                            Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Dokumen 2</td>
                                                    <td>2006/03/12</td>
                                                    <td>2000/05/08</td>
                                                    <td><button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editMaterialModal">Ubah
                                                            Detail</button></td>
                                                </tr>
                                                <div class="modal fade" id="editMaterialModal" tabindex="-1"
                                                    aria-labelledby="editMaterialModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="editMaterialModalLabel">
                                                                    Ubah Materi SPBE</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <label for="inputTitle"
                                                                        class="col-sm-3 col-form-label">Nama
                                                                        Materi</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control"
                                                                            id="inputTitle"
                                                                            placeholder="Berikan nama materi disini...">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="inputMaterialFile"
                                                                        class="col-sm-3 col-form-label">Unggah
                                                                        Materi
                                                                        SPBE</label>
                                                                    <div class="col-sm-9">
                                                                        <input class="form-control" type="file"
                                                                            id="inputMaterialFile">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mb-3" id="editSpbeRegulation" style="display: none;">
                                    <!-- Edit Regulasi SPBE -->
                                    <div class="row mb-3">
                                        <label for="regulationSelect" class="col-sm-3 col-form-label">Pilih Regulasi
                                            SPBE</label>
                                        <div class="col-sm-9">
                                            <select class="form-select" aria-label="selectRegulation"
                                                id="regulationSelect">
                                                <option disabled selected hidden>Pilih opsi regulasi disini</option>
                                                <option value="1">Peraturan Presiden</option>
                                                <option value="2">Peraturan Menteri</option>
                                                <option value="3">Keputusan Menteri</option>
                                                <option value="4">Surat Edaran Menteri</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <table class="table datatable" id="editRegulationTable">
                                            <thead>
                                                <tr>
                                                    <th>Nama Regulasi</th>
                                                    <th data-type="date" data-format="YYYY/DD/MM">Tanggal Dibuat
                                                    </th>
                                                    <th data-type="date" data-format="YYYY/DD/MM">Terakhir Diubah
                                                    </th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Regulasi 1</td>
                                                    <td>2005/02/11</td>
                                                    <td>1999/04/07</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editRegulationModal">Ubah
                                                            Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Regulasi 2</td>
                                                    <td>2006/03/12</td>
                                                    <td>2000/05/08</td>
                                                    <td><button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editRegulationModal">Ubah
                                                            Detail</button></td>
                                                </tr>
                                                <div class="modal fade" id="editRegulationModal" tabindex="-1"
                                                    aria-labelledby="editRegulationModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="editRegulationModalLabel">
                                                                    Ubah Regulasi SPBE</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <label for="inputTitle"
                                                                        class="col-sm-3 col-form-label">Nama
                                                                        Regulasi</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control"
                                                                            id="inputTitle"
                                                                            placeholder="Berikan nama regulasi disini...">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="inputRegulationFile"
                                                                        class="col-sm-3 col-form-label">Unggah
                                                                        Regulasi
                                                                        SPBE</label>
                                                                    <div class="col-sm-9">
                                                                        <input class="form-control" type="file"
                                                                            id="inputRegulationFile">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    {{-- Additional Scripts --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const switchElement = document.getElementById("flexSwitchCheckDefault");
            const createForm = document.getElementById("createAbout");
            const editForm = document.getElementById("editAbout");
            const cardTitle = document.getElementById("cardTitle");

            switchElement.addEventListener("change", function() {
                if (this.checked) {
                    createForm.style.display = "none";
                    editForm.style.display = "block";
                    cardTitle.innerText = "Ubah Tentang SPBE";
                } else {
                    createForm.style.display = "block";
                    editForm.style.display = "none";
                    cardTitle.innerText = "Tentang SPBE";
                }
            });
        });

        document.getElementById('optionSelect').addEventListener('change', function() {
            var selectedOption = this.value;
            var spbeMaterial = document.getElementById('spbeMaterial');
            var spbeRegulation = document.getElementById('spbeRegulation');

            if (selectedOption == '1') {
                spbeMaterial.style.display = 'block';
                spbeRegulation.style.display = 'none';
            } else if (selectedOption == '2') {
                spbeMaterial.style.display = 'none';
                spbeRegulation.style.display = 'block';
            } else {
                spbeMaterial.style.display = 'none';
                spbeRegulation.style.display = 'none';
            }
        });

        document.getElementById('optionSelectEdit').addEventListener('change', function() {
            var selectedOption = this.value;
            var editSpbeMaterial = document.getElementById('editSpbeMaterial');
            var editSpbeRegulation = document.getElementById('editSpbeRegulation');

            if (selectedOption == '1') {
                editSpbeMaterial.style.display = 'block';
                editSpbeRegulation.style.display = 'none';
            } else if (selectedOption == '2') {
                editSpbeMaterial.style.display = 'none';
                editSpbeRegulation.style.display = 'block';
            } else {
                editSpbeMaterial.style.display = 'none';
                editSpbeRegulation.style.display = 'none';
            }
        });
    </script>
@endsection
