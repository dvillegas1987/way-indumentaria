<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Regalo;

/**
 * RegaloSearch represents the model behind the search form about `app\models\Regalo`.
 */
class RegaloSearch extends Regalo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idProducto', 'cantidad', 'vendedor', 'cliente', 'estado', 'tipo_venta', 'caracter', 'carga_venta', 'forma_pago', 'descuento_aplicado', 'folio'], 'integer'],
            [['importe', 'fecha_venta', 'importe_unitario', 'fecha_carga', 'fecha_antigua', 'regalo'], 'safe'],
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
        $query = Regalo::find();

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
            'estado' => $this->estado,
            'fecha_carga' => $this->fecha_carga,
            'tipo_venta' => $this->tipo_venta,
            'caracter' => $this->caracter,
            'carga_venta' => $this->carga_venta,
            'forma_pago' => $this->forma_pago,
            'descuento_aplicado' => $this->descuento_aplicado,
            'folio' => $this->folio,
            'fecha_antigua' => $this->fecha_antigua,
        ]);

        $query->andFilterWhere(['like', 'importe', $this->importe])
            ->andFilterWhere(['like', 'importe_unitario', $this->importe_unitario])
            ->andFilterWhere(['like', 'regalo', $this->regalo]);

        return $dataProvider;
    }
}
