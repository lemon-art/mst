<?php
use yii\helpers\Html;
use backend\models\Files;
?>

				<div class="cont">
					<div class="img">
						
							<img src="<?=Files::getPath($model['image'])?>" alt="<?=$model['name'] ?>">
						
					</div>

					<div class="box">
						<div class="info">Суперпредложение</div>
						
						<div class="name"><?=$model['name'] ?></div>

						<?=$model['preview_text'] ?>

						<div class="more">
							<a href="#modal_call" class="modal_link">Узнать подробнее</a>
						</div>
					</div>
				</div>