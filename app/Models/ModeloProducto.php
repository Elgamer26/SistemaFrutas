<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloProducto
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

    function ListadoProductos()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.id, 
            producto.codigo, 
            producto.nombre, 
            producto.tipo_id, 
            tipo_producto.tipo, 
            producto.precio, 
            producto.descripcion, 
            producto.imagen, 
            producto.estado,
            producto.cantidad
            FROM
            producto
            INNER JOIN
            tipo_producto
            ON 
            producto.tipo_id = tipo_producto.id ORDER BY producto.id DESC";
            $query = $c->prepare($sql);
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

    function SelectProductoOferta()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.id, 
            producto.codigo, 
            producto.nombre, 
            producto.tipo_id, 
            tipo_producto.tipo, 
            producto.precio, 
            producto.descripcion, 
            producto.imagen, 
            producto.estado,
            producto.cantidad
            FROM producto
            INNER JOIN tipo_producto 
            ON producto.tipo_id = tipo_producto.id 
            WHERE producto.cantidad != 0 AND producto.estado = 1 AND producto.oferta = 0
            ORDER BY producto.id DESC";
            $query = $c->prepare($sql);
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

    function SelecProductoComentado()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            calificarproducto.idproducto,
            producto.codigo,
            producto.nombre,
            tipo_producto.tipo 
            FROM
            calificarproducto
            INNER JOIN producto ON calificarproducto.idproducto = producto.id
            INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
            GROUP BY
            calificarproducto.idproducto 
            ORDER BY
            calificarproducto.idproducto DESC";
            $query = $c->prepare($sql);
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

    function ListadoTipoProducto()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipo_producto ORDER BY id DESC";
            $query = $c->prepare($sql);
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

    function RegistraTipoProducto($rol)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistraTipoProducto(?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $rol);
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

    function EstadoTipo($estado, $id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE tipo_producto SET estado = ? WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $estado);
            $querya->bindParam(2, $id);
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

    function TraerTipoProductoEdit($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipo_producto WHERE id = ?";
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

    function EditarTipoProducto($nombrerol, $id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarTipoProducto(?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombrerol);
            $query->bindParam(2, $id);
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

    function SelecTipoProducto()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipo_producto WHERE estado = 1 ORDER BY id DESC";
            $query = $c->prepare($sql);
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

    function RegistraProducto($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $nombrearchivo)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistraProducto(?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $codigo);
            $query->bindParam(2, $nombres);
            $query->bindParam(3, $tipo_producto);
            $query->bindParam(4, $precio_venta);
            $query->bindParam(5, $descripcion);
            $query->bindParam(6, $nombrearchivo);
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

    function EstadoProducto($estado, $id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE producto SET estado = ? WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $estado);
            $querya->bindParam(2, $id);
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

    function TraerProducto($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.id, 
            producto.codigo, 
            producto.nombre, 
            producto.tipo_id, 
            tipo_producto.tipo, 
            producto.precio, 
            producto.descripcion, 
            producto.imagen, 
            producto.estado
            FROM
            producto
            INNER JOIN
            tipo_producto
            ON 
            producto.tipo_id = tipo_producto.id WHERE producto.id = ?";
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

    function EditarProducto($productoID, $codigo, $nombres, $tipo_producto, $precio_venta, $descripcion)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarProducto(?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $productoID);
            $query->bindParam(2, $codigo);
            $query->bindParam(3, $nombres);
            $query->bindParam(4, $tipo_producto);
            $query->bindParam(5, $precio_venta);
            $query->bindParam(6, $descripcion);
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

    function EditarFotoProducto($id, $foto)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE producto SET imagen = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $foto);
            $querya->bindParam(2, $id);
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

    function ListProductoProduccion()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.id, 
            producto.codigo, 
            producto.nombre, 
            tipo_producto.tipo, 
            producto.estado
            FROM
            producto
            INNER JOIN
            tipo_producto
            ON 
            producto.tipo_id = tipo_producto.id WHERE producto.estado = 1 ORDER BY producto.id DESC";
            $query = $c->prepare($sql);
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

    function RegistroOferta($producto, $fechainicio, $fechafin, $tipooferta, $valordescuento)
    {
        try {
            $result = 0;

            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO oferta (producto_id, fecha_inicio, fecha_fin, tipo_oferta, valor_descuento) VALUES (?,?,?,?,?)";
            $query = $c->prepare($sql);

            $query->bindParam(1, $producto);
            $query->bindParam(2, $fechainicio);
            $query->bindParam(3, $fechafin);
            $query->bindParam(4, $tipooferta);
            $query->bindParam(5, $valordescuento);

            if ($query->execute()) {
                $sql_p = "UPDATE producto SET oferta = 1 WHERE id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $producto);
                if ($query_p->execute()) {
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

    function EditarOferta($idoferta, $fechainicio, $fechafin, $tipooferta, $valordescuento)
    {
        try {
            $result = 0;

            $c = $this->conexion->conexionPDO();
            $sql = "UPDATE oferta SET fecha_inicio = ?, fecha_fin = ?, tipo_oferta = ?, valor_descuento = ? WHERE id = ?";
            $query = $c->prepare($sql);

            $query->bindParam(1, $fechainicio);
            $query->bindParam(2, $fechafin);
            $query->bindParam(3, $tipooferta);
            $query->bindParam(4, $valordescuento);
            $query->bindParam(5, $idoferta);

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

    function Pagination_oferta($partida, $valor)
    {
        try {
            $c = $this->conexion->conexionPDO();

            $paginaactual = htmlspecialchars($partida, ENT_QUOTES, 'UTF-8');
            if (!empty($valor)) {
                $datos = $valor;
                $sql = "SELECT
                COUNT(*) 
                FROM
                oferta
                INNER JOIN producto ON oferta.producto_id = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
                WHERE
                producto.estado = 1 AND 
                oferta.fecha_inicio LIKE '%" . $datos . "%' 
                OR oferta.fecha_fin LIKE '%" . $datos . "%' 
                OR oferta.tipo_oferta LIKE '%" . $datos . "%' 
                OR oferta.valor_descuento LIKE '%" . $datos . "%' 
                OR producto.nombre LIKE '%" . $datos . "%' 
                OR tipo_producto.tipo LIKE '%" . $datos . "%'";
            } else {
                $sql = "SELECT
                COUNT(*) 
                FROM
                oferta
                INNER JOIN producto ON oferta.producto_id = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
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
                oferta.id,
                oferta.producto_id,
                oferta.fecha_inicio,
                oferta.fecha_fin,
                oferta.tipo_oferta,
                oferta.valor_descuento,
                oferta.fecha_registro,
                producto.codigo,
                producto.nombre,
                tipo_producto.tipo,
                producto.precio,
                producto.descripcion,
                producto.imagen,
                producto.cantidad 
                FROM
                oferta
                INNER JOIN producto ON oferta.producto_id = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
                WHERE
                producto.estado = 1 
                AND oferta.fecha_inicio LIKE '%" . $datos . "%' 
                OR oferta.fecha_fin LIKE '%" . $datos . "%' 
                OR oferta.tipo_oferta LIKE '%" . $datos . "%' 
                OR oferta.valor_descuento LIKE '%" . $datos . "%' 
                OR producto.nombre LIKE '%" . $datos . "%' 
                OR tipo_producto.tipo LIKE '%" . $datos . "%'
                ORDER BY oferta.id DESC LIMIT $limit, $numlotes";
            } else {
                $sql_p = "SELECT
                oferta.id,
                oferta.producto_id,
                oferta.fecha_inicio,
                oferta.fecha_fin,
                oferta.tipo_oferta,
                oferta.valor_descuento,
                oferta.fecha_registro,
                producto.codigo,
                producto.nombre,
                tipo_producto.tipo,
                producto.precio,
                producto.descripcion,
                producto.imagen,
                producto.cantidad 
                FROM
                oferta
                INNER JOIN producto ON oferta.producto_id = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
                WHERE
                producto.estado = 1 
                ORDER BY oferta.id DESC LIMIT $limit, $numlotes";
            }
            //
            $query_p = $c->prepare($sql_p);
            $query_p->execute();
            $result = $query_p->fetchAll();

            $estado = "";

            foreach ($result as $respuesta) {

                if ($respuesta[4] == "2x1") {
                    $estado = "primary";
                } else if ($respuesta[4] == "3x1") {
                    $estado = "warning";
                } else {
                    $estado = "success";
                }

                $tabla = $tabla . '<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                        Producto en oferta 
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>' . $respuesta[7] . '</b></h2>
                                                    <p class="text-muted text-sm"><b>Producto: </b> ' . $respuesta[8] . ' </p>
                                                    <p class="text-muted text-sm"><b>Tipo: </b> ' . $respuesta[9] . ' </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span> Fecha Inicio: ' . $respuesta[2] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span> Fecha Fin: ' . $respuesta[3] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-shopping-cart"></i></span> Precio: $ ' . $respuesta[10] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-tags"></i></span> Oferta:  <span class="badge badge-' . $estado . '">' . $respuesta[4] . '</span></li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-certificate"></i></span> Descuento: ' . $respuesta[5] . ' %</li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="' . base_url() . 'public/img/producto/' . $respuesta[12] . '" alt="user-avatar" class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a title="Enviar correo masivos" class="btn btn-sm bg-primary" onclick="EnviarCorreoMasivosOfertas(' . $respuesta[0] . ');">
                                                    <i class="fa fa-envelope"></i>
                                                </a>

                                                <a title="Enviar whatsapp masivos" class="btn btn-sm bg-success" onclick="EnviarOfertasSMS(' . $respuesta[0] . ');">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>

                                                <a title="Eliminar la oferta" class="btn btn-sm bg-danger" onclick="EliminarOferta(' . $respuesta[0] . ', ' . $respuesta[1] . ');">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                                <a title="Editar la oferta" class="btn btn-sm bg-warning" onclick="cargar_contenido(`contenido_principal`, `' .  base_url() . 'admin/oferta/editar/' . $respuesta[0] . '`);">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                            </div>
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

    function TraerOfertaEditar($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            oferta.id,
            oferta.producto_id,
            oferta.fecha_inicio,
            oferta.fecha_fin,
            oferta.tipo_oferta,
            oferta.valor_descuento
            FROM
            oferta
            INNER JOIN producto ON oferta.producto_id = producto.id
            INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
            WHERE oferta.id = ?";
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

    function EliminarOferta($idoferta, $idproducto)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "DELETE FROM oferta WHERE id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $idoferta);
            if ($query->execute()) {
                $sqlp = "UPDATE producto SET oferta = 0 WHERE id = ?";
                $querp = $c->prepare($sqlp);
                $querp->bindParam(1, $idproducto);
                if ($querp->execute()) {
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

    function GeneraOfertaSms($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT telefono, nombre, apellidos FROM cliente WHERE estado = 1";
            $query = $c->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();

            $sqloferta = "SELECT oferta.fecha_fin, oferta.tipo_oferta, producto.nombre, producto.imagen 
            FROM oferta INNER JOIN  producto ON oferta.producto_id = producto.id WHERE oferta.id = ?";
            $queryoferta = $c->prepare($sqloferta);
            $queryoferta->bindParam(1, $id);
            $queryoferta->execute();
            $oferta = $queryoferta->fetch();

            $sms = [];

            foreach ($data as $row) {
                try {
                    if (mb_strlen($row["telefono"]) == 10) {
                        $telefono = substr($row["telefono"], 1);
                        $postal = "593" . $telefono;

                        $sms[] = ["numero" => $postal, "mensaje" => "INSETECH LE RECUERDA: ESTIMADO(A) CLIENTE(A): " . $row['nombre'] . " " . $row['apellidos'] . ", TENEMOS UNA OFERTA ESPECIALMENTE PARA TI, HASTA EL: $oferta[0], NOMBRE DEL PRODUCTO: $oferta[2], EL TIPO DE OFERTA ES: $oferta[1], INGRESE A NUESTRA PAGINA WEB http://instechsystema.i-sistener.xyz/TIENDA/index.php PARA VER MAS DETALLE DE LA OFERTA, GRACIAS POR CONFIAR EN NOSOTROS"];
                        $sms[] = ["numero" => $postal, "url" => "http://instechsystema.i-sistener.xyz/ADMIN/" . $oferta[3] . ""];
                    }
                } catch (\Exception $e) {
                    return 0;
                }
            }

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $sms;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerComentarioProductoCliente($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            calificarproducto.id,
            calificarproducto.calificacion,
            calificarproducto.detalle,
            calificarproducto.fecha,
            calificarproducto.idproducto,
            calificarproducto.oferta,
            calificarproducto.idcliente,
            CONCAT_WS( ' ', cliente.nombre, cliente.apellidos ) AS cliente,
            CONCAT_WS( ' ', producto.codigo, '-', producto.nombre, '-', tipo_producto.tipo ) AS producto 
            FROM
            calificarproducto
            INNER JOIN cliente ON calificarproducto.idcliente = cliente.id
            INNER JOIN producto ON calificarproducto.idproducto = producto.id
            INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
            WHERE
            calificarproducto.idproducto = ?
            ORDER BY
            calificarproducto.id DESC";
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

    function ListCalificaionProducto()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            calificarestado.id,
            cliente.nombre,
            cliente.apellidos,
            producto.nombre AS producto,
            calificarestado.estado,
            calificarestado.fecha,
            'Sin oferta' AS oferta 
            FROM
            calificarestado
            INNER JOIN producto ON calificarestado.productoid = producto.id
            INNER JOIN cliente ON calificarestado.clienteid = cliente.id UNION ALL
            SELECT
            calificarestadooferta.id,
            cliente.nombre,
            cliente.apellidos,
            producto.nombre AS producto,
            calificarestadooferta.estado,
            calificarestadooferta.fecha,
            oferta.tipo_oferta AS oferta 
            FROM
            calificarestadooferta
            INNER JOIN cliente ON calificarestadooferta.clienteid = cliente.id
            INNER JOIN producto ON calificarestadooferta.productoid = producto.id
            INNER JOIN oferta ON producto.id = oferta.producto_id 
            ORDER BY id DESC";
            $query = $c->prepare($sql);
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

    function ObtenerCorreoClientes()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            cliente.correo,
            cliente.nombre,
            cliente.apellidos,
            cliente.telefono 
            FROM
                cliente 
            WHERE
            estado = 1";
            $query = $c->prepare($sql);
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

    function ObtenerProductEnvio($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            oferta.id,
            producto.nombre,
            tipo_producto.tipo,
            producto.imagen,
            oferta.fecha_fin,
            oferta.tipo_oferta 
            FROM
            oferta
            INNER JOIN producto ON oferta.producto_id = producto.id
            INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
            WHERE
            oferta.id = ?";
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
}
