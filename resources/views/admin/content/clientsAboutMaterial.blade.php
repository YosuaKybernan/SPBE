@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Klien - Tentang Material')

@section('page-title')
    Klien - Tentang Material
@endsection

@section('content-section')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-10">
                                <h5 class="card-title" id="cardTitle">Tentang Material</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                                <button id="createMaterialButton" class="btn btn-warning">Unggah Materi</button>
                            </div>
                        </div>

                        <div class="row mb-3" id="createMaterialForm" style="display: none;">
                            <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama Materi</label>
                                    <input type="text" class="form-control" name="name" required> <!-- Mengubah title menjadi name -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Unggah Materi</label>
                                    <input class="form-control" type="file" name="file" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Unggah Materi</button>
                                <button type="button" class="btn btn-secondary" id="cancelCreateMaterial">Batal</button>
                            </form>
                        </div>

                        <div class="row mb-3" id="materialList">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Dokumen</th>
                                        <th scope="col">Tanggal Dibuat</th>
                                        <th scope="col">Terakhir Diubah</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materials as $material)
                                        <tr>
                                            <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                            <td class="align-middle">{{ $material->name }}</td> <!-- Mengubah title menjadi name -->
                                            <td class="align-middle">
                                                {{ $material->created_at ? \Carbon\Carbon::parse($material->created_at)->format('d-m-Y') : '-' }}
                                            </td>
                                            <td class="align-middle">
                                                {{ optional($material->updated_at)->format('d-m-Y') ?? '-' }}
                                            </td>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editMaterialModal{{ $material->id }}">Ubah Detail</button>
                                                <form action="{{ route('materials.destroy', $material->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus materi ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editMaterialModal{{ $material->id }}" tabindex="-1" aria-labelledby="editMaterialModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Materi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
    
                                                            @csrf
                                                            @method('PUT') <!-- Mengubah dari POST ke PUT -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Materi</label>
                                                                <input type="text" class="form-control" name="name" value="{{ $material->name }}" required> <!-- Mengubah title menjadi name -->
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Unggah Materi</label>
                                                                <input class="form-control" type="file" name="file">
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
        document.getElementById("createMaterialButton").addEventListener("click", function() {
            document.getElementById("createMaterialForm").style.display = "block";
            document.getElementById("materialList").style.display = "none";
        });

        document.getElementById("cancelCreateMaterial").addEventListener("click", function() {
            document.getElementById("createMaterialForm").style.display = "none";
            document.getElementById("materialList").style.display = "block";
        });
    </script>
@endsection
