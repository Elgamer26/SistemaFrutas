<div class="information" style="background-color: black; color: white;">
    <div class="container">
        <div class="infor-top" style="padding: 26px;">
            <div class="col-md-4 infor-left" style="color: white">
                <h3 style="color: white">Tienda Online</h3>
                <ul>
                    <li><a>
                            <h6 style="color: white">Producto</h6>
                        </a></li>
                    <li><a>
                            <h6 style="color: white">Ofertas</h6>
                        </a></li>
                    <li><a>
                            <h6 style="color: white">Envio</h6>
                        </a></li>
                </ul>
            </div>
            <div class="col-md-4 infor-left">
                <h3 style="color: white">Información</h3>
                <ul>
                    <li><a>
                            <p style="color: white">Plantas especiales</p>
                        </a></li>
                    <li><a>
                            <p style="color: white">Nuevos productos</p>
                        </a></li>
                    <li><a>
                            <p style="color: white">Tienda Virtual</p>
                        </a></li>
                    <li><a>
                            <p style="color: white">Contáctanos</p>
                        </a></li>
                    <li><a>
                            <p style="color: white">Oferta disponibles</p>
                        </a></li>
                </ul>
            </div>

            <div class="col-md-4 infor-left">
                <h3 style="color: white">Contacto</h3>
                <h4 style="color: white">Viverio Danielito,
                    <span style="color: white">Venta de todo tipo de plantas,</span>
                    La troncal.
                </h4>
                <h5 style="color: white">0989376730</h5>
                <p><a>ViveroDanielito@hotmail.com</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- <div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-6 footer-left">
            </div>
            <div class="col-md-6 footer-right">
                <p>© 2023 Sistema de fruta. Todos los derechos reservados | Diseño por JR </p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3985.4375089531186!2d-79.63233868524377!3d-2.68520899804372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMsKwNDEnMDYuOCJTIDc5wrAzNyc0OC41Ilc!5e0!3m2!1ses-419!2sec!4v1687620215159!5m2!1ses-419!2sec" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

</div> -->
<div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-6 footer-left">

            </div>
            <div class="col-md-6 footer-right">
                <p>© 2023 Vivero Danielito. Venta de todo tipos de plantas</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</body>

</html>

<script src="<?php echo base_url(); ?>public/js/tienda.js"></script>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";
    ContarCantidadCarrito();
</script>


<!-- ///////////////////////////////////////// -->

<style>
    /* Estilos para o modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        overflow: auto;
    }

    /* Estilos para o conteúdo do modal */
    .modal-content {
        text-align: center;
        background-color: #fefefe;
        padding: 10px;
        border: 1px solid #888;
        width: 80%;
        /* Largura do conteúdo do modal */
        max-width: 400px;
        /* Largura máxima para garantir responsividade */
        margin: 10% auto;
        /* Centralizar verticalmente e alinhar horizontalmente */
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    /* Estilos para o botão fechar */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Estilos para o formulário de login */
    .input-group {
        width: 100%;
        margin-bottom: 15px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
    }

    .input-group input[type="text"],
    .input-group input[type="password"] {
        width: calc(100% - 12px);
        /* Calculando a largura do campo de entrada */
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        text-align: center;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>

<!-- Botão para abrir o modal -->
<button style="display: none !important;" id="openModalBtn">Login</button>

<!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Inicie sesión</h2>
        <br>
        <form id="loginForm">
            <div class="input-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" placeholder="Inicie sesión">
        </form>
    </div>
</div>

<script>
    var modal = document.getElementById("modal");
    var openModalBtn = document.getElementById("openModalBtn");
    var closeBtn = document.querySelector(".close");
    var loginForm = document.getElementById("loginForm");

    function openModal() {
        modal.style.display = "block";
    }

    function closeModal() {
        modal.style.display = "none";
    }

    openModalBtn.addEventListener("click", openModal);

    closeBtn.addEventListener("click", closeModal);

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            closeModal();
        }
    });

    loginForm.addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(loginForm);
        var username = formData.get("username");
        var password = formData.get("password");
        ValidarClienteDeTienda(username, password)
    });

    function RecordaPasswordUserTienda() {
        const rmcheck = true;
        const password = document.getElementById("password");
        const usuario = document.getElementById("username");

        if (rmcheck.checkedc || usuario.value != "" || password.value != "") {
            localStorage.usuarioc = usuario.value;
            localStorage.passwordc = password.value;
            localStorage.checkboxc = rmcheck.checked;
        }
    }

    $(document).ready(function() {
        const rmcheck = true;
        const password = document.getElementById("password");
        const usuario = document.getElementById("username");
        if (localStorage.checkboxc && localStorage.checkboxc != "") {
            password.value = localStorage.passwordc;
            usuario.value = localStorage.usuarioc;
        } else {
            password.value = "";
            usuario.value = "";
        }
    })
</script>