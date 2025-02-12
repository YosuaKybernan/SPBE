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
                                <h5 class="card-title" id="cardTitle">Daftar Artikel SPBE</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                                <button id="createButton" class="btn btn-warning">Create</button>
                            </div>
                        </div>

                        <div class="row mb-3" id="createForm" style="display: none;">
                            <form action="{{ route('clients.article.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <input type="text" class="form-control" name="category" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Unggah Sampul</label>
                                    <input class="form-control" type="file" name="image" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Keterangan dan Sumber Gambar</label>
                                    <input type="text" class="form-control" name="image_source">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Isi Artikel</label>
                                    <textarea class="form-control" name="content" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Unggah Artikel</button>
                                <button type="button" class="btn btn-secondary" id="cancelCreate">Batal</button>
                            </form>
                        </div>

                        <div class="row mb-3" id="articleList">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
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
                                            <td class="align-middle">{{ $article->updated_at ? $article->updated_at->format('d-m-Y') : '-' }}</td>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editArticleModal{{ $article->id }}">Ubah Detail</button>
                                                <form action="{{ route('clients.article.delete', $article->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editArticleModal{{ $article->id }}" tabindex="-1" aria-labelledby="editArticleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Artikel</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('clients.article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="POST">
                                                            <div class="mb-3">
                                                                <label class="form-label">Judul</label>
                                                                <input type="text" class="form-control" name="title" value="{{ $article->title }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kategori</label>
                                                                <input type="text" class="form-control" name="category" value="{{ $article->category }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Unggah Sampul</label>
                                                                <input class="form-control" type="file" name="image" accept="image/*">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Keterangan dan Sumber Gambar</label>
                                                                <input type="text" class="form-control" name="image_source" value="{{ $article->image_source }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Isi Artikel</label>
                                                                <textarea class="form-control" name="content" rows="5" required>{{ $article->content }}</textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById("createButton").addEventListener("click", function() {
            document.getElementById("createForm").style.display = "block";
            document.getElementById("articleList").style.display = "none";
        });

        document.getElementById("cancelCreate").addEventListener("click", function() {
            document.getElementById("createForm").style.display = "none";
            document.getElementById("articleList").style.display = "block";
        });
    </script>
@endsection