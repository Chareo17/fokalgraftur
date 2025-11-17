@extends('layouts.app')

@section('content')
<style>
  :root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
    --border-radius: 15px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  body {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  }

  .forum-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
  }

  /* Header Styles */
  .forum-header {
    background: var(--primary-gradient);
    color: white;
    border-radius: var(--border-radius);
    padding: 3rem 2rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
    box-shadow: var(--card-shadow);
    animation: slideInDown 0.8s ease-out;
  }

  .forum-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    animation: float 20s ease-in-out infinite;
  }

  .forum-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }

  .forum-header p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    line-height: 1.6;
  }

  .btn-primary-gradient {
    background: var(--success-gradient);
    border: none;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 600;
    color: white;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(0, 242, 254, 0.3);
  }

  .btn-primary-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 242, 254, 0.4);
    color: white;
  }

  /* Filter Section */
  .filter-section {
    background: white;
    padding: 1.5rem;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    margin-bottom: 2rem;
    animation: slideInUp 0.8s ease-out 0.2s both;
  }

  .form-select {
    border: 2px solid #e1e5e9;
    border-radius: 10px;
    padding: 12px 16px;
    transition: var(--transition);
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
  }

  .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
  }

  /* Topic Cards */
  .topics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
  }

  .forum-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 1.5rem;
    box-shadow: var(--card-shadow);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    cursor: pointer;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .forum-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
    transform: scaleX(0);
    transition: var(--transition);
  }

  .forum-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--card-shadow-hover);
  }

  .forum-card:hover::before {
    transform: scaleX(1);
  }

  .card-header {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    gap: 12px;
  }

  .avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
    line-height: 1.3;
  }

  .card-meta {
    font-size: 0.85rem;
    color: #718096;
    margin: 0;
  }

  .card-content {
    color: #4a5568;
    line-height: 1.6;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .category-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .category-karier {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
  }

  .category-pendidikan {
    background: linear-gradient(135deg, #f093fb, #f5576c);
    color: white;
  }

  .category-umum {
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    color: white;
  }

  /* Detail Section */
  .detail-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    border: none;
    overflow: hidden;
  }

  .detail-header {
    background: var(--primary-gradient);
    color: white;
    padding: 2rem;
  }

  .detail-body {
    padding: 2rem;
  }

  .detail-title {
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 1rem;
  }

  .discussion-section {
    background: white;
    border-radius: var(--border-radius);
    padding: 1.5rem;
    box-shadow: var(--card-shadow);
    margin-bottom: 1.5rem;
  }

  .reply-item {
    background: linear-gradient(145deg, #f8f9fa, #e9ecef);
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 1rem;
    border-left: 4px solid #667eea;
    transition: var(--transition);
  }

  .reply-item:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  /* Form Styles */
  .form-section {
    background: white;
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--card-shadow);
  }

  .form-control {
    border: 2px solid #e1e5e9;
    border-radius: 10px;
    padding: 12px 16px;
    transition: var(--transition);
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
  }

  .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
  }

  .btn-back {
    background: white;
    border: 2px solid #e1e5e9;
    color: #4a5568;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    transition: var(--transition);
  }

  .btn-back:hover {
    background: #f7fafc;
    border-color: #667eea;
    color: #667eea;
    transform: translateY(-1px);
  }

  .btn-success-gradient {
    background: linear-gradient(135deg, #48bb78, #38a169);
    border: none;
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 600;
    transition: var(--transition);
  }

  .btn-success-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
    color: white;
  }

  /* Animations */
  @keyframes slideInDown {
    from {
      opacity: 0;
      transform: translateY(-30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes slideInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
  }

  .fade-in {
    animation: slideInUp 0.6s ease-out both;
  }

  .fade-in:nth-child(1) { animation-delay: 0.1s; }
  .fade-in:nth-child(2) { animation-delay: 0.2s; }
  .fade-in:nth-child(3) { animation-delay: 0.3s; }
  .fade-in:nth-child(4) { animation-delay: 0.4s; }

  /* Responsive Design */
  @media (max-width: 768px) {
    .forum-container {
      padding: 1rem;
    }
    
    .forum-header {
      padding: 2rem 1.5rem;
    }
    
    .forum-header h1 {
      font-size: 1.8rem;
    }
    
    .topics-grid {
      grid-template-columns: 1fr;
      gap: 1rem;
    }
    
    .forum-card {
      padding: 1rem;
    }
  }

  /* Loading Animation */
  .loading-shimmer {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
  }

  @keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
  }
</style>

<div class="forum-container" style="margin-top: 100px">
  <!-- Header -->
  <div class="forum-header">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h1>
          🌟 Selamat Datang di <span style="background: linear-gradient(45deg, #fff, #e0e7ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Forum Komunitas</span>
        </h1>
        <p>
          Bergabunglah dalam diskusi menarik bersama alumni dan teman-teman. Mari berbagi pengetahuan, pengalaman, dan saling mendukung dalam perjalanan karier! 🚀
        </p>
        <button class="btn btn-primary-gradient" onclick="showSection('form')">
          <i class="bi bi-plus-circle me-2"></i> Mulai Diskusi Baru
        </button>
      </div>
      <div class="col-md-4 text-center d-none d-md-block">
        <div style="position: relative;">
          <img src="{{ asset('assets/img/diskusi.png') }}" alt="Forum Illustration" 
               style="max-width: 100%; height: auto; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));">
          <div style="position: absolute; top: -20px; right: -20px; width: 60px; height: 60px; 
                      background: var(--success-gradient); border-radius: 50%; 
                      display: flex; align-items: center; justify-content: center;
                      animation: float 3s ease-in-out infinite;">
            <i class="bi bi-chat-heart-fill" style="font-size: 1.5rem; color: white;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Filter Section -->
  <div class="filter-section">
    <div class="row align-items-center">
      <div class="col-md-6">
        <label for="category-select" class="form-label fw-bold mb-2">
          <i class="bi bi-funnel me-2"></i>Filter Kategori
        </label>
        <select id="category-select" class="form-select" onchange="filterCategory(this.value)">
          <option value="">🌐 Semua Kategori</option>
          <option value="karier">💼 Karier</option>
          <option value="pendidikan">📚 Pendidikan</option>
          <option value="umum">💬 Umum</option>
        </select>
      </div>
      <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <div class="d-flex align-items-center justify-content-md-end gap-3">
          <span class="text-muted fw-medium">
            <i class="bi bi-collection me-1"></i>
            <span id="topic-count">{{ count($topics) }}</span> Topik
          </span>
          <div class="d-flex gap-1">
            <div class="category-badge category-karier" style="padding: 4px 8px; font-size: 0.7rem;">Karier</div>
            <div class="category-badge category-pendidikan" style="padding: 4px 8px; font-size: 0.7rem;">Pendidikan</div>
            <div class="category-badge category-umum" style="padding: 4px 8px; font-size: 0.7rem;">Umum</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Topics List -->
  <div id="topik-list">
    <div class="topics-grid" id="topics-container">
      @foreach ($topics as $index => $topic)
      <div class="forum-card fade-in" onclick="showDetail({{ $topic['id'] }})">
        <div class="card-header">
          @if(!empty($topic['profile_image']))
            <img src="{{ asset('storage/' . $topic['profile_image']) }}" class="avatar" alt="Avatar">
          @else
            <img src="https://i.pravatar.cc/96?u={{ strtolower($topic['creator_identifier'] ?? $topic['creator_role']) }}" class="avatar" alt="Avatar">
          @endif
          <div style="flex: 1;">
            <h3 class="card-title ">{{ $topic['judul_topik'] }}</h3>
            <p class="card-meta">
              <i class="bi bi-person-circle me-1"></i>{{ $topic['creator_name'] }} • 
              <i class="bi bi-briefcase me-1"></i>{{ $topic['creator_role'] }} • 
              <i class="bi bi-clock me-1"></i>{{ $topic['time_ago'] }} lalu
            </p>
          </div>
        </div>
        <p class="card-content">{{ $topic['isi_topik'] }}</p>
        <div class="d-flex justify-content-between align-items-center">
          <span class="category-badge category-{{ $topic['kategori'] }}">
            @if($topic['kategori'] == 'karier') 💼 @elseif($topic['kategori'] == 'pendidikan') 📚 @else 💬 @endif
            {{ ucfirst($topic['kategori']) }}
          </span>
          <small class="text-muted">
            <i class="bi bi-eye me-1"></i>Klik untuk detail
          </small>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- Detail Topik -->
  <div id="topik-detail" class="d-none">
    <button class="btn btn-back mb-4" onclick="showSection('list')">
      <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
    </button>

    <div class="detail-card mb-4">
      <div class="detail-header">
        <h1 id="judul-topik" class="detail-title mb-3 text-white"></h1>
        <div class="d-flex align-items-center gap-3">
          <img id="avatar-detail" src="" class="avatar" style="width: 56px; height: 56px;" alt="Avatar">
          <div>
            <p id="creator-info" class="mb-1 fw-semibold"></p>
            <p id="time-info" class="mb-0 opacity-75"></p>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <p id="isi-topik" style="font-size: 1.1rem; line-height: 1.7;"></p>
      </div>
    </div>

    <div class="discussion-section">
      <h4 class="mb-4">
        <i class="bi bi-chat-dots me-2" style="color: #667eea;"></i>
        Diskusi & Balasan
      </h4>
      <div id="discussion-list"></div>
    </div>

    <div class="form-section">
      <h5 class="mb-3">
        <i class="bi bi-reply me-2"></i>Tambahkan Balasan
      </h5>
      <form id="reply-form" onsubmit="submitReply(event)">
        <textarea class="form-control mb-3" rows="4" maxlength="1000"
                  placeholder="Bagikan pemikiran, pengalaman, atau saran Anda..." required></textarea>
      <button type="submit" class="btn btn-success-gradient">
        <i class="bi bi-send me-2"></i> Kirim Balasan
      </button>
      </form>
    </div>
  </div>

  <!-- Form Topik Baru -->
  <div id="topik-form" class="d-none">
    <button class="btn btn-back mb-4" onclick="showSection('list')">
      <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
    </button>
    
    <div class="form-section">
      <div class="text-center mb-4">
        <h3 class="fw-bold">
          <i class="bi bi-plus-circle-dotted me-2" style="color: #667eea;"></i>
          Buat Topik Diskusi Baru
        </h3>
        <p class="text-muted">Mulai percakapan yang menarik dan bermanfaat untuk komunitas</p>
      </div>
      
      <form id="new-topic-form" onsubmit="submitNewTopic(event)">
        <div class="mb-4">
          <label class="form-label fw-bold">
            <i class="bi bi-card-heading me-2"></i>Judul Topik
          </label>
          <input type="text" name="judul_topik" class="form-control" 
                 placeholder="Contoh: Tips Sukses Interview di Perusahaan BUMN" required>
        </div>
        
        <div class="mb-4">
          <label class="form-label fw-bold">
            <i class="bi bi-tags me-2"></i>Kategori
          </label>
          <select name="kategori" class="form-select" required>
            <option value="" disabled selected>-- Pilih Kategori yang Sesuai --</option>
            <option value="karier">💼 Karier (Lowongan, Tips Interview, Networking)</option>
            <option value="pendidikan">📚 Pendidikan (Kursus, Sertifikasi, Skill Development)</option>
            <option value="umum">💬 Umum (Diskusi Bebas, Sharing Pengalaman)</option>
          </select>
        </div>
        
        <div class="mb-4">
          <label class="form-label fw-bold">
            <i class="bi bi-journal-text me-2"></i>Isi Topik
          </label>
          <textarea name="isi_topik" class="form-control" rows="6" 
                    placeholder="Ceritakan topik diskusi Anda dengan detail. Semakin jelas dan menarik, semakin banyak yang akan berpartisipasi!" required></textarea>
        </div>
        
        <div class="text-center">
          <button type="submit" class="btn btn-success-gradient btn-lg">
            <i class="bi bi-rocket-takeoff me-2"></i> Publikasikan Topik
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
let topics = @json($topics);
let filteredTopics = topics;

function showSection(section) {
  // Hide all sections with smooth transition
  ['topik-list', 'topik-detail', 'topik-form'].forEach(id => {
    const element = document.getElementById(id);
    element.style.opacity = '0';
    element.style.transform = 'translateY(20px)';
    setTimeout(() => {
      element.classList.add('d-none');
    }, 300);
  });

  // Show selected section with smooth transition
  setTimeout(() => {
    const targetElement = document.getElementById(`topik-${section}`);
    targetElement.classList.remove('d-none');
    setTimeout(() => {
      targetElement.style.opacity = '1';
      targetElement.style.transform = 'translateY(0)';
    }, 50);
  }, 300);
}

function filterCategory(category) {
  // Add loading animation
  const container = document.getElementById('topics-container');
  container.style.opacity = '0.5';
  
  setTimeout(() => {
    if (!category) {
      filteredTopics = topics;
    } else {
      filteredTopics = topics.filter(topic => topic.kategori === category);
    }
    renderTopicList();
    updateTopicCount();
    container.style.opacity = '1';
  }, 300);
}

function updateTopicCount() {
  document.getElementById('topic-count').textContent = filteredTopics.length;
}

function renderTopicList() {
  const container = document.getElementById('topics-container');
  container.innerHTML = '';

  filteredTopics.forEach((topic, index) => {
    const card = document.createElement('div');
    card.className = 'forum-card fade-in';
    card.style.animationDelay = `${index * 0.1}s`;
    card.onclick = () => showDetail(topic.id);

    const categoryIcon = topic.kategori === 'karier' ? '💼' : 
                        topic.kategori === 'pendidikan' ? '📚' : '💬';

    card.innerHTML = `
      <div class="card-header">
        <img src="${topic.profile_image ? `/storage/${topic.profile_image}` : `https://i.pravatar.cc/96?u=${(topic.creator_identifier || topic.creator_role).toLowerCase()}`}" 
             class="avatar" alt="Avatar">
        <div style="flex: 1;">
          <h3 class="card-title ">${topic.judul_topik}</h3>
          <p class="card-meta">
            <i class="bi bi-person-circle me-1"></i>${topic.creator_name} • 
            <i class="bi bi-briefcase me-1"></i>${topic.creator_role} • 
            <i class="bi bi-clock me-1"></i>${topic.time_ago} lalu
          </p>
        </div>
      </div>
      <p class="card-content">${topic.isi_topik}</p>
      <div class="d-flex justify-content-between align-items-center">
        <span class="category-badge category-${topic.kategori}">
          ${categoryIcon} ${topic.kategori.charAt(0).toUpperCase() + topic.kategori.slice(1)}
        </span>
        <small class="text-muted">
          <i class="bi bi-eye me-1"></i>Klik untuk detail
        </small>
      </div>
    `;

    container.appendChild(card);
  });
}

function showDetail(id) {
  showSection('detail');
  const topic = topics.find(t => t.id === id);
  if (topic) {
    document.getElementById('judul-topik').innerText = topic.judul_topik;
    document.getElementById('isi-topik').innerText = topic.isi_topik;
    document.getElementById('avatar-detail').src = topic.profile_image ? 
      `/storage/${topic.profile_image}` : 
      `https://i.pravatar.cc/96?u=${(topic.creator_identifier || topic.creator_role).toLowerCase()}`;
    document.getElementById('creator-info').innerText = `${topic.creator_name} • ${topic.creator_role}`;
    document.getElementById('time-info').innerText = `${topic.time_ago} lalu`;

    const discussionList = document.getElementById('discussion-list');
    discussionList.innerHTML = '';
    
    if (topic.replies && topic.replies.length > 0) {
      topic.replies.forEach((reply, index) => {
        const replyDiv = document.createElement('div');
        replyDiv.className = 'reply-item';
        replyDiv.style.animationDelay = `${index * 0.1}s`;
        replyDiv.innerHTML = `
          <div class="d-flex align-items-center mb-2 gap-3">
            <img src="${reply.profile_image ? `/storage/${reply.profile_image}` : `https://i.pravatar.cc/96?u=${(reply.creator_identifier || reply.creator_role).toLowerCase()}`}" 
                 class="avatar" style="width: 40px; height: 40px;" alt="Avatar">
            <div>
              <strong class="fw-bold">${reply.creator_name || reply.creator_role}</strong>
              <small class="text-muted d-block">${reply.created_at_human}</small>
            </div>
          </div>
          <p class="mb-0" style="padding-left: 52px;">${reply.reply_content}</p>
        `;
        discussionList.appendChild(replyDiv);
      });
    } else {
      discussionList.innerHTML = `
        <div class="text-center py-4 text-muted">
          <i class="bi bi-chat-square-dots" style="font-size: 2rem; opacity: 0.5;"></i>
          <p class="mt-2">Belum ada balasan. Jadilah yang pertama!</p>
        </div>
      `;
    }
  }
}

function submitNewTopic(event) {
  event.preventDefault();
  const form = event.target;
  const submitBtn = form.querySelector('button[type="submit"]');
  
  // Loading state
  submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>Mengirim...';
  submitBtn.disabled = true;
  
  const data = {
    judul_topik: form.judul_topik.value,
    kategori: form.kategori.value,
    isi_topik: form.isi_topik.value,
  };

  fetch('/forum', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify(data)
  })
  .then(async response => {
    if (response.ok) {
      Swal.fire({
        title: "Berhasil! 🎉",
        text: "Topik diskusi Anda telah dipublikasikan!",
        icon: "success",
        confirmButtonColor: "#667eea"
      }).then(() => {
        window.location.reload();
      });
    } else {
      // Try to parse error message from response
      let errorMessage = "Terjadi kesalahan saat mengirim topik. Silakan coba lagi.";
      try {
        const errorData = await response.json();
        if (errorData && errorData.message) {
          errorMessage = errorData.message;
        }
      } catch (e) {
        // ignore JSON parse errors
      }
      Swal.fire({
        title: "Oops! 😅",
        text: errorMessage || "Terjadi kesalahan saat mengirim topik. Silakan coba lagi.",
        icon: "error",
        confirmButtonColor: "#667eea"
      });
    }
  })
  .catch(() => {
    Swal.fire({
      title: "Oops! 😅",
      text: "Terjadi kesalahan saat mengirim topik. Silakan coba lagi.",
      icon: "error",
      confirmButtonColor: "#667eea"
    });
  })
  .finally(() => {
    // Reset button state
    submitBtn.innerHTML = '<i class="bi bi-rocket-takeoff me-2"></i> Publikasikan Topik';
    submitBtn.disabled = false;
  });
}

function submitReply(event) {
  event.preventDefault();
  const form = event.target;
  const submitBtn = form.querySelector('button[type="submit"]');
  const textarea = form.querySelector('textarea');
  const replyContent = textarea.value;

  if (replyContent.length > 1000) {
    Swal.fire({
      title: "Oops! 😅",
      text: "Balasan tidak boleh lebih dari 1000 karakter.",
      icon: "error",
      confirmButtonColor: "#667eea"
    });
    return;
  }
  
  // Loading state
  submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>Mengirim...';
  submitBtn.disabled = true;
  
  const topicId = topics.find(t => t.judul_topik === document.getElementById('judul-topik').innerText)?.id;

  if (!topicId) {
    Swal.fire({
      title: "Error! ❌",
      text: "Topik tidak ditemukan.",
      icon: "error",
      confirmButtonColor: "#667eea"
    });
    submitBtn.innerHTML = '<i class="bi bi-send me-2"></i> Kirim Balasan';
    submitBtn.disabled = false;
    return;
  }

  fetch(`/forum/reply/${topicId}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    credentials: 'include',
    body: JSON.stringify({ reply_content: replyContent })
  })
  .then(response => {
    if (response.ok) {
      return response.json();
    } else {
      throw new Error('Failed to submit reply');
    }
  })
  .then(data => {
    Swal.fire({
      title: "Berhasil! 💬",
      text: data.message || "Balasan Anda telah dikirim!",
      icon: "success",
      confirmButtonColor: "#667eea",
      timer: 2000,
      showConfirmButton: false
    });

    // Append new reply to discussion list
    const discussionList = document.getElementById('discussion-list');
    const replyDiv = document.createElement('div');
    replyDiv.className = 'reply-item';
    replyDiv.innerHTML = `
      <div class="d-flex align-items-center mb-2 gap-3">
        <img src="https://i.pravatar.cc/96?u=currentUser" 
             class="avatar" style="width: 40px; height: 40px;" alt="Avatar">
        <div>
          <strong class="fw-bold">Anda</strong>
          <small class="text-muted d-block">Baru saja</small>
        </div>
      </div>
      <p class="mb-0" style="padding-left: 52px;">${replyContent}</p>
    `;
    discussionList.appendChild(replyDiv);

    // Clear textarea
    const textarea = submitBtn.closest('form').querySelector('textarea');
    textarea.value = '';
  })
  .catch(() => {
    Swal.fire({
      title: "Oops! 😅",
      text: "Terjadi kesalahan saat mengirim balasan. Silakan coba lagi.",
      icon: "error",
      confirmButtonColor: "#667eea"
    });
  })
  .finally(() => {
    // Reset button state
    submitBtn.innerHTML = '<i class="bi bi-send me-2"></i> Kirim Balasan';
    submitBtn.disabled = false;
  });
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
  // Add smooth transitions to all elements
  document.querySelectorAll('.forum-card').forEach((card, index) => {
    card.style.animationDelay = `${index * 0.1}s`;
  });
  
  updateTopicCount();
  
  // Add intersection observer for scroll animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, observerOptions);
  
  // Observe all cards for scroll animations
  document.querySelectorAll('.forum-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'all 0.6s ease-out';
    observer.observe(card);
  });
});

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
  // Escape key to go back
  if (e.key === 'Escape') {
    const currentSection = document.querySelector('[id^="topik-"]:not(.d-none)');
    if (currentSection && currentSection.id !== 'topik-list') {
      showSection('list');
    }
  }
  
  // Ctrl/Cmd + N for new topic
  if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
    e.preventDefault();
    showSection('form');
  }
});

