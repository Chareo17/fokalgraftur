@extends('layouts.app')

@section('content')
  <!-- Hero Section -->
  <section id="hero" class="hero section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row align-items-center">
        <div class="col-lg-6" style="">
          <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
            <div class="company-badge mb-4">
              <i class="bi bi-gear-fill me-2"></i>
              Working for your success
            </div>

            <h1 class="mb-4">
              Aplikasi<br>Digital 
              Alumni <br>
              <span class="accent-text">SMK Grafika <br> Yayasan Lektur</span>
            </h1>

           <p class="mb-4 mb-md-5"  style="text-align: justify; text-justify: inter-word;">
  Aplikasi ini dirancang untuk memudahkan pengelolaan data alumni SMK Grafika Yayasan Lektur, memperkuat komunikasi dengan sekolah, serta membangun jaringan profesional antar lulusan.
</p>


            <div class="hero-buttons">
              {{-- <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Get Started</a> --}}
              {{-- <a href="hhttps://www.youtube.com/watch?v=i1u9l1M8g-M&t=111s" class="btn btn-link mt-2 mt-sm-0 glightbox">
                <i class="bi bi-play-circle me-1"></i>
                Play Video
              </a> --}}
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
            <img src="{{ asset('assets/img/illustration-1.webp') }}" alt="Hero Image" class="img-fluid">

            {{-- <div class="customers-badge">
              <div class="customer-avatars">
                <img src="{{ asset('assets/img/avatar-1.webp') }}" alt="Customer 1" class="avatar">
                <img src="{{ asset('assets/img/avatar-2.webp') }}" alt="Customer 2" class="avatar">
                <img src="{{ asset('assets/img/avatar-3.webp') }}" alt="Customer 3" class="avatar">
                <img src="{{ asset('assets/img/avatar-4.webp') }}" alt="Customer 4" class="avatar">
                <img src="{{ asset('assets/img/avatar-5.webp') }}" alt="Customer 5" class="avatar">
                <span class="avatar more">12+</span>
              </div>
              <p class="mb-0 mt-2">12,000+ lorem ipsum dolor sit amet consectetur adipiscing elit</p>
            </div> --}}
          </div>
        </div>
      </div>

      <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
        <!-- stat items… -->
      </div>

    </div>
  </section><!-- /Hero Section -->

  <!-- About Section -->
  <section id="about" class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4 align-items-center justify-content-between">

        <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
          <span class="about-meta">TENTANG KAMI</span>
          <h2 class="about-title">Membangun Jaringan Alumni yang Lebih Kuat</h2>
        <p class="about-description" style="text-align: justify; text-justify: inter-word;">
    Kami berkomitmen untuk mendukung Alumni SMK Grafika Yayasan Lektur dalam mengelola data kealumnian, memperkuat hubungan komunikasi, serta membuka peluang jejaring profesional yang bermanfaat bagi seluruh alumni. Melalui platform ini, kami berharap tercipta komunitas alumni yang aktif, solid, dan saling mendukung untuk kemajuan bersama.
