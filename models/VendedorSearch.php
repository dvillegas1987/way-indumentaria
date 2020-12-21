<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vendedor;

/**
 * VendedorSearch represents the model behind the search form about `app\models\Vendedor`.
 */
class VendedorSearch extends Vendedor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dni'], 'integer'],
            [['nombre', 'apellido', 'domicilio', 'email', 'localidad',/* 'garante',*/ 'adjunto'], 'safe'],
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
        $query = Vendedor::find();

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
            'dni' => $this->dni,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'domicilio', $this->domicilio])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'localidad', $this->localidad])
            //->andFilterWhere(['like', 'garante', $this->garante])
            ->andFilterWhere(['like', 'adjunto', $this->adjunto]);

        return $dataProvider;
    }
}
