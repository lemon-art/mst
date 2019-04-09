<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\date\DatePicker;
use dosamigos\fileupload\FileUpload;
use backend\models\Files;
use mihaildev\elfinder\ElFinder;
/* @var $this yii\web\View */
/* @var $model app\models\Atricles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atricles-form">
	<?php $form = ActiveForm::begin([
		'options' => ['enctype' => 'multipart/form-data']
		]); 
	?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'date')->widget(DatePicker::className(),[
		'value' => date('Y-m-d'),
		'options' => ['placeholder' => 'Select issue date ...'],
		'pluginOptions' => [
			'format' => 'yyyy-mm-dd',
			'todayHighlight' => true
		]
	]);?>
	
	
	<div class="form-group">
		<label for="exampleInputEmail1"><?=$model->getAttributeLabel('image');?></label>
		<br>
		<?if ( $model->image ):?>
			<?=Html::img(Files::getPath($model->image),[
				'style' => 'width:150px;'
			]);?>
			<br><br>
		<?endif;?>
							
		<?= $form->field($model, 'image')->fileInput()->label(false);?>
	</div>	
	
	

    <?= $form->field($model, 'preview_text')->textarea(['rows' => 6]) ?>
	
	
	
	<div class="form-group">
		<label for="exampleInputEmail1"><?=$model->getAttributeLabel('detail_text');?></label>
		<?=  $form->field($model, 'detail_text')->widget(CKEditor::className(),[
			'editorOptions' => ElFinder::ckeditorOptions('elfinder'),
		])->label(false);?>
	</div>
	
	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?
$js = <<< JS


$(document).ready(function(){

	function translit() {
		var str = $('#atricles-name').val();
		var space = '-';
		var link = '';
		var transl = {
			'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
			'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
			'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
			'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': space,
			'ы': 'y', 'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya'
		}
	if (str != '')
		str = str.toLowerCase();
	 
	for (var i = 0; i < str.length; i++){
		if (/[а-яё]/.test(str.charAt(i))){ // заменяем символы на русском
			link += transl[str.charAt(i)];
		} else if (/[a-z0-9]/.test(str.charAt(i))){ // символы на анг. оставляем как есть
			link += str.charAt(i);
		} else {
			if (link.slice(-1) !== space) link += space; // прочие символы заменяем на space
		}
	}

		$('#atricles-code').val(link); 
	}              
					

    $('#atricles-name').keyup(function(){
         translit();
         return false;
    });


});


JS;


$this->registerJs($js);
?>

