let slideIndex = 1;
showSlide(slideIndex);
function plusSlides(n) {
    showSlide(slideIndex += n);
}
function showSlide(n) {
    const slides = document.querySelectorAll('.carousel-wrapper__slide');
    const dots = document.querySelectorAll('.dot');
    if (n > slides.length) slideIndex = 1;
    if (n < 1) slideIndex = slides.length;
    slides.forEach(slide => slide.style.display = 'none');
    dots.forEach(dot => dot.classList.remove('active'));
    slides[slideIndex - 1].style.display = 'flex';
    dots[slideIndex - 1].classList.add('active');
}
function currentSlide(n) {
    showSlide(slideIndex = n);
}
let timer = setInterval(() => plusSlides(1), 3500);

function resetTimer() {
    clearInterval(timer);
    timer = setInterval(() => plusSlides(1), 3500);
}
document.querySelector('.prev').addEventListener('click', resetTimer);
document.querySelector('.next').addEventListener('click', resetTimer);
