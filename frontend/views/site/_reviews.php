<?php
// YOUR_APP/views/list/_list_item.php
use backend\models\Files;
use frontend\components\ShortTag;
use yii\helpers\Html;

$model['name'] = ShortTag::cityTag($model['name']);
$model['preview_text'] = ShortTag::cityTag($model['preview_text']);
?>


					<div class="comment">
						<div class="user">
							<div class="foto">
								<?if ( $model['image'] ):?>
									<img src="<?=Files::getPath($model['image'])?>" alt="<?=$model['name'] ?>">
								<?endif;?>
							</div>

							<div class="name"><?=$model['name'] ?></div>
						</div>

						<div class="text"><?=$model['preview_text'] ?> <a href="<?=$model['detailUrl']?>" class="more">Читать далее</a></div>
					</div>