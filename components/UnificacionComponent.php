<?php

namespace app\components;
use Yii;
use yii\base\Component;
use app\models\Ventas;
use app\models\VentasSearch;
use app\models\Producto;
use app\models\Stock;
use app\models\Vendedor;
use app\models\Folio;

class UnificacionComponent extends Component{


    public function init(){
       // parent::init();
       // $this->content= 'Hello Yii 2.0';
    }
    

    /**
     * Funcion que envia a nueva venta ya sea desde ventas pendientes como desde ventas impagas
     */
    public function unificar($cod_vta,$cod_producto,$cantidad,$vendedor,$caracter,$fecha_venta,$cliente,$forma_pago,$estado_venta_destino,$fecha_carga,$estado_venta_desde,$tipo_envio)
    {


        $producto = Producto::find()->where(['codigo' => $cod_producto])->one();
        $cproducto = $producto['id'];
        $venta = Ventas::find()->where(['idProducto' => $cproducto,'estado' => $estado_venta_destino,'vendedor' =>$vendedor])->one();
        $count = Ventas::find()->where(['estado' => $estado_venta_destino,'vendedor' =>$vendedor,'idProducto' => $cproducto])->count();

        $count_verificar_pestania_vendedor = Ventas::find()->where(['estado' => $estado_venta_destino,'vendedor' =>$vendedor])->count();

        if($count > 0){

                //CODIGO DE ACTUALIZACION DE UN PRODUCTO YA EXISTENTE ASIGNADO A UN VENDEDOR
                $codventa = $venta['id'];
                $cantidad_total = $venta['cantidad'] + $cantidad;

                $importe_unitario = $producto['precio_descuento'];
                $importe = null;
                if($producto['descuento'] != 0){
                    $importe = (int)$importe_unitario * (int)$cantidad_total;
                    $importe = $importe - (($importe* (int)$producto['descuento'])/100);
                }else{
                    $importe = (int)$importe_unitario * (int)$cantidad_total;
                }

                $sql = "update ventas set  cantidad = '$cantidad_total' , importe = '$importe' where id = '$codventa' ";
                $query = Yii::$app->db->createCommand($sql)->execute();

                $id = $producto['id'];   



                /*********** Actualizar venta a la cual se le quito cantidad enviada a neuva venta **************/

                $venta_editada = Ventas::find()->where(['id' => $cod_vta])->one();
                $cv = $venta_editada['cantidad'];

                if($cantidad == $cv || $cantidad > $cv){

                    $sql = "delete from ventas where id = '$cod_vta' ";
                    $query = Yii::$app->db->createCommand($sql)->execute();

                    
                    
                    if($estado_venta_desde == "desde_impagas"){ 

                        if($tipo_envio == "nueva_venta"){
                            //regresar a stock porque es desde impagas
                            $cod4 = $venta_editada['idProducto'];
                            $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                            $cantidad_stock = $stock['cantidad'];
                            $total = $cantidad_stock + $cv;

                            $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                            $query4 = Yii::$app->db->createCommand($sql4)->execute();

                            $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                            $query5 = Yii::$app->db->createCommand($sql5)->execute();
                        }

                    }


                    if($estado_venta_desde == "desde_pendientes"){
                        if($tipo_envio == "impagas"){
                            $cod4 = $venta_editada['idProducto'];
                            $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                            $cantidad_stock = $stock['cantidad'];
                            $total = $cantidad_stock - $cv;

                            $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                            $query4 = Yii::$app->db->createCommand($sql4)->execute();

                            $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                            $query5 = Yii::$app->db->createCommand($sql5)->execute();
                        }
                    }


              
                }else{

                    $diferencia_cantidad = $venta_editada['cantidad'] - $cantidad;

                    $producto = Producto::find()->where(['id' => $venta_editada->idProducto])->one();

                    $id = $producto->id;
                    $importe_unitario = $producto->precio_descuento;

                    $importe1 = null;
                    if($producto->descuento != 0){
                        $importe1 = (int)$importe_unitario * (int)$diferencia_cantidad;
                        $importe1 = $importe1 - (($importe1 * (int)$producto->descuento)/100);
                    }else{
                        $importe1 = (int)$importe_unitario * (int)$diferencia_cantidad;
                    }


                    $importe2 = null;
                    if($producto->descuento != 0){
                        $importe2 = (int)$importe_unitario * (int)$cantidad;
                        $importe2 = $importe2 - (($importe2* (int)$producto->descuento)/100);
                    }else{
                        $importe2 = (int)$importe_unitario * (int)$cantidad;
                    }





                    





                    $sql = "update ventas set cantidad = '$diferencia_cantidad', importe = '$importe1' where id = '$cod_vta' ";
                    $query = Yii::$app->db->createCommand($sql)->execute();

                    if($estado_venta_desde == "desde_impagas"){ 
                        

                        if($tipo_envio == "nueva_venta"){
                            $cod4 = $venta_editada['idProducto'];
                            $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                            $cantidad_stock = $stock['cantidad'];
                            $total = $cantidad_stock + $cantidad;
                            //stock
                            $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                            $query4 = Yii::$app->db->createCommand($sql4)->execute();

                            $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                            $query5 = Yii::$app->db->createCommand($sql5)->execute();
                        }
                    }

                    if($estado_venta_desde == "desde_pendientes"){
                        if($tipo_envio == "impagas"){
                            $cod4 = $venta_editada['idProducto'];
                            $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                            $cantidad_stock = $stock['cantidad'];
                            $total = $cantidad_stock - $cv;

                            $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                            $query4 = Yii::$app->db->createCommand($sql4)->execute();

                            $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                            $query5 = Yii::$app->db->createCommand($sql5)->execute();
                        }
                    }

                }








                /*********** Se agrega a historial tmb ************/

                $movimiento = date('Y-m-d H:i:s');
                $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                    value ('$id','$cantidad','$importe','$vendedor','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago','Enviada a nueva venta','$codventa','$movimiento')";

                Yii::$app->db->createCommand($sql2)->execute();




                
        }else{


            $venta_editada = Ventas::find()->where(['id' => $cod_vta])->one();
            $diferencia_cantidad = $venta_editada['cantidad'] - $cantidad;

            $producto = Producto::find()->where(['id' => $venta_editada->idProducto])->one();

            $id = $producto->id;
            $importe_unitario = $producto->precio_descuento;

            $importe1 = null;
            if($producto->descuento != 0){
                $importe1 = (int)$importe_unitario * (int)$diferencia_cantidad;
                $importe1 = $importe1 - (($importe1 * (int)$producto->descuento)/100);
            }else{
                $importe1 = (int)$importe_unitario * (int)$diferencia_cantidad;
            }


            $importe2 = null;
            if($producto->descuento != 0){
                $importe2 = (int)$importe_unitario * (int)$cantidad;
                $importe2 = $importe2 - (($importe2* (int)$producto->descuento)/100);
            }else{
                $importe2 = (int)$importe_unitario * (int)$cantidad;
            }


            $sql = "update ventas set cantidad = '$diferencia_cantidad', importe = '$importe1' where id = '$cod_vta' ";
            $query = Yii::$app->db->createCommand($sql)->execute();

        









                $id = $producto['id'];
                $importe_unitario = $producto['precio_descuento'];
                $importe = null;
                if($producto['descuento'] != 0){
                    $importe = (int)$importe_unitario * (int)$cantidad;
                    $importe = $importe - (($importe* (int)$producto['descuento'])/100);
                }else{
                    $importe = (int)$importe_unitario * (int)$cantidad;
                }

                
                /* se decuenta stock */
                $stock = Yii::$app->db->createCommand("select * from stock where codigo = $id")->queryOne();





                $movimiento = date('Y-m-d H:i:s');

                $sql = " insert into ventas (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago)
                    value ('$id','$cantidad','$importe','$vendedor','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago')";

                Yii::$app->db->createCommand($sql)->execute();

                $id_max = Ventas::findBySql('select max(id) as id from ventas')->one();
                $cod_max = $id_max['id'];
 

                //se agrega a historial tmb
                $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                    value ('$id','$cantidad','$importe','$vendedor','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago','Venta agregada','$cod_max','$movimiento')";

                Yii::$app->db->createCommand($sql2)->execute();


        }
    }








    





public function quitar_venta($cod_vta,$cantidad,$estado_venta_destino,$tipo_envio){

    $venta_editada = Ventas::find()->where(['id' => $cod_vta])->one();
    $cv = $venta_editada['cantidad'];

    if($cantidad == $cv || $cantidad > $cv){

        $sql = "delete from ventas where id = '$cod_vta' ";
        $query = Yii::$app->db->createCommand($sql)->execute();

        
        
        if($estado_venta_desde == "desde_impagas"){ 

            if($tipo_envio == "nueva_venta"){
                //regresar a stock porque es desde impagas
                $cod4 = $venta_editada['idProducto'];
                $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                $cantidad_stock = $stock['cantidad'];
                $total = $cantidad_stock + $cv;

                $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                $query4 = Yii::$app->db->createCommand($sql4)->execute();

                $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                $query5 = Yii::$app->db->createCommand($sql5)->execute();
            }

        }


        if($estado_venta_desde == "desde_pendientes"){
            if($tipo_envio == "impagas"){
                $cod4 = $venta_editada['idProducto'];
                $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                $cantidad_stock = $stock['cantidad'];
                $total = $cantidad_stock - $cv;

                $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                $query4 = Yii::$app->db->createCommand($sql4)->execute();

                $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                $query5 = Yii::$app->db->createCommand($sql5)->execute();
            }
        }


    
    }else{

        $diferencia_cantidad = $venta_editada['cantidad'] - $cantidad;

        $producto = Producto::find()->where(['id' => $venta_editada->idProducto])->one();

        $id = $producto->id;
        $importe_unitario = $producto->precio_descuento;

        $importe1 = null;
        if($producto->descuento != 0){
            $importe1 = (int)$importe_unitario * (int)$diferencia_cantidad;
            $importe1 = $importe1 - (($importe1 * (int)$producto->descuento)/100);
        }else{
            $importe1 = (int)$importe_unitario * (int)$diferencia_cantidad;
        }


        $importe2 = null;
        if($producto->descuento != 0){
            $importe2 = (int)$importe_unitario * (int)$cantidad;
            $importe2 = $importe2 - (($importe2* (int)$producto->descuento)/100);
        }else{
            $importe2 = (int)$importe_unitario * (int)$cantidad;
        }



        $sql = "update ventas set cantidad = '$diferencia_cantidad', importe = '$importe1' where id = '$cod_vta' ";
        $query = Yii::$app->db->createCommand($sql)->execute();

        if($estado_venta_desde == "desde_impagas"){ 
            

            if($tipo_envio == "nueva_venta"){
                $cod4 = $venta_editada['idProducto'];
                $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                $cantidad_stock = $stock['cantidad'];
                $total = $cantidad_stock + $cantidad;
                //stock
                $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                $query4 = Yii::$app->db->createCommand($sql4)->execute();

                $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                $query5 = Yii::$app->db->createCommand($sql5)->execute();
            }
        }

        if($estado_venta_desde == "desde_pendientes"){
            if($tipo_envio == "impagas"){
                $cod4 = $venta_editada['idProducto'];
                $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                $cantidad_stock = $stock['cantidad'];
                $total = $cantidad_stock - $cv;

                $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                $query4 = Yii::$app->db->createCommand($sql4)->execute();

                $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                $query5 = Yii::$app->db->createCommand($sql5)->execute();
            }
        }

    }
}





























