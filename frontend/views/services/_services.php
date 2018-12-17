<?php
use yii\helpers\Html;
use backend\models\Files;

if ( isset($_GET['code']) ){
	$curService = $_GET['code'];
}
else {
	$curService = '';
}
?>



					<li>
						<a href="/specoffers/<?=$model['code'] ?>" <?if ( $curService == $model['code']):?>class="active"<?endif;?>>
							<span><?=$model['name'] ?></span>
						</a>
					</li>