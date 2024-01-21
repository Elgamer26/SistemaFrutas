<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloProduccion
{
    private $conexion;

    function __construct()
    {
        date_default_timezone_set('America/Guayaquil');
        require_once 'ModeloConection.php';
        $this->conexion = new ModeloConection();
        //abrir conexion
        $this->conexion->conexionPDO();
        //cerra conexion
        $this->conexion->cerrar_conexion();
    }

    function TraerCantidadInsumo($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT cantidad FROM insumo WHERE id = ?";
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

    function TraerCantidadMaterial($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT cantidad FROM material WHERE id = ?";
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

    function RegistrarProduccionPlantas($nombreproduccion, $fechainicio, $fechaFin, $diasproduccion, $producto, $iduser, $cantidadprod)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO produccion (nombre, fechaini, fechafin, dias, productoid, usuarioid, cantidad) VALUES (?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);

            $query->bindParam(1, $nombreproduccion);
            $query->bindParam(2, $fechainicio);
            $query->bindParam(3, $fechaFin);
            $query->bindParam(4, $diasproduccion);
            $query->bindParam(5, $producto);
            $query->bindParam(6, $iduser);
            $query->bindParam(7, $cantidadprod);

            if ($query->execute()) {
                $result = $c->lastInsertId();

                $sql_pro = "SELECT cantidad FROM producto WHERE id = ?";
                $query_pro = $c->prepare($sql_pro);
                $query_pro->bindParam(1,  $producto);
                $query_pro->execute();
                $datapro = $query_pro->fetch();
                $cantidadpro = $datapro[0];

                $cantidadpro = $cantidadpro + $cantidadprod;

                $sql_m = "UPDATE producto SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $cantidadpro);
                $query_m->bindParam(2, $producto);
                $query_m->execute();

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

    function RegistrarDetalleInsumoProduccion($id, $arraglo_idinsumo, $arraglo_cantidad)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO detalleproduccioninsumo (produccion_id, insumo_id, cantidad) VALUES (?,?,?)";

            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $arraglo_idinsumo);
            $query->bindParam(3, $arraglo_cantidad);

            if ($query->execute()) {

                $sql_p = "SELECT cantidad FROM insumo where id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idinsumo);
                $query_p->execute();
                $data = $query_p->fetch();

                $stock = $data[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }

                $stock = $stock - $arraglo_cantidad;

                $sql_m = "UPDATE insumo SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idinsumo);

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

    function RegistrarDetalleMaterialProduccion($id, $arraglo_idmaterial, $arraglo_cantidad)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO detalleproduccionmaterial(produccion_id, material_id, cantidad) VALUES (?,?,?)";

            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $arraglo_idmaterial);
            $query->bindParam(3, $arraglo_cantidad);

            if ($query->execute()) {

                $sql_p = "SELECT cantidad FROM material where id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idmaterial);
                $query_p->execute();
                $data = $query_p->fetch();

                $stock = $data[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }

                $stock = $stock - $arraglo_cantidad;

                $sql_m = "UPDATE material SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idmaterial);

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

    function PaginadorProduccion($partida, $valor)
    {
        try {
            $c = $this->conexion->conexionPDO();

            $paginaactual = htmlspecialchars($partida, ENT_QUOTES, 'UTF-8');
            if (!empty($valor)) {
                $datos = $valor;
                $sql = "SELECT
                COUNT(*)
                FROM
                produccion
                INNER JOIN
                producto
                ON 
                produccion.productoid = producto.id
                WHERE 
                produccion.estado = 1 
                AND
                (produccion.nombre LIKE '%" . $datos . "%'
                OR
                producto.nombre LIKE '%" . $datos . "%'
                OR
                produccion.dias LIKE '%" . $datos . "%')
                AND produccion.cantidad > 0";
            } else {
                $sql = "SELECT
                COUNT(*)
                FROM
                produccion
                INNER JOIN
                producto
                ON 
                produccion.productoid = producto.id
                WHERE produccion.estado = 1 
                AND produccion.cantidad > 0";
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
                produccion.id,
                produccion.nombre,
                DATE_FORMAT(produccion.fecharegistro, '%d/%m/%Y') as fecha,    
                produccion.fechaini,
                produccion.fechafin,
                produccion.dias,
                produccion.productoid,
                producto.nombre AS nombreprod,
                tipo_producto.tipo,
                produccion.estado,
                usuario.nombres,
                produccion.cantidad
                FROM
                produccion
                INNER JOIN producto ON produccion.productoid = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
                INNER JOIN usuario ON produccion.usuarioid = usuario.id 
                WHERE
                produccion.estado = 1 AND
                (produccion.nombre LIKE '%" . $datos . "%' 
                OR producto.nombre LIKE '%" . $datos . "%' 
                OR produccion.dias LIKE '%" . $datos . "%')
                AND produccion.cantidad > 0
                ORDER BY produccion.id DESC LIMIT $limit, $numlotes";
            } else {
                $sql_p = "SELECT
                produccion.id,
                produccion.nombre,
                DATE_FORMAT(produccion.fecharegistro, '%d/%m/%Y') as fecha,    
                produccion.fechaini,
                produccion.fechafin,
                produccion.dias,
                produccion.productoid,
                producto.nombre AS nombreprod,
                tipo_producto.tipo,
                produccion.estado,
                usuario.nombres,
                produccion.cantidad
                FROM
                produccion
                INNER JOIN producto ON produccion.productoid = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
                INNER JOIN usuario ON produccion.usuarioid = usuario.id 
                WHERE
                produccion.estado = 1 
                AND produccion.cantidad > 0
                ORDER BY
                produccion.id DESC LIMIT $limit, $numlotes";
            }
            //
            $query_p = $c->prepare($sql_p);
            $query_p->execute();
            $result = $query_p->fetchAll();

            $estado = "";

            foreach ($result as $respuesta) {

                if ($respuesta[9] == 1) {
                    $estado = "Iniciado";
                } else if ($respuesta[9] == 2) {
                    $estado = "Finalizado";
                } else {
                    $estado = "Caducado";
                }

                $tabla = $tabla . '<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                        ' . $respuesta[1] . '
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>' . $respuesta[7] . '</b></h2>
                                                    <p class="text-muted text-sm"><b>Lote: </b> ' . $respuesta[0] . ' </p>
                                                    <p class="text-muted text-sm"><b>Tipo: </b> ' . $respuesta[8] . ' </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span> Fecha registro: ' . $respuesta[2] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Usuario: ' . $respuesta[10] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-cube"></i></span> Cantidad: ' . $respuesta[11] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-tags"></i></span> Estado:  <span class="badge badge-warning">Registrado</span></li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="' . base_url() . 'public/img/producto/producto.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a title="Ver Pdf" class="btn btn-sm bg-primary" onclick="VerReporteproduccionActiva(' . $respuesta[0] . ');">
                                                    <i class="fas fa-file"></i>
                                                </a>

                                                <a title="Ver Eliminar la producción" class="btn btn-sm bg-danger" onclick="EliminarProduccion(' . $respuesta[0] . ', ' . $respuesta[6] . ', ' . $respuesta[11] . ');">
                                                    <i class="fas fa-times"></i> Eliminar producción
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }

            // <a title="Ver perdidas" class="btn btn-sm bg-primary" onclick="VerPerdidaProduccion(' . $respuesta[0] . ');">
            //                                         <i class="fa fa-exclamation-triangle"></i>
            //                                     </a>

            //                                     <a title="Ver Fases" class="btn btn-sm bg-warning" onclick="VerFaseProduccion(' . $respuesta[0] . ');">
            //                                         <i class="fa fa-eye"></i>
            //                                     </a>

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

    function paginationFinalizado($partida, $valor)
    {
        try {
            $c = $this->conexion->conexionPDO();

            $paginaactual = htmlspecialchars($partida, ENT_QUOTES, 'UTF-8');
            if (!empty($valor)) {
                $datos = $valor;
                $sql = "SELECT
                COUNT(*)
                FROM
                produccion
                INNER JOIN
                producto
                ON 
                produccion.productoid = producto.id
                WHERE 
                produccion.estado = 2 
                AND
                produccion.nombre LIKE '%" . $datos . "%'
                OR
                producto.nombre LIKE '%" . $datos . "%'
                OR
                produccion.dias LIKE '%" . $datos . "%'";
            } else {
                $sql = "SELECT
                COUNT(*)
                FROM
                produccion
                INNER JOIN
                producto
                ON 
                produccion.productoid = producto.id
                WHERE produccion.estado = 2 ";
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
                produccion.id,
                produccion.nombre,
                produccion.fecharegistro,
                produccion.fechaini,
                produccion.fechafin,
                produccion.dias,
                produccion.productoid,
                producto.nombre AS nombreprod,
                tipo_producto.tipo,
                produccion.estado,
                usuario.nombres,
                produccion.cantidad
                FROM
                produccion
                INNER JOIN producto ON produccion.productoid = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
                INNER JOIN usuario ON produccion.usuarioid = usuario.id 
                WHERE
                produccion.estado = 2 AND
                produccion.nombre LIKE '%" . $datos . "%' 
                OR producto.nombre LIKE '%" . $datos . "%' 
                OR produccion.dias LIKE '%" . $datos . "%' 
                ORDER BY produccion.id DESC LIMIT $limit, $numlotes";
            } else {
                $sql_p = "SELECT
                produccion.id,
                produccion.nombre,
                produccion.fecharegistro,
                produccion.fechaini,
                produccion.fechafin,
                produccion.dias,
                produccion.productoid,
                producto.nombre AS nombreprod,
                tipo_producto.tipo,
                produccion.estado,
                usuario.nombres,
                produccion.cantidad
                FROM
                produccion
                INNER JOIN producto ON produccion.productoid = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
                INNER JOIN usuario ON produccion.usuarioid = usuario.id 
                WHERE
                produccion.estado = 2 
                ORDER BY
                produccion.id DESC LIMIT $limit, $numlotes";
            }
            //
            $query_p = $c->prepare($sql_p);
            $query_p->execute();
            $result = $query_p->fetchAll();

            $estado = "";

            foreach ($result as $respuesta) {

                if ($respuesta[9] == 1) {
                    $estado = "Iniciado";
                } else if ($respuesta[9] == 2) {
                    $estado = "Finalizado";
                } else {
                    $estado = "Caducado";
                }

                $tabla = $tabla . '<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                        ' . $respuesta[1] . '
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>' . $respuesta[7] . '</b></h2>
                                                    <p class="text-muted text-sm"><b>Lote: </b> ' . $respuesta[0] . ' </p>
                                                    <p class="text-muted text-sm"><b>Tipo: </b> ' . $respuesta[8] . ' </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span> Fecha Inicio: ' . $respuesta[3] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span> Fecha Fin: ' . $respuesta[4] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-home"></i></span> Dias: ' . $respuesta[5] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Usuario: ' . $respuesta[10] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-cube"></i></span> Cantidad: ' . $respuesta[11] . ' </li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-tags"></i></span> Estado:  <span class="badge badge-success">' . $estado . '</span></li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="' . base_url() . 'public/img/producto/planta.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">

                                                <a title="Ver perdidas" class="btn btn-sm bg-primary" onclick="VerPerdidaProduccion(' . $respuesta[0] . ');">
                                                    <i class="fa fa-exclamation-triangle"></i>
                                                </a>

                                                <a title="Ver Fase" class="btn btn-sm bg-warning" onclick="VerFaseProduccion(' . $respuesta[0] . ');">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a title="Ver Pdf" class="btn btn-sm bg-danger" onclick="VerReporteproduccionFinalizada(' . $respuesta[0] . ');">
                                                    <i class="fas fa-file"></i>
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

    function ListProduccionActivas()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            produccion.id,
            produccion.nombre,
            produccion.fecharegistro,
            produccion.fechaini,
            produccion.fechafin,
            produccion.dias,
            produccion.productoid,
            producto.nombre AS nombreprod,
            tipo_producto.tipo,
            produccion.estado,
            usuario.nombres,
            produccion.cantidad
            FROM
            produccion
            INNER JOIN producto ON produccion.productoid = producto.id
            INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
            INNER JOIN usuario ON produccion.usuarioid = usuario.id 
            WHERE
            produccion.estado = 1 ORDER BY produccion.id DESC";
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

    function RegistroPerdidaProduccion($produccion, $cantidadperdida, $detalleperdida,  $fechaperdida, $iduser)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO perdida_produccion (produccion_id, cantidad, detalle, fecha, usuario_id) VALUES (?,?,?,?,?)";
            $query = $c->prepare($sql);

            $query->bindParam(1, $produccion);
            $query->bindParam(2, $cantidadperdida);
            $query->bindParam(3, $detalleperdida);
            $query->bindParam(4, $fechaperdida);
            $query->bindParam(5, $iduser);

            if ($query->execute()) {

                $sql_p = "SELECT cantidad FROM produccion WHERE id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $produccion);
                $query_p->execute();
                $data = $query_p->fetch();

                $stock = $data[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }

                $stock = $stock - $cantidadperdida;

                $sql_m = "UPDATE produccion SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $produccion);

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

    function ListarPerdida()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            perdida_produccion.id,
            produccion.id AS lote,
            produccion.nombre,
            perdida_produccion.cantidad,
            perdida_produccion.detalle,
            perdida_produccion.fecha,
            usuario.nombres,
            produccion.id AS idproduccion,
            produccion.estado as estadoproduccion
            FROM
                perdida_produccion
                INNER JOIN produccion ON perdida_produccion.produccion_id = produccion.id
                INNER JOIN usuario ON perdida_produccion.usuario_id = usuario.id 
            ORDER BY
            perdida_produccion.id DESC";
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

    function EliminarLaPerdida($id, $cantidad, $idprod)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "DELETE FROM perdida_produccion WHERE id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            if ($query->execute()) {

                $sql_p = "SELECT cantidad FROM produccion WHERE id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $idprod);
                $query_p->execute();
                $data = $query_p->fetch();

                $stock = $data[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }

                $stock = $stock + $cantidad;

                $sql_m = "UPDATE produccion SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $idprod);

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

    function ListFases()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM fase
            ORDER BY id ASC";
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

    function TraerNumeroFaseProduccion($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT COUNT(*) FROM faseproduccion where faseproduccion.produccion_id = ?";
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

    function TraerDetalleFaseProduccion($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            faseproduccion.id,
            faseproduccion.produccion_id,
            fase.fase,
            faseproduccion.fecha,
            faseproduccion.detalle,
            fase.id 
            FROM
                faseproduccion
                INNER JOIN fase ON faseproduccion.fase_id = fase.id 
            WHERE
                faseproduccion.produccion_id = ? 
            ORDER BY
            fase.id ASC";
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

    function RegistrarFaseProduccion($produccion, $fecharegistro, $diasproduccion,  $detallefase)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO faseproduccion (produccion_id, fase_id, fecha, detalle) VALUES (?,?,?,?)";
            $query = $c->prepare($sql);

            $query->bindParam(1, $produccion);
            $query->bindParam(2, $diasproduccion);
            $query->bindParam(3, $fecharegistro);
            $query->bindParam(4, $detallefase);

            if ($query->execute()) {
                $result = 1;
            } else {
                $result = 0;
            }

            if ($result == 1) {
                if ($diasproduccion == 10) {

                    $sql_produc = "SELECT cantidad, productoid FROM produccion WHERE id = ?";
                    $query_prduc = $c->prepare($sql_produc);
                    $query_prduc->bindParam(1, $produccion);
                    $query_prduc->execute();
                    $dataproduc = $query_prduc->fetch();
                    $cantidadproduc = $dataproduc[0];


                    $sql_pro = "SELECT cantidad FROM producto WHERE id = ?";
                    $query_pro = $c->prepare($sql_pro);
                    $query_pro->bindParam(1,  $dataproduc[1]);
                    $query_pro->execute();
                    $datapro = $query_pro->fetch();
                    $cantidadpro = $datapro[0];

                    $cantidadpro = $cantidadpro + $cantidadproduc;

                    $sql_m = "UPDATE producto SET cantidad = ?, estado = 2 where id = ?";
                    $query_m = $c->prepare($sql_m);
                    $query_m->bindParam(1, $cantidadpro);
                    $query_m->bindParam(2, $dataproduc[1]);

                    if ($query_m->execute()) {

                        $sqlf = "UPDATE produccion SET estado = 2 WHERE id = ?";
                        $queryf = $c->prepare($sqlf);
                        $queryf->bindParam(1, $produccion);
                        if ($queryf->execute()) {
                            $result = 1;
                        } else {
                            $result = 0;
                        }
                    } else {
                        $result = 0;
                    }
                }
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

    function EliminarFaseProduccion($id_fase, $id_produccion)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "DELETE FROM faseproduccion WHERE produccion_id = ? AND fase_id = ?";
            $query = $c->prepare($sql);

            $query->bindParam(1, $id_produccion);
            $query->bindParam(2, $id_fase);

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

    function EditarFaseTipo($id, $nombre)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "UPDATE fase SET fase = ? WHERE id = ?";
            $query = $c->prepare($sql);

            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);

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

    function traerCantidadProduction($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT cantidad FROM produccion WHERE id = ?";
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

    function VerPerdidaProduccion($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            perdida_produccion.produccion_id,
            perdida_produccion.cantidad,
            perdida_produccion.detalle,
            perdida_produccion.fecha,
            usuario.nombres 
            FROM
                perdida_produccion
                INNER JOIN usuario ON perdida_produccion.usuario_id = usuario.id 
            WHERE
                perdida_produccion.produccion_id = ? 
            ORDER BY
            perdida_produccion.fecha DESC";
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

    function EliminarProduccion($id, $productoid, $cantidad)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "DELETE FROM produccion WHERE id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            if ($query->execute()) {

                $sql_p = "SELECT cantidad FROM producto WHERE id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1,  $productoid);
                $query_p->execute();
                $datap = $query_p->fetch();
                $cantidadstok = $datap[0] - $cantidad;

                $sql_m = "UPDATE producto SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $cantidadstok);
                $query_m->bindParam(2, $productoid);
                $query_m->execute();

                if ($query_m->execute()) {

                    $sql_pro = "SELECT cantidad FROM producto WHERE id = ?";
                    $query_pro = $c->prepare($sql_pro);
                    $query_pro->bindParam(1,  $productoid);
                    $query_pro->execute();
                    $datapro = $query_pro->fetch();
                    
                    if ($datapro[0] <= 0){
                        $sql_n = "UPDATE producto SET cantidad = 0 where id = ?";
                        $query_n = $c->prepare($sql_n);
                        $query_n->bindParam(1, $productoid);
                        $query_n->execute();
                    }

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
}
