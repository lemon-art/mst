<?php
use yii\helpers\Html;
use backend\models\Files;
?>

				<div class="cont">
					<div class="img">
						<a href="/">
							<img src="<?=Files::getPath($model['image'])?>" alt="<?=$model['name'] ?>">
						</a>
					</div>

					<div class="box">
						<div class="info">Суперпредложение</div>
						
						<div class="name"><?=$model['name'] ?></div>

						<?=$model['preview_text'] ?>

						<div class="more">
							<a href="/">Узнать подробнее</a>
						</div>
					</div>
				</div>