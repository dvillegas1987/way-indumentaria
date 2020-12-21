<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vendedores".
 *
 * @property string $id
 * @property string $nombre
 * @property string $apellido
 * @property string $dni
 * @property string $domicilio
 * @property string $email
 * @property string $localidad
 * @property string $garante
 * @property string $adjunto
 *
 * @property ProductosAsignados[] $productosAsignados
 */
class Vendedor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendedores';
    }
    public $a1;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido'/*, 'dni','dni_garante', 'domicilio', 'localidad', 'garante','ape_garante','nom_garante','domicilio_garante'*/], 'required'],
            [['dni','dni_garante'], 'integer'],
            [['adjunto'], 'string'],
            [['nombre', 'apellido','telefono','telefono_garante','ape_garante','nom_garante'], 'string', 'max' => 45],
            [['domicilio','domicilio_garante', 'localidad'/*, 'garante'*/], 'string', 'max' => 100],
            [['email','email_garante'], 'string', 'max' => 200],
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
            'email' => 'Email',
            'localidad' => 'Localidad',
            //'garante' => 'Garante',
            'adjunto' => 'Adjunto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductosAsignados()
    {
        return $this->hasMany(ProductosAsignados::className(), ['vendedor' => 'id']);
    }
}
