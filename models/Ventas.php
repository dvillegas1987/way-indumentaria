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
 */
class Ventas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ventas';
    }

    public $categoria;
    public $codigo_laser;

    public $impagas;
    public $devuelve;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProducto', 'cantidad', 'importe', 'vendedor', /*'cliente',*/ 'fecha_venta', 'importe_unitario', 'estado', 'fecha_carga'], 'required'],
            [[ 'cantidad', 'vendedor', 'cliente', 'estado','categoria','tipo_venta','caracter','carga_venta','forma_pago','descuento_aplicado'], 'integer'],
            [['fecha_venta', 'fecha_carga','fecha_antigua'], 'safe'],
            [['idProducto','importe', 'importe_unitario','codigo_laser','regalo'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idProducto' => 'Producto',
            'cantidad' => 'Cantidad',
            'importe' => 'Importe',
            'vendedor' => 'Vendedor',
            'cliente' => 'Cliente',
            'fecha_venta' => 'Fecha Venta',
            'importe_unitario' => 'Importe Unitario',
            'estado' => 'Estado',
            'fecha_carga' => 'Fecha Carga',
            'categoria' => 'Categoría',
            'tipo_venta' => 'Tipo de venta',
            'caracter' => 'Carácter de la venta',
            'forma_pago' => 'Forma de pago',
            'descuento_aplicado' => 'Descuento aplicado',
            'regalo' => 'Regalo'


        ];
    }
}