    /**
     *  Funcion que envia desde ventas impagas a nueva venta
     */
    public function unificar_impagas($cod_vta,$cod_producto,$cantidad,$vendedor,$caracter,$fecha_venta,$cliente,$forma_pago,$estado,$fecha_carga)
    {


        $producto = Producto::find()->where(['codigo' => $cod_producto])->one();
        $cproducto = $producto['id'];
        $venta = Ventas::find()->where(['idProducto' => $cproducto,'estado' => 0,'vendedor' =>$vendedor])->one();
        $count = Ventas::find()->where(['estado' => 0,'vendedor' =>$vendedor,'idProducto' => $cproducto])->count();

        $count_verificar_pestania_vendedor = Ventas::find()->where(['estado' => 0,'vendedor' =>$vendedor])->count();

        if($count > 0){

                //CODIGO DE ACTUALIZACION DE UN PRODUCTO YA EXISTENTE ASIGNADO A UN VENDEDOR
                $codventa = $venta['id'];
                $cantidad_total = $venta['cantidad'] + $cantidad;

                $importe_unitario = $producto['precio_descuento'];
                $importe = null;
                if($producto['descuento'] != 0){
                    $importe = (int)$importe_unitario * (int)$cantidad_total;
                    $importe = $importe - (($importe* (int)$producto['descuento'])/100);
                }else{
                    $importe = (int)$importe_unitario * (int)$cantidad_total;
                }

                $sql = "update ventas set  cantidad = '$cantidad_total' , importe = '$importe' where id = '$codventa' ";
                $query = Yii::$app->db->createCommand($sql)->execute();

                $id = $producto['id'];   



                /*********** Actualizar venta a la cual se le quito cantidad enviada a neuva venta **************/

                $venta_editada = Ventas::find()->where(['id' => $cod_vta])->one();
                $cv = $venta_editada['cantidad'];

                if($cantidad == $cv || $cantidad > $cv){

                    $sql = "delete from ventas where id = '$cod_vta' ";
                    $query = Yii::$app->db->createCommand($sql)->execute();

                    if($estado == "impagas"){ 

                        //regresar a stock
                        $cod4 = $venta_editada['idProducto'];
                        $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                        $cantidad_stock = $stock['cantidad'];
                        $total = $cantidad_stock - $cv;

                        $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                        $query4 = Yii::$app->db->createCommand($sql4)->execute();

                        $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                        $query5 = Yii::$app->db->createCommand($sql5)->execute();

                    }
                }else{

                    $diferencia_cantidad = $venta_editada['cantidad'] - $cantidad;

                    $producto = Producto::find()->where(['id' => $venta_editada->idProducto])->one();

                    $id = $producto->id;
                    $importe_unitario = $producto->precio_descuento;

                    $importe1 = null;
                    if($producto->descuento != 0){
                        $importe1 = (int)$importe_unitario * (int)$diferencia_cantidad;
                        $importe1 = $importe1 - (($importe1 * (int)$producto->descuento)/100);
                    }else{
                        $importe1 = (int)$importe_unitario * (int)$diferencia_cantidad;
                    }


                    $importe2 = null;
                    if($producto->descuento != 0){
                        $importe2 = (int)$importe_unitario * (int)$cantidad;
                        $importe2 = $importe2 - (($importe2* (int)$producto->descuento)/100);
                    }else{
                        $importe2 = (int)$importe_unitario * (int)$cantidad;
                    }


                    $cod4 = $venta_editada['idProducto'];
                    $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                    $cantidad_stock = $stock['cantidad'];
                    $total = $cantidad_stock - $cantidad;


                    $sql = "update ventas set cantidad = '$diferencia_cantidad', importe = '$importe1' where id = '$cod_vta' ";
                    $query = Yii::$app->db->createCommand($sql)->execute();

                    if($estado == "impagas"){ 
                        //stock
                        $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                        $query4 = Yii::$app->db->createCommand($sql4)->execute();

                        $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                        $query5 = Yii::$app->db->createCommand($sql5)->execute();
                    }

                }








                /*********** Se agrega a historial tmb ************/

                $movimiento = date('Y-m-d H:i:s');
                $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                    value ('$id','$cantidad','$importe','$vendedor','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago','Enviada a nueva venta','$codventa','$movimiento')";

                Yii::$app->db->createCommand($sql2)->execute();




                
        }else{



                $id = $producto['id'];
                $importe_unitario = $producto['precio_descuento'];
                $importe = null;
                if($producto['descuento'] != 0){
                    $importe = (int)$importe_unitario * (int)$cantidad;
                    $importe = $importe - (($importe* (int)$producto['descuento'])/100);
                }else{
                    $importe = (int)$importe_unitario * (int)$cantidad;
                }

                
                /* se decuenta stock */
                $stock = Yii::$app->db->createCommand("select * from stock where codigo = $id")->queryOne();

                $movimiento = date('Y-m-d H:i:s');


                $sql = " insert into ventas (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago)
                    value ('$id','$cantidad','$importe','$vendedor','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago')";

                Yii::$app->db->createCommand($sql)->execute();

                $id_max = Ventas::findBySql('select max(id) as id from ventas')->one();
                $cod_max = $id_max['id'];
 

                //se agrega a historial tmb
                $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                    value ('$id','$cantidad','$importe','$vendedor','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago','Venta agregada','$cod_max','$movimiento')";

                Yii::$app->db->createCommand($sql2)->execute();


        }
    }














    
}
?>