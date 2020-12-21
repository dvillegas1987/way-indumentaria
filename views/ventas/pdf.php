
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


$total_cant = 0;$total_importe = 0;$total_precio_unitario = 0;
?>

<div style="padding-bottom: 5px;padding-top: 11px;font-size:13px;">
<title><b>PLANILLA DE CARGA POR MINORISTA</b></title>
</div>
<div style="padding-bottom: 11px;padding-top: 5px;font-size:11px;">
<p>El día de la fecha <?= date('d'); ?> de <?= date('M'); ?> de <?= date('Y'); ?>,  el/la minorista  .................................................  se responsabiliza por la serie de productos descriptos a continuación:</p>
</div>
    
    <table   class='table table-bordered' role="grid"  style="padding-bottom:110px;">

            <tr  role="row" class="even">
            	<td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; "><b>F.Carga</b></td>
                <td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; "><b>F.Venta</b></td>
            	<td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; "><b>Cod.</b></td>
            	<td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; "><b>Producto</b></td>
            	<td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; width:5%;"><b>Cant.</b></td>
            	<td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; width:7%;"><b>P. vta($)</b></td>
            	<td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; width:7%;"><b>N° de C.</b></td>
            	<td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; "><b>Desc.</td>
            	<td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; "><b>V</b></td>
            	<td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; "><b>D</b></td>
            	<td style="text-align: center;background:#BDBDBD;border-color:#000000;font-size:10px;padding-top:2px;padding-bottom:2px; "><b>C</b></td>
            </tr>
        

        <tbody style="border-color-bottom:#ffffff;">
        	<?php foreach ($dataProvider->models as $model): ?> 
            <tr role="row" class="even">
       
              	
              	<?php
					$producto = Producto::find()->where(['id' => $model->idProducto])->one();
					$vendedor = Vendedor::find()->where(['id' => $model->vendedor])->one();
              	?>


                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "><?php echo $model['fecha_carga']; ?></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "><?php echo $model['fecha_venta']; ?></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "><?php echo $producto->codigo; ?></td>
                	<td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "><?php echo $producto->descripcion; ?></td>
                	<td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "><?php echo $model->cantidad; ?></td>
                	<td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "><?php echo $producto->precio_unitario; ?></td>
                	<td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "><?php echo $model->importe; ?></td>
                	<td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "><?php echo $producto->descuento; ?> Off</td>
                	<td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; background: #D11D11D11;"><?php  ?></td>
                	<td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; background: #D11D11D11;"><?php  ?></td>
                	<td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; background: #D11D11D11;"><?php  ?></td>
               
            </tr>
            <?php
                $total_cant += $model->cantidad; 
                $total_precio_unitario += $producto->precio_unitario; 
                $total_importe += $model->importe;

             ?>
       		<?php endforeach; ?>
            <tr role="row" class="even">
               <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; ">

                    <?php  echo $total_cant; ?>
                        
                    </td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "><?php echo $total_precio_unitario; ?></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "><?php echo $total_importe; ?></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; "></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; background: #FFF;"><?php  ?></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; background: #FFF;"><?php  ?></td>
                    <td style="border-color:#000000;font-size:11px;padding-top:2px;padding-bottom:2px; background: #FFF;"><?php  ?></td>
            </tr>
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
<div style="padding-top: 110px;">
     <table class='table table-bordered' role='grid' style="padding-top:110px;">

            <tr >
                 <td style="padding-top:11px;width:30%;text-align: center;font-size: 5px;border-width:1px;border-bottom-color:#ffffff;border-top-color:#ffffff;border-left-color:#ffffff;border-right-color:#ffffff;"> </td>
                <th align="center" style="padding-top:11px;border-right-color:#ffffff;width:35%;text-align: center;font-size: 11px;border-width:1px;border-bottom-color:#ffffff;border-top-color:#000000;">
                 FIRMA MINORISTA
                </th>
                <td style="padding-top:11px;width:30%;text-align: center;font-size: 11px;border-width:1px;border-bottom-color:#ffffff;border-top-color:#ffffff;border-left-color:#ffffff;border-right-color:#ffffff;"> </td>
            </tr>
    </table>         
</div>


