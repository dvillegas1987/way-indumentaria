<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property string $id
 * @property string $nombre
 * @property string $apellido
 * @property string $dni
 * @property string $domicilio
 * @property string $telefono
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'dni', 'domicilio', 'telefono'], 'required'],
            [['nombre', 'apellido', 'dni', 'domicilio', 'telefono'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'dni' => 'Dni',
            'domicilio' => 'Domicilio',
            'telefono' => 'Telefono',
        ];
    }
}
