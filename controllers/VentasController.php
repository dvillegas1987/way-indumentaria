<?php

namespace app\controllers;

use Yii;
use app\models\Ventas;
use app\models\VentasSearch;
use app\models\Producto;
use app\models\Stock;
use app\models\Vendedor;
use app\models\Folio;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use kartik\mpdf\Pdf;
/**
 * VentasController implements the CRUD actions for Ventas model.
 */
class VentasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                    'bulkcargar' => ['post'],
                    'bulkcargar2' => ['post'],
                    'bulkenviaracarga' => ['post'],
                    'probar' => ['post'],
                    'devolver' => ['post'],
                    'bulkenviarapendientes' => ['post'],
                    'bulkdeletependientes' => ['post'],
                    'bulkdividir' => ['post'],
                    'actualizarfecha' => ['post'],
                    'finalizar2' => ['post'],
         
                ],
            ],
        ];
    }


    public function actionBulkdividir($id){


        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys

        foreach ( $pks as $pk ) {
            

            $venta = Ventas::find()->where(['id' => $pk])->one();
            $long = $venta->cantidad;
            $importe = floatval($venta->importe) / floatval($venta->cantidad);
            for ($i=0; $i < $long; $i++) { 
                
                $model =  new Ventas();

                $model->idProducto = $venta->idProducto;
                $model->cantidad = 1;
                $model->importe = $importe;
                $model->vendedor = $venta->vendedor;
                $model->cliente = $venta->cliente;
                $model->fecha_venta = $venta->fecha_venta;
                $model->importe_unitario = $venta->importe_unitario;
                $model->estado = $venta->estado;
                $model->fecha_carga = $venta->fecha_carga;
                $model->tipo_venta = $venta->tipo_venta;
                $model->caracter = $venta->caracter;
                $model->carga_venta = $venta->carga_venta;
                $model->forma_pago = $venta->forma_pago;
                $model->folio = $venta->folio;

                $model->save(false);

            }

            $sql = "delete from ventas where id = '$pk' ";
            $query = Yii::$app->db->createCommand($sql)->execute();


        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>$id];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index2']);
        }

    }



    public function actionActualizarfecha()
    {
       
        $pks = explode(',', Yii::$app->request->post( 'keylist2' ));  // Array or selected records primary keys
        $recargo = Yii::$app->request->post( 'recargo' );
        $nuevafecha = Yii::$app->request->post( 'nuevafecha' );
         
            foreach ( $pks as $pk ) {
                

                        $venta = Ventas::find()->where(['id' => $pk])->one();
                        $venta->fecha_antigua = $venta->fecha_venta;


                        $f = date_create($nuevafecha);
                        $f =  date_format($f, 'Y-m-d');
                        $venta->fecha_venta = $f;


                        $importe =  (($recargo * floatval($venta->importe) )/100) + floatval($venta->importe);

                        $venta->importe = $importe;

                        $venta->save(false);

               

            }
        
          
        
    }



















    /**
     * Lists all Ventas models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new VentasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Ventas();  


        /*$arr[] = null;

        $vendedor = Vendedor::find()->all();

        foreach ($vendedor as $ven) {
            $searchModel2 = new VentasSearch();
            $searchModel2->vendedor = $ven['id'];
            $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
           array_push($arr,$dataProvider2);
        }*/


       if(!isset($_SESSION)){
            session_start();
        }

        $_SESSION["parametros"] = Yii::$app->request->queryParams;
        $_SESSION["dataProvider"] = $dataProvider;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            //'arr' => $arr
        ]);
    }

    /**
     * Lists all Ventas models.
     * @return mixed
     */
    public function actionIndex1()
    {    
        $searchModel = new VentasSearch();
       //$searchModel->estado = 3;
        $dataProvider = $searchModel->search1(Yii::$app->request->queryParams);

         

        return $this->render('index1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }


    /**
     * Lists all Ventas models.
     * @return mixed
     */
    public function actionIndex2()
    {    
        $searchModel = new VentasSearch();

        $dataProvider = $searchModel->search2(Yii::$app->request->queryParams);

         

        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Lists all Ventas models.
     * @return mixed
     */
    public function actionIndex3()
    {    
        $searchModel = new VentasSearch();
        $dataProvider = $searchModel->search3(Yii::$app->request->queryParams);

         

        return $this->render('index3', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }


    /**
     * Displays a single Ventas model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Ventas #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Ventas();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear nueva venta",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Agregar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) ){
                


                $model->fecha_carga = date('Y-m-d');
                
                $date = date_create($model->fecha_venta);
                $fechaventa =  date_format($date, 'Y-m-d');
                $model->fecha_venta = $fechaventa;


                $id = $model->idProducto;
                $producto = Producto::find()->where(['id' => $id])->one();



               /* $importe_unitario = number_format($model->importe_unitario,2,'.',',');
                $cantidad = $model->cantidad;
                $desc = number_format($producto->descuento,2,'.',',');

                if($model->forma_pago == 1 && $producto->descuento !== 0){

                    $importe = floatval($importe_unitario) * $cantidad;
                    $descuento = ( floatval($desc) * floatval($importe) ) / 100;
                    $model->importe = floatval($importe) - floatval($descuento);

                }else{
                    $importe = floatval($importe_unitario) * floatval($cantidad);
                    $model->importe = $importe;
                }*/
                




                $model->save();

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Crear nueva venta",
                    'content'=>'<span class="text-success">Create Ventas success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Crear otra',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Crear nueva venta",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Agregar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Ventas #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Ventas #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Ventas #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
         $vendedor = null;
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);

             $venta = Ventas::find()->where(['id' => $pk])->one();
            //se agrega a historial tmb
            $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
            $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
            $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
            $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

            $movimiento = date('Y-m-d H:i:s');

            $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',0,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Venta eliminada','$folio','$movimiento')";
            Yii::$app->db->createCommand($sql2)->execute();


            $model->delete();

            $vendedor = $venta->vendedor;
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable'. $vendedor.'-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

     /**
     * Delete multiple existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkdeletependientes()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
         $vendedor = null;
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);

             $venta = Ventas::find()->where(['id' => $pk])->one();
            //se agrega a historial tmb
            $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
            $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
            $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
            $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

            $movimiento = date('Y-m-d H:i:s');

            $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',0,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Venta eliminada','$folio','$movimiento')";
            Yii::$app->db->createCommand($sql2)->execute();


            $model->delete();

            $vendedor = $venta->vendedor;
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable5-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }




    /**
     * Delete multiple existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkcargar($id)
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            
            $venta = Ventas::find()->where(['id' => $pk])->one();
    
            $cp = $venta['idProducto'];
            $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cp")->queryOne();
        
            $cantidad = $venta['cantidad'];


            if($stock['cantidad'] != 0){ 
                if($cantidad >= $stock['cantidad'] ){

                    $total = 0;

                    $sql4 = "update stock set cantidad = '$total' where codigo = '$cp' ";
                    $query4 = Yii::$app->db->createCommand($sql4)->execute();


                    $cv = $stock['cantidad'];

                    


                    $codigo = $venta['idProducto'];
                    $producto = Producto::find()->where(['id' => $codigo])->one();
                    //recalcular importe
                    $importe_unitario = $producto->precio_descuento;
                    $importe = null;
                    if($producto->descuento != 0){
                        $importe = (int)$importe_unitario * (int)$stock['cantidad'];
                        $importe = $importe - (($importe* (int)$producto->descuento)/100);
                    }else{
                        $importe = (int)$importe_unitario * (int)$stock['cantidad'];
                    }


                    $sql = "update ventas set estado = 0, cantidad = '$cv',importe='$importe' where id = '$pk' ";
                    $query = Yii::$app->db->createCommand($sql)->execute();


                    //se agrega a historial tmb
                    $cantidad = $cv;$importe = $importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                    $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                    $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                    $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;

                    $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle)
                        value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',0,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Enviada a impagas')";
                    Yii::$app->db->createCommand($sql2)->execute();






                                
                }else{
                    if($cantidad <= $stock['cantidad'] ){
                        $cantidad_stock = $stock['cantidad'];
                        $total = $cantidad_stock - $cantidad;

                        $sql4 = "update stock set cantidad = '$total' where codigo = '$cp' ";
                        $query4 = Yii::$app->db->createCommand($sql4)->execute();

                        $sql = "update ventas set estado = 0 where id = '$pk' ";
                        $query = Yii::$app->db->createCommand($sql)->execute();



                    //hisotrial
                    $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                    $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                    $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                    $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;

                    $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle)
                        value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',0,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Enviada a impagas')";
                    Yii::$app->db->createCommand($sql2)->execute();




                    }
                }   
            } 


        }

        $iddatatable = '#crud-datatable'.$id.'-pjax';

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=> '#crud-datatable'.$id.'-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }


    /**
     * Delete multiple existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkfinalizar()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            
            $sql = "update ventas set estado = 1 where id = '$pk' ";
            $query = Yii::$app->db->createCommand($sql)->execute();


            $venta = Ventas::find()->where(['id' => $pk])->one();
            //se agrega a historial tmb
            $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
            $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
            $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
            $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago; $folio = $venta->id;

            $movimiento = date('Y-m-d H:i:s');

            $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',1,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Venta pagada','$folio','$movimiento')";
            Yii::$app->db->createCommand($sql2)->execute();
        }

        /*if($request->isAjax){
           
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{*/
           
            return $this->redirect(['index']);
        //}
       
    }

    /**
     * Delete multiple existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkenviaracarga($cant)
    {        


        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        
        foreach ( $pks as $pk ) {
            

            $sql = "update ventas set estado = '$cant' where id = '$pk' ";
            $query = Yii::$app->db->createCommand($sql)->execute();


            $venta = Ventas::find()->where(['id' => $pk])->one();
            //se agrega a historial tmb
            $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
            $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
            $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
            $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

            $movimiento = date('Y-m-d H:i:s');

            $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario','$cant','$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Enviada a carga','$folio','$movimiento')";
            Yii::$app->db->createCommand($sql2)->execute();


        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }


    /**
     * Delete multiple existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionAgregar($codigo,$cantidad,$vendedor,$caracter,$fecha_venta,$cliente,$forma_pago)
    {        
        
        $fecha_carga = date('Y-m-d');

        $v = (int)$vendedor;

        $producto = Producto::find()->where(['codigo' => $codigo])->one();
        $cproducto = $producto['id'];
        $venta = Ventas::find()->where(['idProducto' => $cproducto,'estado' => 2,'vendedor' =>$v])->one();
        $count = Ventas::find()->where(['estado' => 2,'vendedor' =>$v,'idProducto' => $cproducto])->count();

        $count_verificar_pestania_vendedor = Ventas::find()->where(['estado' => 2,'vendedor' =>$v])->count();

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

                //se agrega a historial tmb
                $movimiento = date('Y-m-d H:i:s');
                $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                    value ('$id','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago','Venta agregada','$codventa','$movimiento')";

                Yii::$app->db->createCommand($sql2)->execute();






                
                $stock = Yii::$app->db->createCommand("select * from stock where codigo = $id")->queryOne();
            
                if($cantidad >= $stock['cantidad'] ){


                    $total = 0;

                    $sql4 = "update stock set cantidad = '$total' where codigo = '$id' ";
                    $query4 = Yii::$app->db->createCommand($sql4)->execute();

                                
                }else{
                    if($cantidad <= $stock['cantidad'] ){
                        $cantidad_stock = $stock['cantidad'];
                        $total = $cantidad_stock - $cantidad;

                        $sql4 = "update stock set cantidad = '$total' where codigo = '$id' ";
                        $query4 = Yii::$app->db->createCommand($sql4)->execute();
                    }
                }   

                
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
             

                if($cantidad >= $stock['cantidad'] ){


                    $total = 0;

                    $sql4 = "update stock set cantidad = '$total' where codigo = '$id' ";
                    $query4 = Yii::$app->db->createCommand($sql4)->execute();

                                
                }else{
                    if($cantidad <= $stock['cantidad'] ){
                        $cantidad_stock = $stock['cantidad'];
                        $total = $cantidad_stock - $cantidad;

                        $sql4 = "update stock set cantidad = '$total' where codigo = '$id' ";
                        $query4 = Yii::$app->db->createCommand($sql4)->execute();
                    }
                }   


                $movimiento = date('Y-m-d H:i:s');


                $sql = " insert into ventas (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago)
                    value ('$id','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago')";

                Yii::$app->db->createCommand($sql)->execute();

                $id_max = Ventas::findBySql('select max(id) as id from ventas')->one();
                $cod_max = $id_max['id'];
 

                //se agrega a historial tmb
                $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                    value ('$id','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago','Venta agregada','$cod_max','$movimiento')";

                Yii::$app->db->createCommand($sql2)->execute();



                //return '#tabid';



     }



        if($count_verificar_pestania_vendedor > 0){
            return '#crud-datatable'.$v.'-pjax';
        }else{
            return '#tabid';
        }


      

    }





    public function actionEnviar_anuevaventa()
    {

        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'keylist' )); // Array or selected records primary keys

        /* PARAMETROS RECIBIDOS POR AJAX */
        $cant = Yii::$app->request->post( 'cant' ); 
        $index = Yii::$app->request->post( 'index' );
        $estado_venta_desde = Yii::$app->request->post( 'estado_venta_desde' );
        $estado_venta_destino = Yii::$app->request->post( 'estado_venta_destino' );
        $tipo_envio = Yii::$app->request->post( 'tipo_envio' );

        foreach ( $pks as $pk ) {
                
            $venta = Ventas::find()->where(['id' => $pk])->one();

            $cv = $venta['cantidad'];

            /* ***************** PARAMETROS PARA EVENTO UNICAR VENTAS ******************/

            $vendedor = $venta['vendedor'];
            
            $producto = Producto::find()->where(['id' => $venta->idProducto])->one();
            $cod_producto = $producto['codigo'];

            $caracter = $venta['caracter'];$fecha_venta = $venta['fecha_venta'];$cliente = $venta['cliente'];
            $forma_pago = $venta['forma_pago'];$fecha_carga = $venta['fecha_carga'];

            $cod_vta = $venta['id'];

            /*************************************************************************/ 

            Yii::$app->unificacion->unificar($pk,$cod_producto,$cant,$vendedor,$caracter,$fecha_venta,$cliente,$forma_pago,$estado_venta_destino,$fecha_carga,$estado_venta_desde,$tipo_envio);
        }

        return $this->redirect([$index]);

    }






    public function actionQuitar_venta()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'keylist' )); 

        /* PARAMETROS RECIBIDOS POR AJAX */
        $cant = Yii::$app->request->post( 'cant' ); 
        $index = Yii::$app->request->post( 'index' );
        $estado_venta_desde = Yii::$app->request->post( 'estado_venta_desde' );
        $tipo_envio = Yii::$app->request->post( 'tipo_envio' );

        foreach ( $pks as $pk ) {
            Yii::$app->unificacion->quitar_venta($pk,$cant,$estado_venta_desde,$tipo_envio);
        }

        return $this->redirect([$index]);
    }











    public function actionProbar()
    {
       // Array or selected records primary keys
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'keylist' )); // Array or selected records primary keys
        $cant = Yii::$app->request->post( 'cant' ); $index = Yii::$app->request->post( 'index' );$estado = Yii::$app->request->post( 'estado' );
            
            foreach ( $pks as $pk ) {
                
                $venta = Ventas::find()->where(['id' => $pk])->one();

                $cv = $venta['cantidad'];

      

                if($cant == $cv || $cant > $cv){
                    $sql = "update ventas set estado = 2  where id = '$pk' ";
                    $query = Yii::$app->db->createCommand($sql)->execute();

                    //regresar a stock
                        $cod4 = $venta['idProducto'];
                        $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                        $cantidad_stock = $stock['cantidad'];
                        $total = $cantidad_stock + $cv;

                        if($estado == "impagas"){ 

                            $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                            $query4 = Yii::$app->db->createCommand($sql4)->execute();

                            $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                            $query5 = Yii::$app->db->createCommand($sql5)->execute();

                        }
                }else{

                        

                        $cantidad = $cv - $cant;

                        


                        $producto = Producto::find()->where(['id' => $venta->idProducto])->one();

                        $id = $producto->id;
                        $importe_unitario = $producto->precio_descuento;

                        $importe1 = null;
                        if($producto->descuento != 0){
                            $importe1 = (int)$importe_unitario * (int)$cantidad;
                            $importe1 = $importe1 - (($importe1 * (int)$producto->descuento)/100);
                        }else{
                            $importe1 = (int)$importe_unitario * (int)$cantidad;
                        }


                        $importe2 = null;
                        if($producto->descuento != 0){
                            $importe2 = (int)$importe_unitario * (int)$cant;
                            $importe2 = $importe2 - (($importe2* (int)$producto->descuento)/100);
                        }else{
                            $importe2 = (int)$importe_unitario * (int)$cant;
                        }


                        //$venta = Ventas::find()->where(['id' => $pk])->one();


                        $cod4 = $venta['idProducto'];
                        $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod4")->queryOne();

                        $cantidad_stock = $stock['cantidad'];
                        $total = $cantidad_stock + $cant;


                        $sql = "update ventas set cantidad = '$cantidad', importe = '$importe1' where id = '$pk' ";
                        $query = Yii::$app->db->createCommand($sql)->execute();

                        if($estado == "impagas"){ 
                            //stock
                            $sql4 = "update stock set cantidad = '$total' where codigo = '$cod4' ";
                            $query4 = Yii::$app->db->createCommand($sql4)->execute();

                            $sql5 = "update producto set stock = '$total' where id= '$cod4' ";
                            $query5 = Yii::$app->db->createCommand($sql5)->execute();
                        }
                    
                        $producto = $venta->idProducto;
                        $importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                        $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                        $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                        $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;

$sql_insertar = " insert into ventas (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago)
            value ('$producto','$cant','$importe2','$v','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago')";

        Yii::$app->db->createCommand($sql_insertar)->execute();


                        
                        
                        
                    }



                     $venta = Ventas::find()->where(['id' => $pk])->one();
                    //se agrega a historial tmb
                    $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                    $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                    $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                    $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

                    $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio)
                        value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario','$cant','$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Enviada a nueva venta',$folio)";
                    Yii::$app->db->createCommand($sql2)->execute();



                }
                

               



               


        /*if($request->isAjax){

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=> '#crud-datatable5-pjax'];
        }else{
   
            return $this->redirect(['index1']);
        }*/
                

         return $this->redirect([$index]);
            

    }





    public function actionEnviar_aimpagas()
    {


        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'keylist2' )); // Array or selected records primary keys
        $cantidad = Yii::$app->request->post( 'cant2' );
        foreach ( $pks as $pk ) {
            
            $venta = Ventas::find()->where(['id' => $pk])->one();
    



            $cp = $venta['idProducto'];
            $stock = Yii::$app->db->createCommand("select * from stock where codigo = '$cp' ")->queryOne();


            if($stock['cantidad'] != 0){ 
                if($cantidad >= $stock['cantidad'] ){
                    $total = 0;

                    $sql4 = "update stock set cantidad = '$total' where codigo = '$cp' ";
                    $query4 = Yii::$app->db->createCommand($sql4)->execute();

                    $sql5 = "update producto set stock = '$total' where id = '$cp' ";
                    $query5 = Yii::$app->db->createCommand($sql5)->execute();

                    $cv = $stock['cantidad'];



                    $sql = "update ventas set estado = 0, cantidad = '$cv',importe='$importe' where id = '$pk' ";
                    $query = Yii::$app->db->createCommand($sql)->execute();



                    //se agrega a historial tmb
                    $cantidad = $cv;$importe = $importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                    $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                    $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                    $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

                    $movimiento = date('Y-m-d H:i:s');

                    $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                        value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',0,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Enviada a impagas','$folio','$movimiento')";
                    Yii::$app->db->createCommand($sql2)->execute();



       
                }else{
                    if($cantidad <= $stock['cantidad'] ){
                        $cantidad_stock = $stock['cantidad'];
                        $total = $cantidad_stock - $cantidad;

                        $cantidad_restante = $venta['cantidad'] - $cant;

                        $sql4 = "update stock set cantidad = '$total' where codigo = '$cp' ";
                        $query4 = Yii::$app->db->createCommand($sql4)->execute();

                        $sql5 = "update producto set stock = '$total' where id = '$cp' ";
                        $query5 = Yii::$app->db->createCommand($sql5)->execute();



                        $codigo = $venta['idProducto'];
                        $producto = Producto::find()->where(['id' => $codigo])->one();
                        //recalcular importe
                        $importe_unitario = $producto->precio_descuento;
                        $importe = null;
                        if($producto->descuento != 0){
                            $importe = (int)$importe_unitario * (int)$cantidad;
                            $importe = $importe - (($importe* (int)$producto->descuento)/100);
                        }else{
                            $importe = (int)$importe_unitario * (int)$cantidad;
                        }


                        $sql = "update ventas set estado = 0,cantidad = '$cantidad',importe='$importe' where id = '$pk' ";
                        $query = Yii::$app->db->createCommand($sql)->execute();




                        $importe_unitario = $producto->precio_descuento;
                        $importe = null;
                        if($producto->descuento != 0){
                            $importe = (int)$importe_unitario * (int)$cantidad_restante;
                            $importe = $importe - (($importe* (int)$producto->descuento)/100);
                        }else{
                            $importe = (int)$importe_unitario * (int)$cantidad_restante;
                        }


                        $model =  new Ventas();

                        $model->idProducto = $venta->idProducto;
                        $model->cantidad = $cantidad_restante;
                        $model->importe = $importe;
                        $model->vendedor = $venta->vendedor;
                        $model->cliente = $venta->cliente;
                        $model->fecha_venta = $venta->fecha_venta;
                        $model->importe_unitario = $venta->importe_unitario;
                        $model->estado = 3;
                        $model->fecha_carga = $venta->fecha_carga;
                        $model->tipo_venta = $venta->tipo_venta;
                        $model->caracter = $venta->caracter;
                        $model->carga_venta = $venta->carga_venta;
                        $model->forma_pago = $venta->forma_pago;
                        $model->folio = $venta->folio;

                        $model->save(false);




                        //hisotrial
                        $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                        $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                        $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                        $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

                        $movimiento = date('Y-m-d H:i:s');

                        $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                            value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',0,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Enviada a impagas','$folio','$movimiento')";

                        Yii::$app->db->createCommand($sql2)->execute();




                    }
                }   
            } 


        }

        $iddatatable = '#crud-datatable5-pjax';

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=> '#crud-datatable5-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
            
    }





















    public function actionEnviaraimpagascantidad()
    {


        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'keylist2' )); // Array or selected records primary keys
        $cant = Yii::$app->request->post( 'cant2' );
        foreach ( $pks as $pk ) {
            
            $venta = Ventas::find()->where(['id' => $pk])->one();
    



            $cp = $venta['idProducto'];
            $stock = Yii::$app->db->createCommand("select * from stock where codigo = '$cp' ")->queryOne();
            $cantidad = $cant;

            if($stock['cantidad'] != 0){ 
                if($cantidad >= $stock['cantidad'] ){
                    $total = 0;

                    $sql4 = "update stock set cantidad = '$total' where codigo = '$cp' ";
                    $query4 = Yii::$app->db->createCommand($sql4)->execute();

                    $sql5 = "update producto set stock = '$total' where id = '$cp' ";
                    $query5 = Yii::$app->db->createCommand($sql5)->execute();

                    $cv = $stock['cantidad'];


                    $codigo = $venta['idProducto'];
                    $producto = Producto::find()->where(['id' => $codigo])->one();
                    //recalcular importe
                    $importe_unitario = $producto->precio_descuento;
                    $importe = null;
                    if($producto->descuento != 0){
                        $importe = (int)$importe_unitario * (int)$stock['cantidad'];
                        $importe = $importe - (($importe* (int)$producto->descuento)/100);
                    }else{
                        $importe = (int)$importe_unitario * (int)$stock['cantidad'];
                    }


                    $sql = "update ventas set estado = 0, cantidad = '$cv',importe='$importe' where id = '$pk' ";
                    $query = Yii::$app->db->createCommand($sql)->execute();



  
                        
                    /*$model =  new Ventas();

                    $model->idProducto = $venta->idProducto;
                    $model->cantidad = $stock['cantidad'];
                    $model->importe = $importe;
                    $model->vendedor = $venta->vendedor;
                    $model->cliente = $venta->cliente;
                    $model->fecha_venta = $venta->fecha_venta;
                    $model->importe_unitario = $venta->importe_unitario;
                    $model->estado = 3;
                    $model->fecha_carga = $venta->fecha_carga;
                    $model->tipo_venta = $venta->tipo_venta;
                    $model->caracter = $venta->caracter;
                    $model->carga_venta = $venta->carga_venta;
                    $model->forma_pago = $venta->forma_pago;
                    $model->folio = $venta->folio;

                    $model->save(false);*/

                





                    //se agrega a historial tmb
                    $cantidad = $cv;$importe = $importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                    $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                    $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                    $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

                    $movimiento = date('Y-m-d H:i:s');

                    $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                        value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',0,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Enviada a impagas','$folio','$movimiento')";
                    Yii::$app->db->createCommand($sql2)->execute();






                                
                }else{
                    if($cantidad <= $stock['cantidad'] ){
                        $cantidad_stock = $stock['cantidad'];
                        $total = $cantidad_stock - $cantidad;

                        $cantidad_restante = $venta['cantidad'] - $cant;

                        $sql4 = "update stock set cantidad = '$total' where codigo = '$cp' ";
                        $query4 = Yii::$app->db->createCommand($sql4)->execute();

                        $sql5 = "update producto set stock = '$total' where id = '$cp' ";
                        $query5 = Yii::$app->db->createCommand($sql5)->execute();



                        $codigo = $venta['idProducto'];
                        $producto = Producto::find()->where(['id' => $codigo])->one();
                        //recalcular importe
                        $importe_unitario = $producto->precio_descuento;
                        $importe = null;
                        if($producto->descuento != 0){
                            $importe = (int)$importe_unitario * (int)$cantidad;
                            $importe = $importe - (($importe* (int)$producto->descuento)/100);
                        }else{
                            $importe = (int)$importe_unitario * (int)$cantidad;
                        }


                        $sql = "update ventas set estado = 0,cantidad = '$cantidad',importe='$importe' where id = '$pk' ";
                        $query = Yii::$app->db->createCommand($sql)->execute();




                        $importe_unitario = $producto->precio_descuento;
                        $importe = null;
                        if($producto->descuento != 0){
                            $importe = (int)$importe_unitario * (int)$cantidad_restante;
                            $importe = $importe - (($importe* (int)$producto->descuento)/100);
                        }else{
                            $importe = (int)$importe_unitario * (int)$cantidad_restante;
                        }


                        $model =  new Ventas();

                        $model->idProducto = $venta->idProducto;
                        $model->cantidad = $cantidad_restante;
                        $model->importe = $importe;
                        $model->vendedor = $venta->vendedor;
                        $model->cliente = $venta->cliente;
                        $model->fecha_venta = $venta->fecha_venta;
                        $model->importe_unitario = $venta->importe_unitario;
                        $model->estado = 3;
                        $model->fecha_carga = $venta->fecha_carga;
                        $model->tipo_venta = $venta->tipo_venta;
                        $model->caracter = $venta->caracter;
                        $model->carga_venta = $venta->carga_venta;
                        $model->forma_pago = $venta->forma_pago;
                        $model->folio = $venta->folio;

                        $model->save(false);




                        //hisotrial
                        $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                        $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                        $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                        $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

                        $movimiento = date('Y-m-d H:i:s');

                        $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                            value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',0,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Enviada a impagas','$folio','$movimiento')";

                        Yii::$app->db->createCommand($sql2)->execute();




                    }
                }   
            } 


        }

        $iddatatable = '#crud-datatable5-pjax';

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=> '#crud-datatable5-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
            
    }

    public function actionDevolver()
    {
       // Array or selected records primary keys

        $pks = explode(',', Yii::$app->request->post( 'keylist2' )); // Array or selected records primary keys
        $cant = Yii::$app->request->post( 'cant2' ); $index = Yii::$app->request->post( 'index' );
            $mensaje = null;
            foreach ( $pks as $pk ) {
                

                        $venta = Ventas::find()->where(['id' => $pk])->one();

                        $cod = $venta['idProducto'];
                        $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cod ")->queryOne();

                        $cs = $stock['cantidad'];
                        $cv = $venta['cantidad'];


                            if($cant > $cv){
                                $cant = $cv;
                            }


                            $cantidad = $cs + $cant;
                            $cantidad2 = $cv - $cant;
                            



                            if ($cantidad2 == 0) {

                                $sql2 = "delete from ventas where id = '$pk' ";
                                $query2 = Yii::$app->db->createCommand($sql2)->execute();

                                $sql = "update stock set cantidad = '$cantidad' where codigo = '$cod' ";
                                $query = Yii::$app->db->createCommand($sql)->execute();

                                $sql3 = "update producto set stock = '$cantidad' where id = '$cod' ";
                                $query3 = Yii::$app->db->createCommand($sql3)->execute();

                         

                            }else{
                                $sql = "update stock set cantidad = '$cantidad' where codigo = '$cod' ";
                                $query = Yii::$app->db->createCommand($sql)->execute();

                                $sql2 = "update ventas set cantidad = '$cantidad2' where id = '$pk' ";
                                $query2 = Yii::$app->db->createCommand($sql2)->execute();

                                $sql3 = "update producto set stock = '$cantidad' where id = '$cod' ";
                                $query3 = Yii::$app->db->createCommand($sql3)->execute();
                            }

                          


                        

            }
        
           // return $mensaje;
      
        return $this->redirect([$index]);
    }


    /**
     * Finds the Ventas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Ventas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ventas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }






     public function actionDescuento()
    {
       // Array or selected records primary keys

        $pks = explode(',', Yii::$app->request->post( 'keylist' )); // Array or selected records primary keys
        $descuento = Yii::$app->request->post( 'cant' );
        //$venta = null;
            foreach ( $pks as $pk ) {

                        
                
                        $venta = Ventas::find()->where(['id' => $pk])->one();

                        $idp = $venta->idProducto;
                        /*$sql = "update producto set  descuento = '$descuento' where id = '$idp' ";
                        $query = Yii::$app->db->createCommand($sql)->execute();*/

                        $producto = Producto::find()->where(['id' => $idp])->one();

                        //$id = $producto->id;
                        $importe_unitario = $producto->precio_descuento;

                        $descuento_total = (int)$descuento + (int)$producto->descuento;


                        $importe1 = null;
                        if($descuento_total > 0){

                            $importe1 = (int)$importe_unitario * (int)$venta->cantidad; //$producto->stock
                            $importe1 = $importe1 - (($importe1 * (int)$descuento_total)/100);


                            $sql = "update ventas set  importe = '$importe1', descuento_aplicado = $descuento  where id = '$pk' ";
                            $query = Yii::$app->db->createCommand($sql)->execute();

                        }


                        //se agrega a historial tmb
                    $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                    $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                    $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                    $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

                    $movimiento = date('Y-m-d H:i:s');

                    $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                        value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario','$cant','$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Descuento aplicado','$folio','$movimiento')";

                    Yii::$app->db->createCommand($sql2)->execute();



                        
                    }


                    $venta = Ventas::find()->where(['id' => $pk])->one();
                  
                    




    
                    return '#crud-datatable'.$venta->vendedor.'-pjax';
                



}
                

               





