<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gastos_categoria".
 *
 * @property string $idcategoriagastos
 * @property string $descripcion
 */
class Gasto_categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gastos_categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcategoriagastos' => 'Idcategoriagastos',
            'descripcion' => 'Descripcion',
        ];
    }
}
