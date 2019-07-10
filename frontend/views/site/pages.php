<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\components\ShortTag;

//шорт теги
$this->title = ShortTag::cityTag($model->title);
$model->description = ShortTag::cityTag($model->description);
$this->h1 = ShortTag::cityTag($model->h1);
$this->text = ShortTag::cityTag($model->text);

$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->params['breadcrumbs'][] = $this->title;
?>

				<?=$model->text?>
						</div>
				</section>
				
				<?= $this->render('_contact_form', [
					'model' => $reqModel,
				]) ?>

