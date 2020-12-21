<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

/**
 * ProductoSearch represents the model behind the search form about `app\models\Producto`.
 */
class ProductoSearch extends Producto
{

    public $codigos_categorias;

    public $codigo_origen;
    public $codigo_sexo;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'categoria', 'stock', 'estado'], 'integer'],
            [['codigo', 'descripcion','codigos_categorias','codigo_origen','codigo_sexo'], 'safe'],
            [['precio_costo', 'precio_unitario', 'precio_descuento', 'descuento'], 'number'],
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
        $query = Producto::find();

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
            'precio_costo' => $this->precio_costo,
            'precio_unitario' => $this->precio_unitario,
            'precio_descuento' => $this->precio_descuento,
            'categoria' => $this->categoria,
            'stock' => $this->stock,
            'estado' => $this->estado,
            'descuento' => $this->descuento,
        ]);




        $co = Categoria::find()->where(['categoria_origen' =>  $this->codigo_origen])->all();
        $origenes = [];
        foreach ($co as $o) {
            array_push($origenes, $o->codigo);
        }

        $cs = Categoria::find()->where(['categoria_sexo' =>  $this->codigo_sexo])->all();
        $sexos = [];
        foreach ($cs as $s) {
            array_push($sexos, $s->codigo);
        }

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['in', 'categoria', $origenes])
            ->andFilterWhere(['in', 'categoria', $sexos])
            ->andFilterWhere(['in', 'categoria', $this->codigos_categorias])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }



    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchhombre($params)
    {
        $query = Producto::find();

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
            'precio_costo' => $this->precio_costo,
            'precio_unitario' => $this->precio_unitario,
            'precio_descuento' => $this->precio_descuento,
            'categoria' => $this->categoria,
            'stock' => $this->stock,
            'estado' => $this->estado,
            'descuento' => $this->descuento,
        ]);




        $cs = Categoria::find()->where(['categoria_sexo' =>  1])->all();
        $sexos = [];
        foreach ($cs as $s) {
            array_push($sexos, $s->codigo);
        }

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['in', 'categoria', $sexos])
            ->andFilterWhere(['in', 'categoria', $this->codigos_categorias])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchmujer($params)
    {
        $query = Producto::find();

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
            'precio_costo' => $this->precio_costo,
            'precio_unitario' => $this->precio_unitario,
            'precio_descuento' => $this->precio_descuento,
            'categoria' => $this->categoria,
            'stock' => $this->stock,
            'estado' => $this->estado,
            'descuento' => $this->descuento,
        ]);




        $cs = Categoria::find()->where(['categoria_sexo' =>  0])->all();
        $sexos = [];
        foreach ($cs as $s) {
            array_push($sexos, $s->codigo);
        }

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['in', 'categoria', $sexos])
            ->andFilterWhere(['in', 'categoria', $this->codigos_categorias])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }




    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchhba($params)
    {
        $query = Producto::find();

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
            'precio_costo' => $this->precio_costo,
            'precio_unitario' => $this->precio_unitario,
            'precio_descuento' => $this->precio_descuento,
            'categoria' => $this->categoria,
            'stock' => $this->stock,
            'estado' => $this->estado,
            'descuento' => $this->descuento,
        ]);




        $co = Categoria::find()->where(['categoria_origen' => 0])->all();
        $origenes = [];
        foreach ($co as $o) {
            array_push($origenes, $o->codigo);
        }

        $cs = Categoria::find()->where(['categoria_sexo' =>  1])->all();
        $sexos = [];
        foreach ($cs as $s) {
            array_push($sexos, $s->codigo);
        }

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['in', 'categoria', $origenes])
            ->andFilterWhere(['in', 'categoria', $sexos])
            ->andFilterWhere(['in', 'categoria', $this->codigos_categorias])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchhchile($params)
    {
        $query = Producto::find();

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
            'precio_costo' => $this->precio_costo,
            'precio_unitario' => $this->precio_unitario,
            'precio_descuento' => $this->precio_descuento,
            'categoria' => $this->categoria,
            'stock' => $this->stock,
            'estado' => $this->estado,
            'descuento' => $this->descuento,
        ]);




        $co = Categoria::find()->where(['categoria_origen' => 1])->all();
        $origenes = [];
        foreach ($co as $o) {
            array_push($origenes, $o->codigo);
        }

        $cs = Categoria::find()->where(['categoria_sexo' =>  1])->all();
        $sexos = [];
        foreach ($cs as $s) {
            array_push($sexos, $s->codigo);
        }

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['in', 'categoria', $origenes])
            ->andFilterWhere(['in', 'categoria', $sexos])
            ->andFilterWhere(['in', 'categoria', $this->codigos_categorias])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchhoulet($params)
    {
        $query = Producto::find();

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
            'precio_costo' => $this->precio_costo,
            'precio_unitario' => $this->precio_unitario,
            'precio_descuento' => $this->precio_descuento,
            'categoria' => $this->categoria,
            'stock' => $this->stock,
            'estado' => $this->estado,
            'descuento' => $this->descuento,
        ]);




        $co = Categoria::find()->where(['categoria_origen' => 2])->all();
        $origenes = [];
        foreach ($co as $o) {
            array_push($origenes, $o->codigo);
        }

        $cs = Categoria::find()->where(['categoria_sexo' =>  1])->all();
        $sexos = [];
        foreach ($cs as $s) {
            array_push($sexos, $s->codigo);
        }

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['in', 'categoria', $origenes])
            ->andFilterWhere(['in', 'categoria', $sexos])
            ->andFilterWhere(['in', 'categoria', $this->codigos_categorias])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }






    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchmba($params)
    {
        $query = Producto::find();

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
            'precio_costo' => $this->precio_costo,
            'precio_unitario' => $this->precio_unitario,
            'precio_descuento' => $this->precio_descuento,
            'categoria' => $this->categoria,
            'stock' => $this->stock,
            'estado' => $this->estado,
            'descuento' => $this->descuento,
        ]);




        $co = Categoria::find()->where(['categoria_origen' => 0])->all();
        $origenes = [];
        foreach ($co as $o) {
            array_push($origenes, $o->codigo);
        }

        $cs = Categoria::find()->where(['categoria_sexo' =>  0])->all();
        $sexos = [];
        foreach ($cs as $s) {
            array_push($sexos, $s->codigo);
        }

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['in', 'categoria', $origenes])
            ->andFilterWhere(['in', 'categoria', $sexos])
            ->andFilterWhere(['in', 'categoria', $this->codigos_categorias])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }



    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchmchile($params)
    {
        $query = Producto::find();

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
            'precio_costo' => $this->precio_costo,
            'precio_unitario' => $this->precio_unitario,
            'precio_descuento' => $this->precio_descuento,
            'categoria' => $this->categoria,
            'stock' => $this->stock,
            'estado' => $this->estado,
            'descuento' => $this->descuento,
        ]);




        $co = Categoria::find()->where(['categoria_origen' => 1])->all();
        $origenes = [];
        foreach ($co as $o) {
            array_push($origenes, $o->codigo);
        }

        $cs = Categoria::find()->where(['categoria_sexo' =>  0])->all();
        $sexos = [];
        foreach ($cs as $s) {
            array_push($sexos, $s->codigo);
        }

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['in', 'categoria', $origenes])
            ->andFilterWhere(['in', 'categoria', $sexos])
            ->andFilterWhere(['in', 'categoria', $this->codigos_categorias])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchmoulet($params)
    {
        $query = Producto::find();

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
            'precio_costo' => $this->precio_costo,
            'precio_unitario' => $this->precio_unitario,
            'precio_descuento' => $this->precio_descuento,
            'categoria' => $this->categoria,
            'stock' => $this->stock,
            'estado' => $this->estado,
            'descuento' => $this->descuento,
        ]);




        $co = Categoria::find()->where(['categoria_origen' => 2])->all();
        $origenes = [];
        foreach ($co as $o) {
            array_push($origenes, $o->codigo);
        }

        $cs = Categoria::find()->where(['categoria_sexo' =>  0])->all();
        $sexos = [];
        foreach ($cs as $s) {
            array_push($sexos, $s->codigo);
        }

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['in', 'categoria', $origenes])
            ->andFilterWhere(['in', 'categoria', $sexos])
            ->andFilterWhere(['in', 'categoria', $this->codigos_categorias])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
