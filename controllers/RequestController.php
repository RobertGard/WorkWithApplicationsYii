<?php 
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RequestForm;
use app\models\Request;

class RequestController extends Controller
{ 

    //Отправка заявки
    public function actionRequest(){
    
    $request_model = new RequestForm();
    //Получаем данные пост
    $form_data = Yii::$app->request->post('RequestForm');
    
    if($request_model->load(Yii::$app->request->post())){//получение данных post
            //передаём данные на сохранение
            if ($request_model->request($form_data)) {
            
            }
        
    }
    //Вывод
    return $this->render('request',['request_model'=>$request_model]);
    }
    
    //Вывод заявок для юзера
    public function actionListuser(){
        $user_name = Yii::$app->session->get('user_name');
        $record = Request::find()->where(['auth_request'=>$user_name])->all();
    
        return $this->render('list',['record'=>$record]);
    }
    
    //Вывод подробной информации
    public function actionDetailed(){
    //Получение id  записи get способом
    $idRecord = Yii::$app->request->get('id');
    //Выборка подробной информации по id 
    $record = Request::find()->where(['id'=>$idRecord])->all();
    //Вывод
    return $this->render('detailed',['record'=>$record]);
    }
    
    //Вывод заявок для админа 
    public function actionListadmin(){
        //Получаем имя пользователя
        $user_name = Yii::$app->session->get('user_name');
        // если это админ, то получаем все записи из бд
        if($user_name == 'admin'){
        $record = Request::find()->all();
        }
        //Вывод
        return $this->render('list',['record'=>$record]);
    }
    //Меняем статуз запросов
    public function actionDecision(){
        //Получаем данные get
        $record_data = Yii::$app->request->get();
        //ищем нужную запиь в бд
        $record = Request::find()->where(['id' => $record_data['id']])->one();
        //изменяем status
        $record->status = $record_data['status'];
        //Если сохранение произошло , переадресум на
        // предидущую страницу
        if($record->save()){
            return $this->redirect(Yii::$app->request->referrer);
        }   
    }
}
