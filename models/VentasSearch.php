<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ventas;
use app\models\VentasSearch;
use app\models\Producto;
use app\models\Stock;
use app\models\Vendedor;
use app\models\Folio;

/**
 * VentasSearch represents the model behind the search form about `app\models\Ventas`.
 */
class VentasSearch extends Ventas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'/*, 'idProducto'*/, 'cantidad', 'vendedor', 'cliente', 'estado','carga_venta','caracter'], 'integer'],
            [['importe', 'fecha_venta', 'importe_unitario', 'fecha_carga'], 'safe'],
            [ 'idProducto','string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ventas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'idProducto' => $this->idProducto,
            'cantidad' => $this->cantidad,
            'vendedor' => $this->vendedor,
            'cliente' => $this->cliente,
            'fecha_venta' => $this->fecha_venta == null ? null : date('Y-m-d',(strtotime($this->fecha_venta))),
            'estado' => 2,
            'carga_venta' => 0,
            'fecha_carga' => $this->fecha_carga == null ? null : date('Y-m-d',(strtotime($this->fecha_carga))),
        ]);

        $query->andFilterWhere(['like', 'importe', $this->importe])->andFilterWhere(['like', 'idProducto', $this->idProducto])
            ->andFilterWhere(['like', 'importe_unitario', $this->importe_unitario]);

        return $dataProvider;
    }



    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search2($params)
    {
        $query = Ventas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'idProducto' => $this->idProducto,
            'cantidad' => $this->cantidad,
            'vendedor' => $this->vendedor,
            'cliente' => $this->cliente,
            'fecha_venta' => $this->fecha_venta,
            'estado' => 0,
            'carga_venta' => 0,
            'fecha_carga' => $this->fecha_carga,
        ]);

        $query->andFilterWhere(['like', 'importe', $this->importe])
            ->andFilterWhere(['like', 'importe_unitario', $this->importe_unitario]);

        return $dataProvider;
    }
     /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search3($params)
    {
        $query = Ventas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'idProducto' => $this->idProducto,
            'cantidad' => $this->cantidad,
            'vendedor' => $this->vendedor,
            'cliente' => $this->cliente,
            'fecha_venta' => $this->fecha_venta,
            'estado' => 1,
            'carga_venta' => 0,
            'fecha_carga' => $this->fecha_carga,
        ]);

        $query->andFilterWhere(['like', 'importe', $this->importe])
            ->andFilterWhere(['like', 'importe_unitario', $this->importe_unitario]);

        return $dataProvider;
    }


     /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search1($params)
    {
        $query = Ventas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'idProducto' => $this->idProducto,
            'cantidad' => $this->cantidad,
            'vendedor' => $this->vendedor,
            'cliente' => $this->cliente,
            'fecha_venta' => $this->fecha_venta,
            'estado' => 3,
            //'carga_venta' => 0,
            'fecha_carga' => $this->fecha_carga,
        ]);

        $query->andFilterWhere(['like', 'importe', $this->importe])
            ->andFilterWhere(['like', 'importe_unitario', $this->importe_unitario]);

        return $dataProvider;
    }



    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search4($params)
    {
        $query = Ventas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'idProducto' => $this->idProducto,
            'cantidad' => $this->cantidad,
            'vendedor' => $this->vendedor,
            'cliente' => $this->cliente,
            'fecha_venta' => $this->fecha_venta,
            //'estado' => 1,
            'carga_venta' => 0,
            'caracter' => 1,
            'fecha_carga' => $this->fecha_carga,
        ]);

        $query->andFilterWhere(['like', 'importe', $this->importe])
            ->andFilterWhere(['like', 'importe_unitario', $this->importe_unitario]);

        return $dataProvider;
    }









    public function unificar_venta($cod_vta,$cod_producto,$cantidad,$vendedor,$caracter,$fecha_venta,$cliente,$forma_pago,$estado)
    {


        $producto = Producto::find()->where(['codigo' => $cod_producto])->one();
        $cproducto = $producto['id'];
        $venta = Ventas::find()->where(['idProducto' => $cproducto,'estado' => 2,'vendedor' =>$vendedor])->one();
        $count = Ventas::find()->where(['estado' => 2,'vendedor' =>$vendedor,'idProducto' => $cproducto])->count();

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
                        $total = $cantidad_stock + $cv;

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
                    $total = $cantidad_stock + $cant;


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
                    value ('$id','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago')";

                Yii::$app->db->createCommand($sql)->execute();

                $id_max = Ventas::findBySql('select max(id) as id from ventas')->one();
                $cod_max = $id_max['id'];
 

                //se agrega a historial tmb
                $sql2 = " insert into historial (idProducto,cantidad,importe,vendedor,cliente,fecha_venta,importe_unitario,estado,fecha_carga,tipo_venta,caracter,carga_venta,forma_pago,detalle,folio,movimiento)
                    value ('$id','$cantidad','$importe','$v','$cliente','$fecha_venta','$importe_unitario',2,'$fecha_carga',0,'$caracter',0,'$forma_pago','Venta agregada','$cod_max','$movimiento')";

                Yii::$app->db->createCommand($sql2)->execute();


        }
    }
}
