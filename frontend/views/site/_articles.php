<?php
// YOUR_APP/views/list/_list_item.php

use yii\helpers\Html;
?>




					<div class="article" data-key="<?= $model['id'] ?>">
						<div class="tag">#Депозиты</div>

						<div class="name">
							<a href="/"><?= Html::encode($model['name']); ?></a>
						</div>

						<div class="text"><?= Html::encode($model['preview_text']); ?></div>

						<div class="box">
							<div class="time">10.08.2018</div>

							<div class="more_all">
								<a href="/">Подробнее</a>
							</div>
						</div>
					</div>