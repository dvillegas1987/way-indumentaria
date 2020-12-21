<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viaje_items".
 *
 * @property string $codigo
 * @property string $descripcion
 * @property string $importe
 */
class Viaje_items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viaje_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'importe'], 'required'],
            [['descripcion', 'importe'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'descripcion' => 'Descripcion',
            'importe' => 'Importe',
        ];
    }
}
