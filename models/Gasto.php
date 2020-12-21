<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gastos".
 *
 * @property string $idgatos
 * @property string $descripcion
 * @property string $importe
 * @property string $categoria
 */
class Gasto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gastos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'importe', 'categoria'], 'required'],
            [['descripcion'], 'string'],
            [['importe', 'categoria'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idgatos' => 'Idgatos',
            'descripcion' => 'Descripcion',
            'importe' => 'Importe',
            'categoria' => 'Categoria',
        ];
    }
}
