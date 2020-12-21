<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ventas".
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
 * @property string $descuento_aplicado
 * @property string $folio
 * @property string $fecha_antigua
 * @property string $regalo
 */
class Regalo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ventas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProducto', 'cantidad', 'importe', 'vendedor', 'fecha_venta', 'importe_unitario', 'fecha_carga'], 'required'],
            [['idProducto', 'cantidad', 'vendedor', 'cliente', 'estado', 'tipo_venta', 'caracter', 'carga_venta', 'forma_pago', 'descuento_aplicado', 'folio'], 'integer'],
            [['fecha_venta', 'fecha_carga', 'fecha_antigua'], 'safe'],
            [['importe', 'importe_unitario'], 'string', 'max' => 45],
            [['regalo'], 'string', 'max' => 50],
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
            'descuento_aplicado' => 'Descuento Aplicado',
            'folio' => 'Folio',
            'fecha_antigua' => 'Fecha Antigua',
            'regalo' => 'Regalo',
        ];
    }
}
