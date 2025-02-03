@extends('admin.frontend.auth')

@section('title', 'Admin SPBE - Login')

@section('content')
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="{{ url('/admin/login') }}" class="logo d-flex align-items-center w-auto">
                                <span class="d-none d-lg-block">Masuk - Admin SPBE</span>
                            </a>
                        </div><!-- End Logo -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Masuk Dashboard Admin SPBE</h5>
                                </div>
                                <form id="loginForm" class="row g-3 needs-validation" novalidate>
                                    <div class="col-12">
                                        <label for="yourUsernameOrEmail" class="form-label">Username atau Email</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="username_or_email" class="form-control"
                                                id="yourUsernameOrEmail" required>
                                            <div class="invalid-feedback">Tolong masukkan username atau email anda!</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword"
                                            required>
                                        <div class="invalid-feedback">Tolong masukkan password anda!</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true"
                                                id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Ingat saya</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Masuk</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Belum punya akun? <a href="{{ url('/admin/signup') }}">Buat
                                                akun</a></p>
                                    </div>
                                </form>
                                <div class="alert alert-danger mt-3 d-none" id="loginAlert"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('additional-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const loginAlert = document.getElementById('loginAlert');

            loginForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const usernameOrEmail = document.getElementById('yourUsernameOrEmail').value;
                const password = document.getElementById('yourPassword').value;

                fetch('{{ url('/admin/login') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            username_or_email: usernameOrEmail,
                            password: password
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = "{{ url('/admin/') }}";
                        } else {
                            loginAlert.textContent = data.message;
                            loginAlert.classList.remove('d-none');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        loginAlert.textContent = 'Terjadi kesalahan, silakan coba lagi.';
                        loginAlert.classList.remove('d-none');
                    });
            });
        });
    </script>
@endsection
