<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $model->h1;
$this->params['breadcrumbs'][] = $this->title;
?>

				<?=$model->text?>
						</div>
				</section>
				
				<?= $this->render('_contact_form', [
					'model' => $reqModel,
				]) ?>

