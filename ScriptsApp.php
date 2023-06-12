<?php
require_once 'auth.php';
class ScriptsApp {
    public function contents() {
        $js = <<<JAVASCRIPT
            <script>
            function loadContents(data) {
                let url = 'ficha.php?codigo=' + data.codigo + '&nombre=' + data.nombre;
                window.location.href = url;
            }
            //Funcion window para la opacidad del slider
            $(window).on('load', function() {
                var swipers = [];
                //opacidades del slider
                $('.swiper-ciudades').each(function(index) {
                    swipers[index] = new Swiper(this, {
                        pagination: {
                            el: '.swiper-pagination',
                        },
                        centeredSlides: true,
                        slidesPerView: 'auto',
                        spaceBetween: 10,
                        breakpoints: {
                            // when window width is >= 320px
                            330: {
                                slidesPerView: 1.5,
                                spaceBetween: 5
                            },
                            // when window width is >= 480px
                            495: {
                                slidesPerView: 2,
                                spaceBetween: 10
                            },
                            // when window width is >= 640px
                            660: {
                                slidesPerView: 3,
                                spaceBetween: 10
                            },
                            825: {
                                slidesPerView: 4,
                                spaceBetween: 15
                            }
                        },
                        on: {
                            init: function() {
                                // Set initial opacity
                                $(this.slides).find(".img-list").css("opacity", "0.4"); // Set all images opacity to 0.5
                                var currentSlide = $(this.slides[this.activeIndex]); // Get current active slide
                                currentSlide.find(".img-list").css("opacity", "1"); // Set active image opacity to 1
                            },
                            slideChange: function() {
                                // Change opacity on slide change
                                $(this.slides).find(".img-list").css("opacity", "0.4"); // Change all images opacity to 0.5
                                var currentSlide = $(this.slides[this.activeIndex]); // Get current active slide
                                currentSlide.find(".img-list").css("opacity", "1"); // Change active image opacity to 1
                            }
                        }
                    });
                    swipers[index].init();
                });
            });
            </script>
        JAVASCRIPT;
        echo $js;
    }
    public function perfil() {
        $js = <<<JAVASCRIPT
       
        JAVASCRIPT;
        echo $js;
    }
}
?>
