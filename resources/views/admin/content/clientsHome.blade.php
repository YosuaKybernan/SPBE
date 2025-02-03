@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Beranda Klien')

@section('page-title')
    Klien - Beranda
@endsection

@section('content-section')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Form Create Landing Page Content -->
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-10">
                                <h5 class="card-title" id="cardTitle">Buat Konten Terbaru</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                                <!-- Switch untuk mengubah mode -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Mode Edit</label>
                                </div>
                            </div>
                        </div>

                        <!-- Form untuk Menyimpan Konten Baru -->
                        <form id="createForm" action="{{ route('admin.storeHomeContent') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputTitle" class="col-sm-2 col-form-label">Judul Konten</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDescription" class="col-sm-2 col-form-label">Deskripsi Konten</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputImage" class="col-sm-2 col-form-label">Unggah Gambar</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="image" id="formFile">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary">Unggah Konten</button>
                                </div>
                            </div>
                        </form>

                        <!-- Menampilkan Semua Konten -->
                        @foreach($slides as $slide)
                        <!-- Satu form untuk Simpan & Hapus -->
                        <form class="editForm" action="{{ route('admin.updateHomeContent', $slide->id) }}" method="POST" enctype="multipart/form-data" style="display: none;">
                            @csrf
                            @method('POST')

                            <div class="row mb-3" id="cardGrid">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <div class="row mb-3">
                                                <img src="{{ asset('storage/'.$slide->image) }}" class="img-fluid" alt="..." style="max-height: 400px; object-fit: contain;">
                                            </div>
                                            <div class="row mb-3">
                                                <label for="editTitle" class="col-sm-3 col-form-label">Judul Konten</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="editTitle" name="title" value="{{ $slide->title }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="editDesc" class="col-sm-3 col-form-label">Deskripsi Konten</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id="editDesc" rows="2" name="description">{{ $slide->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="editImage" class="col-sm-3 col-form-label">Ganti Gambar</label>
                                                <div class="col-sm-9">
                                                    <input type="file" class="form-control" id="editImage" name="image">
                                                </div>
                                            </div>

                                            <div class="row mb-3 text-center">
                                                <div class="col-sm-6 d-grid">
                                                    <button type="submit" class="btn btn-primary" name="action" value="update">Simpan Perubahan</button>
                                                </div>
                                                <div class="col-sm-6 d-grid">
                                                    <button type="submit" class="btn btn-danger" name="action" value="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus konten ini?');">Hapus Konten</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Toggle Edit Mode
        document.addEventListener("DOMContentLoaded", function() {
            const switchElement = document.getElementById("flexSwitchCheckDefault");
            const cardTitle = document.getElementById("cardTitle");
            const createForm = document.getElementById("createForm");
            const editForms = document.querySelectorAll(".editForm"); // Ambil semua form edit

            // Fungsi untuk update tampilan sesuai mode edit
            function updateView() {
                if (switchElement.checked) {
                    // Mode Edit Aktif: Tampilkan form edit, sembunyikan form create
                    cardTitle.textContent = "Ubah Konten";
                    createForm.style.display = "none";
                    editForms.forEach(form => {
                        form.style.display = "block";
                    });
                } else {
                    // Mode Edit Tidak Aktif: Tampilkan form create, sembunyikan form edit
                    cardTitle.textContent = "Buat Konten Terbaru";
                    createForm.style.display = "block";
                    editForms.forEach(form => {
                        form.style.display = "none";
                    });
                }
            }

            // Jalankan fungsi saat switch diubah
            switchElement.addEventListener("change", updateView);

            // Pastikan tampilan awal sesuai dengan posisi switch
            updateView();
        });
    </script>
@endsection
