<?php

namespace app\models;

use Yii;
use app\models\Producto;


/**
 * This is the model class for table "producto".
 *
 * @property string $id
 * @property string $codigo
 * @property string $descripcion
 * @property string $precio_costo
 * @property string $precio_unitario
 * @property string $precio_descuento
 * @property string $categoria
 * @property string $stock
 * @property int $estado
 * @property string $descuento
 *
 * @property Categoria $categoria0
 * @property ProductosAsignados[] $productosAsignados
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion', 'categoria', 'stock', 'estado'], 'required'],
            [['precio_costo', 'precio_unitario', 'precio_descuento', 'descuento'], 'number'],
            [['categoria', 'stock', 'estado'], 'integer'],
            [['codigo'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 45],
            [['categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria' => 'codigo']],

            //['codigo', 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'descripcion' => 'Descripcion',
            'precio_costo' => 'Precio Compra',
            'precio_unitario' => 'Precio Unitario',
            'precio_descuento' => 'Precio Descuento',
            'categoria' => 'Categoria',
            'stock' => 'Stock',
            'estado' => 'Estado',
            'descuento' => 'Descuento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria0()
    {
        return $this->hasOne(Categoria::className(), ['codigo' => 'categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductosAsignados()
    {
        return $this->hasMany(ProductosAsignados::className(), ['producto' => 'id']);
    }


}