</p>


          <!-- feature list… -->

          {{-- <div class="info-wrapper">
            <div class="row gy-4">
              <div class="col-lg-5">
                <div class="profile d-flex align-items-center gap-3">
                  <img src="{{ asset('assets/img/avatar-1.webp') }}" alt="CEO Profile" class="profile-image">
                  <div>
                    <h4 class="profile-name">Andi Wijaya</h4>
                    <p class="profile-position">Founder & CEO</p>
                  </div>
                </div>
              </div>
              <!-- contact info… -->
            </div>
          </div> --}}
        </div>

        <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
          <div class="image-wrapper">
            <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
              <img src="{{ asset('assets/img/alumni.jpg') }}" alt="Manajemen Alumni" class="img-fluid main-image rounded-4">
              <img src="{{ asset('assets/img/gambar/gambar3.jpg') }}" alt="Kolaborasi Alumni" class="img-fluid small-image rounded-4">
            </div>
            {{-- <div class="experience-badge floating">
              <h3>5+ <span>Tahun</span></h3>
              <p>Pengalaman dalam manajemen alumni</p>
            </div> --}}
          </div>
        </div>
      </div>

    </div>
  </section><!-- /About Section -->

  <!-- Organizational Structure Section -->
  <section id="struktur" class="struktur section">
    <div class="container section-title" data-aos="fade-up" style="padding-bottom: 0px;">
      <p class="section-heading fw-bold text-primary">Struktur Organisasi</p>
      {{-- <p class="text-muted">Struktur Organisasi SMK Grafika Yayasan Lektur</p> --}}
    </div>
  
    <div class="container d-flex justify-content-center align-items-center" data-aos="zoom-in" data-aos-delay="200">
      <!-- Tombol Kiri -->
      <button class="btn btn-primary btn-lg me-3 struktur-nav-btn" onclick="prevStruktur()" id="prevBtnStruktur">
        <i class="bi bi-chevron-left"></i>
      </button>

      <!-- Card Gambar -->
      <div class="card shadow-lg border-0 rounded-4 p-3 struktur-card position-relative">
        <img src="{{ asset('assets/img/struktur.jpg') }}"
             alt="Struktur Organisasi SMK Grafika Yayasan Lektur"
             class="img-fluid rounded-3 struktur-img"
             id="strukturImg">

        <!-- Indicator/Label -->
        <div class="text-center mt-3">
          <h5 class="fw-bold text-dark" id="strukturTitle">Struktur Organisasi SMK Grafika Yayasan Lektur</h5>
          <p class="text-muted small" id="strukturCounter">1 / 2</p>
        </div>
      </div>

      <!-- Tombol Kanan -->
      <button class="btn btn-primary btn-lg ms-3 struktur-nav-btn" onclick="nextStruktur()" id="nextBtnStruktur">
        <i class="bi bi-chevron-right"></i>
      </button>
    </div>

    <!-- Dots Indicator (Optional) -->
    <div class="d-flex justify-content-center mt-4">
      <span class="struktur-dot active" onclick="showStruktur(0)"></span>
      <span class="struktur-dot" onclick="showStruktur(1)"></span>
    </div>
  </section>

  <!-- /Organizational Structure Section -->

{{-- testimoni --}}
<section id="testimoni" class="testimoni section">
  <div class="container section-title fw-bold text-primary" data-aos="fade-up" style="margin-bottom: 0px; padding-bottom: 0px;">
    <h2>Testimoni Alumni</h2>
    <div class="title-underline"></div>
    <p class="section-subtitle">Cerita sukses alumni yang telah berkarya di dunia kerja</p>
  </div>

  <div class="testimonial-carousel-container" data-aos="fade-up" data-aos-delay="200" style="margin-bottom: -25px;">
    <!-- Navigation Buttons -->
    <button class="carousel-btn carousel-btn-prev" id="prevBtn">
      <i class="fas fa-chevron-left"></i>
    </button>
    <button class="carousel-btn carousel-btn-next" id="nextBtn">
      <i class="fas fa-chevron-right"></i>
    </button>

    <!-- Carousel Wrapper -->
    <div class="testimonial-carousel" id="testimonialCarousel">
      @if(isset($testimonials) && count($testimonials) > 0)
        @foreach($testimonials as $testimonial)
        <div class="testimonial-slide">
          <div class="testimonial-card h-100">
            <div class="quote-icon">
              <i class="fas fa-quote-left"></i>
            </div>
            <div class="card-body text-center p-4">
              <div class="alumni-photo">
                <img src="{{ $testimonial->foto ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face' }}" alt="Foto {{ $testimonial->nama_alumni }}" class="rounded-circle mb-3">
                <div class="photo-border"></div>
              </div>
              <h5 class="card-title mb-1">{{ $testimonial->nama_alumni }}</h5>
              <div class="alumni-info">
                <span class="graduation-year">Lulusan {{ $testimonial->tahun_lulusan }}</span>
                <span class="divider">•</span>
                <span class="major">{{ $testimonial->jurusan }}</span>
              </div>
              @if($testimonial->posisi_pekerjaan || $testimonial->nama_perusahaan)
              <div class="position-info">
                @if($testimonial->posisi_pekerjaan)
                  <span class="position">{{ $testimonial->posisi_pekerjaan }}</span>
                @endif
                @if($testimonial->posisi_pekerjaan && $testimonial->nama_perusahaan)
                  <span class="divider">•</span>
                @endif
                @if($testimonial->nama_perusahaan)
                  <span class="company">{{ $testimonial->nama_perusahaan }}</span>
                @endif
              </div>
              @endif
              <p class="testimonial-text">
                "{{ $testimonial->testimoni }}"
              </p>
            </div>
          </div>
        </div>
        @endforeach
      @else
        <div class="testimonial-slide">
          <div class="testimonial-card h-100">
            <div class="card-body text-center p-4">
              <i class="fas fa-quote-left fa-3x text-muted mb-3"></i>
              <h5 class="card-title mb-3">Belum ada testimoni</h5>
              <p class="testimonial-text text-muted">
                Testimoni alumni akan segera ditampilkan di sini.
              </p>
            </div>
          </div>
        </div>
      @endif
    </div>

    <!-- Indicators -->
    <div class="carousel-indicators">
      <span class="indicator active" data-slide="0"></span>
      <span class="indicator" data-slide="1"></span>
      <span class="indicator" data-slide="2"></span>
      <span class="indicator" data-slide="3"></span>
      <span class="indicator" data-slide="4"></span>
      <span class="indicator" data-slide="5"></span>
      <span class="indicator" data-slide="6"></span>
    </div>
  </div>
