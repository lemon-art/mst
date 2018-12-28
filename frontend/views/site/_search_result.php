<?php
// YOUR_APP/views/list/_list_item.php
use yii\helpers\Html;

//это пока временно
$q = Yii::$app->request->get('q');
$model['text'] = strip_tags($model['text']);
$pos = strpos($model['text'], $q);
if ($pos > 100 ){
	$start = $pos - 100;
	$text = '...' . substr($model['text'], $start, 200) . '...';
}
else {
	$start = 0;
	$text = substr($model['text'], $start, 200) . '...';
}

$text = str_replace($q, '<b>'.$q.'</b>', $text);


?>

					<div class="search_item">

						<div class="name">
							<a href="<?=$model['url']?>"><?=$model['name']?></a>
						</div>
						<div class="text">
							<?=$text?>
						</div>
					</div>