<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<br><br>
<br><br>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-center">Ro'yxatdan o'tish uchun quyidagi maydonlarni to'ldiring:</p>
<div class="container">
    <div class="row text-center">
        <div class="col-sm-4"></div>
        <div class="col-lg-4">
            <?php $form = ActiveForm::begin(['action' => 'signup','method' => 'post']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>


                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
</div>