</section>
{{-- endtestimoni --}}



    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up" style="padding-bottom: 0">
        <p class="section-heading">Features</p>
        <p>Platform ini menyediakan berbagai fitur untuk mendukung kolaborasi dan pengembangan diri pengguna, antara lain:</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="d-flex justify-content-center">

          <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">

            <li class="nav-item">
              <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                <h4>Berita</h4>
              </a>
            </li><!-- End tab nav item -->

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                <h4>Lowongan Kerja</h4>
              </a>
            </li><!-- End tab nav item -->

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                <h4>Donasi</h4>
              </a>
            </li><!-- End tab nav item -->

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4">
                <h4>Mentorship</h4>
              </a>
            </li><!-- End tab nav item -->

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-5">
                <h4>Forum</h4>
              </a>
            </li><!-- End tab nav item -->

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-6">
                <h4>Pintar</h4>
              </a>
            </li><!-- End tab nav item -->

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-7">
                <h4>Voucher</h4>
              </a>
            </li><!-- End tab nav item -->

          </ul>

        </div>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

          <div class="tab-pane fade active show" id="features-tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Fitur Berita</h3>
                <p class="fst-italic">
                  Fitur ini memberikan informasi terkini seputar kegiatan, prestasi, dan pengumuman penting yang berkaitan dengan alumni.
                  Dirancang untuk menjaga keterhubungan dan memperkuat jaringan antar alumni.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Menampilkan berita dan informasi aktual terkait alumni dan institusi.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Admin dapat mengelola konten berita melalui dashboard yang mudah digunakan.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Setiap berita dilengkapi dengan gambar, deskripsi, dan tanggal publikasi agar lebih informatif.</span></li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/gambar/berita.jpg" alt="Fitur Berita Alumni" class="img-fluid">
              </div>
            </div>
          </div>
          <!-- End tab content item -->

          <div class="tab-pane fade" id="features-tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Fitur Lowongan Kerja</h3>
                <p class="fst-italic">
                  Fitur ini menyediakan informasi lowongan kerja yang ditujukan untuk alumni, sehingga mereka dapat tetap update terhadap peluang kerja yang tersedia.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Menampilkan daftar lowongan kerja yang dikumpulkan dari berbagai sumber terpercaya.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Setiap lowongan disertai informasi penting seperti nama perusahaan, posisi, dan kualifikasi dasar.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Alumni dapat melihat detail lowongan dan mengakses link atau kontak untuk melamar langsung.</span></li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/gambar/lowongan.jpg" alt="Fitur Lowongan Kerja" class="img-fluid">
              </div>
            </div>
          </div>
          <!-- End tab content item -->

          <div class="tab-pane fade" id="features-tab-3">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Fitur Donasi</h3>
                <p class="fst-italic">
                  Fitur ini memungkinkan alumni berkontribusi untuk kemajuan institusi melalui platform donasi digital yang aman dan terpercaya.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Alumni dapat memberikan donasi secara langsung melalui platform dengan sistem keamanan berlapis.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Donasi dapat dialokasikan untuk pembangunan fasilitas, kegiatan sosial, atau beasiswa siswa.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Notifikasi otomatis dikirim sebagai bukti penerimaan donasi yang telah dikonfirmasi admin.</span></li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/gambar/donasi.jpg" alt="Fitur Donasi Alumni" class="img-fluid">
              </div>
            </div>
          </div>
          <!-- End tab content item -->

          <div class="tab-pane fade" id="features-tab-4">
            <div class="row">
              <!-- Konten Teks -->
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Fitur Mentorship & Pelatihan Alumni</h3>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Alumni, siswa, dan admin dapat mengikuti berbagai program pelatihan atau Mentorship yang disediakan oleh sekolah atau komunitas alumni.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Materi pelatihan mencakup pengembangan karier, kewirausahaan, peningkatan soft skill, dan keterampilan profesional lainnya.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Pelatihan dapat diakses langsung melalui platform tanpa adanya sistem notifikasi atau penerbitan sertifikat.</span></li>
                </ul>                
                <p class="fst-italic">
                  Fitur ini memberikan kesempatan bagi alumni untuk terus berkembang melalui bimbingan langsung dari mentor berpengalaman. Membangun koneksi, berbagi ilmu, dan memperluas wawasan bersama komunitas alumni.
                </p>
              </div>
          
              <!-- Gambar Ilustrasi -->
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/gambar/mentorship.jpg" alt="Ilustrasi Mentoring Alumni" class="img-fluid">
              </div>
            </div >
          </div>
          <!-- End tab content item -->

          <div class="tab-pane fade" id="features-tab-5">
            <div class="row">
              <!-- Konten Teks -->
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Fitur Forum Diskusi</h3>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Tersedia forum diskusi yang dibagi dalam beberapa kategori seperti Karier, Pendidikan, dan Umum.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Alumni, siswa, dan admin dapat membuat topik baru, membalas komentar, dan berbagi pandangan secara terbuka.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Forum dirancang untuk menjadi wadah interaksi aktif, saling berbagi pengalaman, dan memperluas jaringan komunitas.</span></li>
                </ul>                
                <p class="fst-italic">
                  Fitur ini memberikan ruang bagi seluruh pengguna untuk berdiskusi secara konstruktif dalam berbagai topik. Dengan pembagian kategori, pengguna dapat dengan mudah menemukan atau memulai pembahasan sesuai minat mereka.
                </p>
              </div>
          
              <!-- Gambar Ilustrasi -->
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/gambar/forum.jpg" alt="Ilustrasi Forum Diskusi" class="img-fluid">
              </div>
            </div>
          </div>
          <!-- End tab content item -->

          <div class="tab-pane fade" id="features-tab-6">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Fitur Pintar</h3>
                <p class="fst-italic">
                  Fitur ini menyajikan perkembangan informasi terkini yang aktual dan realtime mengenai SMK Grafika. Memberikan transparansi dan keterbukaan informasi kepada seluruh alumni dan siswa.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Menampilkan update perkembangan sekolah secara realtime dan berkelanjutan.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Informasi mencakup prestasi siswa, program baru, kegiatan sekolah, dan pengumuman penting lainnya.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Setiap informasi dilengkapi dengan timestamp untuk menunjukkan keaktualan data yang disajikan.</span></li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/gambar/pintar.jpg" alt="Fitur Pintar" class="img-fluid">
              </div>
            </div>
          </div>
          <!-- End tab content item -->

          <div class="tab-pane fade" id="features-tab-7">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Fitur Voucher</h3>
                <p class="fst-italic">
                  Fitur ini memungkinkan alumni dan siswa untuk mengklaim berbagai voucher yang tersedia sebagai bentuk apresiasi dan dukungan dari institusi atau mitra kerja sama.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Menampilkan daftar voucher yang dapat diklaim oleh alumni dan siswa yang memenuhi syarat.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Voucher mencakup diskon pendidikan, pelatihan, akses ke event eksklusif, dan benefit lainnya.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Proses klaim voucher mudah dan cepat melalui platform dengan verifikasi otomatis.</span></li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/gambar/voucher.jpg" alt="Fitur Voucher" class="img-fluid">
              </div>
            </div>
          </div>
          <!-- End tab content item -->

        </div>

      </div>

    </section><!-- /Features Section -->

