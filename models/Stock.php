<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property string $codigo
 * @property string $producto
 * @property string $cantidad
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['producto', 'cantidad'], 'required'],
            [[/*'producto',*/ 'cantidad'], 'integer'],
            ['producto','string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'producto' => 'Producto',
            'cantidad' => 'Cantidad',
        ];
    }
}
