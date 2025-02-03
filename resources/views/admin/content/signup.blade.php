@extends('admin.frontend.auth')

@section('title', 'Admin SPBE - Signup')

@section('content')
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="{{ url('/admin/signup') }}" class="logo d-flex align-items-center w-auto">
                                <span class="d-none d-lg-block">Daftar - Admin SPBE</span>
                            </a>
                        </div><!-- End Logo -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Buat Akun Baru</h5>
                                </div>
                                <form method="POST" action="{{ url('/admin/signup') }}" class="row g-3 needs-validation"
                                    novalidate>
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" id="yourName"
                                            value="{{ old('name') }}" required>
                                        <div class="invalid-feedback">Tolong masukkan nama lengkap anda!</div>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="yourEmail"
                                            value="{{ old('email') }}" required>
                                        <div class="invalid-feedback">Tolong masukkan email valid anda!</div>
                                        <small id="emailFeedback" class="form-text"></small>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="yourUsername"
                                            value="{{ old('username') }}" required>
                                        <div class="invalid-feedback">Tolong buat username anda!</div>
                                        <small id="usernameFeedback" class="form-text"></small>
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control" id="yourPassword"
                                                required>
                                            <span class="input-group-text" id="togglePassword">
                                                <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                        <div class="invalid-feedback">Tolong buat password anda!</div>
                                        <small id="passwordFeedback" class="form-text"></small>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPasswordConfirm" class="form-label">Ulangi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="yourPasswordConfirm" required disabled>
                                        <div class="invalid-feedback">Tolong ulangi password anda!</div>
                                        <small id="passwordConfirmFeedback" class="form-text"></small>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox" value=""
                                                id="acceptTerms" required disabled>
                                            <label class="form-check-label" for="acceptTerms" id="termsLabel">Saya setuju
                                                dan menerima <a href="#">syarat dan ketentuan</a></label>
                                            <div class="invalid-feedback">Anda harus menyetujui sebelum mengirim.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit" id="submitBtn" disabled>Buat
                                            Akun</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Sudah punya akun? <a
                                                href="{{ url('/admin/login') }}">Masuk</a></p>
                                    </div>
                                </form>
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
            const nameInput = document.getElementById('yourName');
            const emailInput = document.getElementById('yourEmail');
            const usernameInput = document.getElementById('yourUsername');
            const passwordInput = document.getElementById('yourPassword');
            const passwordConfirmInput = document.getElementById('yourPasswordConfirm');
            const termsCheckbox = document.getElementById('acceptTerms');
            const submitBtn = document.getElementById('submitBtn');
            const emailFeedback = document.getElementById('emailFeedback');
            const usernameFeedback = document.getElementById('usernameFeedback');
            const passwordFeedback = document.getElementById('passwordFeedback');
            const passwordConfirmFeedback = document.getElementById('passwordConfirmFeedback');
            const togglePassword = document.getElementById('togglePassword');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');

            function validateForm() {
                const isFormValid = document.querySelector('.needs-validation').checkValidity();
                termsCheckbox.disabled = !isFormValid;
                if (termsCheckbox.checked && isFormValid) {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }
            }

            nameInput.addEventListener('input', function() {
                if (nameInput.value) {
                    nameInput.classList.remove('is-invalid');
                    nameInput.classList.add('is-valid');
                } else {
                    nameInput.classList.remove('is-valid');
                }
                validateForm();
            });

            emailInput.addEventListener('input', function() {
                const email = emailInput.value;
                const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                if (email && emailValid) {
                    fetch(`{{ url('/admin/check-email') }}?email=${email}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.exists) {
                                emailInput.setCustomValidity('Email sudah terdaftar.');
                                emailFeedback.textContent = 'Email sudah terdaftar.';
                                emailFeedback.classList.add('text-danger');
                                emailInput.classList.add('is-invalid');
                            } else {
                                emailInput.setCustomValidity('');
                                emailFeedback.textContent = '';
                                emailFeedback.classList.remove('text-danger');
                                emailInput.classList.remove('is-invalid');
                                emailInput.classList.add('is-valid');
                            }
                            validateForm();
                        });
                } else {
                    emailInput.setCustomValidity('Email tidak valid.');
                    emailFeedback.textContent = 'Email tidak valid.';
                    emailFeedback.classList.add('text-danger');
                    emailInput.classList.add('is-invalid');
                    emailInput.classList.remove('is-valid');
                    validateForm();
                }
            });

            usernameInput.addEventListener('input', function() {
                usernameInput.value = usernameInput.value.toLowerCase();
                const username = usernameInput.value;
                const usernameValid = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]+$/.test(username);
                if (username && usernameValid) {
                    fetch(`{{ url('/admin/check-username') }}?username=${username}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.exists) {
                                usernameInput.setCustomValidity('Username sudah digunakan.');
                                usernameFeedback.textContent = 'Username sudah digunakan.';
                                usernameFeedback.classList.add('text-danger');
                                usernameInput.classList.add('is-invalid');
                            } else {
                                usernameInput.setCustomValidity('');
                                usernameFeedback.textContent = '';
                                usernameFeedback.classList.remove('text-danger');
                                usernameInput.classList.remove('is-invalid');
                                usernameInput.classList.add('is-valid');
                            }
                            validateForm();
                        });
                } else {
                    usernameInput.setCustomValidity('Username tidak valid.');
                    usernameFeedback.textContent = 'Username tidak valid.';
                    usernameFeedback.classList.add('text-danger');
                    usernameInput.classList.add('is-invalid');
                    usernameInput.classList.remove('is-valid');
                    validateForm();
                }
            });

            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                if (password.length > 16) {
                    passwordInput.value = password.substring(0, 16);
                }
                if (password.length < 8) {
                    passwordFeedback.textContent = 'Password kurang dari 8 karakter.';
                    passwordFeedback.classList.add('text-danger');
                    passwordInput.classList.add('is-invalid');
                    passwordConfirmInput.disabled = true;
                } else if (!/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
                    passwordFeedback.textContent = 'Password harus mengandung huruf dan angka.';
                    passwordFeedback.classList.add('text-danger');
                    passwordInput.classList.add('is-invalid');
                    passwordConfirmInput.disabled = true;
                } else {
                    passwordFeedback.textContent = '';
                    passwordFeedback.classList.remove('text-danger');
                    passwordInput.classList.remove('is-invalid');
                    passwordInput.classList.add('is-valid');
                    passwordConfirmInput.disabled = false;
                }
                validateForm();
            });

            passwordConfirmInput.addEventListener('input', function() {
                const passwordConfirm = passwordConfirmInput.value;
                if (passwordConfirm !== passwordInput.value) {
                    passwordConfirmInput.setCustomValidity('Password tidak cocok.');
                    passwordConfirmFeedback.textContent = 'Password tidak cocok.';
                    passwordConfirmFeedback.classList.add('text-danger');
                    passwordConfirmInput.classList.add('is-invalid');
                } else {
                    passwordConfirmInput.setCustomValidity('');
                    passwordConfirmFeedback.textContent = '';
                    passwordConfirmFeedback.classList.remove('text-danger');
                    passwordConfirmInput.classList.remove('is-invalid');
                    passwordConfirmInput.classList.add('is-valid');
                }
                validateForm();
            });

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                togglePasswordIcon.classList.toggle('bi-eye');
            });

            termsCheckbox.addEventListener('change', validateForm);
        });
    </script>
@endsection