{{-- struktur Organisasi --}}
<style>
  /* Card container */
  .struktur-card {
    background: #ffffff;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    max-width: 1000px; /* batas lebar maksimal di layar besar */
    width: 100%;
  }

  /* Hover effect */
  .struktur-card:hover {
    transform: scale(1.02);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
  }

  /* Image styling */
  .struktur-img {
    border: 5px solid #f0f0f0;
    transition: transform 0.4s ease;
    width: 100%;
    height: auto;
  }

  .struktur-card:hover .struktur-img {
    transform: scale(1.01);
  }

  /* Responsif */
  @media (max-width: 768px) {
    .struktur-card {
      padding: 10px;
    }

    .struktur-img {
      border-width: 3px;
    }
  }

  @media (max-width: 576px) {
    .struktur-card {
      padding: 8px;
    }

    .struktur-img {
      border-width: 2px;
    }
  }

</style>

{{-- endstruktur --}}


{{-- fitur --}}
<style>
  .section-heading {
  font-size: 2rem;   /* besar seperti h2 */
  font-weight: bold;
  margin: 1rem 0 0.5rem;
}

.section-title {
  font-size: 1rem;   /* lebih kecil */
  color: #666;
  margin-bottom: 1.5rem;
}
</style>
{{-- endfitur --}}



