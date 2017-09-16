<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SignupForm;
use app\models\LoginForm;

class SiteController extends Controller
{

    //Отображение главной страницы
    public function actionIndex(){
        return $this->render('index');
    }
 
    //Выход из системы
    public function actionLogout()
        {
            $session = Yii::$app->session;
        
            if($session->has('user_name'))
            {
                $session->remove('user_name');
                return $this->redirect(['login']);
            }
        }
 
    //Регистрация пользователей
     public function actionSignup()
    {
        $model = new SignupForm();
 
        if ($model->load(Yii::$app->request->post())) {
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
    $post_data = Yii::$app->request->post('LoginForm');
    
    if($login_model->load(Yii::$app->request->post())){//получение данных и post
        if ($user = $login_model->login($post_data)) {
            return $this->goHome();
        }
    }
        return $this->render('login',['login_model'=>$login_model]);
    }
    
}

