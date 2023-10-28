<br>

<div class="about" style="padding: 0 0 0 0;">
    <div class="container">
        <div class="about-top grid-1">
            <div class="col-md-4 about-left">
            </div>
            <div class="col-md-4 about-left" style="text-align: center; font-weight: bold;">
                <h4 style="font-weight: bold;">PRODUCTOS DISPONIBLES</h4>
            </div>
            <div class="col-md-4 about-left">
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<br>

<div class="container" hidden>
    <div class="about-top grid-1">
        <div class="col-md-4 about-left">
            <div class="search-bar">
                <input type="text" placeholder="Buscar..." id="buscar_producto_categoria">
                <input type="submit" value="">
            </div>
        </div>
    </div>
</div>

<br>

<div class="product" style="padding: 0px;">
    <div class="container">
        <div class="product-top">
            <div class="product-one" id="producto_categoria">

            </div>
        </div>
    </div>
</div>

<input type="number" value="<?php echo $id; ?>" id="valornumerico" hidden>

<br>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";

    $(document).ready(function() {
        paginartiendaCategorias(1);
    });

    $(document).on("keyup", "#buscar_producto_categoria", function() {
        let valor = $(this).val();
        if (valor != "") {
            paginartiendaCategorias(1, valor);
        } else {
            paginartiendaCategorias(1);
        }
    });

    function paginartiendaCategorias(partida, valor) {

        var id = $("#valornumerico").val();

        $.ajax({
            url: BaseUrl + "tienda/paginartiendaCategorias",
            type: "POST",
            data: {
                partida: partida,
                valor: valor,
                id: id
            },
        }).done(function(response) {          
            var array = eval(response);
            
            if (array[0]) {
                $("#producto_categoria").html(array[0]);
            } else {
                $("#producto_categoria")
                    .html(`<div class="col-12" style="text-align: center; justify-content: center; align-items: center"><br>
                        <label style="font-size: 20px;"></i>.:No se encontro producto:.<label>
                    </div>`);
            }
        });
    }
</script>