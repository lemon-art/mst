<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Files;
/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

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
