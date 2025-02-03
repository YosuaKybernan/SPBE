@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Klien - Domain')

@section('page-title')
    Klien - Domain
@endsection

@section('content-section')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-10">
                                <h5 class="card-title" id="cardTitle">Buat Aspek Domain SPBE</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                                <!-- Switches di sini -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Mode Edit</label>
                                </div>
                            </div>
                        </div>
                        <form id="createForm">
                            <div class="row mb-3 px-2">
                                <select class="form-select" aria-label="selectDomain" id="domainSelect"
                                    onchange="togglePlaceholder()">
                                    <option disabled selected hidden>Tentukan domain yang ingin dibuat</option>
                                    <option value="1">Kebijakan SPBE</option>
                                    <option value="2">Tata Kelola SPBE</option>
                                    <option value="3">Manajemen SPBE</option>
                                    <option value="4">Layanan SPBE</option>
                                </select>
                            </div>
                            <div class="row mb-3">
                                <label for="inputAspect" class="col-sm-2 col-form-label">Nama Aspek</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputAspect">
                                </div>
                            </div>

                            <div id="indikatorContainer">
                                <!-- Row Indikator akan generate disini -->
                            </div>

                            <div class="row mb-3" id="tambahIndikatorRow">
                                <div class="col-sm-12 text-end">
                                    <button type="button" class="btn btn-primary" onclick="addAdditionalInput()">Tambah
                                        Indikator</button>
                                </div>
                            </div>

                            <div class="row mb-3" id="submitButtonRow">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                        <!-- Form untuk mode edit -->
                        <form id="editForm" style="display: none;">
                            <div class="row mb-1 px-2">
                                <select class="form-select" aria-label="Domain Select" id="domainSelect"
                                    onchange="togglePlaceholder(), toggleIndicatorSelectVisibility()">
                                    <option disabled selected hidden>Tentukan domain yang ingin diubah</option>
                                    <option value="1">Kebijakan SPBE</option>
                                    <option value="2">Tata Kelola SPBE</option>
                                    <option value="3">Manajemen SPBE</option>
                                    <option value="4">Layanan SPBE</option>
                                </select>
                            </div>
                            <div class="row mb-3 px-2" id="indicatorSelectRow" style="display: none;">
                                <select class="form-select mb-3" aria-label="Indicator Select" id="indicatorSelect"
                                    onchange="togglePlaceholder()">
                                    <option disabled selected hidden>Tentukan indikator yang ingin diubah</option>
                                    <option value="1">Indikator 1 : Kebijakan Internal Arsitektur SPBE Pemerintah
                                        Daerah</option>
                                    <option value="2">Indikator 2 : Kebijakan Internal Peta Rencana SPBE Pemerintah
                                        Daerah</option>
                                    <option value="3">Indikator 3 : Kebijakan Internal Manajemen Data</option>
                                    <option value="4">Indikator 4 : Kebijakan Internal Pembangunan Aplikasi SPBE
                                    </option>
                                    <option value="5">Indikator 5 : Kebijakan Internal Layanan Pusat Data</option>
                                    <option value="6">Indikator 6 : Kebijakan Internal Layanan Jaringan Intra
                                        Pemerintah Daerah</option>
                                    <option value="7">Indikator 7 : Kebijakan Internal Penggunaan Sistem Penghubung
                                        Layanan Pemerintah Daerah</option>
                                    <option value="8">Indikator 8 : Kebijakan Internal Manajemen Keamanan Informasi
                                    </option>
                                    <option value="9">Indikator 9 : Kebijakan Internal Audit TIK</option>
                                    <option value="10">Indikator 10 : Kebijakan Internal Tim Koordinasi SPBE
                                        Pemerintah Daerah</option>
                                </select>
                                <button class="btn btn-danger" type="button" id="deleteButton">Hapus
                                    Indikator</button>
                            </div>
                            <div id="editDomainDetail">
                                <div class="row mb-3">
                                    <label for="editIndicatorTitle" class="col-sm-2 col-form-label">Nama
                                        Indikator</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="editIndicatorTitle">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="editIndicatorDescription" class="col-sm-2 col-form-label">Deskripsi
                                        Indikator</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Isi deskripsi indikator di sini..." id="editIndicatorDescription"
                                            rows="5"></textarea>
                                    </div>
                                </div>
                                <!-- Penjelasan Indikator -->
                                <div class="row mb-3">
                                    <label for="editIndicatorExplanation" class="col-sm-2 col-form-label">Penjelasan
                                        Indikator</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Isi penjelasan indikator di sini..." id="editIndicatorExplanation"
                                            rows="5"></textarea>
                                    </div>
                                </div>

                                <!-- Penjelasan Penilaian -->
                                <div class="row mb-3">
                                    <label for="editAssessmentDescription" class="col-sm-2 col-form-label">Penjelasan
                                        Penilaian</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Isi penjelasan penilaian di sini..." id="editAssessmentDescription"
                                            rows="5"></textarea>
                                    </div>
                                </div>

                                <!-- Penjelasan Bukti Dukung -->
                                <div class="row mb-3">
                                    <label for="editEvidenceDescription" class="col-sm-2 col-form-label">Penjelasan
                                        Bukti Dukung</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Isi penjelasan bukti dukung di sini..." id="editEvidenceDescription"
                                            rows="5"></textarea>
                                    </div>
                                </div>

                                <!-- Level 1 -->
                                <div class="row mb-3">
                                    <label for="editLevel1" class="col-sm-2 col-form-label">Level 1</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Isi level 1 di sini..." id="editLevel1" rows="5"></textarea>
                                    </div>
                                </div>

                                <!-- Level 2 -->
                                <div class="row mb-3">
                                    <label for="editLevel2" class="col-sm-2 col-form-label">Level 2</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Isi level 2 di sini..." id="editLevel2" rows="5"></textarea>
                                    </div>
                                </div>

                                <!-- Level 3 -->
                                <div class="row mb-3">
                                    <label for="editLevel3" class="col-sm-2 col-form-label">Level 3</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Isi level 3 di sini..." id="editLevel3" rows="5"></textarea>
                                    </div>
                                </div>

                                <!-- Level 4 -->
                                <div class="row mb-3">
                                    <label for="editLevel4" class="col-sm-2 col-form-label">Level 4</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Isi level 4 di sini..." id="editLevel4" rows="5"></textarea>
                                    </div>
                                </div>

                                <!-- Level 5 -->
                                <div class="row mb-3">
                                    <label for="editLevel5" class="col-sm-2 col-form-label">Level 5</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Isi level 5 di sini..." id="editLevel5" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12 text-center">
                                    <button class="btn btn-primary" type="button" id="submitEditButton">Submit
                                        Perubahan</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

    <script>
        // Toggle/Switch Edit Mode
        document.addEventListener("DOMContentLoaded", function() {
            const switchElement = document.getElementById("flexSwitchCheckDefault");
            const createForm = document.getElementById("createForm");
            const editForm = document.getElementById("editForm");
            const submitButtonRow = document.getElementById("submitButtonRow");
            const cardTitle = document.getElementById("cardTitle");

            switchElement.addEventListener("change", function() {
                if (this.checked) {
                    createForm.style.display = "none";
                    editForm.style.display = "block";
                    submitButtonRow.style.display = "none";
                    cardTitle.innerText = "Ubah Aspek Domain SPBE";
                } else {
                    createForm.style.display = "block";
                    editForm.style.display = "none";
                    submitButtonRow.style.display = "block";
                    cardTitle.innerText = "Buat Aspek Domain SPBE";
                }
            });
        });

        // Placeholder Select Domain
        function togglePlaceholder() {
            var selectElement = document.getElementById("domainSelect");
            var placeholderOption = selectElement.getElementsByTagName("option")[0];
            if (placeholderOption.selected) {
                placeholderOption.style.display = "none";
            } else {
                placeholderOption.style.display = "block";
            }
        }

        // Fungsi untuk mengatur visibilitas dropdown edit mode
        function toggleIndicatorSelectVisibility() {
            var domainSelect = document.getElementById("domainSelect");
            var indicatorSelectRow = document.getElementById("indicatorSelectRow");

            if (domainSelect.value !== "") {
                indicatorSelectRow.style.display = "block";
            } else {
                indicatorSelectRow.style.display = "none";
            }
        }

        // Fungsi untuk mengatur visibilitas tombol hapus
        function toggleDeleteButtonVisibility() {
            var selectElement = document.getElementById("indicatorSelect");
            var deleteButton = document.getElementById("deleteButton");

            // Periksa apakah opsi indikator yang dipilih bukan yang pertama (opsi default)
            if (selectElement.selectedIndex !== 0) {
                deleteButton.style.display = "block"; // Tampilkan tombol hapus
            } else {
                deleteButton.style.display = "none"; // Sembunyikan tombol hapus
            }
        }

        // Fungsi untuk mengatur visibilitas Edit Detail
        document.addEventListener("DOMContentLoaded", function() {
            const indicatorSelect = document.getElementById("indicatorSelect");
            const editDomainDetail = document.getElementById("editDomainDetail");

            // Sembunyikan #editDomainDetail saat halaman dimuat
            editDomainDetail.style.display = "none";

            // Tambahkan event listener untuk perubahan pada select indikator
            indicatorSelect.addEventListener("change", function() {
                if (this.value !== "") {
                    // Jika indikator dipilih, tampilkan #editDomainDetail
                    editDomainDetail.style.display = "block";
                } else {
                    // Jika tidak ada indikator yang dipilih, sembunyikan #editDomainDetail
                    editDomainDetail.style.display = "none";
                }
            });
        });


        // Panggil fungsi toggleDeleteButtonVisibility setiap kali nilai diubah pada select
        document.getElementById("indicatorSelect").addEventListener("change", toggleDeleteButtonVisibility);

        // Panggil fungsi toggleDeleteButtonVisibility saat halaman dimuat untuk menentukan visibilitas awal
        toggleDeleteButtonVisibility();

        // Initialize indikatorCount
        var indikatorCount = 1;

        function addAdditionalInput() {
            var indikatorContainer = document.getElementById("indikatorContainer");

            // Membuat elemen div untuk indikator baru
            var newIndicatorRow = document.createElement("div");
            newIndicatorRow.innerHTML = `
                <div class="row mb-3" id="Indicator${indikatorCount}">
                    <div class="col-sm-2">
                        <label class="col-form-label">Indikator ${indikatorCount}</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#indicatorDetail_${indikatorCount}">
                                Detail Indikator
                            </button>
                            <button class="btn btn-danger" type="button">Hapus Indikator</button>
                        </div>
                    </div>
                </div>`;

            // Menambahkan indikator baru ke dalam container
            indikatorContainer.appendChild(newIndicatorRow);

            // Membuat elemen modal detail indikator
            var modalDetail = document.createElement("div");
            modalDetail.innerHTML = `
                <div id="indicatorDetail_${indikatorCount}" class="modal fade" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Indikator ${indikatorCount}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="accordion" id="accIndicatorDetail_${indikatorCount}">
                                        <div class="accordion-item"> <!-- Deskripsi Indikator -->
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#indicatorDescription${indikatorCount}" aria-expanded="true" aria-controls="inputIndicatorDescription">
                                                    Deskripsi Indikator
                                                </button>
                                            </h2>
                                            <div id="indicatorDescription${indikatorCount}" class="accordion-collapse collapse show" data-bs-parent="#accIndicatorDetail_${indikatorCount}">
                                                <div class="accordion-body">
                                                    <textarea class="form-control" placeholder="Isi deskripsi indikator di sini..." id="inputIndicatorDescription${indikatorCount}" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item"> <!-- Penjelasan Indikator -->
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#indicatorExplanation${indikatorCount}" aria-expanded="false" aria-controls="inputIndicatorExplanation">
                                                    Penjelasan Indikator
                                                </button>
                                            </h2>
                                            <div id="indicatorExplanation${indikatorCount}" class="accordion-collapse collapse" data-bs-parent="#accIndicatorDetail_${indikatorCount}">
                                                <div class="accordion-body">
                                                    <textarea class="form-control" placeholder="Isi penjelasan indikator di sini..." id="inputIndicatorExplanation${indikatorCount}" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item"> <!-- Penjelasan Penilaian -->
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#assessmentExplanation${indikatorCount}" aria-expanded="false" aria-controls="inputAssessmentExplanation">
                                                    Penjelasan Penilaian
                                                </button>
                                            </h2>
                                            <div id="assessmentExplanation${indikatorCount}" class="accordion-collapse collapse" data-bs-parent="#accIndicatorDetail_${indikatorCount}">
                                                <div class="accordion-body">
                                                    <textarea class="form-control" placeholder="Isi penjelasan penilaian di sini..." id="inputAssessmentExplanation${indikatorCount}" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item"> <!-- Penjelasan Bukti Dukung -->
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#supportingEvidenceExplanation${indikatorCount}" aria-expanded="false" aria-controls="inputSupportingEvidenceExplanation">
                                                    Penjelasan Bukti Dukung
                                                </button>
                                            </h2>
                                            <div id="supportingEvidenceExplanation${indikatorCount}" class="accordion-collapse collapse" data-bs-parent="#accIndicatorDetail_${indikatorCount}">
                                                <div class="accordion-body">
                                                    <textarea class="form-control" placeholder="Isi penjelasan bukti dukung di sini..." id="inputSupportingEvidenceExplanation${indikatorCount}" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item"> <!-- Level 1 -->
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#level1_${indikatorCount}" aria-expanded="false" aria-controls="level1">
                                                    Level 1
                                                </button>
                                            </h2>
                                            <div id="level1_${indikatorCount}" class="accordion-collapse collapse" data-bs-parent="#accIndicatorDetail_${indikatorCount}">
                                                <div class="accordion-body">
                                                    <textarea class="form-control" placeholder="Isi level 1 di sini..." id="inputLevel1_${indikatorCount}" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item"> <!-- Level 2 -->
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#level2_${indikatorCount}" aria-expanded="false" aria-controls="level2">
                                                    Level 2
                                                </button>
                                            </h2>
                                            <div id="level2_${indikatorCount}" class="accordion-collapse collapse" data-bs-parent="#accIndicatorDetail_${indikatorCount}">
                                                <div class="accordion-body">
                                                    <textarea class="form-control" placeholder="Isi level 2 di sini..." id="inputLevel2_${indikatorCount}" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item"> <!-- Level 3 -->
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#level3_${indikatorCount}" aria-expanded="false" aria-controls="level3">
                                                    Level 3
                                                </button>
                                            </h2>
                                            <div id="level3_${indikatorCount}" class="accordion-collapse collapse" data-bs-parent="#accIndicatorDetail_${indikatorCount}">
                                                <div class="accordion-body">
                                                    <textarea class="form-control" placeholder="Isi level 3 di sini..." id="inputLevel3_${indikatorCount}" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item"> <!-- Level 4 -->
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#level4_${indikatorCount}" aria-expanded="false" aria-controls="level4">
                                                    Level 4
                                                </button>
                                            </h2>
                                            <div id="level4_${indikatorCount}" class="accordion-collapse collapse" data-bs-parent="#accIndicatorDetail_${indikatorCount}">
                                                <div class="accordion-body">
                                                    <textarea class="form-control" placeholder="Isi level 4 di sini..." id="inputLevel4_${indikatorCount}" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item"> <!-- Level 5 -->
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#level5_${indikatorCount}" aria-expanded="false" aria-controls="level5">
                                                    Level 5
                                                </button>
                                            </h2>
                                            <div id="level5_${indikatorCount}" class="accordion-collapse collapse" data-bs-parent="#accIndicatorDetail_${indikatorCount}">
                                                <div class="accordion-body">
                                                    <textarea class="form-control" placeholder="Isi level 5 di sini..." id="inputLevel5_${indikatorCount}" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>`;

            // Menambahkan modal detail indikator ke dalam body
            document.body.appendChild(modalDetail);

            // Menambahkan 1 ke jumlah indikator
            indikatorCount++;
        }

        function showModal(indicatorId) {
            // Mengganti ID modal sesuai dengan ID indikator
            var modalId = "indicatorDetail_" + indicatorId.slice(-1); // Mendapatkan angka terakhir dari ID indikator
            var modal = document.getElementById(modalId);
            var modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
        }

        // Fungsi untuk menghapus indikator
        function removeIndicator(indicatorRow) {
            // Hapus baris indikator dari container
            indicatorRow.remove();
            // Kurangi 1 dari jumlah indikator
            indikatorCount--;
        }
    </script>
@endsection
