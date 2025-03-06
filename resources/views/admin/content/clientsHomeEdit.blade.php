@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Beranda Klien')

@section('page-title')
    Klien - Beranda Edit
@endsection

@section('content-section')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="row mb-3 align-items-center">
                            <div class="col-sm-10">
                                <h5 class="card-title" id="cardTitle">Daftar Konten</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                                <button id="createButton" class="btn btn-warning">Create</button>
                            </div>
                        </div>

                        <div class="row mb-3" id="createForm" style="display: none;">
                            <form action="{{ route('admin.storeHomeContent') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Judul Konten</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Konten</label>
                                    <textarea class="form-control" name="description" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Unggah Gambar</label>
                                    <input class="form-control" type="file" name="image" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary">Unggah Konten</button>
                                <button type="button" class="btn btn-secondary" id="cancelCreate">Batal</button>
                            </form>
                        </div> --}}

                        <div class="mt-4">
                            <form class="editForm mb-4" action="{{ route('admin.updateHomeContent', $dataslide->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="title" value="{{ $dataslide->title }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="description" style="resize: none; height: auto;">{{ $dataslide->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gambar Saat Ini</label>
                                    <div>
                                        <img src="{{ asset('storage/'.$dataslide->image) }}" class="img-fluid" style="max-height: 100px; object-fit: contain;">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Unggah Gambar Baru</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Link</label>
                                    <input type="text" class="form-control" name="image" value="{{$dataslide->link}}">
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary" name="action" value="update">Ubah</button>
                                    <a type="submit" class="btn btn-danger" name="action" value="delete" href="{{route('slide_home')}}">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById("createButton").addEventListener("click", function() {
            document.getElementById("createForm").style.display = "block";
            document.getElementById("contentTable").style.display = "none";
        });

        document.getElementById("cancelCreate").addEventListener("click", function() {
            document.getElementById("createForm").style.display = "none";
            document.getElementById("contentTable").style.display = "block";
        });
    </script>

@endsection
