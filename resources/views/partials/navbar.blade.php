<style>
  /* Modern Color Palette & Variables */
  :root {
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --primary-light: #3b82f6;
    --secondary-color: #64748b;
    --accent-color: #0b5df5;
    --success-color: #10b981;
    --danger-color: #ef4444;
    --warning-color: #0b74f5;
    --info-color: #06b6d4;
    --surface-color: #ffffff;
    --surface-alt: #f8fafc;
    --surface-hover: #f1f5f9;
    --text-primary: #1e293b;
    --text-secondary: #64748b;
    --text-muted: #94a3b8;
    --border-color: #e2e8f0;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    --gradient-surface: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
  }

  /* Header Base Styles */
  /* .header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    box-shadow: var(--shadow-sm);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1000;
  } */

  /* .header.scrolled {
    background: rgba(255, 255, 255, 0.98);
    box-shadow: var(--shadow-lg);
    border-bottom-color: var(--border-color);
  } */

  .header-container {
    padding: 0.875rem 1.5rem;
    min-height: 75px;
    transition: all 0.3s ease;
  }

  /* Logo Modern Styling */
  .logo {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: rgba(255, 255, 255, 0.8);
    padding: 0.25rem;
  }

  .logo:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    background: rgba(255, 255, 255, 0.95);
  }

  .logo img {
    transition: all 0.3s ease;
    filter: brightness(1) contrast(1.05);
  }

  .logo:hover img {
    transform: scale(1.03);
    filter: brightness(1.05) contrast(1.1);
  }

  /* Navigation Modern Styling */
  .navmenu {
    position: relative;
  }

  .navmenu ul {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    margin: 0;
    padding: 0;
    list-style: none;
  }

  .navmenu li {
    position: relative;
  }

  .navmenu a {
    position: relative;
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    font-weight: 500;
    font-size: 0.95rem;
    color: var(--text-primary);
    text-decoration: none;
    border-radius: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-right: 10px;
  }

  /* Hover Effects for Navigation */
  .navmenu a:hover {
    color: var(--primary-color);
    background: rgba(37, 99, 235, 0.08);
    transform: translateY(-1px);
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
  }

  .navmenu a.active {
    color: var(--primary-color);
    background: rgba(37, 99, 235, 0.12);
    border-bottom: 2px solid var(--primary-color);
  }

  /* Dropdown Modern Styling */
  .navmenu .dropdown > a::after {
    content: '\F282';
    font-family: 'bootstrap-icons';
    margin-left: 0.5rem;
    font-size: 0.75rem;
    transition: all 0.3s ease;
  }

  .navmenu .dropdown.show > a::after {
    transform: rotate(180deg);
  }

  .navmenu .dropdown-menu {
    background: var(--surface-color);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    box-shadow: var(--shadow-xl);
    padding: 0.5rem;
    margin-top: 0.5rem;
    min-width: 200px;
    animation: fadeInUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .navmenu .dropdown-item {
    padding: 0.75rem 1rem;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-weight: 500;
    color: var(--text-primary);
  }

  .navmenu .dropdown-item:hover {
    background: var(--surface-hover);
    color: var(--primary-color);
    transform: translateX(4px);
  }

  /* Notification Icon Modern Design */
  .notification-icon {
    width: 48px !important;
    height: 48px !important;
    background: var(--gradient-surface) !important;
    border: 2px solid var(--border-color) !important;
    border-radius: 14px !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    box-shadow: var(--shadow-sm) !important;
    position: relative;
    overflow: hidden;
  }

  .notification-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient-primary);
    opacity: 0;
    transition: all 0.3s ease;
    z-index: -1;
  }

  .notification-icon:hover::before {
    opacity: 1;
  }

  .notification-icon:hover {
    background: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
    transform: translateY(-3px) !important;
    box-shadow: var(--shadow-lg) !important;
  }

  .notification-icon:hover i {
    color: #ffffff !important;
    transform: scale(1.1);
  }

  .notification-icon i {
    font-size: 1.3rem;
    color: var(--text-secondary);
    transition: all 0.3s ease;
  }

  /* Notification Badge */
  #notificationCount {
    position: absolute;
    top: -6px;
    right: -6px;
    width: 24px;
    height: 24px;
    font-size: 0.7rem;
    font-weight: 700;
    background: var(--gradient-primary);
    color: white;
    border: 3px solid white;
    box-shadow: var(--shadow-md);
    animation: pulse 2s infinite;
  }

  @keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(37, 99, 235, 0); }
    100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
  }

  /* Profile Icon Modern Design */
  .profile-icon {
    display: flex;
    align-items: center;
    text-decoration: none;
    padding: 0.25rem;
    border-radius: 50%;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: var(--gradient-surface);
    border: 2px solid var(--border-color);
  }

  .profile-icon:hover {
    background: var(--surface-hover);
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }

  .profile-icon img {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--border-color);
    transition: all 0.3s ease;
  }

  .profile-icon:hover img {
    border-color: var(--primary-color);
    transform: scale(1.05);
  }

  /* Dropdown Menus Enhanced */
  .dropdown-menu {
    background: var(--surface-color);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    box-shadow: var(--shadow-xl);
    padding: 0.75rem;
    animation: fadeInDown 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
  }

  .dropdown-item {
    padding: 0.75rem 1rem;
    color: var(--text-primary);
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    display: flex;
    align-items: center;
    border-radius: 10px;
    position: relative;
    overflow: hidden;
  }

  .dropdown-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background: var(--gradient-primary);
    opacity: 0.1;
    transition: all 0.3s ease;
  }

  .dropdown-item:hover::before,
  .dropdown-item:focus::before {
    width: 100%;
  }

  .dropdown-item:hover,
  .dropdown-item:focus {
    background: var(--surface-hover);
    color: var(--primary-color);
    outline: none;
    transform: translateX(4px);
  }

  .dropdown-item i {
    margin-right: 0.75rem;
    width: 16px;
    font-size: 1rem;
    transition: all 0.3s ease;
  }

  .dropdown-item:hover i {
    transform: scale(1.1);
  }

  /* Login Button Modern Design */
  .btn-getstarted {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    color: white;
    background: var(--gradient-primary);
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
  }

  .btn-getstarted::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: all 0.5s ease;
  }

  .btn-getstarted:hover::before {
    left: 100%;
  }

  .btn-getstarted:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
  }

  /* Notification Dropdown Enhanced */
  #notificationDropdown .dropdown-menu {
    width: 380px;
    max-height: 480px;
    overflow-y: auto;
    border-radius: 20px;
    padding: 0;
    border: none;
    box-shadow: var(--shadow-xl);
    background: var(--surface-color);
  }

  /* Notification Header */
  .notification-header {
    padding: 1.25rem 1.5rem;
    background: var(--gradient-surface);
    border-bottom: 1px solid var(--border-color);
    border-radius: 20px 20px 0 0;
  }

  .notification-header h6 {
    margin: 0;
    font-weight: 700;
    color: var(--text-primary);
    font-size: 1.1rem;
  }

  .notification-header .badge {
    background: var(--gradient-primary);
    color: white;
    font-size: 0.75rem;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-weight: 600;
  }

  /* Notification Items Enhanced */
  .notification-content {
    padding: 1.25rem 1.5rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    border-bottom: 1px solid rgba(226, 232, 240, 0.5);
  }

  .notification-content::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 0;
    height: 100%;
    background: var(--gradient-primary);
    opacity: 0.05;
    transition: all 0.3s ease;
  }

  .notification-content:hover::before {
    width: 4px;
  }

  .notification-content:hover {
    background: var(--surface-alt);
    transform: translateX(4px);
  }

  .notification-content img {
    width: 44px;
    height: 44px;
    border: 2px solid var(--border-color);
    transition: all 0.3s ease;
  }

  .notification-content:hover img {
    border-color: var(--primary-color);
    transform: scale(1.05);
  }

  /* Notification Badges */
  .notification-content .badge {
    font-size: 0.7rem;
    padding: 0.3rem 0.75rem;
    border-radius: 20px;
    font-weight: 600;
    border: 1px solid currentColor;
    background: transparent !important;
  }

  .notification-content .badge.bg-info {
    color: var(--info-color);
    background: rgba(6, 182, 212, 0.1) !important;
  }

  .notification-content .badge.bg-success {
    color: var(--success-color);
    background: rgba(16, 185, 129, 0.1) !important;
  }

  .notification-content .badge.bg-danger {
    color: var(--danger-color);
    background: rgba(239, 68, 68, 0.1) !important;
  }

  /* Empty State */
  .notification-empty {
    padding: 3rem 2rem;
    text-align: center;
    color: var(--text-muted);
  }

  .notification-empty i {
    font-size: 3rem;
    opacity: 0.3;
    margin-bottom: 1rem;
    display: block;
  }

  /* Custom Scrollbar Enhanced */
  .dropdown-menu::-webkit-scrollbar {
    width: 8px;
  }

  .dropdown-menu::-webkit-scrollbar-track {
    background: var(--surface-alt);
    border-radius: 10px;
  }

  .dropdown-menu::-webkit-scrollbar-thumb {
    background: var(--text-muted);
    border-radius: 10px;
    transition: all 0.3s ease;
  }

  .dropdown-menu::-webkit-scrollbar-thumb:hover {
    background: var(--text-secondary);
  }

  /* Animations */
  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translate3d(0, -30px, 0);
    }
    to {
      opacity: 1;
      transform: translate3d(0, 0, 0);
    }
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translate3d(0, 20px, 0);
    }
    to {
      opacity: 1;
      transform: translate3d(0, 0, 0);
    }
  }

  /* Mobile Responsive Enhanced */
  @media (max-width: 768px) {
    .header-container {
      padding: 0.75rem 1rem;
      min-height: 65px;
    }

    /* Notification Dropdown Mobile */
    #notificationDropdown .dropdown-menu {
      width: calc(100vw - 32px) !important;
      max-width: 340px;
      max-height: 280px !important;
      left: 50% !important;
      transform: translateX(-50%) !important;
      right: 50% !important;
      margin-top: 12px;
      border-radius: 16px;
    }

    .notification-icon {
      width: 44px !important;
      height: 44px !important;
      border-radius: 12px !important;
    }

    .notification-icon i {
      font-size: 1.2rem !important;
    }

    #notificationCount {
      width: 20px !important;
      height: 20px !important;
      font-size: 0.65rem !important;
      top: -4px !important;
      right: -4px !important;
    }

    /* Navigation Mobile */
    .navmenu ul {
      gap: 0.125rem;
    }

    .navmenu a {
      padding: 0.625rem 0.875rem;
      font-size: 0.9rem;
      border-radius: 8px;
    }

    /* Profile Mobile */
    .profile-icon img {
      width: 38px !important;
      height: 38px !important;
    }

    /* Logo Mobile */
    .logo {
      border-radius: 10px;
      padding: 0.125rem;
    }

    .logo img {
      height: 85% !important;
    }

    /* Notification Content Mobile */
    .notification-content {
      padding: 1rem !important;
    }

    .notification-content img {
      width: 36px !important;
      height: 36px !important;
    }

    .notification-header {
      padding: 1rem 1.25rem;
    }
  }

  @media (max-width: 576px) {
    .header-container {
      padding: 0.625rem 0.875rem;
    }

    #notificationDropdown .dropdown-menu {
      width: calc(100vw - 24px) !important;
      max-height: 250px !important;
      left: 12px !important;
      right: 12px !important;
      transform: none !important;
      border-radius: 14px;
    }

    .notification-content {
      padding: 0.875rem !important;
    }

    .notification-content .d-flex {
      flex-direction: column;
      align-items: flex-start !important;
      gap: 0.75rem;
    }

    .notification-content .me-3 {
      margin-right: 0 !important;
      margin-bottom: 0.5rem;
    }

    .notification-content img {
      width: 32px !important;
      height: 32px !important;
    }

    .notification-header {
      padding: 0.875rem 1rem;
    }

    .notification-header h6 {
      font-size: 1rem;
    }

    /* Mobile Navigation Toggle */
    .mobile-nav-toggle {
      font-size: 1.5rem;
      padding: 0.5rem;
      border-radius: 8px;
      transition: all 0.3s ease;
      color: var(--text-primary);
    }

    .mobile-nav-toggle:hover {
      background: var(--surface-hover);
      color: var(--primary-color);
    }

    /* Responsive Login Button */
    .btn-getstarted {
      padding: 0.625rem 1.25rem;
      font-size: 0.9rem;
      border-radius: 10px;
    }
  }

  /* Force dropdown visibility fixes */
  .dropdown-menu.show {
    display: block !important;
    opacity: 1;
    visibility: visible;
  }

  .dropdown-toggle.show::after {
    transform: rotate(180deg);
  }

  /* Interactive micro-animations */
  .navmenu a,
  .notification-icon,
  .profile-icon,
  .btn-getstarted {
    will-change: transform;
  }

  /* Enhanced focus states for accessibility */
  .navmenu a:focus,
  .notification-icon:focus,
  .profile-icon:focus,
  .btn-getstarted:focus,
  .dropdown-item:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
  }
