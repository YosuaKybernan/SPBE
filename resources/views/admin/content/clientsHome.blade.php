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
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-10">
                                <h5 class="card-title" id="cardTitle">Daftar Konten</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                            </div>
                        </div>

                        <form id="createForm" action="{{ route('admin.storeHomeContent') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Judul Konten</th>
                                        <th>Deskripsi Konten</th>
                                        <th>Unggah Gambar Baru</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="title" class="form-control w-100"></td>
                                        <td><textarea name="description" class="form-control w-100" style="resize: none; height: auto;"></textarea></td>
                                        <td><input class="form-control w-100" type="file" name="image"></td>
                                        <td><button type="submit" class="btn btn-primary">Unggah Konten</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Unggah Gambar Baru</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slides as $slide)
                                <form class="editForm" action="{{ route('admin.updateHomeContent', $slide->id) }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                    @csrf
                                    @method('POST')
                                    <tr>
                                        <td><img src="{{ asset('storage/'.$slide->image) }}" class="img-fluid" style="max-height: 100px; object-fit: contain;"></td>
                                        <td><input type="text" class="form-control w-100" name="title" value="{{ $slide->title }}"></td>
                                        <td><textarea class="form-control w-100" name="description" style="resize: none; height: auto;">{{ $slide->description }}</textarea></td>
                                        <td><input type="file" class="form-control w-100" name="image"></td>
                                        <td class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary" name="action" value="update">Ubah</button>
                                            <button type="submit" class="btn btn-danger" name="action" value="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus konten ini?');">Hapus</button>
                                        </td>
                                    </tr>
                                </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