// Add search functionality (bonus feature)
function addSearchFunctionality() {
  const searchInput = document.createElement('input');
  searchInput.type = 'text';
  searchInput.className = 'form-control';
  searchInput.placeholder = '🔍 Cari topik diskusi...';
  searchInput.style.marginLeft = '1rem';
  
  searchInput.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    if (searchTerm) {
      filteredTopics = topics.filter(topic => 
        topic.judul_topik.toLowerCase().includes(searchTerm) ||
        topic.isi_topik.toLowerCase().includes(searchTerm) ||
        topic.creator_name.toLowerCase().includes(searchTerm)
      );
    } else {
      const selectedCategory = document.getElementById('category-select').value;
      if (selectedCategory) {
        filteredTopics = topics.filter(topic => topic.kategori === selectedCategory);
      } else {
        filteredTopics = topics;
      }
    }
    renderTopicList();
    updateTopicCount();
  });
  
  // Add search input to filter section
  const filterRow = document.querySelector('.filter-section .row');
  const searchCol = document.createElement('div');
  searchCol.className = 'col-md-6 mt-3 mt-md-0';
  searchCol.innerHTML = `
    <label class="form-label fw-bold mb-2">
      <i class="bi bi-search me-2"></i>Pencarian
    </label>
  `;
  searchCol.appendChild(searchInput);
  filterRow.appendChild(searchCol);
}

// Initialize search functionality
setTimeout(addSearchFunctionality, 1000);

</script>
@if(session('error') || $errors->any())
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    let errorMessage = '';
    @if(session('error'))
      errorMessage = {!! json_encode(session('error')) !!};
    @elseif($errors->any())
      errorMessage = {!! json_encode($errors->first()) !!};
    @endif

    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: errorMessage || "Terjadi kesalahan yang tidak diketahui.",
      footer: '<a href="#">Why do I have this issue?</a>'
    });
  });
</script>
@endif

@endsection