</style>

<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0" style="height: 100%;">
      <h1 class="sitename" style="height: 100%; margin: 0; display: flex; align-items: center;">
        <img src="{{ asset('assets/img/grafika1.png') }}" alt="Graftur Logo" style="height: 100%; width: auto;">
      </h1>
      <h1 class="sitename" style="height: 100%; margin: 0; display: flex; align-items: center;">
        <img src="{{ asset('assets/img/grafika2.png') }}" alt="Graftur Logo" style="height: 100%; width: auto;">
      </h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ route('landingpage') }}" class="{{ request()->routeIs('landingpage') ? 'active' : '' }}">Home</a></li>
        @auth('admin')
        <li class="dropdown {{ (request()->routeIs('admin.dashboard') || request()->routeIs('data-pengguna') || request()->routeIs('admin.donasi') || request()->routeIs('testimoni') || request()->routeIs('admin.undangan.*')) ? 'active' : '' }}">
          <a href="#" class="dropdown-toggle toggle-dropdown" aria-expanded="false">Kelola Data</a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.dashboard') }}" class="dropdown-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="{{ route('data-pengguna') }}" class="dropdown-item {{ request()->routeIs('data-pengguna') ? 'active' : '' }}">Data Pengguna</a></li>
            <li><a href="{{ route('admin.donasi') }}" class="dropdown-item {{ request()->routeIs('admin.donasi') ? 'active' : '' }}">Validasi Donasi</a></li>
            <li><a href="{{ route('testimoni') }}" class="dropdown-item {{ request()->routeIs('testimoni') ? 'active' : '' }}">Testimoni</a></li>
            <li><a href="{{ route('admin.undangan.index') }}" class="dropdown-item {{ request()->routeIs('admin.undangan.*') ? 'active' : '' }}">Event & Undangan</a></li>
          </ul>
        </li>
        @endauth
        <li><a href="{{ route('admin.pintar.index') }}" class="{{ request()->routeIs('admin.pintar.*') ? 'active' : '' }}">Pintar</a></li>
        <li class="dropdown {{ (request()->routeIs('berita.index') || request()->routeIs('lowongan.index') || request()->routeIs('mentoring') || request()->routeIs('forum')) ? 'active' : '' }}">
          <a href="#" class="dropdown-toggle toggle-dropdown" aria-expanded="false">Informasi dan Komunikasi</a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('berita.index') }}" class="dropdown-item {{ request()->routeIs('berita.index') ? 'active' : '' }}">Berita</a></li>
            <li><a href="{{ route('lowongan.index') }}" class="dropdown-item {{ request()->routeIs('lowongan.index') ? 'active' : '' }}">Lowongan Kerja</a></li>
            <li><a href="{{ route('mentoring') }}" class="dropdown-item {{ request()->routeIs('mentoring') ? 'active' : '' }}">Mentorship</a></li>
            <li><a href="{{ route('forum') }}" class="dropdown-item {{ request()->routeIs('forum') ? 'active' : '' }}">Forum</a></li>
          </ul>
        </li>
        @if(!auth('admin')->check())
        <li><a href="{{ route('donasi.form') }}" class="{{ request()->routeIs('donasi.form') ? 'active' : '' }}">Donasi</a></li>
        @endif
        <li><a href="{{ route('voucher') }}" class="{{ request()->routeIs('voucher') ? 'active' : '' }}">Voucher</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <!-- Login Button & Profile/Notification Icons -->
    <div class="d-flex align-items-center">
      
      @php
          $isAuthenticated = false;
          $currentGuard = null;
          $currentUser = null;

          // Check all guards in order of priority
          foreach (['admin', 'alumni', 'siswa', 'web'] as $guard) {
              if (auth($guard)->check()) {
                  $isAuthenticated = true;
                  $currentGuard = $guard;
                  $currentUser = auth($guard)->user();
                  break;
              }
          }
      @endphp

      @if($isAuthenticated)
      <!-- Notification Icon with Dropdown -->
      <div class="dropdown me-3" id="notificationDropdown">
        <a href="#" id="notificationIcon" class="notification-icon position-relative d-flex align-items-center justify-content-center"
           data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-bell"></i>
          @if($notificationCount > 0)
          <span id="notificationCount" class="badge bg-danger position-absolute rounded-circle d-flex align-items-center justify-content-center">
            {{ $notificationCount }}
          </span>
          @endif
        </a>
      
        <!-- Dropdown Menu -->
        <ul id="notificationList" class="dropdown-menu dropdown-menu-start border-0 shadow-lg p-0">
          
          <!-- Header -->
          <li class="notification-header">
            <div class="d-flex justify-content-between align-items-center">
              <h6 class="mb-0 fw-semibold text-dark">
                <i class="bi bi-bell me-2 text-primary"></i>Notifikasi
              </h6>
              @if($notificationCount > 0)
              <span id="notificationCountHeader" class="badge">{{ $notificationCount }} Baru</span>
              @endif
            </div>
          </li>

          @forelse($notifications as $notification)
          <li class="notification-item border-0 p-0">
            <div class="notification-content">
              <div class="d-flex align-items-start">
                <div class="me-3 flex-shrink-0">
                  <img src="{{ $notification['profile_image'] ?? asset('assets/img/avatar-1.webp') }}" 
                       alt="User Avatar" 
                       class="rounded-circle">
                </div>

                <div class="flex-grow-1 min-width-0">
                  @if($notification['type'] === 'berita')
                  <div class="d-flex align-items-center mb-2">
                    <span class="badge bg-info me-2">
                      <i class="bi bi-newspaper me-1"></i>Berita
                    </span>
                    <strong class="text-dark" style="font-size: 0.9rem;">{{ $notification['author'] }}</strong>
                  </div>
                  <p class="mb-2 text-muted lh-sm" style="font-size: 0.85rem;">
                    Meng-upload berita terbaru: <span class="fw-medium text-dark">"{{ Str::limit($notification['title'], 50) }}"</span>
                  </p>
                  
                  <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                      <i class="bi bi-clock me-1"></i>
                      {{ \Carbon\Carbon::parse($notification['updated_at'])->diffForHumans() }}
                    </small>
                  </div>
                  
                  @elseif($notification['type'] === 'donasi' && $notification['status'] === 'divalidasi')
                  <div class="d-flex align-items-center mb-2">
                    <span class="badge bg-success me-2">
                      <i class="bi bi-heart me-1"></i>Donasi
                    </span>
                    <strong class="text-dark" style="font-size: 0.9rem;">{{ $notification['name'] }}</strong>
                  </div>
                  <p class="mb-2 text-muted lh-sm" style="font-size: 0.85rem;">
                    Donasi telah terverifikasi sebesar <span class="fw-bold text-success">Rp {{ number_format($notification['nominal'], 0, ',', '.') }}</span>
                  </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                      <i class="bi bi-clock me-1"></i>
                      {{ \Carbon\Carbon::parse($notification['updated_at'])->diffForHumans() }}
                    </small>
                  </div>
                  @elseif($notification['type'] === 'donasi' && $notification['status'] === 'ditolak')
                  <div class="d-flex align-items-center mb-2">
                    <span class="badge bg-danger me-2">
                      <i class="bi bi-x-circle me-1"></i>Donasi Ditolak
                    </span>
                    <strong class="text-dark" style="font-size: 0.9rem;">{{ $notification['name'] }}</strong>
                  </div>
                  <p class="mb-2 text-muted lh-sm" style="font-size: 0.85rem;">
                    Donasi Anda sebesar <span class="fw-bold text-danger">Rp {{ number_format($notification['nominal'], 0, ',', '.') }}</span> telah ditolak oleh admin.
                  </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                      <i class="bi bi-clock me-1"></i>
                      {{ \Carbon\Carbon::parse($notification['updated_at'])->diffForHumans() }}
                    </small>
                  </div>
                  @elseif($notification['type'] === 'undangan')
                  <div class="d-flex align-items-center mb-2">
                    <span class="badge bg-primary me-2">
                      <i class="bi bi-envelope-paper me-1"></i>Undangan
                    </span>
                    <strong class="text-dark" style="font-size: 0.9rem;">{{ $notification['author'] }}</strong>
                  </div>
                  <p class="mb-2 text-muted lh-sm" style="font-size: 0.85rem;">
                    Undangan baru: <span class="fw-medium text-dark">"{{ Str::limit($notification['title'], 50) }}"</span>
                  </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                      <i class="bi bi-clock me-1"></i>
                      {{ \Carbon\Carbon::parse($notification['updated_at'])->diffForHumans() }}
                    </small>
                    <div class="d-flex align-items-center gap-2">
                      @if($notification['role_target'])
                      <small class="text-info">
                        <i class="bi bi-people me-1"></i>{{ ucfirst(implode(', ', $notification['role_target'])) }}
                      </small>
                      @endif
                      @if(isset($notification['gambar']) && $notification['gambar'])
                      <a href="{{ asset('storage/' . $notification['gambar']) }}" download class="btn btn-sm btn-outline-primary" title="Download Lampiran">
                        <i class="bi bi-download"></i>
                      </a>
                      @endif
                      @if(isset($notification['download_url']))
                      <a href="{{ $notification['download_url'] }}" download class="btn btn-sm btn-success" title="Download PDF Undangan">
                        <i class="bi bi-file-earmark-pdf"></i>
                      </a>
                      @endif
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </li>
          @empty
          <li class="notification-empty">
            <div class="text-muted">
              <i class="bi bi-bell-slash mb-3 d-block" style="font-size: 2.5rem; opacity: 0.4;"></i>
              <p class="mb-0">Belum ada notifikasi</p>
              <small class="text-muted">Notifikasi akan muncul di sini</small>
            </div>
          </li>
          @endforelse
          
        </ul>
      </div>

      <!-- Profile Dropdown - Unified for all user types -->
      <div class="dropdown">
        <a href="#" class="profile-icon dropdown-toggle d-flex align-items-center"
           data-bs-toggle="dropdown" aria-expanded="false" id="profileDropdown">
          @if($currentGuard === 'admin')
            <img src="{{ asset('assets/img/avatar-1.webp') }}" alt="Profile" class="rounded-circle">
          @elseif($currentGuard === 'alumni')
            <img src="{{ $currentUser->profile_image ? asset('storage/' . $currentUser->profile_image) : asset('assets/img/avatar-1.webp') }}" alt="Profile" class="rounded-circle">
          @elseif($currentGuard === 'siswa')
            <img src="{{ $currentUser->profile_image ? asset('storage/' . $currentUser->profile_image) : asset('assets/img/avatar-1.webp') }}" alt="Profile" class="rounded-circle">
          @elseif($currentGuard === 'web')
            <img src="{{ asset('assets/img/avatar-1.webp') }}" alt="Profile" class="rounded-circle">
          @else
            <img src="{{ asset('assets/img/avatar-1.webp') }}" alt="Profile" class="rounded-circle">
          @endif
        </a>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          @if($currentGuard === 'admin')
            {{-- Admin: hide profile link, show only logout --}}
            <li>
              <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item">
                  <i class="bi bi-box-arrow-right"></i>
                  Logout
                </button>
              </form>
            </li>
          @else
            {{-- Other roles: show profile and logout --}}
            <li>
              <a class="dropdown-item" href="{{ route('profil') }}">
                <i class="bi bi-person-circle"></i>
                Profile
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item">
                  <i class="bi bi-box-arrow-right"></i>
                  Logout
                </button>
              </form>
            </li>
          @endif
        </ul>
      </div>
      @endif

      @unless(auth()->check() || auth('admin')->check() || auth('alumni')->check() || auth('siswa')->check() || auth('web')->check())
      <!-- Login Button -->
      <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
      @endunless
    </div>

  </div>
