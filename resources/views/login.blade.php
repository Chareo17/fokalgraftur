<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <title>Login Portal - Alumni SMK Grafika</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800;900&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: "Nunito", sans-serif;
  overflow: hidden;
}

.container {
  position: relative;
  width: 100%;
  min-height: 100vh;
  background: linear-gradient(45deg, #1a237e, #3949ab, #5e35b1, #7b1fa2, #ad1457);
  background-size: 300% 300%;
  animation: backgroundMove 8s ease infinite;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

@keyframes backgroundMove {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

/* Animated shapes in background */
.shape {
  position: absolute;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.1);
  animation: floating 6s ease-in-out infinite;
}

.shape1 {
  width: 80px;
  height: 80px;
  top: 10%;
  left: 10%;
  animation-delay: 0s;
}

.shape2 {
  width: 120px;
  height: 120px;
  top: 70%;
  right: 20%;
  animation-delay: 2s;
}

.shape3 {
  width: 60px;
  height: 60px;
  bottom: 10%;
  left: 70%;
  animation-delay: 4s;
}

.shape4 {
  width: 100px;
  height: 100px;
  top: 30%;
  right: 10%;
  animation-delay: 1s;
}

.shape5 {
  width: 90px;
  height: 90px;
  bottom: 30%;
  left: 20%;
  animation-delay: 3s;
}

@keyframes floating {
  0%, 100% {
    transform: translateY(0px) rotate(0deg);
    opacity: 0.7;
  }
  50% {
    transform: translateY(-20px) rotate(180deg);
    opacity: 1;
  }
}

.login-container {
  background: rgba(255, 255, 255, 0.95);
  border-radius: 30px;
  box-shadow: 
    0 30px 60px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.2),
    inset 0 1px 0 rgba(255, 255, 255, 0.8);
  padding: 0;
  width: 100%;
  max-width: 450px;
  position: relative;
  overflow: hidden;
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.3);
}

