<?php
use yii\helpers\Html;
use backend\models\Files;
?>


					
					
						<div class="item">
							<div class="box">
								<div class="block">
									<div class="number"><?=$index?></div>
									
									<div class="ic_bank">
										<img src="<?=Files::getPath($model->banks->image)?>" alt="<?=$model['name']?>">
										<?=$model['name']?>
									</div>
									
								</div>
							</div>

							<div class="box">
								<div class="block">
									<div class="rate">от <?=$model['rate']?> % годовых</div>
								</div>
							</div>

							<div class="box">
								<div class="block">
									<div class="time">от <?=$model['min_term']?> до <?=$model['max_term']?> месяцев</div>
								</div>
							</div>

							<div class="box">
								<div class="block">
									 <?=$model['preview_text']?>	
								</div>
							</div>
						</div>