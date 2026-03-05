document.addEventListener('DOMContentLoaded', () => {


    const nav = document.querySelector('nav');
    if (nav) {
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('nav ul');
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('open');
        });

        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('open');
            });
        });
    }

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    const revealItems = document.querySelectorAll('.reveal-item');
    if (revealItems.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        revealItems.forEach(item => observer.observe(item));
    }
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav ul li a');
    if (sections.length > 0 && navLinks.length > 0) {
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const top = section.offsetTop - 120;
                if (window.scrollY >= top) {
                    current = section.getAttribute('id');
                }
            });
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    }

    const typingEl = document.querySelector('.typing-text');
    if (typingEl) {
        const phrases = [
            'Web Developer',
            'Game Enthusiast',
            'Music Lover',
            'Video Editor',
        ];
        const phrasesJP = [
            'ウェブ開発者',
            'ゲーム愛好家',
            '音楽愛好家',
            'ビデオエディター'
        ];
        let phraseIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function typeAnimation() {
            const currentLang = document.documentElement.getAttribute('data-lang') || 'id';
            const activeList = currentLang === 'jp' ? phrasesJP : phrases;
            const currentPhrase = activeList[phraseIndex];
            const cursor = '<span class="cursor"></span>';

            if (isDeleting) {
                charIndex--;
            } else {
                charIndex++;
            }

            typingEl.innerHTML = currentPhrase.substring(0, charIndex) + cursor;

            let speed = isDeleting ? 40 : 70;

            if (!isDeleting && charIndex === currentPhrase.length) {
                speed = 2000;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                phraseIndex = (phraseIndex + 1) % activeList.length;
                speed = 400;
            }

            setTimeout(typeAnimation, speed);
        }

        typeAnimation();
    }

    const galleryImages = document.querySelectorAll('.img-wrapper img');
    const aboutDesc = document.getElementById('about-desc');
    if (galleryImages.length > 0 && aboutDesc) {
        const descriptions = [
            "Dinda - My Partner hehehe",
            "Mount Lemongan - My Fav Place",
            "Alhaitham - My Husband :D",
            "Artham - It's me, rima"
        ];
        const descriptionsJP = [
            "ディンダ - 私のパートナー hehehe",
            "レモンガン山 - お気に入りの場所",
            "アルハイサム - 私の旦那さん :D",
            "アルサム - 私です、りま"
        ];
        const defaultText = "Hover a photo to see my description!";
        const defaultTextJP = "写真にカーソルを合わせて説明を見よう！";

        galleryImages.forEach((img, index) => {
            img.addEventListener('mouseenter', () => {
                const lang = document.documentElement.getAttribute('data-lang') || 'id';
                aboutDesc.textContent = lang === 'jp' ? descriptionsJP[index] : descriptions[index];
            });
            img.addEventListener('mouseleave', () => {
                const lang = document.documentElement.getAttribute('data-lang') || 'id';
                aboutDesc.textContent = lang === 'jp' ? defaultTextJP : defaultText;
            });
        });
    }

    document.querySelectorAll('.photo-card-3d').forEach(card => {
        const inner = card.querySelector('.photo-card-inner');
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / centerY * -8;
            const rotateY = (x - centerX) / centerX * 8;
            inner.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
        });
        card.addEventListener('mouseleave', () => {
            inner.style.transform = '';
        });
    });

    const langBtn = document.getElementById('lang-btn');
    if (langBtn) {
        const translations = {
            'nav-home': { id: 'Home', jp: 'ホーム' },
            'nav-about': { id: 'About', jp: '概要' },
            'nav-skills': { id: 'Skills', jp: 'スキル' },
            'nav-projects': { id: 'Projects', jp: 'プロジェクト' },
            'nav-contact': { id: 'Contact', jp: '連絡先' },
            'hero-intro': { id: "HELLO, I'M", jp: 'こんにちは、私は' },
            'hero-desc': {
                id: 'I build interactive websites and dream of creating my own games someday. Currently learning and growing every single day.',
                jp: 'インタラクティブなウェブサイトを作り、いつか自分のゲームを作ることを夢見ています。毎日学び、成長しています。'
            },
            'btn-projects': { id: 'See My Projects', jp: 'プロジェクトを見る' },
            'btn-contact': { id: 'Contact Me', jp: '連絡する' },
            'title-about': { id: 'ABOUT ME', jp: '私について' },
            'about-desc': { id: 'Hover a photo to see my description!', jp: '写真にカーソルを合わせて説明を見よう！' },
            'about-bottom-text': {
                id: "I'm Artham — a student passionate about web development and gaming. I love learning new things and turning creative ideas into real projects.",
                jp: '私はアルサムです。ウェブ開発とゲームに情熱を持つ学生です。新しいことを学び、クリエイティブなアイデアを実際のプロジェクトに変えることが大好きです。'
            },
            'title-skills': { id: 'MY SKILLS', jp: '私のスキル' },
            'subtitle-skills': { id: 'What I can do — hover to see details', jp: 'できること — ホバーして詳細を見よう' },
            'title-projects': { id: 'PROJECTS', jp: 'プロジェクト' },
            'subtitle-projects': { id: 'Things I have built and worked on', jp: '作ったもの・取り組んだもの' },
            'title-contact': { id: 'CONTACT', jp: '連絡先' },
            'subtitle-contact': { id: "Let's connect and collaborate", jp: '繋がって一緒にやろう' },
            'contact-cta-title': { id: 'Want my CV?', jp: '履歴書が欲しいですか？' },
            'contact-cta-desc': {
                id: 'Request my CV and I will review it. Once approved, you can download it directly.',
                jp: '履歴書をリクエストしてください。承認されたらダウンロードできます。'
            },
            'cv-btn-text': { id: '📄 Request CV', jp: '📄 履歴書をリクエスト' },
            'footer-text': { id: '© 2026 Artham. All rights reserved.', jp: '© 2026 アルサム. 全著作権所有。' }
        };

        let currentLang = 'id';

        langBtn.addEventListener('click', () => {
            currentLang = currentLang === 'id' ? 'jp' : 'id';
            document.documentElement.setAttribute('data-lang', currentLang);
            langBtn.textContent = currentLang === 'id' ? '🇯🇵 日本語' : '🇮🇩 Bahasa';

            for (const [id, texts] of Object.entries(translations)) {
                const el = document.getElementById(id);
                if (el) {
                    el.textContent = texts[currentLang];
                }
            }
        });
    }

});
