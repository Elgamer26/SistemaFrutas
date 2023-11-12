<div class="ckeckout" style="padding: 30px;">

    <div class="container">
        <div class="ckeck-top heading">
            <h2>ESTADO DE PEDIDOS</h2>
        </div>

        <div class="row">
            <div>
                <table style="width:100%; text-align: center;" border=1>
                    <thead style="background: black; color: white; text-align: center !important; height: 20px;">
                        <tr style="height:32px !important; text-align: center !important;">
                            <th width="50">N. compra</th>
                            <th width="50">Código de servicio</th>
                            <th width="50">Fecha</th>
                            <th width="50">Estado del servicio</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($detallecompra) && is_array($detallecompra)) {
                            foreach ($detallecompra as $detallecompra_item) { ?>

                                <tr style="height:28px !important;">

                                    <td width="50"><?= esc($detallecompra_item["n_venta"]); ?> </td>
                                    <td width="50"><?= esc($detallecompra_item["codigo"]); ?></td>
                                    <td width="50"><?= esc($detallecompra_item["fecha"]); ?></td>

                                    <?php if ($detallecompra_item["estado"] == 0) { ?>

                                        <td width="50"> <a style="cursor: alias;" class="btn btn-warning"> En proceso </a> </td>   

                                    <?php } else { ?>

                                        <td width="50"> <a style="cursor: alias;" class="btn btn-success"> Entregado </a> </td>   

                                    <?php } ?>

                                </tr>

                        <?php }
                        } ?>

                    </tbody>
                </table>

            </div>
        </div>


    </div>
</div>