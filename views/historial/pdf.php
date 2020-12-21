
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Categoria;
use app\models\Producto;
use app\models\Vendedor;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Créditos aprobados';
$this->params['breadcrumbs'][] = $this->title;




?>

<div style="padding-bottom: 20px;padding-top: 20px;">
<title><b>PLANILLA DE CARGA POR MINORISTA</b></title>
</div>
<div style="padding-bottom: 20px;padding-top: 20px;">
<p>El día de la fecha <?= date('d'); ?> de <?= date('M'); ?> de <?= date('Y'); ?>,  el/la minorista  .................................................  se responsabiliza por la serie de productos descriptos a continuación:</p>
</div>
    
    <table   class='table table-bordered' role="grid"  style="padding-bottom:100px;">
        
        <thead>
            <tr  role="row">
            	<td style="background:#BDBDBD;border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><b>Fecha carga</b></td>
            	<td style="background:#BDBDBD;border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><b>Código</b></td>
            	<td style="background:#BDBDBD;border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><b>Producto</b></td>
            	<td style="background:#BDBDBD;border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><b>Cant.</b></td>
            	<td style="background:#BDBDBD;border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><b>P. de venta ($)</b></td>
            	<td style="background:#BDBDBD;border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><b>Número de C.</b></td>
            	<td style="background:#BDBDBD;border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><b>Descuento</td>
            	<td style="background:#BDBDBD;border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><b>D</b></td>
            	<td style="background:#BDBDBD;border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><b>C</b></td>
            	<td style="background:#BDBDBD;border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><b>V</b></td>
            </tr>
        </thead>

        <tbody style="border-color-bottom:#ffffff;">
        	<?php foreach ($dataProvider->models as $model): ?> 
            <tr role="row" class="even">
       
              	
              	<?php
					$producto = Producto::find()->where(['id' => $model->idProducto])->one();
					$vendedor = Vendedor::find()->where(['id' => $model->vendedor])->one();
              	?>


                    <td style="border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><?php echo $model['fecha_carga']; ?></td>
                    <td style="border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><?php echo $producto->codigo; ?></td>
                	<td style="border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><?php echo $producto->descripcion; ?></td>
                	<td style="border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><?php echo $model->cantidad; ?></td>
                	<td style="border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><?php echo $producto->precio_unitario; ?></td>
                	<td style="border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><?php echo $model->importe; ?></td>
                	<td style="border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; "><?php echo $producto->descuento; ?> Off</td>
                	<td style="border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; background: #D8D8D8;"><?php  ?></td>
                	<td style="border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; background: #D8D8D8;"><?php  ?></td>
                	<td style="border-color:#000000;font-size:12px;padding-top:2px;padding-bottom:2px; background: #D8D8D8;"><?php  ?></td>
               
            </tr>
       		<?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr></tr>
            <tr>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
            </tr>
        </tfoot>
    </table> 
<div style="padding-top: 70px;">
     <table class='table table-bordered' role='grid' style="padding-top:100px;">

            <tr >
                 <td style="padding-top:10px;width:30%;text-align: justify;font-size: 5px;border-width:1px;border-bottom-color:#ffffff;border-top-color:#ffffff;border-left-color:#ffffff;border-right-color:#ffffff;"> </td>
                <th align="center" style="padding-top:10px;border-right-color:#ffffff;width:35%;text-align: justify;font-size: 10px;border-width:1px;border-bottom-color:#ffffff;border-top-color:#000000;">
                 FIRMA MINORISTA
                </th>
                <td style="padding-top:10px;width:30%;text-align: justify;font-size: 12px;border-width:1px;border-bottom-color:#ffffff;border-top-color:#ffffff;border-left-color:#ffffff;border-right-color:#ffffff;"> </td>
            </tr>
    </table>         
</div>


