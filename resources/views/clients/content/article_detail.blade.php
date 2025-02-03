@extends('clients.layouts.master')

@section('title', $article->title)

@section('additional-style')
    <style>
        .image-container {
            width: 1280px;
            height: 720px;
            position: relative;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-content p {
            text-align: justify;
        }

        .image-source {
            text-align: center;
        }

        .back-link {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content-body')
    <main id="main">
        <!-- ======= Article Details Section ======= -->
        <section id="article" class="about mt-5">
            <div class="container mt-5" data-aos="fade-up">
                <div class="section-title">
                    <h2>{{ $article->title }}</h2>
                    <p>{{ \Carbon\Carbon::parse($article->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY, HH:mm') }}
                    </p>
                </div>
                <div class="row content">
                    <div class="col-lg-12">
                        <p class="back-link"><a href="{{ url('/artikel-spbe') }}">
                                < Kembali</a>
                        </p>
                        <div class="card">
                            <div class="card-body article-content">
                                <div class="image-container">
                                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}">
                                </div>
                                <p class="image-source"><em>{{ $article->image_source }}</em></p>
                                <hr>
                                <p>{{ $article->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Article Detail Section -->
    </main>
@endsection

@section('additional-scripts')
@endsection
