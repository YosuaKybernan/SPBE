@extends('clients.layouts.master')

@section('title', 'Artikel SPBE')

@section('additional-style')
    <style>
        /* Optional: Customize DataTables styles if needed */
    </style>
@endsection

@section('content-body')
    <main id="main">
        <!-- ======= Article Section ======= -->
        <section id="article" class="about mt-5">
            <div class="container mt-5" data-aos="fade-up">
                <div class="section-title">
                    <h2>Artikel SPBE</h2>
                </div>
                <div class="row content">
                    <div class="col-lg-12">
                        <!-- Table with stripped rows -->
                        <table id="articlesTable" class="display">
                            <thead>
                                <tr>
                                    <th>Judul Artikel</th>
                                    <th>Kategori</th>
                                    <th>Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td><a href="{{ route('article', $article->id) }}">{{ $article->title }}</a></td>
                                        <td>{{ $article->category }}</td>
                                        <td>{{ \Carbon\Carbon::parse($article->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') }}
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
            $('#articlesTable').DataTable();
        });
    </script>
@endsection
