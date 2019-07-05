<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Files;
use frontend\components\ShortTag;
/* @var $this yii\web\View */
/* @var $model app\models\Banks */

//шорт теги
$this->title = ShortTag::cityTag($model->title);
$model->description = ShortTag::cityTag($model->description);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);

$this->params['breadcrumbs'][] = $this->title;
?>



				<div class="bank">
					<div class="logo_bank">
						<img src="<?=Files::getPath($model->image)?>" alt="<?=$model->name?>">
					</div>

					<?if ( $model->link ):?>
						<div class="link_bank">
							<a href="<?=$model->link?>" target="_blank" rel="noopener"><?=$model->link?></a>
						</div>
					<?endif;?>
					
					<div class="text_block">
						<p>
							<?=$model->preview_text?>
						</p>
					</div>

					<div class="contact_bank">
						<div class="line_flex">
							
							<?/*
							<div class="item">
								<div class="title ic_license">Лицензия</div>

								<div class="text">
									<p>107078, г. Москва, ул. Каланчевская, д. 27</p>
								</div>
							</div>
							*/?>
							<?if ( $model->adress ):?>
								<div class="item">
									<div class="title ic_marker">Адрес</div>

									<div class="text">
										<p><?=$model->adress?></p>
									</div>
								</div>
							<?endif;?>

							<?if ( $model->phone ):?>
								<div class="item big">
									<div class="title ic_tel">Телефоны</div>
									
									<div class="block">
									
										<?=$model->phone?>
										
									</div>
								</div>
							<?endif;?>

							<?if ( $model->license ):?>
								<div class="item big">
									<div class="text_block">Лицензия</div>

									<div class="block">
										<?=$model->license?>
									</div>
								</div>
							<?endif;?>

							<?if ( $model->foundation_date ):?>
								<div class="item big">
									<div class="text_block">Дата основания</div>

									<div class="block">
										<?=$model->foundation_date?>
									</div>
								</div>
							<?endif;?>
							<h1>Адрес</h1>
							<h2>Адрес</h2>
							<h3>Адрес</h3>
							<h4>Адрес</h4>
						</div>
					</div>
				</div>



	


