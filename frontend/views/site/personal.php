<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>



		<section class="sectionMarg">
			<div class="cont">
				<!-- Боковая колонка -->
				<aside class="aside_left left">
					<div class="title ic_profile">Мой профиль <a href="/user/settings/profile"></a></div>

					<div class="profile">
						<div class="name"><b><?=$profileUser->last_name?></b> <?=$profileUser->name?> <?=$profileUser->second_name?></div>

						<div class="date"><?=$profileUser->display_bithday?></div>
					
						<br>
						<center><a href="/user/settings/account">Сменить пароль</a></center>
						<br>
						
						<?= Html::a(Yii::t('user', 'Logout'), ['/user/security/logout'], [
								'class'       => 'btn btn-danger btn-block',
								'data-method' => 'post'
						]) ?>
					</div>	
						
					
				</aside>
				<!-- End Боковая колонка -->
				

				<section class="section_center right">
					<div class="title_small">Мои заявки</div>

					
					<?
					echo ListView::widget([
						'dataProvider' => $ordersProvider,
						'itemView' => '_orders',
						'layout' => '{items}',
						'id'           => false,
						'options' => [
							'tag'=>'div',
							'class' => 'accordion'
						],
						'itemOptions' => [
						'tag' => false,
						],
						'viewParams' => [
						'fullView' => false,
						'context' => 'main-page',
						],
					]);
					?>
					
					
				</section>
				<div class="clear"></div>
			</div>
		</section>