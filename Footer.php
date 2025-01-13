<?php

/**
 * Classe Footer
 * Genera el peu de pàgina amb estil Bootstrap i funcionalitats addicionals.
 */
class Footer {

    /**
     * Mostra el peu de pàgina HTML amb els scripts necessaris.
     *
     * @return void
     */
    public function mostrarFooter() {
        echo '<div class="footer text-center bg-dark text-white py-2">
                <p>&copy; 2023 CIFP Pau Casesnoves · Centro de Formación Profesional</p>
              </div>';

        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
              <script>
                  document.addEventListener(\'DOMContentLoaded\', function () {
                      var myCarousel = new bootstrap.Carousel(document.getElementById(\'carrusel\'), {
                          interval: 2000,
                          wrap: true
                      });
                  });
              </script>';
        echo '</body></html>';
    }
}

// Crea una instància de la classe Footer i la mostra
$footer = new Footer();
$footer->mostrarFooter();

?>