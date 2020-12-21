<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viaje".
 *
 * @property string $idviaje
 * @property string $pasajes
 * @property string $hospedaje
 * @property string $comestibles
 */
class Viaje extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viaje';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pasajes', 'hospedaje', 'comestibles'], 'required'],
            [['pasajes', 'hospedaje', 'comestibles'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idviaje' => 'Idviaje',
            'pasajes' => 'Pasajes',
            'hospedaje' => 'Hospedaje',
            'comestibles' => 'Comestibles',
        ];
    }
}
