<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Artham | Portfolio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style1.css">
</head>

<body>

  <!-- ===== NAVBAR ===== -->
  <nav>
    <div class="logo">Artham</div>

    <ul>
      <li><a href="#home">Home</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#skills">Skills</a></li>
      <li><a href="#projects">Projects</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>

    <div class="nav-right">
      <?php if (isset($_SESSION['admin'])): ?>
        <a href="dashboard.php" class="profile-icon">👤</a>
      <?php else: ?>
        <a href="login.php" class="login-btn">Login</a>
      <?php endif; ?>
    </div>
  </nav>

  <!-- ===== HOME ===== -->
  <section id="home" class="section-hero">
    <div class="hero-wrapper">

      <div class="profile-container">
        <div class="profile-glow"></div>
        <img src="assets/img/me.jpg" alt="Profile Artham" class="profile-pic">
      </div>

      <div class="hero-content">
        <p class="intro">HELLO, I'M</p>
        <h1 class="glow-text">ARTHAM</h1>
        <h2 class="typing-text">Web Developer • Game Enthusiast • Student</h2>
        <p class="hero-desc">
          I build interactive websites and dream of creating my own games someday.
          Currently learning and growing every single day.
        </p>

        <div class="hero-buttons">
          <a href="#projects" class="btn primary-btn">See My Projects</a>
          <a href="#contact" class="btn outline-btn">Contact Me</a>
        </div>
      </div>

    </div>
  </section>

  <!-- ===== ABOUT ME ===== -->
  <section id="about" class="about-reveal">
    <h2><B>ABOUT ME</B></h2>

    <div class="about-layout">
      <p id="about-desc" class="about-desc">
        Hover a photo to see my description!
      </p>

      <div class="gallery">
        <div class="img-wrapper">
          <img src="assets/img/1.jpeg" alt="Partner">
        </div>
        <div class="img-wrapper">
          <img src="assets/img/3.jpeg" alt="Spot-fav">
        </div>
        <div class="img-wrapper">
          <img src="assets/img/2.jpeg" alt="Alhaitham">
        </div>
        <div class="img-wrapper">
          <img src="assets/img/me1.jpeg" alt="NPC">
        </div>
      </div>
    </div>

    <div class="desc">
      <p></p>
    </div>
  </section>

  <!-- ===== SKILLS ===== -->
  <section id="skills" class="skills-reveal">
    <h2 class="section-title"><b>MY SKILLS</b></h2>
    <div class="skills-grid">

      <div class="skill-card">
        <div class="skill-content">
          <div class="skill-front">
            <img src="assets/img/html.png" alt="HTML">
            <h3>HTML 5</h3>
            <div class="stars">★★★★★</div>
          </div>
          <div class="skill-back">
            <p>Memahami struktur semantik, form handling, dan aksesibilitas web modern.</p>
          </div>
        </div>
      </div>

      <div class="skill-card">
        <div class="skill-content">
          <div class="skill-front">
            <img src="assets/img/css.png" alt="CSS">
            <h3>CSS 3</h3>
            <div class="stars">★★★★☆</div>
          </div>
          <div class="skill-back">
            <p>Mahir dalam Flexbox, Grid, Animasi CSS, dan Responsive Design (Mobile First).</p>
          </div>
        </div>
      </div>

      <div class="skill-card">
        <div class="skill-content">
          <div class="skill-front">
            <img src="assets/img/js.png" alt="JS">
            <h3>JavaScript</h3>
            <div class="stars">★★★☆☆</div>
          </div>
          <div class="skill-back">
            <p>Bisa manipulasi DOM, Fetch API, dan membuat interaksi dinamis tanpa library.</p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ===== SKILLS ===== -->
  <section id="projects" class="projects-reveal">
    <h2 class="section-title"><b>PROJECTS</b></h2>
    <div class="projects-grid">

      <div class="project-card">
        <div class="project-media">
          <img src="assets/img/proj1-thumb.jpg" class="static-img" alt="Project 1">
          <video src="" class="hover-video" muted loop></video>
        </div>
        <div class="project-info">
          <h3>Game Portofolio v1</h3>
          <p>Website interaktif bertema RPG dengan sistem leveling sederhana.</p>
          <div class="tags"><span>HTML</span> <span>CSS</span> <span>JS</span></div>
        </div>
      </div>

      <div class="project-card">
        <div class="project-media">
          <img src="assets/img/proj2-thumb.jpg" class="static-img" alt="Project 2">
          <img src="assets/img/proj2-preview.gif" class="hover-gif" alt="Preview GIF">
        </div>
        <div class="project-info">
          <h3>Landing Page Artham</h3>
          <p>Desain minimalis untuk jasa pembuatan website landing page cepat.</p>
          <div class="tags"><span>UI/UX</span> <span>Slicing</span></div>
        </div>
      </div>

    </div>
  </section>
  
  <!-- ===== CONTACT ===== -->
  <section id="contact" class="contact-reveal">
    <h2><B>CONTACT</B></h2>
  </section>

  <script src="assets/js/script.js"></script>
</body>

</html>