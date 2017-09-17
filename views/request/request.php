    <?php
     
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
     
    $this->title = 'Создать заявку';
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    <div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Ведите данные запроса:</p>
        <div class="row">
            <div class="col-lg-5">
     
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                    <?= $form->field($request_model, 'name_request')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($request_model, 'text_request')->textInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
     
            </div>
        </div>
    </div> 
