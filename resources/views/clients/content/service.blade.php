@extends('clients.layouts.master')

@section('title', 'SPBE - Layanan SPBE')

@section('additional-style')

@endsection

@section('content-body')
    <main id="main">
        <!-- ======= Governance Domain Section ======= -->
        <section id="service" class="about mt-5">
            <div class="container mt-5" data-aos="fade-up">
                <div class="section-title">
                    <h2>Domain Layanan SPBE</h2>
                </div>
                <div class="row content">
                    <div class="col-lg-12">
                        <div class="accordion" id="accordionService">
                            @foreach ($aspects as $index => $aspect)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseServiceAspect{{ $index + 2 }}" aria-expanded="false"
                                            aria-controls="collapseServiceAspect{{ $index + 2 }}"
                                            style="font-size: 20px; font-weight: 500">
                                            {{ $aspect['title'] }}
                                        </button>
                                    </h2>
                                    <div id="collapseServiceAspect{{ $index + 2 }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionService">
                                        <div class="accordion-body">
                                            @foreach ($aspect['indicators'] as $link)
                                                <a href="javascript:void(0);" data-title="{{ $link['label'] }}"
                                                    data-description="{{ $link['description'] }}"
                                                    data-assessment="{{ $link['assessment'] }}"
                                                    data-support="{{ $link['support'] }}"
                                                    data-levels="{{ json_encode($link['levels']) }}"
                                                    class="text-dark open-modal">{{ $link['label'] }}</a>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Modal --}}
                        @include('clients.partials.modal')
                    </div>
                </div>
            </div>
        </section>
        <!-- End Policy Domain Section -->
    </main>
@endsection

@section('additional-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('indicatorModal'), {
                keyboard: false
            });

            document.querySelectorAll('.open-modal').forEach(function(element) {
                element.addEventListener('click', function() {
                    var title = this.getAttribute('data-title');
                    var description = this.getAttribute('data-description');
                    var assessment = this.getAttribute('data-assessment');
                    var support = this.getAttribute('data-support');
                    var levels = JSON.parse(this.getAttribute('data-levels'));

                    document.getElementById('modalTitle').innerText = title;
                    document.getElementById('modalDescription').innerText = description;
                    document.getElementById('modalAssessment').innerText = assessment;
                    document.getElementById('modalSupport').innerText = support;

                    for (var i = 0; i < levels.length; i++) {
                        document.getElementById('modalLevel' + (i + 1)).innerText = levels[i]
                            .description;
                    }

                    modal.show();
                });
            });
        });
    </script>
@endsection