.login-header {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 40px 30px 30px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.login-header::before {
  content: '';
  position: absolute;
  top: 0;
  left: -50%;
  width: 200%;
  height: 100%;
  background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
  animation: shine 3s ease-in-out infinite;
}

@keyframes shine {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

.logo-container {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 30px;
  margin-bottom: 25px;
}

.logo {
  width: 70px;
  height: 70px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid rgba(255, 255, 255, 0.3);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.logo:hover {
  transform: scale(1.1) rotate(5deg);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.logo img {
  width: 90%;
  height: 90%;
  object-fit: contain;
  border-radius: 15px;
}

.logo i {
  font-size: 2rem;
  color: white;
  opacity: 0.8;
}

.title {
  font-size: 2.2rem;
  color: white;
  font-weight: 800;
  margin-bottom: 8px;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
  letter-spacing: -0.5px;
}

.subtitle {
  color: rgba(255, 255, 255, 0.9);
  font-size: 1rem;
  font-weight: 500;
  line-height: 1.5;
}

.login-body {
  padding: 40px 30px 30px;
}

.alert {
  background: linear-gradient(135deg, #ff4757, #ff3838);
  color: white;
  padding: 15px 20px;
  border-radius: 15px;
  margin-bottom: 25px;
  font-weight: 600;
  text-align: center;
  box-shadow: 0 5px 15px rgba(255, 71, 87, 0.4);
  animation: slideDown 0.5s ease;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.input-group {
  position: relative;
  margin-bottom: 25px;
}

.input-field {
  width: 100%;
  padding: 18px 20px 18px 55px;
  border: 2px solid #e1e8ed;
  border-radius: 15px;
  font-size: 1rem;
  font-weight: 500;
  background: #f8fafc;
  transition: all 0.3s ease;
  outline: none;
}

.input-field:focus {
  border-color: #667eea;
  background: white;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
  transform: translateY(-2px);
}

.input-icon {
  position: absolute;
  left: 18px;
  top: 50%;
  transform: translateY(-50%);
  color: #94a3b8;
  font-size: 1.1rem;
  transition: all 0.3s ease;
}

.input-field:focus + .input-icon,
.input-group:focus-within .input-icon {
  color: #667eea;
  transform: translateY(-50%) scale(1.1);
}

.button-group {
  display: flex;
  gap: 15px;
  margin-top: 30px;
}

.btn {
  flex: 1;
  padding: 16px 24px;
  border: none;
  border-radius: 15px;
  font-size: 1rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  position: relative;
  overflow: hidden;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  transition: left 0.5s;
}

.btn:hover::before {
  left: 100%;
}

.btn-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.btn-primary:hover {
  background: linear-gradient(135deg, #5a67d8 0%, #6b4690 100%);
  transform: translateY(-3px);
  box-shadow: 0 12px 25px rgba(102, 126, 234, 0.5);
}

.btn-secondary {
  background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
  color: white;
  box-shadow: 0 8px 20px rgba(72, 187, 120, 0.4);
}

.btn-secondary:hover {
  background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
  transform: translateY(-3px);
  box-shadow: 0 12px 25px rgba(72, 187, 120, 0.5);
}

.btn:active {
  transform: translateY(0);
}

.btn.loading {
  pointer-events: none;
  opacity: 0.8;
}

.btn.loading::after {
  content: '';
  width: 20px;
  height: 20px;
  border: 2px solid rgba(255,255,255,0.3);
  border-top: 2px solid white;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin-left: 10px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.welcome-panel {
  position: absolute;
  top: 50%;
  left: -350px;
  transform: translateY(-50%);
  width: 300px;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(20px);
  border-radius: 25px;
  padding: 40px 30px;
  text-align: center;
  color: white;
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
  animation: slideInLeft 1s ease 0.5s both;
}

@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateY(-50%) translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateY(-50%) translateX(0);
  }
}

.welcome-panel h3 {
  font-size: 1.8rem;
  font-weight: 800;
  margin-bottom: 20px;
  line-height: 1.3;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.welcome-panel p {
  font-size: 1.1rem;
  line-height: 1.6;
  opacity: 0.9;
  margin-bottom: 30px;
}

.welcome-icon {
  width: 80px;
  height: 80px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 20px;
  margin: 0 auto 25px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2.5rem;
  border: 2px solid rgba(255, 255, 255, 0.3);
}

/* Decorative elements */
.decoration {
  position: absolute;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  pointer-events: none;
}

.decoration-1 {
  top: -100px;
  right: -100px;
  animation: pulse 4s ease-in-out infinite;
}

.decoration-2 {
  bottom: -100px;
  left: -100px;
  animation: pulse 4s ease-in-out infinite 2s;
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
    opacity: 0.5;
  }
  50% {
    transform: scale(1.2);
    opacity: 0.8;
  }
}

/* Responsive */
@media (max-width: 1200px) {
  .welcome-panel {
    display: none;
  }
}

@media (max-width: 768px) {
  .container {
    padding: 15px;
  }

  .login-container {
    max-width: 400px;
  }

  .login-header {
    padding: 30px 25px 25px;
  }

  .logo-container {
    gap: 20px;
    margin-bottom: 20px;
  }

  .logo {
    width: 60px;
    height: 60px;
  }

  .logo i {
    font-size: 1.8rem;
  }

  .title {
    font-size: 1.9rem;
  }

  .subtitle {
    font-size: 0.9rem;
  }

  .login-body {
    padding: 30px 25px 25px;
  }

  .button-group {
    flex-direction: column;
  }
}

@media (max-width: 480px) {
  .login-container {
    max-width: 350px;
    margin: 10px;
  }

  .login-header {
    padding: 25px 20px 20px;
  }

  .logo {
    width: 50px;
    height: 50px;
  }

  .logo i {
    font-size: 1.5rem;
  }

  .title {
    font-size: 1.7rem;
  }

  .login-body {
    padding: 25px 20px 20px;
  }

  .input-field {
    padding: 16px 18px 16px 50px;
    font-size: 0.95rem;
  }

  .input-icon {
    left: 16px;
    font-size: 1rem;
  }

  .btn {
    padding: 14px 20px;
    font-size: 0.9rem;
  }
}

/* Floating particles effect */
.particles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  pointer-events: none;
}

.particle {
  position: absolute;
  width: 4px;
  height: 4px;
  background: rgba(255, 255, 255, 0.5);
  border-radius: 50%;
  animation: particleFloat 15s linear infinite;
}

@keyframes particleFloat {
  0% {
    transform: translateY(100vh) scale(0);
    opacity: 1;
  }
  10% {
    opacity: 1;
  }
  100% {
    transform: translateY(-10vh) scale(1);
    opacity: 0;
  }
}
    </style>
  </head>
  <body>
    <div class="container">
      <!-- Animated shapes -->
      <div class="shape shape1"></div>
      <div class="shape shape2"></div>
      <div class="shape shape3"></div>
      <div class="shape shape4"></div>
      <div class="shape shape5"></div>

      <!-- Floating particles -->
      <div class="particles">
        <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; animation-delay: 2s;"></div>
        <div class="particle" style="left: 30%; animation-delay: 4s;"></div>
        <div class="particle" style="left: 40%; animation-delay: 6s;"></div>
        <div class="particle" style="left: 50%; animation-delay: 8s;"></div>
        <div class="particle" style="left: 60%; animation-delay: 10s;"></div>
        <div class="particle" style="left: 70%; animation-delay: 12s;"></div>
        <div class="particle" style="left: 80%; animation-delay: 14s;"></div>
        <div class="particle" style="left: 90%; animation-delay: 16s;"></div>
      </div>

      <!-- Decorative elements -->
      <div class="decoration decoration-1"></div>
      <div class="decoration decoration-2"></div>

      <!-- Welcome Panel -->
      <div class="welcome-panel">
        <div class="welcome-icon">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <h3>Selamat Datang<br>Alumni SMK Grafika</h3>
        <p>Portal terintegrasi untuk semua kebutuhan alumni. Akses informasi, networking, dan layanan eksklusif.</p>
      </div>

      <!-- Main Login Container -->
      <div class="login-container">
        <div class="login-header">
          <div class="logo-container">
            <!-- Logo 1 - Bisa diganti dengan gambar -->
            <div class="logo">
              <i class="">
                  <img src="{{ asset('assets/img/grafika1.png') }}" alt="Graftur Logo" style="margin-top:7px;">
              </i>
              <!-- <img src="path/to/logo1.png" alt="Logo 1"> -->
            </div>
            <!-- Logo 2 - Bisa diganti dengan gambar -->
            <div class="logo">
              <i class="">
                <img src="{{ asset('assets/img/grafika2.png') }}" alt="Graftur Logo" style="margin-top:7px;">
              </i>
              <!-- <img src="path/to/logo2.png" alt="Logo 2"> -->
            </div>
          </div>
          <h2 class="title">Login Portal</h2>
          <p class="subtitle">Akses portal alumni SMK Grafika Yayasan Lektur</p>
        </div>

        <div class="login-body">
          <form action="{{ route('login.post') }}" method="POST" id="loginForm">
            @csrf
            
            @if ($errors->any())
              <div class="alert">
                <i class="fas fa-exclamation-triangle"></i>
                {{ $errors->first() }}
              </div>
            @endif

            <div class="input-group">
              <input 
                type="text" 
                name="username" 
                class="input-field" 
                placeholder="Masukkan username Anda"
                required
              />
              <i class="fas fa-user input-icon"></i>
            </div>

            <div class="input-group">
              <input 
                type="password" 
                name="password" 
                class="input-field" 
                placeholder="Masukkan password Anda"
                required
              />
              <i class="fas fa-lock input-icon"></i>
            </div>

            <div class="button-group">
              <a href="{{ route('landingpage') }}" class="btn btn-secondary">
                <i class="fas fa-home"></i>
                <span>Home</span>
              </a>
              <button type="submit" class="btn btn-primary" id="loginBtn">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      // Form submission with loading state
      document.getElementById('loginForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('loginBtn');
        const btnText = btn.querySelector('span');
        
        btn.classList.add('loading');
        btn.disabled = true;
        btnText.textContent = 'Memproses...';
      });

      // Input field animations
      document.querySelectorAll('.input-field').forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.style.transform = 'translateY(-2px)';
        });

        input.addEventListener('blur', function() {
          this.parentElement.style.transform = 'translateY(0)';
        });
      });

      // Create more floating particles dynamically
      function createParticles() {
        const particlesContainer = document.querySelector('.particles');
        
        setInterval(() => {
          if (document.querySelectorAll('.particle').length < 15) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = '0s';
            particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
            particlesContainer.appendChild(particle);

            // Remove particle after animation
            setTimeout(() => {
              if (particle.parentNode) {
                particle.parentNode.removeChild(particle);
              }
            }, 20000);
          }
        }, 2000);
      }

      // Start particle creation
      createParticles();

      // Logo hover effects
      document.querySelectorAll('.logo').forEach(logo => {
        logo.addEventListener('mouseenter', function() {
          this.style.background = 'rgba(255, 255, 255, 0.3)';
        });

        logo.addEventListener('mouseleave', function() {
          this.style.background = 'rgba(255, 255, 255, 0.2)';
        });
      });

      // Add ripple effect to buttons
      document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function(e) {
          const rect = button.getBoundingClientRect();
          const ripple = document.createElement('div');
          const size = Math.max(rect.width, rect.height);
          const x = e.clientX - rect.left - size / 2;
          const y = e.clientY - rect.top - size / 2;
          
          ripple.style.cssText = `
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: scale(0);
            animation: rippleEffect 0.6s linear;
            pointer-events: none;
          `;
          
          button.appendChild(ripple);
          
          setTimeout(() => {
            ripple.remove();
          }, 600);
        });
      });

      // Add ripple animation CSS
      const rippleStyle = document.createElement('style');
      rippleStyle.textContent = `
        @keyframes rippleEffect {
          to {
            transform: scale(4);
            opacity: 0;
          }
        }
      `;
      document.head.appendChild(rippleStyle);
    </script>
  </body>
</html>