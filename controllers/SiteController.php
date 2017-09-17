<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    //Отображение главной страницы
    public function actionIndex(){
        return $this->render('index');
    }
    
}

