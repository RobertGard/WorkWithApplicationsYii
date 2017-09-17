<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Request;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RequestForm extends Model
{
    public $name_request;
    public $text_request;
    

    
    public function rules()
    {
        return [
            ['name_request', 'trim'],
            ['name_request', 'required'],
            ['name_request', 'unique', 'targetClass' => '\app\models\Request', 'message' => 'This username has already been taken.'],
            ['name_request', 'string', 'min' => 2, 'max' => 255],
            ['text_request', 'required'],
            ['text_request', 'string', 'min' => 6],
        ];
    }
        
    public function request($form_data){
    
        if (!$this->validate()) {
            return null;
        }
        
        $request = new Request();
        $request->name_request = $form_data['name_request'];
        $request->text_request = $form_data['text_request'];
        $request->auth_request = Yii::$app->session->get('user_name');
        return $request->save() ? $request : null;
    }
}
