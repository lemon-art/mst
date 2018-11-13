<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>



		<section class="sectionMarg">
			<div class="cont">
				<!-- Боковая колонка -->
				<aside class="aside_left left">
					<div class="title ic_profile">Мой профиль <a href="/"></a></div>

					<div class="profile">
						<div class="name"><b>Петров</b> Иван Иванович</div>

						<div class="date">15.09.1977</div>
					
					<br><br>
						<?= Html::a(Yii::t('user', 'Logout'), ['/user/security/logout'], [
								'class'       => 'btn btn-danger btn-block',
								'data-method' => 'post'
						]) ?>
					</div>	
						
					
				</aside>
				<!-- End Боковая колонка -->
				

				<section class="section_center right">
					<div class="title_small">Мои заявки</div>

					<div class="accordion">
						<div class="item">
							<a href="#" class="open_sub">
								<div class="line_top">
									<div class="title">Заявка на Автокредит</div>

									<div class="more">Подробнее</div>
								</div>

								<div class="line_bottom">
									<div class="box">
										<div class="icon">
											<img src="images/ic_srok.svg" alt="">
										</div>

										<div class="name">Дата отправки:</div>

										<div class="text">05.08.2018</div>
									</div>

									<div class="box">
										<div class="icon">
											<img src="images/ic_money.svg" alt="">
										</div>

										<div class="name">Требуемая сумма:</div>

										<div class="text">300 000 рублей</div>
									</div>

									<div class="box">
										<div class="icon">
											<img src="images/ic_time.svg" alt="">
										</div>

										<div class="name">Срок кредитования:</div>

										<div class="text">24 месяца</div>
									</div>
								</div>
							</a>

							<div class="block_none on">
								<div class="table_request">
									<table>
										<thead>
											<tr>
												<th></th>
												<th>Предлогаемая ставка, %</th>
												<th>Ежемесячный платеж, руб.</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="td_img">
													<img src="images/partner4.png" alt="">
												</td>
												<td class="small" data-label="%">11.5</td>
												<td data-label="руб./мес.">25 238,25</td>
												<td class="td_more">
													<a href="/">Выбрать</a>
												</td>
											</tr>
											<tr>
												<td class="td_img">
													<img src="images/partner1.png" alt="">
												</td>
												<td class="small" data-label="%">11.5</td>
												<td data-label="руб./мес.">25 238,25</td>
												<td class="td_more">
													<a href="/bank.html">Выбрать</a>
												</td>
											</tr>
											<tr>
												<td class="td_img">
													<img src="images/partner2.png" alt="">
												</td>
												<td class="small" data-label="%">11.5</td>
												<td data-label="руб./мес.">25 238,25</td>
												<td class="td_more">
													<a href="/">Выбрать</a>
												</td>
											</tr>
											<tr>
												<td class="td_img">
													<img src="images/partner3.png" alt="">
												</td>
												<td class="small" data-label="%">11.5</td>
												<td data-label="руб./мес.">25 238,25</td>
												<td class="td_more">
													<a href="/">Выбрать</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="more_hide">Скрыть</div>
							</div>
						</div>

						<div class="item">
							<a href="#" class="open_sub active">
								<div class="line_top">
									<div class="title">Заявка на Автокредит</div>

									<div class="more">Скрыть</div>
								</div>

								<div class="line_bottom">
									<div class="box">
										<div class="icon">
											<img src="images/ic_srok.svg" alt="">
										</div>

										<div class="name">Дата отправки:</div>

										<div class="text">05.08.2018</div>
									</div>

									<div class="box">
										<div class="icon">
											<img src="images/ic_money.svg" alt="">
										</div>

										<div class="name">Требуемая сумма:</div>

										<div class="text">300 000 рублей</div>
									</div>

									<div class="box">
										<div class="icon">
											<img src="images/ic_time.svg" alt="">
										</div>

										<div class="name">Срок кредитования:</div>

										<div class="text">24 месяца</div>
									</div>
								</div>
							</a>

							<div class="block_none on" style="display: block;">
								<div class="table_request">
									<table>
										<thead>
											<tr>
												<th></th>
												<th>Предлогаемая ставка, %</th>
												<th>Ежемесячный платеж, руб.</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="td_img">
													<img src="images/partner4.png" alt="">
												</td>
												<td class="small" data-label="%">11.5</td>
												<td data-label="руб./мес.">25 238,25</td>
												<td class="td_more">
													<a href="/">Выбрать</a>
												</td>
											</tr>
											<tr>
												<td class="td_img">
													<img src="images/partner1.png" alt="">
												</td>
												<td class="small" data-label="%">11.5</td>
												<td data-label="руб./мес.">25 238,25</td>
												<td class="td_more">
													<a href="/bank.html">Выбрать</a>
												</td>
											</tr>
											<tr>
												<td class="td_img">
													<img src="images/partner2.png" alt="">
												</td>
												<td class="small" data-label="%">11.5</td>
												<td data-label="руб./мес.">25 238,25</td>
												<td class="td_more">
													<a href="/">Выбрать</a>
												</td>
											</tr>
											<tr>
												<td class="td_img">
													<img src="images/partner3.png" alt="">
												</td>
												<td class="small" data-label="%">11.5</td>
												<td data-label="руб./мес.">25 238,25</td>
												<td class="td_more">
													<a href="/">Выбрать</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="more_hide">Скрыть</div>
							</div>
						</div>
					</div>
				</section>
				<div class="clear"></div>
			</div>
		</section>