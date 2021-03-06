<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\RecoveryForm $model
 */

$this->title = Yii::t('user', 'Recover your password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
         <div class="form">
          
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'password-recovery-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>
				<div class="line_form">
					<?= $form->field($model, 'email')->textInput(['placeholder' => 'Электронная почта', 'class' => 'input'])->label('Электронная почта') ?>
				</div>
				 
				<div class="submit">
					<?= Html::submitButton(Yii::t('user', 'Continue'), ['class' => 'submit_btn']) ?>
				</div> 


                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
