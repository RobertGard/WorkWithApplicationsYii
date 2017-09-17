<?php
    namespace app\models;
     
    use Yii;
    use yii\base\Model;
    use app\models\User;
     
    /**
     * Signup form
     */
    class SignupForm extends Model
    {
     
        public $username;
        public $password;
     
        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                ['username', 'trim'],
                ['username', 'required'],
                ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
                ['username', 'string', 'min' => 2, 'max' => 255],
                ['password', 'required'],
                ['password', 'string', 'min' => 6],
            ];
        }
     
        /**
         * Signs user up.
         *
         * @return User|null the saved model or null if saving fails
         */
        public function signup()
        {
     
            if (!$this->validate()) {
                return null;
            }
     
            $user = new User();
            $user->username = $this->username;
            $user->password_hash = sha1($this->password);
            return $user->save() ? $user : null;
        }
     
    }
