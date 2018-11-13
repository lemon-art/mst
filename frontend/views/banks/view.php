<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Files;
/* @var $this yii\web\View */
/* @var $model app\models\Banks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Банки', 'url' => ['index']];
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
										<div class="box">
											<div class="text">
												<p>
													<b><?=$model->phone?></b>
												</p>
												
												<p><b>8 800 100-77-33</b> — для звонков юридических лиц с телефонов, зарегистрированных в регионах</p>
											</div>
										</div>

										<div class="box">
											<div class="text">
												<p><b>(495) 788-88-78</b> — для звонков частных лиц из Москвы и Московской обл.</p>
												
												<p><b>(495) 755-58-58</b> — для звонков юридических лиц из Москвы и Московской обл.</p>
											</div>
										</div>
									</div>
								</div>
							<?endif;?>
						</div>
					</div>
				</div>



	