{{-- testimoni --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

.testimoni {
  background: 
    linear-gradient(135deg, rgba(79, 172, 254, 0.1) 0%, rgba(0, 242, 254, 0.1) 100%),
    radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
    radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
    radial-gradient(circle at 40% 80%, rgba(120, 219, 255, 0.2) 0%, transparent 50%),
    linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 100px 0;
  position: relative;
  font-family: 'Poppins', sans-serif;
  overflow: hidden;
}

.testimoni::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: 
    radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 20%),
    radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 25%),
    radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.02) 0%, transparent 30%);
  pointer-events: none;
  z-index: 1;
}

.testimoni::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: 
    repeating-linear-gradient(45deg, transparent, transparent 2px, rgba(255, 255, 255, 0.03) 2px, rgba(255, 255, 255, 0.03) 4px),
    repeating-linear-gradient(-45deg, transparent, transparent 2px, rgba(255, 255, 255, 0.02) 2px, rgba(255, 255, 255, 0.02) 4px);
  pointer-events: none;
  z-index: 1;
}

.section-title {
  text-align: center;
  margin-bottom: 70px;
  position: relative;
  z-index: 3;
}

.section-title h2 {
  color: white !important;
  font-size: 3.2rem;
  font-weight: 700;
  margin-bottom: 20px;
  text-shadow: 0 4px 20px rgba(0,0,0,0.3);
  background: linear-gradient(135deg, #ffffff 0%, rgba(255,255,255,0.8) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.title-underline {
  width: 120px;
  height: 5px;
  background: linear-gradient(90deg, #ff6b6b 0%, #4ecdc4 50%, #45b7d1 100%);
  margin: 0 auto 25px;
  border-radius: 10px;
  position: relative;
  animation: shimmer 3s ease-in-out infinite;
}

.title-underline::before {
  content: '';
  position: absolute;
  top: -2px;
  left: -2px;
  right: -2px;
  bottom: -2px;
  background: linear-gradient(90deg, rgba(255, 107, 107, 0.3), rgba(78, 205, 196, 0.3), rgba(69, 183, 209, 0.3));
  border-radius: 12px;
  filter: blur(8px);
  z-index: -1;
}

@keyframes shimmer {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.7; }
}

.section-subtitle {
  color: rgba(255,255,255,0.9);
  font-size: 1.1rem;
  font-weight: 300;
  margin: 0;
}

/* Carousel Container */
.testimonial-carousel-container {
  position: relative;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 60px;
}

.testimonial-carousel {
  display: flex;
  transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  gap: 30px;
  padding: 20px 0;
}

.testimonial-slide {
  flex: 0 0 calc(33.333% - 20px);
  transition: all 0.45s cubic-bezier(0.2, 0.9, 0.2, 1);
  filter: blur(3px);
  opacity: 0.6;
  transform: scale(0.95);
  will-change: transform, opacity, filter;
}

.testimonial-slide.visible {
  filter: none;
  opacity: 1;
  transform: scale(1);
}

.testimonial-card {
  background: rgba(255, 255, 255, 0.98);
  backdrop-filter: blur(20px);
  border-radius: 25px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 
    0 25px 50px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(255, 255, 255, 0.05);
  transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  position: relative;
  overflow: hidden;
  z-index: 2;
  height: 100%;
}

.testimonial-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
  background-size: 300% 100%;
  animation: gradient-move 4s ease infinite;
}