/**
     * Delete multiple existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkcargar2()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            
            $venta = Ventas::find()->where(['id' => $pk])->one();
    
            $cp = $venta['idProducto'];
            $stock = Yii::$app->db->createCommand("select * from stock where codigo = $cp")->queryOne();
        
            $cantidad = $venta['cantidad'];


            if($stock['cantidad'] != 0){ 
                if($cantidad >= $stock['cantidad'] ){


                    $total = 0;

                    $sql4 = "update stock set cantidad = '$total' where codigo = '$cp' ";
                    $query4 = Yii::$app->db->createCommand($sql4)->execute();

                    $sql5 = "update producto set stock = '$total' where id = '$cp' ";
                    $query5 = Yii::$app->db->createCommand($sql5)->execute();


                    $cv = $stock['cantidad'];

                    


                    $codigo = $venta['idProducto'];
                    $producto = Producto::find()->where(['id' => $codigo])->one();
                    //recalcular importe
                    $importe_unitario = $producto->precio_descuento;
                    $importe = null;
                    if($producto->descuento != 0){
                        $importe = (int)$importe_unitario * (int)$stock['cantidad'];
                        $importe = $importe - (($importe* (int)$producto->descuento)/100);
                    }else{
                        $importe = (int)$importe_unitario * (int)$stock['cantidad'];
                    }


                    $sql = "update ventas set estado = 0, cantidad = '$cv',importe='$importe' where id = '$pk' ";
                    $query = Yii::$app->db->createCommand($sql)->execute();


                    //se agrega a historial tmb
                    $cantidad = $cv;$importe = $importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                    $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                    $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                    $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

                    $movimiento = date('Y-m-d H:i:s');

                    $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                        value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',0,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Enviada a impagas','$folio','$movimiento')";
                    Yii::$app->db->createCommand($sql2)->execute();






                                
                }else{
                    if($cantidad <= $stock['cantidad'] ){
                        $cantidad_stock = $stock['cantidad'];
                        $total = $cantidad_stock - $cantidad;

                        $sql4 = "update stock set cantidad = '$total' where codigo = '$cp' ";
                        $query4 = Yii::$app->db->createCommand($sql4)->execute();

                        $sql5 = "update producto set stock = '$total' where id = '$cp' ";
                        $query5 = Yii::$app->db->createCommand($sql5)->execute();

                        $sql = "update ventas set estado = 0 where id = '$pk' ";
                        $query = Yii::$app->db->createCommand($sql)->execute();



                        //hisotrial
                        $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                        $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                        $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                        $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;$folio = $venta->id;

                        $movimiento = date('Y-m-d H:i:s');

                        $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                            value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',0,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Enviada a impagas','$folio','$movimiento')";

                        Yii::$app->db->createCommand($sql2)->execute();




                    }
                }   
            } 


        }

        $iddatatable = '#crud-datatable5-pjax';

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=> '#crud-datatable5-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }




    /**
     * Delete multiple existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkenviarapendientes($id)
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys

        

            foreach ( $pks as $pk ) {

                    $venta_model = Ventas::find()->where(['id' => $pk])->one();
                    $stock = Stock::find()->where(['codigo' => $venta_model['idProducto'] ])->one();

                    $ventas = Ventas::find()->where(['estado' => 2,'idProducto' => $venta_model['idProducto'] ])->all();
                    $cant_total = 0;
                    foreach ($ventas as $v) {
                        $cant_total += (int)$v['cantidad'];
                    }

                    if($cant_total <= $stock['cantidad'] ){ 


               
                        $sql = "update ventas set estado = 3 where id = '$pk' ";
                        $query = Yii::$app->db->createCommand($sql)->execute();


                            //hisotiral
                            $venta = Ventas::find()->where(['id' => $pk])->one();

                            $producto = $venta->idProducto;$cant = $venta->cantidad;
                            $importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
                            $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
                            $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
                            $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago;


                            /*$folio = Folio::find()->where(['idfolio' => 1])->one();
                            $f = $folio->numero_folio;*/

                            $folio = $venta->id;

                            $movimiento = date('Y-m-d H:i:s');

                            $sql_insertar = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                                        value ('$producto','$cant','$importe','$v','$cliente','$fecha_venta','$importe_unitario',3,'$fecha_carga',0,'$caracter',0,'$forma_pago','Enviado a pendientes','$folio','$movimiento')";

                            Yii::$app->db->createCommand($sql_insertar)->execute();

                          //  $sql5 = "update ventas set folio = '$f' where id = '$pk' ";
                          //  $query5 = Yii::$app->db->createCommand($sql5)->execute();


                    }       
                             
     
            }
      

        //actualizacion de numero de folio
        /*$f = $f + 1;           
        $sql_folio = "update folio set numero_folio = '$f' where idfolio = 1 ";
        Yii::$app->db->createCommand($sql_folio)->execute();*/



        if($request->isAjax){

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=> '#crud-datatable'.$id.'-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }










    public function actionPdfall($id)
    {


        $searchModel = null;
        $dataProvider = null;
        if($id != ''){
            $searchModel = new VentasSearch();
            $searchModel->vendedor = $id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->pagination  = false;

        }else{
            $searchModel = new VentasSearch();
            //$dataProvider = $searchModel->search2($_SESSION["parametros"]); 
            $parametros = $_SESSION["parametros"]; 
            $searchModel->load($parametros);
            $dataProvider = $_SESSION["dataProvider"];
            $dataProvider->pagination  = false;
        }
       


        $content = $this->renderPartial('pdf', ['dataProvider' => $dataProvider,'searchModel' => $searchModel]); 

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:2px}', 
             // set mPDF properties on the fly
             'options' => [
                'title' => 'Planilla de carga',
                'subject' => 'WAY Indumentaria'
            ],
            'methods' => [
                'SetHeader' => ['WAY Indumentaria||Fecha: ' . date("d-m-Y")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);

         return $pdf->render(); 

    }



     public function actionPdfall_letter($id)
    {


        $searchModel = null;
        $dataProvider = null;
        if($id != ''){
            $searchModel = new VentasSearch();
            $searchModel->vendedor = $id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->pagination  = false;

        }else{
            $searchModel = new VentasSearch();
            //$dataProvider = $searchModel->search2($_SESSION["parametros"]); 
            $parametros = $_SESSION["parametros"]; 
            $searchModel->load($parametros);
            $dataProvider = $_SESSION["dataProvider"];
            $dataProvider->pagination  = false;
        }
       


        $content = $this->renderPartial('pdf', ['dataProvider' => $dataProvider,'searchModel' => $searchModel]); 

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_LETTER, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:2px}', 
             // set mPDF properties on the fly
             'options' => [
                'title' => 'Planilla de carga',
                'subject' => 'WAY Indumentaria'
            ],
            'methods' => [
                'SetHeader' => ['WAY Indumentaria||Fecha: ' . date("d-m-Y")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);

         return $pdf->render(); 

    }







     /**
     * Delete multiple existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionFinalizar2()
    {        
        

        $pks = explode(',', Yii::$app->request->post( 'keylist2' ));
        $idproducto_combo = Yii::$app->request->post( 'producto' );
        $descuento = Yii::$app->request->post( 'descuento' );
        $p = 0;
        foreach ( $pks as $pk ) {
            
            $sql = "update ventas set estado = 1 where id = '$pk' ";
            $query = Yii::$app->db->createCommand($sql)->execute();


            $venta = Ventas::find()->where(['id' => $pk])->one();
            //se agrega a historial tmb
            $cantidad = $venta->cantidad;$importe = $venta->importe;$v = $venta->vendedor;$cliente = $venta->cliente;
            $fecha_venta = $venta->fecha_venta;$importe_unitario = $venta->importe_unitario;
            $fecha_carga = $venta->fecha_carga;$tipo_venta = $venta->tipo_venta;$caracter = $venta->caracter;
            $carga_venta = $venta->carga_venta;$forma_pago = $venta->forma_pago; $folio = $venta->id;

            $movimiento = date('Y-m-d H:i:s');

            $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                value ('$pk','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',1,'$fecha_carga','$tipo_venta','$caracter','$carga_venta','$forma_pago','Venta pagada con regalo','$folio','$movimiento')";
            Yii::$app->db->createCommand($sql2)->execute();

            $p = $pk;
        }


        //INSERTAR VENTA REGALO
        $venta = Ventas::find()->where(['id' => $p])->one();
        $productos =  Yii::$app->request->post( 'producto' );

        $cc = 0;
        foreach ($productos as $pr){$cc = $cc + 1;}

        foreach ($productos as $pr) {
          

                $producto = Producto::find()->where(['id' => $pr])->one();
                $importe_unitario = $producto->precio_descuento;

                $model2 =  new Ventas();

                $model2->idProducto = $pr;
                $model2->cantidad = 1;
                $model2->importe = $importe_unitario;
                $model2->vendedor = $venta->vendedor;
                $model2->cliente = $venta->cliente;
                $model2->fecha_venta = $venta->fecha_venta;
                $model2->importe_unitario = $importe_unitario;
                $model2->estado = 4;
                $model2->fecha_carga = $venta->fecha_carga;
                $model2->tipo_venta = $venta->tipo_venta;
                $model2->caracter = 1;
                $model2->carga_venta = $venta->carga_venta;
                $model2->forma_pago = $venta->forma_pago;
                $model2->regalo = $descuento / $cc;

                $model2->save(false);

        }


       /* if($sumatoria_importe > 10000){

                $venta = Ventas::find()->where(['id' => $pk])->one();

                $model =  new Ventas();

                $model->idProducto = $venta->idProducto;
                $model->cantidad = 1;
                $model->importe = $descuento;
                $model->vendedor = $venta->vendedor;
                $model->cliente = $venta->cliente;
                $model->fecha_venta = $venta->fecha_venta;
                $model->importe_unitario = $venta->importe_unitario;
                $model->estado = 1;
                $model->fecha_carga = $venta->fecha_carga;
                $model->tipo_venta = $venta->tipo_venta;
                $model->caracter = 1;
                $model->carga_venta = $venta->carga_venta;
                $model->forma_pago = $venta->forma_pago;

                $model->save(false);


              
                $producto = Producto::find()->where(['id' => $idproducto_combo])->one();
                $importe_unitario = $producto->precio_descuento;


                $model2 =  new Ventas();

                $model2->idProducto = $idproducto_combo;
                $model2->cantidad = 1;
                $model2->importe = $importe_unitario;
                $model2->vendedor = $venta->vendedor;
                $model2->cliente = $venta->cliente;
                $model2->fecha_venta = $venta->fecha_venta;
                $model2->importe_unitario = $importe_unitario;
                $model2->estado = 1;
                $model2->fecha_carga = $venta->fecha_carga;
                $model2->tipo_venta = $venta->tipo_venta;
                $model2->caracter = 1;
                $model2->carga_venta = $venta->carga_venta;
                $model2->forma_pago = $venta->forma_pago;

                $model2->save(false);
        }*/





        /*if($request->isAjax){
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{*/
            
            return $this->redirect(['index2']);
        //}
       
    }




    /**
     * Lists all Ventas models.
     * @return mixed
     */
    public function actionIndex4()
    {    
        $searchModel = new VentasSearch();
        $searchModel->estado = 4;
        $dataProvider = $searchModel->search4(Yii::$app->request->queryParams);

         

        return $this->render('index3', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }












    public function actionMovimientos()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'keylist' )); 
        $impagas = explode(',', $request->post( 'impagas' )); 
        $devueltas = explode(',', $request->post( 'devueltas' )); 

        $puntero = count($pks);
        $array_principal = array();
        for ($i=0; $i < $puntero; $i++) { 
            
            $fila = array();
            $fila['key'] = $pks[$i];
            if($impagas[$i] != ""){
                $fila['impagas'] = (int)$impagas[$i];
            }else{
                $fila['impagas'] = 0;
            }
            
            if($devueltas[$i] != ""){
                $fila['devueltas'] = (int)$devueltas[$i];
            }else{
                $fila['devueltas'] = 0;
            }
           

            array_push($array_principal,$fila);

        }
        
        foreach ( $array_principal as $ap ) {

            $venta = Ventas::find()->where(['id' => $ap['key']])->one();

            $sumatoria = (int)$ap['impagas'] + (int)$ap['devueltas'];
            $cantidad = (int)$venta['cantidad'];

            $imp = (int)$ap['impagas'];
            $dev = (int)$ap['devueltas'];

            if($sumatoria < $cantidad){
                
                $diferencia = $cantidad - $sumatoria;
           
                /**
                 * Recalculos de importes
                 */

                $codigo = $venta['idProducto'];
                $producto = Producto::find()->where(['id' => $codigo])->one();
     
                //importe destinado a la venta en nueva  venta

                $importe_unitario = $producto['precio_descuento'];
                $importe_nueva_venta = null;
                if($producto['descuento'] != 0){
                    $importe_nueva_venta = (int)$importe_unitario * (int)$diferencia;
                    $importe_nueva_venta = $importe_nueva_venta - (($importe_nueva_venta * (int)$producto['descuento'])/100);
                }else{
                    $importe_nueva_venta = (int)$importe_unitario * (int)$diferencia;
                }

                //Importe destinado a impagas
                $importe_unitario = $producto['precio_descuento'];
                $importe_actualizado = null;
                if($producto['descuento'] != 0){
                    $importe_actualizado = (int)$importe_unitario * (int)$imp;
                    $importe_actualizado = $importe_actualizado - (($importe_actualizado * (int)$producto['descuento'])/100);
                }else{
                    $importe_actualizado = (int)$importe_unitario * (int)$imp;
                }


                /**
                 * Actualizacion de venta en nueva venta y devolucion de stock segun corresponda
                 */
                $cod_venta = $ap['key'];
                $sql = "update ventas set cantidad = '$diferencia', importe ='$importe_nueva_venta' where id = '$cod_venta' ";
                $query = Yii::$app->db->createCommand($sql)->execute();

                //actualizacion de stock en tabla stock y en producto
                $cp = $venta['idProducto'];
                $stock = Yii::$app->db->createCommand("select * from stock where codigo = '$cp'")->queryOne();
                $nuevo_stock = $stock['cantidad'] + $dev;

                $sql2 = "update stock set cantidad = '$nuevo_stock' where codigo = '$cp' ";
                $query2 = Yii::$app->db->createCommand($sql2)->execute();

                $sql3 = "update producto set stock = '$nuevo_stock' where id = '$cp' ";
                $query3 = Yii::$app->db->createCommand($sql3)->execute();

                /**
                  * Insercion de nueva venta destinada a impagas
                **/

                $venta_count = Ventas::find()->where(['idProducto' => $venta['idProducto'], 'estado' => 0, 'vendedor' => $venta['vendedor'] ])->count();

                if($venta_count <> 0){

                    $venta_encontrada = Ventas::find()->where(['idProducto' => $venta['idProducto'], 'estado' => 0, 'vendedor' => $venta['vendedor'] ])->one();
                    
                    $cantidad_definida = (int)$venta_encontrada['cantidad'] + (int)$imp;
                    $importe_definido = (int)$venta_encontrada['importe'] + (int)$importe_actualizado;

                    $codigo_venta_encontrada = $venta_encontrada['id'];

                    $sql_venta_encontrada = "update ventas set cantidad = '$cantidad_definida', importe ='$importe_definido' where id = '$codigo_venta_encontrada' ";
                    $query_venta_encontrada = Yii::$app->db->createCommand($sql_venta_encontrada)->execute();

                }else{
                    $model =  new Ventas();

                    $model->idProducto = $venta->idProducto;
                    $model->cantidad = $imp;
                    $model->importe = $importe_actualizado;
                    $model->vendedor = $venta->vendedor;
                    $model->cliente = $venta->cliente;
                    $model->fecha_venta = $venta->fecha_venta;
                    $model->importe_unitario = $venta->importe_unitario;
                    $model->estado = 0;
                    $model->fecha_carga = $venta->fecha_carga;
                    $model->tipo_venta = $venta->tipo_venta;
                    $model->caracter = $venta->caracter;
                    $model->carga_venta = $venta->carga_venta;
                    $model->forma_pago = $venta->forma_pago;
                    $model->folio = $venta->folio;

                    $model->save(false);
                }

                


            }else{
                if($sumatoria >= $cantidad){
                    
                    $cod_venta = $ap['key'];

                    $codigo = $venta['idProducto'];
                    $producto = Producto::find()->where(['id' => $codigo])->one();

                    //recalculo de importe
                    $importe_unitario = $producto['precio_descuento'];
                    $importe_actualizado = null;
                    if($producto['descuento'] != 0){
                        $importe_actualizado = (int)$importe_unitario * (int)$imp;
                        $importe_actualizado = $importe_actualizado - (($importe_actualizado * (int)$producto['descuento'])/100);
                    }else{
                        $importe_actualizado = (int)$importe_unitario * (int)$imp;
                    }


                    //actualizacion de venta
                    /*$sql1 = "update ventas set cantidad = '$imp', importe = '$importe_actualizado' ,estado = 0 where id = '$cod_venta' ";
                    $query = Yii::$app->db->createCommand($sql1)->execute();*/


                    $venta_impaga = Ventas::find()->where(['estado' => 0, 'idProducto' =>$venta['idProducto'], 'vendedor' => $venta['vendedor']])->one();
                    $nuevo_importe_impaga = (int)$importe_actualizado + (int)$venta_impaga['importe'];
                    $cantidad_actualizada_impaga = (int)$imp + $venta_impaga['cantidad'];
                    $cod_venta_impaga = $venta_impaga['id'];
                    $sql_actualizar_impaga = "update ventas set cantidad = '$cantidad_actualizada_impaga', importe = '$nuevo_importe_impaga'  where id = '$cod_venta_impaga' ";
                    $query_actualizar_impaga = Yii::$app->db->createCommand($sql_actualizar_impaga)->execute();




                    //actualizacion de stock en tabla stock y en producto
                    $cp = $venta['idProducto'];
                    $stock = Yii::$app->db->createCommand("select * from stock where codigo = '$cp'")->queryOne();
                    $nuevo_stock = $stock['cantidad'] + $dev;

                    $sql2 = "update stock set cantidad = '$nuevo_stock' where codigo = '$cp' ";
                    $query2 = Yii::$app->db->createCommand($sql2)->execute();

                    $sql3 = "update producto set stock = '$nuevo_stock' where id = '$cp' ";
                    $query3 = Yii::$app->db->createCommand($sql3)->execute();


                    /*$sql1 = "update ventas set cantidad = '$imp', importe = '$importe_actualizado' ,estado = 0 where id = '$cod_venta' ";
                    $query = Yii::$app->db->createCommand($sql1)->execute();*/
            
                    $sql_delete = "delete from ventas where id = '$cod_venta'";
                    $query_delete = Yii::$app->db->createCommand($sql_delete)->execute();

                }
            }
            
            
        }

        /*if($request->isAjax){
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable5-pjax'];
        }else{
           
            return $this->redirect(['index']);
        }*/
        //print json_encode($array_principal);
        $v = $venta['vendedor'];
        return "#crud-datatable".$v."-pjax";
    }


    



}
