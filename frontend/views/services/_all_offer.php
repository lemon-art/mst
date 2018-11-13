<?php
// YOUR_APP/views/list/_list_item.php
use backend\models\Files;
use yii\helpers\Html;
?>


					<div class="item">
						<div class="img">
							<a href="<?=$model['offerUrl'] ?>">
								<img src="<?=Files::getPath($model['image'])?>" alt="<?=$model['name'] ?>">
							</a>
						</div>

						<div class="box">
							<div class="name"><?=$model['name'] ?></div>

							<?=$model['preview_text'] ?>

							<div class="more">
								<a href="<?=$model['offerUrl'] ?>">Узнать подробнее</a>
							</div>
						</div>
					</div>