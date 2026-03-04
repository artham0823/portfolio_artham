document.addEventListener("DOMContentLoaded", function () {
    const reveals = document.querySelectorAll(".reveal");

    function revealOnScroll() {
        const windowHeight = window.innerHeight;

        reveals.forEach(el => {
            const elementTop = el.getBoundingClientRect().top;

            if (elementTop < windowHeight - 100) {
                el.classList.add("active");
            }
        });
    }

    window.addEventListener("scroll", revealOnScroll);
    revealOnScroll();
});

document.addEventListener('DOMContentLoaded', () => {
  const galleryImages = document.querySelectorAll('.img-wrapper img');
  const aboutDesc = document.getElementById('about-desc');

  const descriptions = [
    "Dinda - My Partner hehehe",
    "Mount Lemongan - My Fav Place",
    "Alhaitham - My Husband :D",
    "Artham - It's me, rima"
  ];

  galleryImages.forEach((img, index) => {
    img.addEventListener('mouseenter', () => {
      aboutDesc.textContent = descriptions[index];
    });
    img.addEventListener('mouseleave', () => {
      aboutDesc.textContent = "Hover a photo to see my description!";
    });
  });
});
