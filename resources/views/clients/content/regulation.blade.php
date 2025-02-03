@extends('clients.layouts.master')

@section('title', 'Regulasi SPBE')

@section('additional-style')
@endsection

@section('content-body')
    <main id="main">
        <!-- ======= Regulation Section ======= -->
        <section id="regulation" class="about mt-5">
            <div class="container mt-5" data-aos="fade-up">
                <div class="section-title">
                    <h2>Regulasi SPBE</h2>
                </div>
                <div class="row content">
                    <div class="col-lg-12">
                        <div class="accordion" id="accordionRegulation">

                            {{-- Loop through each category --}}
                            @foreach ($regulations as $category => $items)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ str_replace(' ', '_', strtolower($category)) }}"
                                            aria-expanded="false"
                                            aria-controls="collapse{{ str_replace(' ', '_', strtolower($category)) }}"
                                            style="font-size: 20px; font-weight: 500">
                                            {{ $category }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ str_replace(' ', '_', strtolower($category)) }}"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ str_replace(' ', '_', strtolower($category)) }}">
                                        <div class="accordion-body">
                                            <ul>
                                                {{-- Loop through each regulation --}}
                                                @foreach ($items as $regulation)
                                                    <li><a href="{{ asset($regulation->file_path) }}"
                                                            target="_blank">{{ $regulation->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Regulation Section -->
    </main>
@endsection

@section('additional-scripts')
    <script>
        // Initialize all collapsed accordions
        var accordions = document.querySelectorAll('.accordion-collapse');
        accordions.forEach(function(accordion) {
            new bootstrap.Collapse(accordion, {
                toggle: false
            });
        });
    </script>
@endsection
