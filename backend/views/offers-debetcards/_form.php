<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Banks;
use mihaildev\ckeditor\CKEditor;
use backend\models\Files;

/* @var $this yii\web\View */
/* @var $model app\models\OffersDebetcards */
/* @var $form yii\widgets\ActiveForm */
if ($model->rate != null) {
    $model->rate = $model->rate / 100;
}
?>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="">
            <div class="offers-debetcards-form">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control']);?>

                <?= $form->field($model, 'activ')->checkbox(array('value'=>1, 'uncheckValue'=>0), ['maxlength' => true, 'class' => 'form-control']); ?>

                <?= $form->field($model, 'special')->checkbox(array('value'=>1, 'uncheckValue'=>0), ['maxlength' => true, 'class' => 'form-control']);?>

                <?= $form->field($model, 'main_page')->checkbox(array('value'=>1, 'uncheckValue'=>0), ['maxlength' => true, 'class' => 'form-control']);?>

                <?= $form->field($model, 'bank_id')->dropDownList(Banks::GetList(), ['maxlength' => true, 'class' => 'form-control']);?>

                <?= $form->field($model, 'rate')->textInput(['maxlength' => true, 'class' => 'form-control']);?>

                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

                <label><?=$model->getAttributeLabel('preview_text');?></label>
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
                
                
            
                <?= $form->field($model, 'residue')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'cash_back')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'maintenance_cost')->textInput(['maxlength' => true]) ?>
            
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
