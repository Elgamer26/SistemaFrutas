<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloTienda
{
    private $conexion;
    function __construct()
    {
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
                                        <div class="product-main simpleCart_shelfItem">
                                            <a href="' . base_url() . 'home/Detalle/' . $respuesta[0] . '" class="mask"><img class="img-responsive zoom-img" 
                                            style="width: 200px;
                                            height: 200px;
                                            object-fit: cover;" src="' . base_url() . 'public/img/producto/' . $respuesta[4] . '" alt="Imagen producto" /></a>
                                            <div class="product-bottom">
                                                <h3>' . $respuesta[1] . '</h3>
                                                <p>' . $respuesta[2] . '</p>
                                                <h4><i class="fa fa-shopping-cart"></i> <a class="item_add" href="#"></a> <span class=" item_price">$ ' . $respuesta[3] . '</span></h4>
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
                                                <h4><i class="fa fa-shopping-cart"></i> <a class="item_add" href="#"></a> <span class=" item_price">$ ' . $respuesta[3] . '</span></h4>
                                            </div>
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
            AND calificarproducto.idproducto = ? ORDER BY calificarproducto.id DESC";
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
}
