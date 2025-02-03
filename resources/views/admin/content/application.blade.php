@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Aplikasi')

@section('page-title')
    Aplikasi SPBE
@endsection

@section('content-section')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-10">
                                <h5 class="card-title" id="cardTitle">Tambahkan Daftar Aplikasi</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                                <!-- Switches di sini -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Mode Edit</label>
                                </div>
                            </div>
                        </div>
                        <form id="createForm" class="px-2">
                            <div class="row mb-3">
                                <label for="inputAppName" class="col-sm-2 col-form-label">Nama Aplikasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputAppName" name="appName">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputOwner" class="col-sm-2 col-form-label">SKPD Pemilik Aplikasi</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="selectSKPD" id="skpdSelect"
                                        onchange="toggleInputField()">
                                        <option disabled selected hidden>Tentukan SKPD pemilik aplikasi</option>
                                        @foreach ($skpdOptions as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                        <option value="new">Tambahkan pemilik baru</option>
                                    </select>
                                    <input type="text" class="form-control mt-3" id="newSKPDInput" style="display: none;"
                                        placeholder="Masukkan SKPD baru" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputService" class="col-sm-2 col-form-label">Jenis Layanan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="selectService" id="serviceSelect"
                                        onchange="toggleInputField('serviceSelect', 'newServiceInput')">
                                        <option disabled selected hidden>Tentukan Jenis Layanan</option>
                                        @foreach ($serviceOptions as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control mt-3" id="newServiceInput"
                                        style="display: none;" placeholder="Masukkan jenis layanan baru" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputSpec" class="col-sm-2 col-form-label">Spesifikasi Layanan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSpec">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputAddress" class="col-sm-2 col-form-label">Alamat Website</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputAddress">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPIC" class="col-sm-2 col-form-label">Nama PIC</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPIC">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhone" class="col-sm-2 col-form-label">Kontak WA</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPhone">
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
                            <!-- Add your edit form content here -->
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
                    cardTitle.innerText = "Ubah Aspek SKPD SPBE";
                } else {
                    createForm.style.display = "block";
                    editForm.style.display = "none";
                    submitButtonRow.style.display = "block";
                    cardTitle.innerText = "Buat Aspek SKPD SPBE";
                }
            });

            // Form submission handler
            createForm.addEventListener("submit", function(e) {
                e.preventDefault();
                const appName = document.getElementById("inputAppName").value;
                const skpdSelect = document.getElementById("skpdSelect");
                const skpdValue = skpdSelect.value;
                const newSKPDInput = document.getElementById("newSKPDInput").value;
                const serviceSelect = document.getElementById("serviceSelect");
                const serviceValue = serviceSelect.value;
                const newServiceInput = document.getElementById("newServiceInput").value;

                const data = {
                    appName: appName,
                    skpdValue: skpdValue,
                    newSKPDInput: newSKPDInput,
                    serviceValue: serviceValue,
                    newServiceInput: newServiceInput
                };

                fetch("{{ route('admin.application.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(data)
                }).then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error("Something went wrong");
                    }
                }).then(data => {
                    // Handle the response data
                    console.log(data);
                }).catch(error => {
                    console.error(error);
                });
            });
        });

        function toggleInputField() {
            const skpdSelect = document.getElementById("skpdSelect");
            const newSKPDInput = document.getElementById("newSKPDInput");

            if (skpdSelect.value === "new") {
                newSKPDInput.style.display = "block";
            } else {
                newSKPDInput.style.display = "none";
            }
        }
    </script>
@endsection
