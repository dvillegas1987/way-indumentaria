<?php 
use app\models\Vendedor;
use app\models\Cliente;
use app\models\Producto;

 $producto = Producto::find()->where(['id' => $model->idProducto])->one();
 $cliente = Cliente::find()->where(['id' => $model->cliente])->one();
 $vendedor = Vendedor::find()->where(['id' => $model->vendedor])->one();


?>
<div class="historial-view">
 <div style="padding-bottom: 0px;padding-top: 20px;">
<title><b>DATOS DE VENTA N° <?= $model->id;?></b></title>
</div>
<div style="padding-bottom: 20px;padding-top: 20px;">
<p>Datos de la venta correspondiente al vendedor <b><?= $vendedor->nombre.', '.$vendedor->apellido; ?></b> :</p></div>
    <table id="w0" class="table table-striped table-bordered detail-view">
    	<tbody>
	    	<tr><th style="width:170px;">ID</th><td><?= $model->id; ?></td></tr>
			<tr><th style="width:170px;">Producto</th><td><?= $producto->descripcion; ?></td></tr>
			<tr><th style="width:170px;">Cantidad</th><td><?= $model->cantidad; ?></td></tr>
			<tr><th style="width:170px;">Importe</th><td><?= $model->importe; ?></td></tr>
			<tr><th style="width:170px;">Vendedor</th><td><?= $vendedor->nombre.', '.$vendedor->apellido; ?></td></tr>
			<tr><th style="width:170px;">Cliente</th><td><?= $cliente->nombre.', '.$cliente->apellido; ?></td></tr>
			<?php 
				$fv = date_create($model->fecha_venta);
                $fv =  date_format($fv, 'd-m-Y');
                $model->fecha_venta = $fv;
			?>
			<tr><th style="width:170px;">Fecha Venta</th><td><?= $model->fecha_venta; ?></td></tr>
			<tr><th style="width:170px;">Importe Unitario</th><td><?= $model->importe_unitario; ?></td></tr>
			<!--<tr><th style="width:170px;">Estado</th><td><?= $model->cantidad; ?></td></tr>-->
			
			<?php 
				$fc = date_create($model->fecha_carga);
                $fc =  date_format($fc, 'd-m-Y');
                $model->fecha_carga = $fc;
			?>
			<tr><th style="width:170px;">Fecha Carga</th><td><?= $model->fecha_carga; ?></td></tr>

			<?php 
				$tv = null;
				if ($model->tipo_venta == 0) {
					$tv = 'Vendedor';
				}else{
					$tv = 'Particular';
				}
			?>
			<tr><th style="width:170px;">Tipo Venta</th><td><?= $tv; ?></td></tr>

			<?php 
				$ca = null;
				if ($model->caracter == 0) {
					$ca = 'Convencional';
				}else{
					$ca = 'Regalo';
				}
			?>
			<tr><th style="width:170px;">Caracter de la venta</th><td><?= $ca ?></td></tr>
			<!--<tr><th style="width:170px;">Carga Venta</th><td><?= $model->cantidad; ?></td></tr>-->

			<?php 
				$fp = null;
				if ($model->forma_pago == 0) {
					$fp = 'Efectivo';
				}else{
					$fp = 'Tarjeta';
				}
			?>
			<tr><th style="width:170px;">Forma Pago</th><td><?= $fp; ?></td></tr>
			<tr><th style="width:170px;">Movimientos</th><td><?= $model->detalle; ?></td></tr>
		</tbody>
	</table>

</div>