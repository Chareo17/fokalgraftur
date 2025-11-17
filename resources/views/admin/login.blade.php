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
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body,
input {
  font-family: "Poppins", sans-serif;
}

.container {
  position: relative;
  width: 100%;
  background: linear-gradient(135deg, #4481eb 0%, #04befe 50%, #2563eb 100%);
  min-height: 100vh;
  overflow: hidden;
  padding: 0 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Animated background particles */
.container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at 20% 80%, rgba(68, 129, 235, 0.3) 0%, transparent 50%),
              radial-gradient(circle at 80% 20%, rgba(4, 190, 254, 0.2) 0%, transparent 50%),
              radial-gradient(circle at 40% 40%, rgba(37, 99, 235, 0.25) 0%, transparent 50%);
  animation: float 6s ease-in-out infinite;
  pointer-events: none;
}

@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-20px) rotate(180deg); }
}

.forms-container {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.signin-signup {
  position: relative;
  width: 100%;
  max-width: 450px;
  z-index: 5;
  padding: 0 1rem;
  box-sizing: border-box;
}

.login-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 25px;
  padding: 3.5rem 2.5rem;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  position: relative;
  overflow: hidden;
  margin: 2rem auto;
  max-width: 100%;
}

.login-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #4481eb, #04befe, #2563eb, #4481eb);
  background-size: 200% 100%;
  animation: shimmer 2s linear infinite;
}

@keyframes shimmer {
  0% { background-position: -200% 0; }
  100% { background-position: 200% 0; }
}

form {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  width: 100%;
  box-sizing: border-box;
}

