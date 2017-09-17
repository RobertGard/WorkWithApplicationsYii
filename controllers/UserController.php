<?php 
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SignupForm;
use app\models\LoginForm;

class UserController extends Controller
{

//Выход из системы
    public function actionLogout()
        {
            $session = Yii::$app->session;
            //Если в сессии есть пользователь
            if($session->has('user_name'))
            {
                //удаляем данную сессию
                $session->remove('user_name');
                //Перенаправляем 
                return $this->redirect(['login']);
            }
        }
 
    //Регистрация пользователей
     public function actionSignup()
    {
        $model = new SignupForm();
        //Если данные post получены
        if ($model->load(Yii::$app->request->post())) {
            //Производим регистрацию
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()) {
                    return $this->goHome();
                }
            }
        }
 
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    
    //Авторизация пользователей
    public function actionLogin (){
        
    $login_model = new LoginForm();
    //Получем данные post 
    $post_data = Yii::$app->request->post('LoginForm');
    
    if($login_model->load(Yii::$app->request->post())){//получение данных post
        if ($user = $login_model->login($post_data)) {//Производим авторизацию
            return $this->goHome();//Возвращаеи домой
        }
    }
    //Вывод
        return $this->render('login',['login_model'=>$login_model]);
    }

}
