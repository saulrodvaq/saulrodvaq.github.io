<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="/dual/assets/css/style_footer.css" crossorigin="anonymous">

<footer id="footer" class="animate-footer">

    <div class="footer-newsletter">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                </div>
            </div>
        </div>
    </div>

    <div class="footer-top">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="row">

                        <div class="col-lg-9 col-md-6 footer-links">
                            <img src="/dual/assets/img/utsc_logo-removebg-preview.png" width="200" height="158">
                            <img src="/dual/assets/img/sep.png" width="250" height="90">
                            <img src="/dual/assets/img/nl_edu_logo.png" width="300" height="150">
                        </div>
                        </style>
                        <style>
                        .ulicons li:nth-child(2) a:before {
                            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%) !important;
                        }
                        </style>
                        <div class="col-lg-3">
                            <div class="social-links px-2">

                                <h3>Sobre UTSC Dual </h3>
                                <p style="text-align: justify;">Creada para brindar servicios a los alumnos y docentes
                                    internos de la Universidad Tecnológica Santa Catarina.</p>
                                <ul class="ulicons flex text-center ml-20">
                                    <li style="text-align: center;">
                                        <a href="https://www.facebook.com/UTSCNL/" class="facebook" target="_blank"><i
                                                class="fab fa-facebook-f icon"></i></a>
                                    </li>
                                    <li style="text-align: center;">
                                        <a href="https://www.instagram.com/utsantacatarina/" class="instagram"
                                            target="_blank"><i class="fab fa-instagram icon"></i></a>
                                    </li>
                                    <li style="text-align: center;">
                                        <a href="https://mx.linkedin.com/company/universidad-tecnol%C3%B3gica-de-santa-catarina"
                                            class="linkedin" target="_blank"><i class="fab fa-linkedin-in icon"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; <?php echo date("Y"); ?> <strong><span>UTSC Dual</span></strong>. Todos los derechos reservados.
        </div>
    </div>
    </div>
</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script>
// Función para verificar cuando el usuario está cerca de la sección del footer
function isInViewport(element) {
  var rect = element.getBoundingClientRect();
  var windowHeight = window.innerHeight || document.documentElement.clientHeight;
  var margin = 100; // Ajusta este valor según tus necesidades (en píxeles)
  return rect.top < windowHeight - margin;
}


// Función para agregar o quitar la clase "show-footer" según la posición del usuario
function handleFooterAnimation() {
    var footer = document.getElementById('footer');
    if (isInViewport(footer)) {
        footer.classList.add('show-footer');
    } else {
        footer.classList.remove('show-footer');
    }
}

// Detectar el evento de desplazamiento del usuario
window.addEventListener('scroll', handleFooterAnimation);

// Verificar el estado inicial al cargar la página
handleFooterAnimation();
</script>