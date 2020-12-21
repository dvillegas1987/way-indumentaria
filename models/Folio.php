<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "folio".
 *
 * @property string $idfolio
 * @property string $numero_folio
 */
class Folio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'folio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_folio'], 'required'],
            [['numero_folio'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idfolio' => 'Idfolio',
            'numero_folio' => 'Numero Folio',
        ];
    }
}
