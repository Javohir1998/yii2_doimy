<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'][] = $this->title;
?>
<br><br>
<br><br>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <p class="text-center">Tizimga kirish  uchun quyidagi maydonlarni to'ldiring:</p>
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-4"></div>
            <div class="col-lg-4">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <p>Ro‘yxatdan o‘tish <a href="<?=\yii\helpers\Url::to(["/site/signup"], true)?>">registration</a></p>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</div>
