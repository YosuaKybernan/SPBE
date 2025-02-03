@extends('clients.layouts.master')

@section('title', 'Materi SPBE')

@section('additional-style')
    <style>
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection

@section('content-body')
    <main id="main">
        <!-- ======= Material Section ======= -->
        <section id="material" class="about mt-5">
            <div class="container mt-5" data-aos="fade-up">
                <div class="section-title">
                    <h2>Materi SPBE</h2>
                </div>
                <div class="row content">
                    <div class="col-lg-12">
                        <!-- Table with stripped rows -->
                        <table id="materialTable" class="display">
                            <thead>
                                <tr>
                                    <th style="width: 90%;">Nama Dokumen</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materials as $material)
                                    <tr>
                                        <td>
                                            <strong>{{ $material->name }}</strong><br>
                                            <small>Dibuat pada
                                                {{ \Carbon\Carbon::parse($material->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') }}</small>
                                        </td>
                                        <td class="center-content">
                                            <a href="{{ asset($material->download_link) }}"
                                                class="btn btn-primary">Unduh</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End Article Section -->
    </main>
@endsection

@section('additional-scripts')
    <script>
        $(document).ready(function() {
            $('#materialTable').DataTable();
        });
    </script>
@endsection
