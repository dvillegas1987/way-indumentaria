<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historial".
 *
 * @property string $id
 * @property string $idProducto
 * @property string $cantidad
 * @property string $importe
 * @property string $vendedor
 * @property string $cliente
 * @property string $fecha_venta
 * @property string $importe_unitario
 * @property int $estado
 * @property string $fecha_carga
 * @property int $tipo_venta
 * @property int $caracter
 * @property int $carga_venta
 * @property int $forma_pago
 */
class Historial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'historial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProducto', 'cantidad', 'importe', 'vendedor', 'fecha_venta', 'importe_unitario', 'fecha_carga'], 'required'],
            [['idProducto', 'cantidad', 'vendedor', 'cliente', 'estado', 'tipo_venta', 'caracter', 'carga_venta', 'forma_pago'], 'integer'],
            [['fecha_venta', 'fecha_carga','movimiento'], 'safe'],
            [['importe', 'importe_unitario'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idProducto' => 'Id Producto',
            'cantidad' => 'Cantidad',
            'importe' => 'Importe',
            'vendedor' => 'Vendedor',
            'cliente' => 'Cliente',
            'fecha_venta' => 'Fecha Venta',
            'importe_unitario' => 'Importe Unitario',
            'estado' => 'Estado',
            'fecha_carga' => 'Fecha Carga',
            'tipo_venta' => 'Tipo Venta',
            'caracter' => 'Caracter',
            'carga_venta' => 'Carga Venta',
            'forma_pago' => 'Forma Pago',
            'movimiento' => 'Movimiento'
        ];
    }
}
