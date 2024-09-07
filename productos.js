 // Inicializar Swiper
 var swiper = new Swiper(".myswiper", {
    // Configuración del efecto de cubierta
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    loop: true,
    coverflowEffect: {
        depth: 500,
        modifier: 5,
        slideShadows: true,
        rotate: 0,
        stretch: 0
    },
    // Habilitar la navegación con teclado
    keyboard: {
        enabled: true
    }
});