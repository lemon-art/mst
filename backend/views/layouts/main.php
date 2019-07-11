<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
	
	
	
		<?php $this->beginBody() ?>
		<div class="wrapper">

			<?php if ( !Yii::$app->user->isGuest): ?>
				
				<?if ( Yii::$app->user->identity->isAdmin): ?>
				
					<?= $this->render(
						'header.php',
						['directoryAsset' => $directoryAsset]
					) ?>

					<?= $this->render(
						'left.php',
						['directoryAsset' => $directoryAsset]
					)
					?>

					<?= $this->render(
						'content.php',
						['content' => $content, 'directoryAsset' => $directoryAsset]
					) ?>
				<?else:?>
					<?Yii::$app->user->logout();?>
					<?if ( Yii::$app->request->url !== '/admin/user/login' ):?>
						<?header('Location: /admin/user/login');?>
					<?endif;?>
				<?endif;?>
				
			<?else:?>
				
				<?if ( Yii::$app->request->url !== '/admin/user/login' ):?>
					<script>
						window.location.href = '/admin/user/login';
					</script>
				<?endif;?>
				
			<?endif;?>
		</div>


		<?php $this->endBody() ?>
		
	
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
