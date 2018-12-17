<?php
// YOUR_APP/views/list/_list_item.php
use backend\models\Files;
use yii\helpers\Html;
?>

					<div class="item">
						<div class="img">
							<?if ( $model['image'] ):?>
								<a href="#modal_call" class="modal_link">
									<?=Html::img(Files::getPath($model['image']));?>
								</a>
							<?endif;?>
						</div>

						<div class="box">
							<div class="name"><?=$model['name'] ?></div>
							
							<?=$model['preview_text'] ?>
	

							<div class="more">
								<a href="#modal_call" class="modal_link">Узнать подробнее</a>
							</div>
						</div>
					</div>