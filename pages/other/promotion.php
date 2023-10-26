<section class="slider">
   
    <img src="img/back/3.svg" alt="Slide 1">
    <img src="img/back/5.svg" alt="Slide 2">
    <img src="img/back/6.svg" alt="Slide 3">
</section>

<script>
    function startSlider() {
  const slider = document.querySelector('.slider');
  const slides = slider.querySelectorAll('img');
  let currentSlide = 0;

  setInterval(() => {
    slides[currentSlide].style.opacity = '0';
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].style.opacity = '1';
  }, 3000); // Интервал смены слайдов в миллисекундах (здесь 3 секунды)
}

startSlider();
</script>
