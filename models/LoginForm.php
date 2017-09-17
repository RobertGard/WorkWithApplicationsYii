<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;


    /**
     *Проверка валидации
     * @return array the validation rules.
     */
    public function rules()
    {
        return [ 
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Поиск пользователя по его username
     *
     * @return User|null
     */
    public function getUser()
    {
        return User::findOne(['username'=>$this->username]);
    }
    
    
    /**
     * Проверка на существование пользователя в бд
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if(!$this->hasErrors()) // если нет ошибок в валидации
        {
            $user = $this->getUser();

            if (!$user || ($user->password_hash != sha1($this->password))) {
                //если мы НЕ нашли в базе такого пользователя
                //или введенный пароль и пароль пользователя в базе НЕ равны ТО,
                $this->addError($attribute, 'Данные введены не верно !');
                 //добавляем новую ошибку для атрибута password о том что пароль или имейл введены не верно
            }
        }
        
    }

    /**
     * Добавление в сессию
     * @return bool whether the user is logged in successfully
     */
    public function login($post_data)
    {
        if ($this->validate()) {
            $session = Yii::$app->session;
            $session->set('user_name',$post_data['username']);
            if($session->has('user_name')){
                return true; 
            }
        }
    }
}