.title {
  font-size: 2.4rem;
  background: linear-gradient(135deg, #4481eb, #04befe);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 0.8rem;
  text-align: center;
  font-weight: 700;
  letter-spacing: -0.5px;
}

.subtitle {
  color: #666;
  font-size: 1.1rem;
  margin-bottom: 2.5rem;
  text-align: center;
  font-weight: 400;
  line-height: 1.5;
}

.input-field {
  max-width: 100%;
  width: 100%;
  background: rgba(240, 240, 240, 0.8);
  margin: 18px 0;
  height: 65px;
  border-radius: 32px;
  display: flex;
  align-items: center;
  padding: 0 25px;
  position: relative;
  border: 2px solid transparent;
  transition: all 0.3s ease;
}

.input-field:focus-within {
  background: rgba(255, 255, 255, 0.9);
  border-color: #4481eb;
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(68, 129, 235, 0.2);
}

.input-field i {
  color: #4481eb;
  font-size: 1.3rem;
  margin-right: 18px;
  transition: all 0.3s ease;
  min-width: 20px;
  text-align: center;
}

.input-field:focus-within i {
  color: #04befe;
  transform: scale(1.1);
}

.input-field input {
  background: none;
  outline: none;
  border: none;
  line-height: 1.4;
  font-weight: 500;
  font-size: 1.1rem;
  color: #333;
  width: 100%;
  padding: 0;
  height: 100%;
}

.input-field input::placeholder {
  color: #999;
  font-weight: 400;
}

.btn {
  width: 100%;
  max-width: 250px;
  background: linear-gradient(135deg, #2563eb, #4481eb, #04befe);
  border: none;
  outline: none;
  height: 58px;
  border-radius: 32px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 600;
  margin: 25px 0 10px 0;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 1.1rem;
  letter-spacing: 1px;
  position: relative;
  overflow: hidden;
}

.btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.5s;
}

.btn:hover::before {
  left: 100%;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 15px 30px rgba(37, 99, 235, 0.4);
  background: linear-gradient(135deg, #1d4ed8, #2563eb, #4481eb);
}

.btn:active {
  transform: translateY(0);
}

.alert {
  max-width: 100%;
  margin: 18px 0;
  padding: 18px 25px;
  background: linear-gradient(135deg, #ff6b6b, #ee5a52);
  color: white;
  border-radius: 25px;
  font-weight: 500;
  text-align: center;
  border: none;
  box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
  animation: slideIn 0.3s ease-out;
  font-size: 1rem;
  line-height: 1.4;
}

@keyframes slideIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.panels-container {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  z-index: 1;
}

.panel {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: space-around;
  text-align: center;
  z-index: 2;
}

.left-panel {
  pointer-events: all;
  padding: 3rem 12% 2rem 8%;
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.panel .content {
  color: #fff;
  transition: transform 0.9s ease-in-out;
  transition-delay: 0.6s;
}

.panel h3 {
  font-weight: 600;
  line-height: 1.3;
  font-size: 1.6rem;
  margin-bottom: 1.5rem;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
  max-width: 400px;
  margin-left: auto;
  margin-right: auto;
}

.panel p {
  font-size: 1rem;
  padding: 0.7rem 0;
  opacity: 0.9;
  text-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
  line-height: 1.5;
  max-width: 350px;
  margin-left: auto;
  margin-right: auto;
}

.image {
  width: 100%;
  max-width: 300px;
  transition: transform 1.1s ease-in-out;
  transition-delay: 0.4s;
  filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.2));
}

.image:hover {
  transform: scale(1.05);
}

/* Decorative elements */
.decorative-circle {
  position: absolute;
  border-radius: 50%;
  background: rgba(68, 129, 235, 0.15);
  pointer-events: none;
}

.circle-1 {
  width: 100px;
  height: 100px;
  top: 10%;
  left: 10%;
  animation: float 4s ease-in-out infinite;
}

.circle-2 {
  width: 150px;
  height: 150px;
  top: 60%;
  right: 10%;
  animation: float 6s ease-in-out infinite reverse;
}

.circle-3 {
  width: 80px;
  height: 80px;
  bottom: 20%;
  left: 20%;
  animation: float 5s ease-in-out infinite;
}

@media (max-width: 870px) {
  .container {
    padding: 1rem;
  }
  
  .signin-signup {
    width: 100%;
    max-width: 420px;
  }
  
  .login-card {
    padding: 2.5rem 2rem;
    margin: 1rem auto;
  }
  
  .panels-container {
    display: none;
  }
  
  .title {
    font-size: 2rem;
  }
  
  .subtitle {
    font-size: 1rem;
  }
  
  .decorative-circle {
    display: none;
  }
}

@media (max-width: 570px) {
  .login-card {
    padding: 2rem 1.5rem;
    margin: 1rem;
  }

  .input-field {
    height: 60px;
    padding: 0 20px;
    margin: 15px 0;
  }
  
  .input-field i {
    font-size: 1.2rem;
    margin-right: 15px;
  }
  
  .btn {
    height: 55px;
    font-size: 1rem;
    margin: 20px 0 10px 0;
  }
  
  .title {
    font-size: 1.8rem;
  }
  
  .subtitle {
    font-size: 0.95rem;
  }
  
  .alert {
    padding: 15px 20px;
    font-size: 0.95rem;
  }
}

/* Loading animation for button */
.btn.loading {
  pointer-events: none;
  opacity: 0.7;
}

.btn.loading::after {
  content: '';
  position: absolute;
  width: 20px;
  height: 20px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-top: 2px solid #fff;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

    </style>
  </head>
  <body>
    <div class="container">
      <!-- Decorative circles -->
      <div class="decorative-circle circle-1"></div>
      <div class="decorative-circle circle-2"></div>
      <div class="decorative-circle circle-3"></div>
      
      <div class="forms-container">
        <div class="signin-signup">
          <div class="login-card">
            <form action="{{ route('login.post') }}" method="POST">
              @csrf
              
              <h2 class="title">Login Portal</h2>
              <p class="subtitle">Selamat datang di portal alumni!</p>
              
              @if ($errors->any())
                  <div class="alert alert-danger">
                      {{ $errors->first() }}
                  </div>
              @endif
          
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required />
              </div>
          
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required />
              </div>
          
              <button type="submit" class="btn">Login</button>
            </form>
          </div>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Selamat Datang<br>Alumni SMK Grafika<br>Yayasan Lektur</h3>
            <p>
              Silahkan masukkan username dan password Anda untuk mengakses portal alumni
            </p>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script>
      // Add loading state to button on submit
      document.querySelector('form').addEventListener('submit', function() {
        const btn = document.querySelector('.btn');
        btn.classList.add('loading');
        btn.innerHTML = 'Loading...';
      });

      // Add input focus animations
      document.querySelectorAll('.input-field input').forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
          this.parentElement.style.transform = 'translateY(0)';
        });
      });
    </script>
  </body>
</html>
