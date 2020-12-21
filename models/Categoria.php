<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property string $codigo
 * @property string $descripcion
 * @property int $estado
 *
 * @property Producto[] $productos
 * @property ProductosAsignados[] $productosAsignados
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'estado'], 'required'],
            [['estado','categoria_sexo','categoria_origen'], 'integer'],
            [['descripcion'], 'string', 'max' => 50],
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
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['categoria' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductosAsignados()
    {
        return $this->hasMany(ProductosAsignados::className(), ['categoria' => 'codigo']);
    }
}
