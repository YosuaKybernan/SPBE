@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Klien - Artikel')

@section('page-title')
    Klien - Artikel
@endsection

@section('content-section')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-10">
                                <h5 class="card-title" id="cardTitle">Buat Artikel SPBE</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Mode Edit</label>
                                </div>
                            </div>
                        </div>

                        <!-- Form untuk membuat artikel -->
                        <div class="row mb-3" id="createForm">
                            {{-- memanggil route untuk menyinpan article dan mengisi article ke koneksi databasenya --}}
                            <form action="{{ route('clients.article.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputTitle" class="col-sm-2 col-form-label">Judul Konten</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title"
                                            placeholder="Berikan judul artikel disini..." required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputCategory" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="category"
                                            placeholder="Berikan kategori disini..." required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputImage" class="col-sm-2 col-form-label">Unggah Sampul Artikel</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="image" accept="image/*">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputSrcAlt" class="col-sm-2 col-form-label">Keterangan dan Sumber Gambar</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="image_source"
                                            placeholder="Berikan keterangan dan sumber gambar disini...">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputContent" class="col-sm-2 col-form-label">Isi Artikel</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="content" rows="5"
                                            placeholder="Berikan isi artikel disini..." required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary">Unggah Artikel</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Tabel daftar artikel untuk mode edit -->
                        <div class="row mb-3" id="editForm" style="display: none;">
                            <table class="table" id="articleList">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Terakhir Diubah</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                            <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                            <td class="align-middle">{{ $article->title }}</td>
                                            <td class="align-middle">{{ $article->category }}</td>
                                            <td class="align-middle">
                                                {{ $article->updated_at ? $article->updated_at->format('d-m-Y') : '-' }}
                                            </td>
                                            <td class="align-middle">
                                                <!-- Tombol Edit -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editArticleModal{{ $article->id }}">
                                                    Ubah Detail
                                                </button>

                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="editArticleModal{{ $article->id }}"
                                                    tabindex="-1" aria-labelledby="editArticleLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <form
                                                                action="{{ route('clients.article.update', $article->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editArticleLabel">Ubah
                                                                        Detail Artikel</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <label for="editTitle"
                                                                            class="col-sm-2 col-form-label">Judul
                                                                            Konten</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" class="form-control"
                                                                                name="title"
                                                                                value="{{ $article->title }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="editCategory"
                                                                            class="col-sm-2 col-form-label">Kategori</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" class="form-control"
                                                                                name="category"
                                                                                value="{{ $article->category }}"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="editImage"
                                                                            class="col-sm-2 col-form-label">Unggah Sampul</label>
                                                                        <div class="col-sm-10">
                                                                            <input class="form-control" type="file"
                                                                                name="image" accept="image/*">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="editImageSource"
                                                                            class="col-sm-2 col-form-label">Keterangan Gambar</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" class="form-control"
                                                                                name="image_source"
                                                                                value="{{ $article->image_source }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="editContent"
                                                                            class="col-sm-2 col-form-label">Isi
                                                                            Artikel</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea class="form-control" name="content" rows="5"
                                                                                required>{{ $article->content }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan
                                                                        Perubahan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tombol Hapus -->
                                                <form
                                                    action="{{ route('clients.article.delete', $article->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Script untuk Switch Mode --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const switchElement = document.getElementById("flexSwitchCheckDefault");
            const createForm = document.getElementById("createForm");
            const editForm = document.getElementById("editForm");
            const cardTitle = document.getElementById("cardTitle");

            switchElement.addEventListener("change", function() {
                if (this.checked) {
                    createForm.style.display = "none";
                    editForm.style.display = "block";
                    cardTitle.innerText = "Ubah Artikel SPBE";
                } else {
                    createForm.style.display = "block";
                    editForm.style.display = "none";
                    cardTitle.innerText = "Buat Artikel SPBE";
                }
            });
        });
    </script>
@endsection