</header>

<!-- JavaScript untuk notifikasi -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/relativeTime.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/locale/id.js"></script>
<script>
  dayjs.extend(window.dayjs_plugin_relativeTime);
  dayjs.locale('id');

  // Header scroll effect
  window.addEventListener('scroll', function() {
    const header = document.getElementById('header');
    if (window.scrollY > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });

  // Fix untuk dropdown yang tidak bisa diklik setelah loading
  document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi ulang semua dropdown
    const dropdowns = document.querySelectorAll('[data-bs-toggle="dropdown"]');
    dropdowns.forEach(dropdown => {
      new bootstrap.Dropdown(dropdown);
    });

    // Pastikan link navigasi berfungsi normal
    const navLinks = document.querySelectorAll('.navmenu a:not([data-bs-toggle="dropdown"])');
    navLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        // Biarkan link berfungsi normal, jangan prevent default
        console.log('Navigating to:', this.href);
      });
    });

    // Manual click handler untuk dropdown yang bermasalah
    const profileDropdown = document.getElementById('profileDropdown');
    const notificationDropdown = document.querySelector('#notificationDropdown [data-bs-toggle="dropdown"]');

    if (profileDropdown) {
      profileDropdown.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        const dropdownMenu = this.nextElementSibling;
        if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
          dropdownMenu.classList.toggle('show');
        }
      });
    }

    if (notificationDropdown) {
      notificationDropdown.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        // Mark notifications as read
        fetch('{{ route("notifications.read") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify({})
        }).then(response => response.json()).then(data => {
          if (data.status === 'success') {
            // Hide the badge
            const countElem = document.getElementById('notificationCount');
            const countHeaderElem = document.getElementById('notificationCountHeader');
            if (countElem) countElem.style.display = 'none';
            if (countHeaderElem) countHeaderElem.style.display = 'none';
          }
        }).catch(error => console.error('Error marking notifications as read:', error));

        const dropdownMenu = this.nextElementSibling;
        if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
          dropdownMenu.classList.toggle('show');
        }
      });
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
          menu.classList.remove('show');
        });
      }
    });
  });

  // Update waktu notifikasi setiap 60 detik
  function updateNotificationTimes() {
    document.querySelectorAll('.notification-time').forEach(el => {
      const ts = el.dataset.timestamp;
      if (ts) {
        const fromNow = dayjs(ts).fromNow();
        el.innerHTML = `<i class="bi bi-clock me-1"></i>${fromNow}`;
      }
    });
  }

  // Tunggu sampai halaman selesai loading
  window.addEventListener('load', function() {
    updateNotificationTimes();
    
    // Set interval setelah halaman load
    setInterval(updateNotificationTimes, 60000);
  });

  // Inisialisasi Pusher
  Pusher.logToConsole = false;

  const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
    cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
    forceTLS: true
  });

  const echo = new Echo({
    broadcaster: 'pusher',
    key: '{{ env("PUSHER_APP_KEY") }}',
    cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
    forceTLS: true
  });

  echo.channel('berita-channel')
    .listen('BeritaCreated', (e) => {
      console.log('New BeritaCreated event received:', e);

      // Update counter
      let countElem = document.getElementById('notificationCount');
      let countHeaderElem = document.getElementById('notificationCountHeader');
      let count = parseInt(countElem?.textContent || '0') || 0;
      count++;
      if (countElem) countElem.textContent = count;
      if (countHeaderElem) countHeaderElem.textContent = count + ' Baru';

      // Tambahkan item notifikasi ke list
      let notificationList = document.getElementById('notificationList');
      if (notificationList) {
        let newNotification = document.createElement('li');
        newNotification.classList.add('notification-item', 'border-0', 'p-0');
        newNotification.innerHTML = `
          <div class="notification-content">
            <div class="d-flex align-items-start">
              <div class="me-3 flex-shrink-0">
                <img src="{{ asset('assets/img/avatar-1.webp') }}" alt="User Avatar" class="rounded-circle">
              </div>
              <div class="flex-grow-1 min-width-0">
                <div class="d-flex align-items-center mb-2">
                  <span class="badge bg-info me-2">
                    <i class="bi bi-newspaper me-1"></i>Berita
                  </span>
                  <strong class="text-dark" style="font-size: 0.9rem;">${e.name}</strong>
                </div>
                <p class="mb-2 text-muted lh-sm" style="font-size: 0.85rem;">
                  Meng-upload berita terbaru: <span class="fw-medium text-dark">"${e.judul.length > 50 ? e.judul.substring(0, 50) + '...' : e.judul}"</span>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted notification-time" data-timestamp="${e.created_at}">
                    <i class="bi bi-clock me-1"></i>Baru saja
                  </small>
                </div>
              </div>
            </div>
          </div>
        `;
        notificationList.prepend(newNotification);
        updateNotificationTimes();
      }
    });

  // Listen for donation validated events
  const userId = {{ $currentUser ? $currentUser->id : 'null' }};

  echo.private(`donations.${userId}`)
    .listen('DonationValidated', (e) => {
      console.log('New DonationValidated event received:', e);

      // Update counter
      let countElem = document.getElementById('notificationCount');
      let countHeaderElem = document.getElementById('notificationCountHeader');
      let count = parseInt(countElem?.textContent || '0') || 0;
      count++;
      if (countElem) countElem.textContent = count;
      if (countHeaderElem) countHeaderElem.textContent = count + ' Baru';

      // Add donation notification to list
      let notificationList = document.getElementById('notificationList');
      if (notificationList) {
        let newNotification = document.createElement('li');
        newNotification.classList.add('notification-item', 'border-0', 'p-0');
        newNotification.innerHTML = `
          <div class="notification-content">
            <div class="d-flex align-items-start">
              <div class="me-3 flex-shrink-0">
                <img src="{{ asset('assets/img/avatar-1.webp') }}" alt="User Avatar" class="rounded-circle">
              </div>
              <div class="flex-grow-1 min-width-0">
                <div class="d-flex align-items-center mb-2">
                  <span class="badge bg-success me-2">
                    <i class="bi bi-heart me-1"></i>Donasi
                  </span>
                  <strong class="text-dark" style="font-size: 0.9rem;">${e.name}</strong>
                </div>
                <p class="mb-2 text-muted lh-sm" style="font-size: 0.85rem;">
                  Donasi telah terverifikasi sebesar <span class="fw-bold text-success">Rp ${e.nominal.toLocaleString('id-ID')}</span>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted notification-time" data-timestamp="${e.updated_at}">
                    <i class="bi bi-clock me-1"></i>Baru saja
                  </small>
                </div>
              </div>
            </div>
          </div>
        `;
        notificationList.prepend(newNotification);
        updateNotificationTimes();
      }
    });

  // Listen for undangan created events
  const userRole = '{{ $currentGuard }}';

  if (userRole === 'alumni' || userRole === 'siswa') {
    echo.channel('undangan-channel')
      .listen('UndanganCreated', (e) => {
        console.log('New UndanganCreated event received:', e);

        // Check if this undangan is targeted to current user's role
        if (e.role_target && e.role_target.includes(userRole)) {
          // Update counter
          let countElem = document.getElementById('notificationCount');
          let countHeaderElem = document.getElementById('notificationCountHeader');
          let count = parseInt(countElem?.textContent || '0') || 0;
          count++;
          if (countElem) countElem.textContent = count;
          if (countHeaderElem) countHeaderElem.textContent = count + ' Baru';

          // Add undangan notification to list
          let notificationList = document.getElementById('notificationList');
          if (notificationList) {
            let newNotification = document.createElement('li');
            newNotification.classList.add('notification-item', 'border-0', 'p-0');
            newNotification.innerHTML = `
              <div class="notification-content">
  <div class="d-flex align-items-start">
    <div class="me-3 flex-shrink-0">
      <img src="${e.gambar ? '{{ asset('storage/') }}' + e.gambar : '{{ asset('assets/img/avatar-1.webp') }}'}" 
           alt="User Avatar" 
           class="rounded-circle">
    </div>
    <div class="flex-grow-1 min-width-0">
      <div class="d-flex align-items-center mb-2">
        <span class="badge bg-primary me-2">
          <i class="bi bi-envelope-paper me-1"></i>Undangan
        </span>
        <strong class="text-dark" style="font-size: 0.9rem;">${e.name}</strong>
      </div>
      <p class="mb-2 text-muted lh-sm" style="font-size: 0.85rem;">
        Undangan baru: 
        <span class="fw-medium text-dark">
          "${e.judul.length > 50 ? e.judul.substring(0, 50) + '...' : e.judul}"
        </span>
      </p>
      <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted notification-time" data-timestamp="${e.created_at}">
          <i class="bi bi-clock me-1"></i>Baru saja
        </small>
        <div class="d-flex align-items-center gap-2">
          <small class="text-info">
            <i class="bi bi-people me-1"></i>${e.role_target ? e.role_target.join(', ') : ''}
          </small>

          <!-- 🔹 Download Lampiran -->
          ${e.gambar ? `
            <a href="{{ asset('storage/') }}` + e.gambar + `"
               download
               class="btn btn-sm btn-outline-primary"
               title="Download Lampiran">
              <i class="bi bi-download"></i>
            </a>`
          : ''}

          <!-- 🔹 Download PDF Undangan -->
          <a href="{{ route('undangan.download-pdf', '') }}` + e.id + `"
             download
             class="btn btn-sm btn-success"
             title="Download PDF Undangan">
            <i class="bi bi-file-earmark-pdf"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

            `;
            notificationList.prepend(newNotification);
            updateNotificationTimes();
          }
        }
      });
  }
</script>