<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Files;
/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

$this->title = 'Отзыв ' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>
	
	<div class="bank">
					<div class="logo_bank">
						<?if ( $model->image ):?>
							<img src="<?=Files::getPath($model->image)?>" alt="<?=$model->name?>">
						<?endif;?>
					</div>

					<div class="link_bank">
						<p><b>Автор отзыва:</b> <?=$model->name?></p>
					</div>
					
					<div class="text_block">
						<?=$model->text?>
					</div>

	</div>
