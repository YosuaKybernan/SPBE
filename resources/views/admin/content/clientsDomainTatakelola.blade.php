@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Klien - Domain Tatakelola')

@section('page-title')
    Klien - Domain Tatakelola
@endsection

@section('content-section')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-10">
                                <h5 class="card-title" id="cardTitle">Daftar Domain Tatakelola</h5>
                            </div>
                            <div class="col-sm-2 text-end">
                                <button id="createButton" class="btn btn-warning">Create</button>
                            </div>
                        </div>

                        <!-- Form untuk Create Domain Tatakelola -->
                        <div class="row mb-3" id="createForm" style="display: none;">
                            <form action="{{ route('admin.domain.tatakelola.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama Aspek</label>
                                    <input type="text" class="form-control" name="aspect_name" required>
                                </div>
                                <div id="indicatorFields">
                                    <div class="mb-3">
                                        <label class="form-label">Indikator</label>
                                        <input type="text" class="form-control" name="indicators[]" required>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary" id="addIndicator">Tambah Indikator</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" id="cancelCreate">Batal</button>
                            </form>
                        </div>

                        <!-- Daftar Domain Tatakelola -->
                        <div class="row mb-3" id="domainList">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Aspek</th>
                                        <th scope="col">Indikator</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($domains as $domain)
                                        <tr>
                                            <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                            <td class="align-middle">{{ $domain->aspect_name }}</td>
                                            <td class="align-middle">
                                                <ul>
                                                    @foreach (json_decode($domain->indicators) as $index => $indicator)
                                                        <li>Indikator {{ $index + 1 }}: {{ $indicator }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editDomainModal{{ $domain->id }}">Ubah</button>
                                                <form action="{{ route('admin.domain.tatakelola.delete', $domain->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus aspek ini?')">Hapus</button>
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

    <!-- Modal Edit Domain Tatakelola -->
    @foreach ($domains as $domain)
    <div class="modal fade" id="editDomainModal{{ $domain->id }}" tabindex="-1" aria-labelledby="editDomainModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDomainModalLabel">Ubah Domain Tatakelola</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.domain.tatakelola.update', $domain->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Menggunakan method PUT untuk update -->
                        <div class="mb-3">
                            <label class="form-label">Nama Aspek</label>
                            <input type="text" class="form-control" name="aspect_name" value="{{ $domain->aspect_name }}" required>
                        </div>
                        <div id="indicatorFields{{ $domain->id }}">
                            @foreach (json_decode($domain->indicators) as $indicator)
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="indicators[]" value="{{ $indicator }}" required>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    <script>
        // Menampilkan form Create
        document.getElementById("createButton").addEventListener("click", function() {
            document.getElementById("createForm").style.display = "block";
            document.getElementById("domainList").style.display = "none";
        });
    
        // Membatalkan form Create
        document.getElementById("cancelCreate").addEventListener("click", function() {
            document.getElementById("createForm").style.display = "none";
            document.getElementById("domainList").style.display = "block";
        });
    
        // Menambah indikator baru di form Create dengan nomor otomatis
        let indicatorCount = 1;
        document.getElementById("addIndicator").addEventListener("click", function() {
            indicatorCount++;
            let indicatorField = document.createElement("div");
            indicatorField.classList.add("mb-3");
            indicatorField.innerHTML = `
                <label class="form-label">Indikator ${indicatorCount}</label>
                <input type="text" class="form-control" name="indicators[]" required>
            `;
            document.getElementById("indicatorFields").appendChild(indicatorField);
        });
    
        // Menambah indikator baru di modal Edit dengan nomor otomatis
        @foreach ($domains as $domain)
            let indicatorCountEdit{{ $domain->id }} = {{ count(json_decode($domain->indicators)) }};
            document.getElementById("addIndicatorEdit{{ $domain->id }}").addEventListener("click", function() {
                indicatorCountEdit{{ $domain->id }}++;
                let indicatorField = document.createElement("div");
                indicatorField.classList.add("mb-3");
                indicatorField.innerHTML = `
                    <label class="form-label">Indikator ${indicatorCountEdit{{ $domain->id }}}</label>
                    <input type="text" class="form-control" name="indicators[]" required>
                `;
                document.getElementById("indicatorFields{{ $domain->id }}").appendChild(indicatorField);
            });
        @endforeach
    </script>
    
@endsection
