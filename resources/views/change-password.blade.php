@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px;">
    <div class="row">
        <!-- Form Column -->
        <div class="col-lg-7 col-md-8">
            <div class="card modern-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-lock"></i>
                        Ubah Password
                    </h2>
                    <p class="card-subtitle">Pastikan password baru Anda kuat dan aman</p>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger modern-alert">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-content">
                                <strong>Terjadi kesalahan:</strong>
                                <ul class="error-list">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('change-password.update') }}" method="POST" class="modern-form">
                        @csrf

                        <div class="form-group">
                            <label for="current_password" class="form-label">
                                <i class="fas fa-key"></i>
                                Password Lama
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control modern-input" id="current_password" name="current_password" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current_password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i>
                                Password Baru
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control modern-input" id="password" name="password" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength mt-2" id="password-strength"></div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-check-circle"></i>
                                Konfirmasi Password Baru
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control modern-input" id="password_confirmation" name="password_confirmation" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-modern btn-primary">
                                <i class="fas fa-save"></i>
                                Ubah Password
                            </button>
                            <a href="{{ route('edit-profile') }}" class="btn btn-cancel ms-2">
                                <i class="fas fa-times"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security Tips Column -->
        <div class="col-lg-5 col-md-4">
            <div class="security-tips">
                <h5><i class="fas fa-shield-alt"></i> Tips Keamanan</h5>
                <ul>
                    <li>Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol</li>
                    <li>Minimal 8 karakter untuk password yang kuat</li>
                    <li>Hindari menggunakan informasi pribadi yang mudah ditebak</li>
                    <li>Jangan gunakan password yang sama untuk akun lain</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Card Styles */
.modern-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    transition: all 0.3s ease;
}

.modern-card:hover {
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    text-align: center;
    border: none;
}

.card-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.card-subtitle {
    font-size: 0.95rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.card-body {
    padding: 2.5rem;
}

/* Modern Form Styles */
.modern-form {
    max-width: 100%;
}

.form-group {
    margin-bottom: 1.8rem;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.8rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
}

.form-label i {
    color: #667eea;
    font-size: 0.9rem;
}

.modern-input {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 0.8rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
}

.modern-input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background-color: #fff;
    outline: none;
}

.input-group {
    position: relative;
}

.input-group .modern-input {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.toggle-password {
    border: 2px solid #e9ecef;
    border-left: none;
    border-radius: 0 12px 12px 0;
    background-color: #f8f9fa;
    color: #6c757d;
    padding: 0.8rem 1rem;
    transition: all 0.3s ease;
}

.toggle-password:hover {
    background-color: #e9ecef;
    color: #495057;
}

.toggle-password:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
}

/* Password Strength Indicator */
.password-strength {
    height: 4px;
    background-color: #e9ecef;
    border-radius: 2px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.password-strength::after {
    content: '';
    height: 100%;
    display: block;
    border-radius: 2px;
    transition: all 0.3s ease;
}

.password-strength.weak::after {
    width: 25%;
    background-color: #dc3545;
}

.password-strength.medium::after {
    width: 50%;
    background-color: #ffc107;
}

.password-strength.strong::after {
    width: 75%;
    background-color: #fd7e14;
}

.password-strength.very-strong::after {
    width: 100%;
    background-color: #28a745;
}

/* Alert Styles */
.modern-alert {
    border: none;
    border-radius: 12px;
    padding: 1.2rem;
    margin-bottom: 1.5rem;
    background-color: #f8d7da;
    border-left: 4px solid #dc3545;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.alert-icon {
    color: #dc3545;
    font-size: 1.2rem;
    margin-top: 0.1rem;
}

.alert-content {
    flex: 1;
}

.alert-content strong {
    color: #721c24;
}

.error-list {
    margin-top: 0.5rem;
    margin-bottom: 0;
    padding-left: 1.2rem;
}

.error-list li {
    color: #721c24;
    margin-bottom: 0.25rem;
}

/* Button Styles */
.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.btn-modern {
    padding: 0.8rem 2rem;
    font-weight: 600;
    border-radius: 12px;
    transition: all 0.3s ease;
    border: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-cancel {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    padding: 0.8rem 2rem;
    font-weight: 600;
    border-radius: 12px;
    transition: all 0.3s ease;
    border: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    font-size: 1rem;
}

.btn-cancel:hover {
    background: linear-gradient(135deg, #5a6268 0%, #3d4142 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
    color: white;
}

/* Security Tips - Now positioned as sidebar */
.security-tips {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 16px;
    padding: 1.5rem;
    border-left: 4px solid #28a745;
    height: fit-content;
    margin-top: 0;
    position: sticky;
    top: 100px;
}

.security-tips h5 {
    color: #28a745;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.security-tips ul {
    margin-bottom: 0;
    padding-left: 1.2rem;
}

.security-tips li {
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.security-tips li:last-child {
    margin-bottom: 0;
}

/* Responsive Design */
@media (max-width: 991px) {
    .security-tips {
        margin-top: 2rem;
        position: static;
    }
}

@media (max-width: 768px) {
    .container {
        margin-top: 40px !important;
        padding: 1rem;
    }
    
    .card-header {
        padding: 1.5rem;
    }
    
    .card-title {
        font-size: 1.5rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .form-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-modern, .btn-cancel {
        width: 100%;
        justify-content: center;
    }
    
    .security-tips {
        padding: 1rem;
        margin-top: 1.5rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modern-card {
    animation: fadeInUp 0.6s ease-out;
}

.security-tips {
    animation: fadeInUp 0.6s ease-out 0.2s both;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const toggleButtons = document.querySelectorAll('.toggle-password');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                targetInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
    
    // Password strength indicator
    const passwordInput = document.getElementById('password');
    const strengthIndicator = document.getElementById('password-strength');
    
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        
        strengthIndicator.className = 'password-strength mt-2 ' + strength;
    });
    
    function calculatePasswordStrength(password) {
        let score = 0;
        
        if (password.length >= 8) score++;
        if (password.match(/[a-z]/)) score++;
        if (password.match(/[A-Z]/)) score++;
        if (password.match(/[0-9]/)) score++;
        if (password.match(/[^a-zA-Z0-9]/)) score++;
        
        switch (score) {
            case 0:
            case 1:
                return 'weak';
            case 2:
                return 'medium';
            case 3:
            case 4:
                return 'strong';
            case 5:
                return 'very-strong';
            default:
                return 'weak';
        }
    }
    
    // Form validation feedback
    const form = document.querySelector('.modern-form');
    form.addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        
        if (password !== confirmation) {
            e.preventDefault();
            Swal.fire({
                title: 'Kesalahan',
                text: 'Password baru dan konfirmasi password tidak cocok !!!!',
                icon: 'error',
                draggable: true
            });
        }
    });
});
</script>
@endsection