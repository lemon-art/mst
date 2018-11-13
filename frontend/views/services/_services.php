<?php
use yii\helpers\Html;
use backend\models\Files;
?>

					<li>
						<a href="/specoffers/<?=$model['code'] ?>" <?if ($_GET['code'] == $model['code']):?>class="active"<?endif;?>>
							<span><?=$model['name'] ?></span>
						</a>
					</li>