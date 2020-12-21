<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temperatura".
 *
 * @property string $idtemperatura
 * @property string $fecha_hora
 * @property string $distorsion
 * @property string $voltaje
 * @property string $temperatura
 */
class Temperatura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temperatura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_hora', 'distorsion', 'voltaje', 'temperatura'], 'required'],
            [['fecha_hora'], 'safe'],
            [['distorsion', 'voltaje', 'temperatura'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtemperatura' => 'Idtemperatura',
            'fecha_hora' => 'Fecha Hora',
            'distorsion' => 'Distorsion',
            'voltaje' => 'Voltaje',
            'temperatura' => 'Temperatura',
        ];
    }
}
