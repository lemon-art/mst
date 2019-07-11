<?php
// YOUR_APP/views/list/_list_item.php
use backend\models\Files;
use yii\helpers\Html;
use frontend\components\ShortTag;

$model['title_main'] = ShortTag::cityTag($model['title_main']);
$model['title_main'] = ShortTag::cityTag($model['preview_text_main']);
$model['title_main'] = ShortTag::cityTag($model['text_main']);
?>



					<a href="/services/<?=$model['code'] ?>" class="item">
						<div class="icon">
							<?=Html::img(Files::getPath($model['image']));?>
						</div>

						<div class="name"><?=$model['title_main'] ?></div>

						<div class="text"><?=$model['preview_text_main'] ?></div>

						<div class="text_abs">
							<?=$model['text_main'] ?>

						</div>
					</a>



					