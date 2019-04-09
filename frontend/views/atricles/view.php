<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Files;

/* @var $this yii\web\View */
/* @var $model app\models\Atricles */

if ( $model->title ){
	$this->title = $model->title;
}
else {
	$this->title = $model->name;
}
if ( $model->description ){
	$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
}
?>


	<div class="text_block">
		<?if ( $model->image ):?>
			<img src="<?=Files::getPath($model->image)?>" alt="<?=$model->name?>" class="left">
		<?endif;?>
		<?=$model->detail_text?>
	</div>



