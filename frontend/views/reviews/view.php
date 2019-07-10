<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Files;
use frontend\components\ShortTag;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

//шорт теги
$this->title = ShortTag::cityTag($model->title);
$model->description = ShortTag::cityTag($model->description);
$model->name = ShortTag::cityTag($model->name);
$model->text = ShortTag::cityTag($model->text);

$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
	
	<div class="bank reviews-page">
					<div class="logo_bank">
						<?if ( $model->image ):?>
							<img src="<?=Files::getPath($model->image)?>" alt="<?=$model->name?>">
						<?endif;?>
					</div>

				
					<div class="text_block">
						<?=$model->text?>
					</div>

	</div>
