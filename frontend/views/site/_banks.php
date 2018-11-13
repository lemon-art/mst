<?php
// YOUR_APP/views/list/_list_item.php
use backend\models\Files;
use yii\helpers\Html;
?>



					<div class="slide">
						<a href="/banks/<?=$model['code'] ?>">
							<img src="<?=Files::getPath($model['image'])?>" alt="<?=$model['name'] ?>">
						</a>
					</div>


					