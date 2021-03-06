    <?php
     
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
     
    $this->title = 'Login';
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    <div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Please fill out the following fields to signup:</p>
        <div class="row">
            <div class="col-lg-5">
     
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                    <?= $form->field($login_model, 'username')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($login_model, 'password')->passwordInput() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
     
            </div>
        </div>
    </div> 
