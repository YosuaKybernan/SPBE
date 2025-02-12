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
                            <h5 class="card-title">Daftar Aplikasi SPBE</h5>
                        </div>
                        <div class="col-sm-2 text-end">
                            <button id="createAppButton" class="btn btn-warning">Tambah Aplikasi</button>
                        </div>
                    </div>

                    <div id="createAppForm" style="display: none;">
                        <form action="{{ route('applications.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Aplikasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_aplikasi" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">SKPD Pemilik</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="skpd_pemilik" required>
                                        <option disabled selected>Pilih SKPD</option>
                                        @foreach ($skpdOptions as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Layanan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="jenis_layanan" required>
                                        <option disabled selected>Pilih Jenis Layanan</option>
                                        @foreach ($serviceOptions as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Spesifikasi Layanan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="spesifikasi_layanan">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Alamat Website</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat_website">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama PIC</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_pic" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kontak WA</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kontak_wa" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <button type="button" class="btn btn-secondary" id="cancelCreateApp">Batal</button>
                        </form>
                    </div>

                    <div id="appTableContainer">
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Aplikasi</th>
                                <th>SKPD Pemilik</th>
                                <th>Jenis Layanan</th>
                                <th>Spesifikasi</th>
                                <th>Alamat Website</th>
                                <th>PIC</th>
                                <th>Kontak WA</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aplikasi as $app)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $app->nama_aplikasi }}</td>
                                    <td>{{ $app->skpd_pemilik }}</td>
                                    <td>{{ $app->jenis_layanan }}</td>
                                    <td>{{ $app->spesifikasi_layanan }}</td>
                                    <td><a href="{{ $app->alamat_website }}" target="_blank">{{ $app->alamat_website }}</a></td>
                                    <td>{{ $app->nama_pic }}</td>
                                    <td>{{ $app->kontak_wa }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAppModal{{ $app->id }}">Edit</button>
                                        <form action="{{ route('applications.destroy', $app->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus aplikasi ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    @foreach ($aplikasi as $app)
                    <div class="modal fade" id="editAppModal{{ $app->id }}" tabindex="-1" aria-labelledby="editAppModalLabel{{ $app->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editAppModalLabel{{ $app->id }}">Edit Aplikasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('applications.update', $app->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @foreach ([
                                            'nama_aplikasi' => 'Nama Aplikasi',
                                            'spesifikasi_layanan' => 'Spesifikasi Layanan',
                                            'alamat_website' => 'Alamat Website',
                                            'nama_pic' => 'Nama PIC',
                                            'kontak_wa' => 'Kontak WA'
                                        ] as $name => $label)
                                        <div class="mb-3">
                                            <label class="form-label">{{ $label }}</label>
                                            <input type="text" class="form-control" name="{{ $name }}" value="{{ $app->$name }}" required>
                                        </div>
                                        @endforeach
                                        <div class="mb-3">
                                            <label class="form-label">SKPD Pemilik</label>
                                            <select class="form-select" name="skpd_pemilik" required>
                                                @foreach ($skpdOptions as $value)
                                                    <option value="{{ $value }}" {{ $app->skpd_pemilik == $value ? 'selected' : '' }}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Layanan</label>
                                            <select class="form-select" name="jenis_layanan" required>
                                                @foreach ($serviceOptions as $value)
                                                    <option value="{{ $value }}" {{ $app->jenis_layanan == $value ? 'selected' : '' }}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script>
        document.getElementById("createAppButton").addEventListener("click", function() {
        document.getElementById("createAppForm").style.display = "block"; // Tampilkan form
        document.getElementById("appTableContainer").style.display = "none"; // Sembunyikan tabel
    });

    document.getElementById("cancelCreateApp").addEventListener("click", function() {
        document.getElementById("createAppForm").style.display = "none"; // Sembunyikan form
        document.getElementById("appTableContainer").style.display = "block"; // Tampilkan tabel
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".deleteAppForm").forEach(form => {
            form.addEventListener("submit", function(event) {
                event.preventDefault();
                if (confirm("Yakin ingin menghapus aplikasi ini?")) {
                    fetch(this.action, {
                        method: "POST",
                        body: new FormData(this),
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            alert(data.message);
                            location.reload(); // Refresh halaman setelah sukses
                        } else {
                            alert("Gagal menghapus aplikasi.");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection