<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\components\ShortTag;

//шорт теги
$this->title = ShortTag::cityTag($model->title);
$model->description = ShortTag::cityTag($model->description);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);

$this->params['breadcrumbs'][] = $this->title;
?>

				<?=$model->text?>
						</div>
				</section>
				
				<?= $this->render('_contact_form', [
					'model' => $reqModel,
				]) ?>

