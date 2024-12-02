<footer class="py-4">
    <div class="container">
        <div class="row">
            <?php if (isset($_SESSION['id_usuario'])): ?>
                <!-- Mostrar si el usuario está registrado -->
                <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                    <h5>Accede a tu perfil IKAT</h5>
                    <div class="col-md-9 col-12">
                        Consulta y gestiona tu información personal y preferencias en IKAT.
                        <div class="text-center">
                            <a href="/xampp/TIS-1/IKAT/views/perfil.php"
                                class="btn btn-light border-dark btn-sm mt-3 text-black text-decoration-none">
                                Ver mi perfil
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Mostrar si el usuario NO está registrado -->
                <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                    <h5>¡Únete a la familia IKAT!</h5>
                    <div class="col-md-9 col-12">
                        Regístrate y disfruta de la experiencia completa de IKAT.
                        <div class="text-center">
                            <a href="/xampp/TIS-1/IKAT/views/menu_registro/registro.php"
                                class="btn btn-light border-dark btn-sm mt-3 text-black text-decoration-none">
                                Registrarme
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Otras secciones del footer -->
            <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                <h5>Servicio</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-black text-decoration-none">Sigue tu pedido</a></li>
                    <li><a href="#" class="text-black text-decoration-none">IKAT Points</a></li>
                    <li><a href="#" class="text-black text-decoration-none">Despacho a domicilio</a></li>
                    <li><a href="#" class="text-black text-decoration-none">Métodos de pago</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                <h5>Sobre IKAT</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-black text-decoration-none" data-bs-toggle="modal" data-bs-target="#aboutModal">Quienes somos</a></li>
                    <li><a href="#" class="text-black text-decoration-none" data-bs-toggle="modal" data-bs-target="#missionModal">Misión y Visión</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                <h5>Redes Sociales</h5>
                <ul class="list-unstyled">
                    <li><a href="https://www.facebook.com/IKEAChile/" class="text-black text-decoration-none"><i class="bi bi-facebook"></i> Facebook</a></li>
                    <li><a href="https://www.instagram.com/ikeachile/" class="text-black text-decoration-none"><i class="bi bi-instagram"></i> Instagram</a></li>
                    <li><a href="https://www.threads.net/@ikeaspain" class="text-black text-decoration-none"><i class="bi bi-threads"></i> Threads</a></li>
                    <li><a href="https://twitter.com/ikea_cl?lang=es" class="text-black text-decoration-none"><i class="bi bi-twitter-x"></i> X</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutModalLabel">Quienes somos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                IKAT fue fundada por un grupo de AMIGOS en 2024, siendo originalmente un proyecto de venta por catálogo del ramo TIS-1,<br><br>
                Actualmente, es una de las marcas de muebles para el hogar más conocidas a nivel mundial que ofrece diseño y comodidad a precios accesibles para todas las personas.<br><br>
                Puede que no hayamos recorrido un largo camino desde nuestros comienzos, pero nuestra visión sigue siendo la misma: crear un mejor día a día para la mayoría de las personas.<br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal "Misión y Visión" -->
<div class="modal fade" id="missionModal" tabindex="-1" aria-labelledby="missionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="missionModalLabel">Misión y Visión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <strong>Visión e idea de negocio</strong><br>
                Nuestra visión es crear un mejor día a día para la mayoría de las personas.<br><br>
                Nos apasiona la vida en el hogar. Nuestra cultura se basa en el entusiasmo, la unión y la actitud de poner manos a la obra.<br><br>
                Somos optimistas y buscamos constantemente nuevas y mejores formas de hacer las cosas, desde cómo diseñar una silla que quepa en un paquete plano, hasta crear focos de luz LED que sean accesibles para todos.<br><br>
                Nuestra visión es crear un mejor día a día para la mayoría de las personas: nuestros clientes, colaboradores y la comunidad.<br><br>
                Esta visión va más allá de la decoración del hogar. Queremos que nuestro negocio tenga un impacto positivo en el mundo, desde las comunidades donde obtenemos nuestros materiales, hasta la forma en que nuestros productos ayudan a nuestros clientes a vivir una vida más sostenible en el hogar.<br><br>
                ​​Compartiendo lo que hacemos y defendiendo lo que creemos, podemos ser parte de un cambio positivo en la sociedad.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>