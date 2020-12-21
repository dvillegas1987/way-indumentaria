<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class Devolucion extends Model
{
    public $cantidad;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['cantidad'], 'required'],
            // rememberMe must be a boolean value
            ['cantidad', 'integer'],
 
        ];
    }

   
}
