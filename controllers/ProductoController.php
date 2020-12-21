<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
use app\models\Categoria;
use app\models\Stock;
use app\models\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
                    'sexomasculino' => ['post'],
                    'sexofemenino' => ['post'],
                    'buenosaires' => ['post'],
                    'chile' => ['post'],
                    'oulet' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex($origen,$sexo,$descripcion)
    {    
        $searchModel = new ProductoSearch();

        if ($origen != null && $sexo != null) {
            $codigos_count = Categoria::find()->where(['categoria_origen' => $origen, 'categoria_sexo' => $sexo])->count();
            $codigos = [];
            if ($codigos_count>0) {
                $codigos_query = Categoria::find()->where(['categoria_origen' => $origen, 'categoria_sexo' => $sexo])->all();
                foreach ($codigos_query as $c) {
                   array_push($codigos, $c->codigo);
                }

                $searchModel->codigos_categorias = $codigos;
            }
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       /* if($descripcion != 'General'){
            $searchModel = false;
        }*/

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'descripcion' => $descripcion,
            'sexo' => $sexo,
            'origen' => $origen
        ]);
    }

    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndexhba()
    {    
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->searchhba(Yii::$app->request->queryParams);
        return $this->render('indexhba', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'descripcion' => 'Hombre - Buenos Aires',
            'sexo' => 'Hombre',
            'origen' => 'Buenos Aires'
        ]);
    }

    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndexhchile()
    {    
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->searchhchile(Yii::$app->request->queryParams);
        return $this->render('indexhchile', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'descripcion' => 'Hombre - Chile',
            'sexo' => 'Hombre',
            'origen' => 'Chile'
        ]);
    }

     /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndexhoulet()
    {    
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->searchhoulet(Yii::$app->request->queryParams);
        return $this->render('indexhoulet', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'descripcion' => 'Hombre - Oulet',
            'sexo' => 'Hombre',
            'origen' => 'Oulet'
        ]);
    }

     /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndexmba()
    {    
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->searchmba(Yii::$app->request->queryParams);
        return $this->render('indexmba', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'descripcion' => 'Mujer - Buenos Aires',
            'sexo' => 'Mujer',
            'origen' => 'Buenos Aires'
        ]);
    }


     /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndexmchile()
    {    
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->searchmchile(Yii::$app->request->queryParams);
        return $this->render('indexmchile', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'descripcion' => 'Mujer - Chile',
            'sexo' => 'Mujer',
            'origen' => 'Chile'
        ]);
    }


     /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndexmoulet()
    {    
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->searchmoulet(Yii::$app->request->queryParams);
        return $this->render('indexmoulet', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'descripcion' => 'Mujer - Oulet',
            'sexo' => 'Mujer',
            'origen' => 'Oulet'
        ]);
    }


    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndexhombre()
    {    
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->searchhombre(Yii::$app->request->queryParams);
        return $this->render('indexhombre', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'descripcion' => 'Hombre',
            'sexo' => 'Hombre',
            'origen' => ''
        ]);
    }


    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndexmujer()
    {    
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->searchmujer(Yii::$app->request->queryParams);
        return $this->render('indexmujer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'descripcion' => 'Mujer',
            'sexo' => 'Mujer',
            'origen' => ''
        ]);
    }


    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex2()
    {    
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }


    /**
     * Displays a single Producto model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Producto #".$id,
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
     * Creates a new Producto model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($origen,$sexo)
    {
        $request = Yii::$app->request;
        $model = new Producto();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [

                    'title'=> "Crear nuevo producto",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'sexo' => $sexo,
                        'origen' => $origen
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){

                
                $producto_count = Producto::find()->where(['codigo' => $model->codigo])->count();

                if ($producto_count > 0) {
                    return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Crear nuevo producto",
                    'content'=>'<span class="text-success">El codigo del producto ya existe. Vuelva a intentarlo.</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Crear otro',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];      
                }else{



                    $porcertaje_venta = (($model->precio_unitario - $model->precio_costo)*100)/$model->precio_costo;
                    $porcertaje_costo = (($model->precio_descuento - $model->precio_costo)*100)/$model->precio_costo;


                    $model->porcentaje_costo = round($porcertaje_costo,0);
                    $model->porcentaje_venta =  round($porcertaje_venta,0);

                    $model->fecha_carga = date('Y-m-d');
                    
                    $model->save();

                    $stock = new Stock();

                    $stock->codigo = $model->id;
                    $stock->producto = $model->codigo;
                    $stock->cantidad = $model->stock;

                    $stock->save();

                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Crear nuevo producto",
                        'content'=>'<span class="text-success">Producto creado exitosamente!</span>',
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Crear otro',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            
                    ];        
                }

                
            }else{           
                return [
                    'title'=> "Crear nuevo producto",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'sexo' => $sexo,
                        'origen' => $origen
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
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
                    'sexo' => $sexo,
                    'origen' => $origen
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Producto model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       


        $cate = Categoria::find()->where(['codigo' => $model->categoria ])->one();

        $sexo = $cate->categoria_sexo;
        $origen = $cate->categoria_origen;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Producto #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'sexo' => $sexo,
                        'origen' => $origen
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){


                $porcertaje_venta = (($model->precio_unitario - $model->precio_costo)*100)/$model->precio_costo;
                $porcertaje_costo = (($model->precio_descuento - $model->precio_costo)*100)/$model->precio_costo;


                $model->porcentaje_costo = round($porcertaje_costo,0);
                $model->porcentaje_venta =  round($porcertaje_venta,0);


                $model->fecha_carga = date('Y-m-d');
                $model->save();
                $cod4 = $model->id;
                $cantidad = $model->stock;
                $sql4 = "update stock set cantidad = '$cantidad' where codigo = '$cod4' ";
                $query4 = Yii::$app->db->createCommand($sql4)->execute();


                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Producto #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Producto #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'sexo' => $sexo,
                        'origen' => $origen
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
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
                    'sexo' => $sexo,
                    'origen' => $origen
                ]);
            }
        }
    }


    /**
     * Updates an existing Producto model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate2($id)
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
                    'title'=> "Actualizar stock #".$id,
                    'content'=>$this->renderAjax('update2', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){

                return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            }else{
                 return [
                    'title'=> "Actualizar stock #".$id,
                    'content'=>$this->renderAjax('update2', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update2', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Producto model.
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
     * Delete multiple existing Producto model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
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
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }







    public function actionLists($id)
    {
        $countProductos = Producto::find()
                        ->where(['id' => $id])
                        ->count();
        $productos = Producto::find()
                    ->where(['id' => $id])
                    ->all();
        if($countProductos > 0)
        {
            foreach ($productos as $producto) {
                echo "<option value='".$producto->id."'>".$producto->descripcion."</option>";
            }
        }
        else
        {
            echo "<option> - </option>";
        }
    }








    /**
     * Delete multiple existing Ventas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionSumar()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', Yii::$app->request->post( 'keylist' )); // Array or selected records primary keys
        $descuento = Yii::$app->request->post( 'cant' );

        foreach ( $pks as $pk ) {
            

            $producto = Producto::find()->where(['id' => $pk])->one();

            $descuento_total = (int)$descuento + (int)$producto->descuento;

            $sql = "update producto set descuento = $descuento_total where id = '$pk' ";
            $query = Yii::$app->db->createCommand($sql)->execute();


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
    public function actionReemplazar()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', Yii::$app->request->post( 'keylist' )); // Array or selected records primary keys
        $descuento = Yii::$app->request->post( 'cant' );

        foreach ( $pks as $pk ) {
            
            $sql = "update producto set descuento = $descuento where id = '$pk' ";
            $query = Yii::$app->db->createCommand($sql)->execute();


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
    public function actionPorcentaje1_costo()
    {        

        //funcion aplicada para reemplazar


        $request = Yii::$app->request;
        $pks = explode(',', Yii::$app->request->post( 'keylist' )); // Array or selected records primary keys
        $porcentaje = Yii::$app->request->post( 'cant' );

        foreach ( $pks as $pk ) {


            $producto = Producto::find()->where(['id' => $pk])->one();

           
            $pc = $producto->precio_costo;
          
            $calculo = (((int)$porcentaje * (int)$pc)/100 ) + (int)$pc;


            $sql = "update producto set precio_descuento = '$calculo', porcentaje_costo = '$porcentaje' where id = '$pk' ";
            $query = Yii::$app->db->createCommand($sql)->execute();


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
    public function actionPorcentaje2_costo()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', Yii::$app->request->post( 'keylist' )); // Array or selected records primary keys
        $porcentaje = Yii::$app->request->post( 'cant' );

        foreach ( $pks as $pk ) {

            $producto = Producto::find()->where(['id' => $pk])->one();

           
            $pc = $producto->precio_costo;

            $porcentaje_total = $porcentaje + $producto->porcentaje_costo;
          
            $calculo = (((int)$porcentaje_total * (int)$pc)/100 ) + (int)$pc;


            $sql = "update producto set precio_descuento = '$calculo', porcentaje_costo = '$porcentaje_total' where id = '$pk' ";
            $query = Yii::$app->db->createCommand($sql)->execute();


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
    public function actionPorcentaje1_venta()
    {        

        $request = Yii::$app->request;
        $pks = explode(',', Yii::$app->request->post( 'keylist' )); // Array or selected records primary keys
        $porcentaje = Yii::$app->request->post( 'cant' );

        foreach ( $pks as $pk ) {


            $producto = Producto::find()->where(['id' => $pk])->one();

           
            $pc = $producto->precio_descuento;
          
            $calculo_precio_venta = (((int)$porcentaje * (int)$pc)/100 ) + (int)$pc;




            $sql = "update producto set precio_unitario = '$calculo_precio_venta', porcentaje_venta = '$porcentaje' where id = '$pk' ";
            $query = Yii::$app->db->createCommand($sql)->execute();




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
    public function actionPorcentaje2_venta()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', Yii::$app->request->post( 'keylist' )); // Array or selected records primary keys
        $porcentaje = Yii::$app->request->post( 'cant' );

        foreach ( $pks as $pk ) {


            $producto = Producto::find()->where(['id' => $pk])->one();

           
            $pc = $producto->precio_descuento;

            $porcentaje_total = $porcentaje + $producto->porcentaje_venta;
          
            $calculo = (((int)$porcentaje_total * (int)$pc)/100 ) + (int)$pc;


            $sql = "update producto set precio_unitario = '$calculo', porcentaje_venta = '$porcentaje_total' where id = '$pk' ";
            $query = Yii::$app->db->createCommand($sql)->execute();


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

}
