@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Klien - Tentang Regulasi')

@section('page-title')
    Klien - Tentang Regulasi
@endsection

@section('content-section')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-10">
                                <h5 class="card-title" id="cardTitle">Tentang Regulasi</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                                <button id="createRegulationButton" class="btn btn-warning">Unggah Regulasi</button>
                            </div>
                        </div>

                        <div class="row mb-3" id="createRegulationForm" style="display: none;">
                            <form action="{{ route('regulations.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Kategori Regulasi</label>
                                    <select class="form-control" name="category" required>
                                        <option disabled selected hidden>Pilih opsi regulasi disini</option>
                                        <option value="1">Peraturan Presiden</option>
                                        <option value="2">Peraturan Menteri</option>
                                        <option value="3">Keputusan Menteri</option>
                                        <option value="4">Surat Edaran Menteri</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Judul Regulasi</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Unggah Regulasi</label>
                                    <input class="form-control" type="file" name="file" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Unggah Regulasi</button>
                                <button type="button" class="btn btn-secondary" id="cancelCreateRegulation">Batal</button>
                            </form>
                        </div>

                        <div class="row mb-3" id="regulationList">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Tanggal Dibuat</th>
                                        <th scope="col">Terakhir Diubah</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $categories = [
                                            1 => 'Peraturan Presiden',
                                            2 => 'Peraturan Menteri',
                                            3 => 'Keputusan Menteri',
                                            4 => 'Surat Edaran Menteri'
                                        ];
                                    @endphp
                                    @foreach ($regulations as $regulation)
                                        <tr>
                                            <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                            <td class="align-middle">{{ $categories[$regulation->category] ?? 'Tidak Diketahui' }}</td>
                                            <td class="align-middle">{{ $regulation->title }}</td>
                                            <td class="align-middle">
                                                {{ $regulation->created_at ? \Carbon\Carbon::parse($regulation->created_at)->format('d-m-Y') : '-' }}
                                            </td>
                                            <td class="align-middle">
                                                {{ optional($regulation->updated_at)->format('d-m-Y') ?? '-' }}
                                            </td>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRegulationModal{{ $regulation->id }}">Ubah Detail</button>
                                                <form action="{{ route('regulations.destroy', $regulation->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus regulasi ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editRegulationModal{{ $regulation->id }}" tabindex="-1" aria-labelledby="editRegulationModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Regulasi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('regulations.update', $regulation->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label class="form-label">Kategori Regulasi</label>
                                                                <select class="form-control" name="category" required>
                                                                    @foreach ($categories as $key => $value)
                                                                        <option value="{{ $key }}" {{ $regulation->category == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Judul Regulasi</label>
                                                                <input type="text" class="form-control" name="title" value="{{ $regulation->title }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Unggah Regulasi</label>
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
        document.getElementById("createRegulationButton").addEventListener("click", function() {
            document.getElementById("createRegulationForm").style.display = "block";
            document.getElementById("regulationList").style.display = "none";
        });

        document.getElementById("cancelCreateRegulation").addEventListener("click", function() {
            document.getElementById("createRegulationForm").style.display = "none";
            document.getElementById("regulationList").style.display = "block";
        });
    </script>
@endsection
