<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
$this->title = 'Администрирование сайта';
?>


	<div class="row">
	
		<div class="col-md-8">
			<div class="box box-info">
				<div class="box-header with-border">
				  <h3 class="box-title">Последние заявки</h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div class="table-responsive">
					<table class="table no-margin">
					  <thead>
					  <tr>
						<th>Номер</th>
						<th>Дата</th>
						<th>Клиент</th>
						<th>Тип заявки</th>
						<th>Статус</th>
					  </tr>
					  </thead>
					  <tbody>
					  
						<?
						echo ListView::widget([
							'dataProvider' => $ordersProvider,
							'itemView' => '_orders',
							'layout' => '{items}',
							'id'           => false,
							'options' => [
								'tag'=>'div',
								'class' => 'amenities owl-carousel'
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
					  
					  
					  </tbody>
					</table>
				  </div>
				  <!-- /.table-responsive -->
				</div>
				<!-- /.box-body -->
				<div class="box-footer clearfix">

				  <a href="orders" class="btn btn-sm btn-default btn-flat pull-right">Все заявки</a>
				</div>
				<!-- /.box-footer -->
			</div>
		</div>
		<div class="col-md-4">
		
		
		</div>
	</div>