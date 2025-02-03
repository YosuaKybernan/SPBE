@extends('admin.frontend.auth')

@section('title', 'Admin SPBE - Akun Dibuat')

@section('content')
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="{{ url('/admin/signup') }}" class="logo d-flex align-items-center w-auto">
                                <span class="d-none d-lg-block">Akun Dibuat</span>
                            </a>
                        </div><!-- End Logo -->
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title fs-4">Selamat, {{ $name }}!</h5>
                                    <p class="card-text">Akun dengan username <strong>{{ $username }}</strong> berhasil
                                        dibuat.</p>
                                    <p class="card-text">Anda akan diarahkan ke halaman login dalam <span
                                            id="countdown">5</span> detik.</p>
                                    <p class="card-text"><a href="{{ url('/admin/login') }}">Klik disini</a> jika tidak
                                        diarahkan secara otomatis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');
        setInterval(() => {
            if (countdown > 0) {
                countdown--;
                countdownElement.textContent = countdown;
            } else {
                window.location.href = "{{ url('/admin/login') }}";
            }
        }, 1000);
    </script>
@endsection
