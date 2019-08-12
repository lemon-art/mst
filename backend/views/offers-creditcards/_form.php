<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Banks;
use mihaildev\ckeditor\CKEditor;
use backend\models\Files;

/* @var $this yii\web\View */
/* @var $model app\models\OffersCreditcards */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="offers-creditcards-form">
               
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control']);?>

                <?= $form->field($model, 'activ')->checkbox(array('value'=>1, 'uncheckValue'=>0), ['maxlength' => true, 'class' => 'form-control']); ?>

                <?= $form->field($model, 'special')->checkbox(array('value'=>1, 'uncheckValue'=>0), ['maxlength' => true, 'class' => 'form-control']);?>

                <?= $form->field($model, 'main_page')->checkbox(array('value'=>1, 'uncheckValue'=>0), ['maxlength' => true, 'class' => 'form-control']);?>

                <?= $form->field($model, 'bank_id')->dropDownList(Banks::GetList(), ['maxlength' => true, 'class' => 'form-control']);?>

                <?= $form->field($model, 'rate')->textInput(['maxlength' => true, 'class' => 'form-control']);?>

                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

                <?=  $form->field($model, 'preview_text')->widget(CKEditor::className(),[
                    'editorOptions' => [
                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                    ],
                ])->label(false);?>

                <label for="exampleInputEmail1"><?=$model->getAttributeLabel('image');?></label>
                <br>
                <?if ( $model->image ):?>
                    <?=Html::img(Files::getPath($model->image),[
                        'style' => 'width:150px;'
                    ]);?>
                    <br><br>
                <?endif;?>

                <?= $form->field($model, 'image')->fileInput()->label(false);?>

                <?= $form->field($model, 'sort')->textInput(['maxlength' => true])->dropDownList([
                    '0' => 'Низкий',
                    '1' => 'Средний',
                    '2' => 'Высокий'
                ]); ?>
                
                
            
                <?= $form->field($model, 'grace_period')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'min_summ_kreditcard')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'max_summ_kreditcard')->textInput(['maxlength' => true]) ?>
            
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>