@keyframes gradient-move {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

.testimonial-card:hover {
  transform: translateY(-15px) scale(1.03);
  box-shadow: 
    0 35px 70px rgba(0, 0, 0, 0.25),
    0 0 0 1px rgba(255, 255, 255, 0.1);
}

.quote-icon {
  position: absolute;
  top: 25px;
  right: 25px;
  color: #4ecdc4;
  font-size: 1.8rem;
  opacity: 0.4;
  transition: all 0.3s ease;
}

.testimonial-card:hover .quote-icon {
  opacity: 0.6;
  transform: scale(1.1);
}

.alumni-photo {
  position: relative;
  display: inline-block;
}

.alumni-photo img {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border: 4px solid white;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease;
}

.photo-border {
  position: absolute;
  top: -10px;
  left: -10px;
  right: -10px;
  bottom: -10px;
  border-radius: 50%;
  background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
  background-size: 300% 300%;
  z-index: -1;
  opacity: 0;
  transition: opacity 0.4s ease;
  animation: gradient-rotate 4s ease infinite;
}

@keyframes gradient-rotate {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.testimonial-card:hover .photo-border {
  opacity: 1;
}

.testimonial-card:hover .alumni-photo img {
  transform: scale(1.05);
}

.card-title {
  font-size: 1.4rem;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 8px;
}

.alumni-info {
  margin-bottom: 15px;
}

.graduation-year, .major {
  color: #666;
  font-size: 0.9rem;
  font-weight: 500;
}

.divider {
  margin: 0 8px;
  color: #ddd;
}

.rating {
  margin: 15px 0;
}

.rating i {
  color: #ffd700;
  font-size: 0.9rem;
  margin: 0 2px;
  filter: drop-shadow(0 2px 4px rgba(255, 215, 0, 0.3));
}

.testimonial-text {
  font-style: italic;
  color: #555;
  line-height: 1.6;
  font-size: 0.95rem;
  position: relative;
  padding: 0 15px;
}

.testimonial-text::before,
.testimonial-text::after {
  content: '"';
  font-size: 1.8rem;
  background: linear-gradient(45deg, #4ecdc4, #45b7d1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  font-weight: bold;
  position: absolute;
}

.testimonial-text::before {
  left: 0;
  top: -5px;
}

.testimonial-text::after {
  right: 0;
  bottom: -10px;
}

/* Navigation Buttons */
.carousel-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 50px;
  height: 50px;
  border: none;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  color: #4ecdc4;
  font-size: 1.2rem;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 10;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.carousel-btn:hover {
  background: rgba(255, 255, 255, 1);
  transform: translateY(-50%) scale(1.1);
  box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
}

.carousel-btn-prev { left: 10px; }
.carousel-btn-next { right: 10px; }

/* Indicators */
.carousel-indicators {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-top: 40px;
  z-index: 10;
  position: relative;
}

.indicator {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.4);
  cursor: pointer;
  transition: all 0.3s ease;
}

.indicator.active {
  background: #4ecdc4;
  transform: scale(1.2);
  box-shadow: 0 0 15px rgba(78, 205, 196, 0.5);
}

.indicator:hover {
  background: rgba(255, 255, 255, 0.7);
}

/* Responsive Design */
@media (max-width: 992px) {
  .testimonial-slide {
    flex: 0 0 calc(50% - 15px);
  }
}
@media (max-width: 768px) {
  .section-title h2 {
    font-size: 2.2rem;
    margin-bottom: 15px;
  }
  .testimonial-carousel-container {
    padding: 0 20px;
  }
  .testimonial-slide {
    flex: 0 0 100%;
    filter: none;
    opacity: 1;
    transform: scale(1);
    margin-bottom: 20px;
  }
  .testimonial-card {
    margin: 0 auto;
    max-width: 100%;
    border-radius: 20px;
  }
  .card-body {
    padding: 3rem 2rem;
  }
  .alumni-photo img {
    width: 90px;
    height: 90px;
  }
  .card-title {
    font-size: 1.2rem;
    margin-bottom: 10px;
  }
  .alumni-info {
    margin-bottom: 12px;
  }
  .graduation-year, .major {
    font-size: 0.85rem;
  }
  .position-info {
    margin-bottom: 15px;
  }
  .position, .company {
    font-size: 0.9rem;
    font-weight: 600;
  }
  .testimonial-text {
    font-size: 0.9rem;
    line-height: 1.5;
    padding: 0 10px;
  }
  .carousel-btn {
    width: 45px;
    height: 45px;
    font-size: 1rem;
  }
  .carousel-btn-prev { left: 5px; }
  .carousel-btn-next { right: 5px; }
}
@media (max-width: 576px) {
  .testimoni {
    padding: 60px 0;
  }
  .testimonial-carousel-container {
    padding: 0 15px;
  }
  .card-body {
    padding: 2.5rem 1.5rem;
  }
  .alumni-photo img {
    width: 80px;
    height: 80px;
  }
  .card-title {
    font-size: 1.1rem;
  }
  .testimonial-text {
    font-size: 0.85rem;
  }
  .carousel-btn {
    width: 40px;
    height: 40px;
    font-size: 0.9rem;
  }
}
.struktur-nav-btn {
      border-radius: 50%;
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
      transition: all 0.3s ease;
    }

    .struktur-nav-btn:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .struktur-nav-btn i {
      font-size: 1.5rem;
    }

    .struktur-card {
      max-width: 900px;
      transition: all 0.3s ease;
    }

    .struktur-img {
      transition: opacity 0.3s ease;
    }

    .struktur-dot {
      height: 12px;
      width: 12px;
      margin: 0 5px;
      background-color: #dee2e6;
      border-radius: 50%;
      display: inline-block;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .struktur-dot.active,
    .struktur-dot:hover {
      background-color: var(--bs-primary, #0d6efd);
      transform: scale(1.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .struktur-nav-btn {
        width: 40px;
        height: 40px;
      }
      
      .struktur-nav-btn i {
        font-size: 1.2rem;
      }
    }
  </style>
  {{-- endtestimoni --}}
  <script>
    class TestimonialCarousel {
      constructor() {
        this.carousel = document.getElementById('testimonialCarousel');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        this.slides = Array.from(document.querySelectorAll('.testimonial-slide'));
        this.indicatorsContainer = document.querySelector('.carousel-indicators');
    
        this.totalSlides = this.slides.length;
        this.slidesToShow = this.getSlidesToShow();
        this.maxSlide = Math.max(0, this.totalSlides - this.slidesToShow);
        this.currentSlide = 0;
        this.autoPlayInterval = null;
    
        this.init();
      }
    
      getSlidesToShow() {
        if (window.innerWidth <= 768) return 1;
        if (window.innerWidth <= 992) return 2;
        return 3; // default
      }
    
      buildIndicators() {
        const count = Math.max(1, this.maxSlide + 1);
        this.indicatorsContainer.innerHTML = '';
        for (let i = 0; i < count; i++) {
          const span = document.createElement('span');
          span.className = 'indicator';
          span.dataset.slide = i;
          span.addEventListener('click', () => this.goToSlide(i));
          this.indicatorsContainer.appendChild(span);
        }
        this.indicators = Array.from(this.indicatorsContainer.querySelectorAll('.indicator'));
      }
    
      init() {
        this.prevBtn.addEventListener('click', () => this.prevSlide());
        this.nextBtn.addEventListener('click', () => this.nextSlide());
    
        window.addEventListener('resize', () => {
          const old = this.slidesToShow;
          this.slidesToShow = this.getSlidesToShow();
          this.maxSlide = Math.max(0, this.totalSlides - this.slidesToShow);
          if (this.currentSlide > this.maxSlide) this.currentSlide = this.maxSlide;
          if (old !== this.slidesToShow) this.buildIndicators();
          this.updateCarousel();
        });
    
        const container = document.querySelector('.testimonial-carousel-container');
        container.addEventListener('mouseenter', () => this.stopAutoPlay());
        container.addEventListener('mouseleave', () => this.autoPlay());
    
        this.buildIndicators();
        this.updateCarousel();
        this.autoPlay();
      }
    
      prevSlide() {
        if (this.currentSlide > 0) this.currentSlide--;
        else this.currentSlide = this.maxSlide; // loop balik
        this.updateCarousel();
        this.resetAutoPlay();
      }
    
      nextSlide() {
        if (this.currentSlide < this.maxSlide) this.currentSlide++;
        else this.currentSlide = 0; // loop awal
        this.updateCarousel();
        this.resetAutoPlay();
      }
    
      goToSlide(index) {
        this.currentSlide = Math.min(Math.max(0, index), this.maxSlide);
        this.updateCarousel();
        this.resetAutoPlay();
      }
    
      updateCarousel() {
        if (!this.slides.length) return;
    
        const gapStr = getComputedStyle(this.carousel).gap || '30px';
        const gap = parseFloat(gapStr);
        const slideRect = this.slides[0].getBoundingClientRect();
        const slideWidth = slideRect.width;
    
        const translateX = (slideWidth + gap) * this.currentSlide;
        this.carousel.style.transform = `translateX(-${translateX}px)`;
    
        // Atur visible/blur
        this.slides.forEach((slide, idx) => {
          if (idx >= this.currentSlide && idx < this.currentSlide + this.slidesToShow) {
            slide.classList.add('visible');
          } else {
            slide.classList.remove('visible');
          }
        });
    
        // Update indikator
        if (!this.indicators || this.indicators.length !== Math.max(1, this.maxSlide + 1)) {
          this.buildIndicators();
        }
        this.indicators.forEach((ind, idx) => ind.classList.toggle('active', idx === this.currentSlide));
      }
    
      autoPlay() {
        this.stopAutoPlay();
        this.autoPlayInterval = setInterval(() => this.nextSlide(), 4000);
      }
    
      stopAutoPlay() {
        if (this.autoPlayInterval) {
          clearInterval(this.autoPlayInterval);
          this.autoPlayInterval = null;
        }
      }
    
      resetAutoPlay() {
        this.stopAutoPlay();
        setTimeout(() => this.autoPlay(), 3000);
      }
    }
    
    document.addEventListener('DOMContentLoaded', () => new TestimonialCarousel());
    </script>
     <script>
      let currentStruktur = 0;
      
      const strukturData = [
        {
          title: 'Struktur Organisasi SMK Grafika Yayasan Lektur',
          img: '{{ asset("assets/img/struktur.jpg") }}',
          alt: 'Struktur Organisasi SMK Grafika Yayasan Lektur'
        },
        {
          title: 'Struktur Organisasi Manajemen Alumni SMK Grafika Yayasan Lektur',
          img: '{{ asset("assets/img/struktur_organisasi_alumni.png") }}',
          alt: 'Struktur Organisasi Manajemen Alumni SMK Grafika Yayasan Lektur'
        }
      ];
  
      function showStruktur(index) {
        currentStruktur = index;
        
        const img = document.getElementById('strukturImg');
        const title = document.getElementById('strukturTitle');
        const counter = document.getElementById('strukturCounter');
        
        // Fade out effect
        img.style.opacity = '0';
        
        setTimeout(() => {
          img.src = strukturData[currentStruktur].img;
          img.alt = strukturData[currentStruktur].alt;
          title.textContent = strukturData[currentStruktur].title;
          counter.textContent = `${currentStruktur + 1} / ${strukturData.length}`;
          
          // Fade in effect
          img.style.opacity = '1';
        }, 150);
        
        // Update dots
        const dots = document.querySelectorAll('.struktur-dot');
        dots.forEach((dot, i) => {
          dot.classList.toggle('active', i === currentStruktur);
        });
      }
  
      function nextStruktur() {
        currentStruktur = (currentStruktur + 1) % strukturData.length;
        showStruktur(currentStruktur);
      }
  
      function prevStruktur() {
        currentStruktur = (currentStruktur - 1 + strukturData.length) % strukturData.length;
        showStruktur(currentStruktur);
      }
  
      // Keyboard navigation
      document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') prevStruktur();
        if (e.key === 'ArrowRight') nextStruktur();
      });
  
      // Touch swipe support (optional)
      let touchStartX = 0;
      let touchEndX = 0;
      
      const strukturCard = document.querySelector('.struktur-card');
      
      strukturCard.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
      });
      
      strukturCard.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
      });
      
      function handleSwipe() {
        if (touchEndX < touchStartX - 50) nextStruktur();
        if (touchEndX > touchStartX + 50) prevStruktur();
      }
    </script>
    
@endsection