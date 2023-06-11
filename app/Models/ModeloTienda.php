<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloTienda
{
    private $conexion;
    function __construct()
    {
        session_start();
        date_default_timezone_set('America/Guayaquil');
        require_once 'ModeloConection.php';
        $this->conexion = new ModeloConection();
        //abrir conexion
        $this->conexion->conexionPDO();
        //cerra conexion
        $this->conexion->cerrar_conexion();
    }

    function paginartienda($partida, $valor)
    {
        try {
            $c = $this->conexion->conexionPDO();

            $paginaactual = htmlspecialchars($partida, ENT_QUOTES, 'UTF-8');
            if (!empty($valor)) {
                $datos = $valor;
                $sql = "SELECT
                COUNT(*) 
                FROM
                producto
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
                WHERE
                producto.estado = 1 
                AND producto.nombre LIKE '%" . $datos . "%' 
                OR tipo_producto.tipo LIKE '%" . $datos . "%' 
                OR producto.precio LIKE '%" . $datos . "%'";
            } else {
                $sql = "SELECT
                COUNT(*) 
                FROM
                producto
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
                WHERE
                producto.estado = 1 ";
            }
            $query = $c->prepare($sql);
            $query->execute();
            $data = $query->fetch();
            $arreglo = array();
            //
            foreach ($data as $respuesta) {
                $arreglo[] = $respuesta;
            }
            //
            $numlotes = 12;
            $nropaguinas = ceil($arreglo[0] / $numlotes);
            $lista = "";
            $tabla = "";
            //
            if ($paginaactual > 1) {
                $lista = $lista . ' <li class="page-item">
                                        <a class="page-link" href="javascript:pagination(' . ($paginaactual - 1) . ');" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Anterior</span>
                                        </a>
                                    </li>';
            }
            //
            for ($i = 1; $i <= $nropaguinas; $i++) {
                if ($i == $paginaactual) {
                    $lista = $lista . '<li class="page-item active"><a class="page-link" href="javascript:pagination(' . ($i) . ');">' . $i . '</a></li>';
                } else {
                    $lista = $lista . '<li class="page-item"><a class="page-link" href="javascript:pagination(' . ($i) . ');">' . $i . '</a></li>';
                }
            }
            //
            if ($paginaactual < $nropaguinas) {
                $lista = $lista . ' <li class="page-item">
                                        <a class="page-link" href="javascript:pagination(' . ($paginaactual + 1) . ');" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Próximo</span>
                                        </a>
                                    </li>';
            }
            //
            if ($paginaactual <= 1) {
                $limit = 0;
            } else {
                $limit = $numlotes * ($paginaactual - 1);
            }
            //
            if (!empty($valor)) {
                $datos = $valor;
                $sql_p = "SELECT
                producto.id, 
                producto.nombre, 
                tipo_producto.tipo, 
                producto.precio, 
                producto.imagen, 
                producto.cantidad
                FROM
                producto
                INNER JOIN
                tipo_producto
                ON 
                producto.tipo_id = tipo_producto.id
                WHERE
                producto.estado = 1 AND
                producto.nombre LIKE '%" . $datos . "%' OR
                tipo_producto.tipo LIKE '%" . $datos . "%' OR
                producto.precio LIKE '%" . $datos . "%'
                ORDER BY producto.id DESC LIMIT $limit, $numlotes";
            } else {
                $sql_p = "SELECT
                producto.id, 
                producto.nombre, 
                tipo_producto.tipo, 
                producto.precio, 
                producto.imagen, 
                producto.cantidad
                FROM
                producto
                INNER JOIN
                tipo_producto
                ON 
                producto.tipo_id = tipo_producto.id
                WHERE
                producto.estado = 1 
                ORDER BY producto.id DESC LIMIT $limit, $numlotes";
            }
            //
            $query_p = $c->prepare($sql_p);
            $query_p->execute();
            $result = $query_p->fetchAll();

            foreach ($result as $respuesta) {
                $tabla = $tabla . '	<div class="col-md-3 product-left">
                                        <div class="product-main simpleCart_shelfItem" >
                                            <a href="' . base_url() . 'home/Detalle/' . $respuesta[0] . '" class="mask"><img class="img-responsive zoom-img" 
                                            style="width: 200px;
                                            height: 200px;
                                            object-fit: cover;" src="' . base_url() . 'public/img/producto/' . $respuesta[4] . '" alt="Imagen producto" /></a>
                                            <div class="product-bottom">
                                                <h3>' . $respuesta[1] . '</h3>
                                                <p>' . $respuesta[2] . '</p>
                                                <h4><i class="fa fa-shopping-cart"></i> <a class="item_add" href="#"></a> <span class=" item_price">$ ' . $respuesta[3] . '</span></h4>';

                if (!empty($_SESSION["TokenClie"])) {
                    $tabla = $tabla . '     <h4><button class="btn btn-success" onclick="AgregarCarritoNormal(' . $respuesta[0] . ', ' . $respuesta[3] . ')">Agregar al carrito<i class="fa fa-shopping-basket" aria-hidden="true"></i></button></h4>';
                }

                $tabla = $tabla . '	   </div>
                                        </div>
                                    </div>';
            }

            $array = array(0 => $tabla, 1 => $lista);
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $array;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function paginartiendaofertas($partida, $valor)
    {
        try {
            $c = $this->conexion->conexionPDO();

            $paginaactual = htmlspecialchars($partida, ENT_QUOTES, 'UTF-8');
            if (!empty($valor)) {
                $datos = $valor;
                $sql = "SELECT
                COUNT(*)
                FROM
                producto
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
                INNER JOIN oferta ON producto.id = oferta.producto_id 
                WHERE
                producto.estado = 1
                AND producto.nombre LIKE '%" . $datos . "%' 
                OR tipo_producto.tipo LIKE '%" . $datos . "%' 
                OR producto.precio LIKE '%" . $datos . "%'
                OR oferta.tipo_oferta LIKE '%" . $datos . "%'";
            } else {
                $sql = "SELECT
                COUNT(*)
                FROM
                producto
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
                INNER JOIN oferta ON producto.id = oferta.producto_id 
                WHERE
                producto.estado = 1";
            }
            $query = $c->prepare($sql);
            $query->execute();
            $data = $query->fetch();
            $arreglo = array();
            //
            foreach ($data as $respuesta) {
                $arreglo[] = $respuesta;
            }
            //
            $numlotes = 12;
            $nropaguinas = ceil($arreglo[0] / $numlotes);
            $lista = "";
            $tabla = "";
            //
            if ($paginaactual > 1) {
                $lista = $lista . ' <li class="page-item">
                                        <a class="page-link" href="javascript:pagination(' . ($paginaactual - 1) . ');" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Anterior</span>
                                        </a>
                                    </li>';
            }
            //
            for ($i = 1; $i <= $nropaguinas; $i++) {
                if ($i == $paginaactual) {
                    $lista = $lista . '<li class="page-item active"><a class="page-link" href="javascript:pagination(' . ($i) . ');">' . $i . '</a></li>';
                } else {
                    $lista = $lista . '<li class="page-item"><a class="page-link" href="javascript:pagination(' . ($i) . ');">' . $i . '</a></li>';
                }
            }
            //
            if ($paginaactual < $nropaguinas) {
                $lista = $lista . ' <li class="page-item">
                                        <a class="page-link" href="javascript:pagination(' . ($paginaactual + 1) . ');" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Próximo</span>
                                        </a>
                                    </li>';
            }
            //
            if ($paginaactual <= 1) {
                $limit = 0;
            } else {
                $limit = $numlotes * ($paginaactual - 1);
            }
            //
            if (!empty($valor)) {
                $datos = $valor;
                $sql_p = "SELECT
                producto.id,
                producto.nombre,
                tipo_producto.tipo,
                producto.precio,
                producto.imagen,
                producto.cantidad,
                oferta.tipo_oferta,
                oferta.fecha_fin,
                oferta.valor_descuento
                FROM
                producto
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
                INNER JOIN oferta ON producto.id = oferta.producto_id 
                WHERE
                producto.estado = 1 AND
                producto.nombre LIKE '%" . $datos . "%' OR
                tipo_producto.tipo LIKE '%" . $datos . "%' OR
                producto.precio LIKE '%" . $datos . "%'
                OR oferta.tipo_oferta LIKE '%" . $datos . "%'
                ORDER BY oferta.id DESC LIMIT $limit, $numlotes";
            } else {
                $sql_p = "SELECT
                producto.id,
                producto.nombre,
                tipo_producto.tipo,
                producto.precio,
                producto.imagen,
                producto.cantidad,
                oferta.tipo_oferta,
                oferta.fecha_fin,
                oferta.valor_descuento
                FROM
                producto
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
                INNER JOIN oferta ON producto.id = oferta.producto_id 
                WHERE
                producto.estado = 1
                ORDER BY oferta.id DESC LIMIT $limit, $numlotes";
            }
            //
            $query_p = $c->prepare($sql_p);
            $query_p->execute();
            $result = $query_p->fetchAll();

            foreach ($result as $respuesta) {

                $tabla = $tabla . '	<div class="col-md-3 product-left">
                                        <div class="product-main simpleCart_shelfItem">
                                            <a href="' . base_url() . 'home/DetalleOferta/' . $respuesta[0] . '" class="mask"><img class="img-responsive zoom-img" 
                                            style="width: 200px;
                                            height: 200px;
                                            object-fit: cover;" src="' . base_url() . 'public/img/producto/' . $respuesta[4] . '" alt="Imagen producto" /></a>
                                            <div class="product-bottom">
                                                <h3>' . $respuesta[1] . '</h3>
                                                <p>' . $respuesta[2] . '</p>
                                                <p> Oferta: ' . $respuesta[6] . '</p>
                                                <p> Fecha fin: ' . $respuesta[7] . '</p>
                                                <h4><i class="fa fa-shopping-cart"></i> <a class="item_add" href="#"></a> <span class=" item_price">$ ' . $respuesta[3] . '</span></h4>';

                if (!empty($_SESSION["TokenClie"])) {
                    $tabla = $tabla . '<h4><button class="btn btn-success" onclick="AgregarCarritoOferta(' . $respuesta[0] . ', ' . $respuesta[3] . ')">Agregar al carrito<i class="fa fa-shopping-basket" aria-hidden="true"></i></button></h4>';
                }

                $tabla = $tabla . '    </div>
                                            <div class="srch">
                                                 <span> ' . $respuesta[8] . ' %</span>
                                            </div>
                                        </div>
                                    </div>';
            }

            $array = array(0 => $tabla, 1 => $lista);
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $array;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerProductoTienda($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.id, 
            producto.nombre, 
            tipo_producto.tipo, 
            producto.precio, 
            producto.imagen, 
            producto.cantidad, 
            producto.codigo, 
            producto.descripcion
            FROM
            producto
            INNER JOIN
            tipo_producto
            ON 
            producto.tipo_id = tipo_producto.id
            WHERE
            producto.estado = 1 AND
            producto.cantidad <> 0 AND
            producto.id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerProductoTiendaOferta($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.id,
            producto.nombre,
            tipo_producto.tipo,
            producto.precio,
            producto.imagen,
            producto.cantidad,
            producto.codigo,
            producto.descripcion,
            oferta.fecha_inicio,
            oferta.fecha_fin,
            oferta.tipo_oferta,
            oferta.valor_descuento 
            FROM
            producto
            INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
            INNER JOIN oferta ON producto.id = oferta.producto_id
            WHERE
            producto.estado = 1 AND
            producto.cantidad <> 0 AND
            producto.id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function RegistraCalificacionOferta($id, $comentario_oferta, $iduser)
    {
        try {
            $rep = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO calificarproducto (idproducto, detalle, idcliente, oferta) VALUES (?,?,?,'oferta')";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $comentario_oferta);
            $query->bindParam(3, $iduser);
            if ($query->execute()) {
                $rep = 1;
            } else {
                $rep = 0;
            }

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $rep;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function RegistraCalificacion($id, $comentario_oferta, $iduser)
    {
        try {
            $rep = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO calificarproducto (idproducto, detalle, idcliente, oferta) VALUES (?,?,?,'Sin oferta')";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $comentario_oferta);
            $query->bindParam(3, $iduser);
            if ($query->execute()) {
                $rep = 1;
            } else {
                $rep = 0;
            }

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $rep;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerComentarioProducto($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            calificarproducto.id,
            calificarproducto.calificacion,
            cliente.nombre,
            calificarproducto.detalle,
            calificarproducto.fecha,
            calificarproducto.idproducto,
            calificarproducto.oferta 
            FROM
                calificarproducto
                INNER JOIN cliente ON calificarproducto.idcliente = cliente.id 
            WHERE
            calificarproducto.oferta = 'oferta' 
            AND calificarproducto.idproducto = ? 
            ORDER BY calificarproducto.id DESC";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll();

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerComentarioProductoNormal($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            calificarproducto.id,
            calificarproducto.calificacion,
            cliente.nombre,
            calificarproducto.detalle,
            calificarproducto.fecha,
            calificarproducto.idproducto,
            calificarproducto.oferta 
            FROM
            calificarproducto
            INNER JOIN cliente ON calificarproducto.idcliente = cliente.id 
            WHERE
            calificarproducto.oferta != 'oferta' 
            AND calificarproducto.idproducto = ? 
            ORDER BY calificarproducto.id DESC";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll();

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraercalificacionProducto($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT COUNT(*) FROM calificarestado WHERE productoid = ? ";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraercalificacionProductoOferta($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT COUNT(*) FROM calificarestadooferta WHERE productoid = ? ";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    //////////////////////
    function IngresarProductoCarritoNormal($iduser, $id, $precio, $cantidad)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "SELECT * FROM aggcarrito where cliente_id = ? AND producto_id = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $iduser);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch();

            if (empty($data_a)) {

                //////////////////// saber si hay stock
                $sql_stock = "SELECT cantidad FROM producto WHERE id = ?";
                $q_stock_a = $c->prepare($sql_stock);
                $q_stock_a->bindParam(1, $id);
                $q_stock_a->execute();
                $stock_actual = $q_stock_a->fetch();

                if ($cantidad > $stock_actual[0]) {
                    return $res = "Stock " . $stock_actual[0];
                }

                $sql_c = "INSERT INTO aggcarrito (cliente_id, producto_id, precio, cantidad, sale, promocion, tipo_promo, porcentaje, descuento_promo) VALUES (?,?,?,?,?,'No oferta','0','0','0')";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $iduser);
                $query_c->bindParam(2, $id);
                $query_c->bindParam(3, $precio);
                $query_c->bindParam(4, $cantidad);
                $query_c->bindParam(5, $cantidad);
                if ($query_c->execute()) {
                    $res = 1; // registro exitoso
                } else {
                    $res = 0; // error en la inserccion
                }
            } else {

                $cant = "";
                $cant = $data_a[2] + $cantidad;

                $stock = 0;
                $sql_p = "SELECT cantidad FROM producto WHERE id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $id);
                $query_p->execute();
                $dato_p = $query_p->fetch();
                foreach ($dato_p as $respuesto_p) {
                    $stock = $respuesto_p;
                }

                if ($cant > $stock) {
                    $res = "Stock " . $stock;
                } else {
                    $sql_d = "UPDATE aggcarrito SET cantidad = ? WHERE producto_id = ? AND cliente_id = ?";
                    $query_d = $c->prepare($sql_d);
                    $query_d->bindParam(1, $cant);
                    $query_d->bindParam(2, $id);
                    $query_d->bindParam(3, $iduser);
                    if ($query_d->execute()) {
                        $res = 2; // exito atualizacion
                    } else {
                        $res = 3; // error en la actualizacion
                    }
                }
                $res = $res; // el prodcuto ya fue agregado
            }

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $res;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    //////////////////////
    function IngresarProductoCarritoOferta($iduser, $id, $precio, $cantidad)
    {
        try {
            $res = "";
            $sale = 0;

            $c = $this->conexion->conexionPDO();
            $sql_a = "SELECT * FROM aggcarrito where cliente_id = ? AND producto_id = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $iduser);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch();
            if (empty($data_a)) {

                // $cantidadd = 1;
                $tipo_promocion = "";
                $valor = 0;
                $porcentaje = 0;
                $descuento = 0;
                $sql_p = "SELECT
                oferta.tipo_oferta,
                oferta.valor_descuento,
                producto.precio 
                FROM oferta
                INNER JOIN producto ON oferta.producto_id = producto.id 
                WHERE oferta.producto_id = ?";

                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $id);
                $query_p->execute();
                $dato_p = $query_p->fetchAll();
                foreach ($dato_p as $respuesta) {
                    $valor = $respuesta[2];
                    $porcentaje = $respuesta[1];
                    $tipo_promocion = $respuesta[0];
                }
                $descuento = $valor * $porcentaje / 100;

                if ($tipo_promocion === '2x1') {
                    $sale = 2 * $cantidad;
                } else if ($tipo_promocion === '3x1') {
                    $sale = 3 * $cantidad;
                } else {
                    $sale = $cantidad;
                }

                //////////////////// saber si hay stock
                $sql_stock = "SELECT cantidad FROM producto WHERE id = ?";
                $q_stock_a = $c->prepare($sql_stock);
                $q_stock_a->bindParam(1, $id);
                $q_stock_a->execute();
                $stock_actual = $q_stock_a->fetch();

                if ($sale > $stock_actual[0]) {
                    return $res = "Es una oferta del: " . $tipo_promocion . " - Stock " . $stock_actual[0];
                }

                $sql_c = "INSERT INTO aggcarrito (cliente_id, producto_id, tipo_promo, porcentaje, descuento_promo, promocion, cantidad, precio, sale) VALUES (?,?,?,?,?,?,?,?,?)";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $iduser);
                $query_c->bindParam(2, $id);
                $query_c->bindParam(3, $tipo_promocion);
                $query_c->bindParam(4, $porcentaje);
                $query_c->bindParam(5, $descuento);
                $query_c->bindParam(6, $tipo_promocion);
                $query_c->bindParam(7, $cantidad);
                $query_c->bindParam(8, $valor);
                $query_c->bindParam(9, $sale);

                if ($query_c->execute()) {
                    $res = 1; // registro exitoso
                } else {
                    $res = 0; // error en la inserccion
                }
            } else {

                $cant = "";
                $cant = $data_a[2] + $cantidad;

                if ($data_a[4] === '2x1') {
                    $sale = 2 * $cant;
                } else if ($data_a[4] === '3x1') {
                    $sale = 3 * $cant;
                } else {
                    $sale = $cant;
                }

                $stock = 0;
                $sql_p = "SELECT cantidad FROM producto WHERE id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $id);
                $query_p->execute();
                $dato_p = $query_p->fetch();
                foreach ($dato_p as $respuesto_p) {
                    $stock = $respuesto_p;
                }

                if ($sale > $stock) {
                    $res = "Es una oferta del: " . $data_a[4] . " - Stock " . $stock;
                } else {
                    $sql_d = "UPDATE aggcarrito SET cantidad = ?, sale = ? WHERE producto_id = ? AND cliente_id = ?";
                    $query_d = $c->prepare($sql_d);
                    $query_d->bindParam(1, $cant);
                    $query_d->bindParam(2, $sale);
                    $query_d->bindParam(3, $id);
                    $query_d->bindParam(4, $iduser);
                    if ($query_d->execute()) {
                        $res = 2; // exito atualizacion
                    } else {
                        $res = 3; // error en la actualizacion
                    }
                }
            }

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $res;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function ContarCantidadCarrito($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT COUNT(*) as contar FROM aggcarrito where cliente_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerProductosDelCliente($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            aggcarrito.producto_id,
            producto.nombre,
            tipo_producto.tipo,
            aggcarrito.cantidad,
            aggcarrito.promocion,
            aggcarrito.tipo_promo,
            aggcarrito.porcentaje,
            aggcarrito.descuento_promo,
            aggcarrito.precio,
            aggcarrito.sale,
            (aggcarrito.precio - aggcarrito.descuento_promo) * (aggcarrito.cantidad) as total,
            aggcarrito.cliente_id
            FROM
            aggcarrito
            INNER JOIN producto ON aggcarrito.producto_id = producto.id
            INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
            WHERE
            aggcarrito.cliente_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function EliminarProductoDetalle($id_pro, $id_cli)
    {
        try {
            $rep = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "DELETE FROM aggcarrito WHERE producto_id = ? AND cliente_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id_pro);
            $query->bindParam(2, $id_cli);
            if ($query->execute()) {
                $rep = 1;
            } else {
                $rep = 0;
            }
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $rep;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function RegistrarVentaCarrito($id_cli, $direccions, $sub, $impuesto, $total, $ciudad, $referencia)
    {
        try {
            $result = 0;
            $iva = 12;
            $comprobante = "PayPal";

            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO ventaweb (cliente_id, direccion, subtotal, impuesto, total, fecha, n_venta, comprobante, iva, ciudad, referencia) 
            VALUE (?,?,?,?,?,?,?,?,?,?,?)";

            $query = $c->prepare($sql);
            $query->bindParam(1, $id_cli);
            $query->bindParam(2, $direccions);
            $query->bindParam(3, $sub);
            $query->bindParam(4, $impuesto);
            $query->bindParam(5, $total);
            $query->bindParam(6, date("Y-m-d"));
            $query->bindParam(7, date("YmdHms"));
            $query->bindParam(8, $comprobante);
            $query->bindParam(9, $iva);

            $query->bindParam(10, $ciudad);
            $query->bindParam(11, $referencia);

            if ($query->execute()) {
                $result = $c->lastInsertId();

                $sql_d = "DELETE FROM aggcarrito WHERE cliente_id = ?";
                $query_d = $c->prepare($sql_d);
                $query_d->bindParam(1, $id_cli);
                $query_d->execute();
            } else {
                $result = 0;
            }
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function RegistrarVentaCarritoDetalle($id, $arraglo_id, $arraglo_cantidad, $arraglo_sale, $arraglo_precio, $arraglo_oferta, $arraglo_descuento, $arraglo_total)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO ventawebdetalle (ventaid, productoid, cantidad, sale, precio, oferta, descuento, total) VALUE (?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $arraglo_id);
            $query->bindParam(3, $arraglo_cantidad);
            $query->bindParam(4, $arraglo_sale);
            $query->bindParam(5, $arraglo_precio);
            $query->bindParam(6, $arraglo_oferta);
            $query->bindParam(7, $arraglo_descuento);
            $query->bindParam(8, $arraglo_total);

            if ($query->execute()) {

                $sql_p = "SELECT cantidad FROM producto where id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_id);
                $query_p->execute();
                $data = $query_p->fetch();

                $stock = $data[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }

                $stock = $stock - $arraglo_sale;

                $sql_m = "UPDATE producto SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_id);

                if ($query_m->execute()) {
                    $result = 1;
                } else {
                    $result = 0;
                }
            } else {
                $result = 0;
            }

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function AnularFacturaVentaWeb($id)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE ventaweb SET estado = 0 WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $res;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function CalificarProducto($iduser, $estado, $idproducto)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "call EventoEstado(?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $iduser);
            $querya->bindParam(2, $idproducto);
            $querya->bindParam(3, $estado);
            $querya->execute();
            $res = $querya->fetch();

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $res[0];
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerCalificaionCliente($id, $idprod)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT estado FROM calificarestado where clienteid = ? AND productoid = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $idprod);
            $query->execute();
            $result = $query->fetch();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            if (!empty($result)) {
                return $result[0];
            } else {
                return $result;
            }
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function CalificarProductoOferta($iduser, $estado, $idproducto)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "call EventoEstadoOferta(?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $iduser);
            $querya->bindParam(2, $idproducto);
            $querya->bindParam(3, $estado);
            $querya->execute();
            $res = $querya->fetch();

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $res[0];
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerCalificaionClienteOferta($id, $idprod)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT estado FROM calificarestadooferta where clienteid = ? AND productoid = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $idprod);
            $query->execute();
            $result = $query->fetch();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            if (!empty($result)) {
                return $result[0];
            } else {
                return $result;
            }
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    //////////// DATOS DEL CLIENTE DASHBOARD
    function ListarComprasClienteWeb($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            ventaweb.id,
            CONCAT_WS( ' ', cliente.nombre, cliente.apellidos ) AS cliente,
            cliente.cedula,
            ventaweb.direccion,
            ventaweb.subtotal,
            ventaweb.impuesto,
            ventaweb.total,
            ventaweb.fecha,
            ventaweb.n_venta,
            ventaweb.comprobante,
            ventaweb.iva,
            ventaweb.estado,
            ventaweb.fecharegistro,
            ventaweb.ciudad,
            ventaweb.referencia 
            FROM
            ventaweb INNER JOIN cliente ON ventaweb.cliente_id = cliente.id 
            WHERE ventaweb.comprobante = 'PayPal' AND cliente.id = ?
            ORDER BY ventaweb.id DESC";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function ListarComprasCliente($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            ventaweb.id,
            CONCAT_WS( ' ', cliente.nombre, cliente.apellidos ) AS cliente,
            cliente.cedula,
            ventaweb.direccion,
            ventaweb.subtotal,
            ventaweb.impuesto,
            ventaweb.total,
            ventaweb.fecha,
            ventaweb.n_venta,
            ventaweb.comprobante,
            ventaweb.iva,
            ventaweb.estado,
            ventaweb.fecharegistro,
            ventaweb.ciudad,
            ventaweb.referencia 
            FROM ventaweb INNER JOIN cliente ON ventaweb.cliente_id = cliente.id 
            WHERE ventaweb.comprobante != 'PayPal' AND cliente.id = ?
            ORDER BY
            ventaweb.id DESC";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerDatosCliente($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            cliente.id,
            cliente.nombre,
            cliente.apellidos,
            cliente.correo,
            cliente.cedula,
            cliente.sexo,
            cliente.direccion,
            cliente.telefono,
            cliente.`password`,
            cliente.estado,
            cliente.createt 
            FROM
                cliente 
            WHERE
            cliente.id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function EditarPasswordCliente($iduser, $passnew)
    {
        try {
            $result = 0;

            $c = $this->conexion->conexionPDO();
            $sql = "UPDATE cliente SET password = ? WHERE id = ? ";

            $query = $c->prepare($sql);
            $query->bindParam(1, $passnew);
            $query->bindParam(2, $iduser);

            if ($query->execute()) {
                $result = 1;
            } else {
                $result = 0;
            }
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }
}
