<?php
// YOUR_APP/views/list/_list_item.php
//use backend\models\Files;
use yii\helpers\Html;
use backend\models\Files;
?>


						<div class="item">
							<a href="#" class="open_sub">
								<div class="line_top">
									<div class="title">Заявка на <?=$model['services']['short_name'] ?></div>

									
								</div>
								
							<?	
								switch ( $model['service_id'] ) {
								case 1:?>
									
										<div class="line_bottom">
											<div class="box">
												<div class="icon">
													<img src="images/ic_srok.svg" alt="">
												</div>

												<div class="name">Дата отправки:</div>

												<div class="text"><?=$model['date'] ?></div>
											</div>

											<div class="box">
												<div class="icon">
													<img src="images/ic_money.svg" alt="">
												</div>

												<div class="name">Требуемая сумма:</div>
												<div class="text"><?=$model['kredit']['summ_display'] ?></div>
												
												
											</div>

											<div class="box">
												<div class="icon">
													<img src="images/ic_time.svg" alt="">
												</div>

												<div class="name">Срок кредитования:</div>

												<div class="text"><?=$model['kredit']['term_display'] ?></div>
											</div>
										</div>
									
									
									<?break;
									case 2:?>
									
										<div class="line_bottom">
											<div class="box">
												<div class="icon">
													<img src="images/ic_srok.svg" alt="">
												</div>

												<div class="name">Дата отправки:</div>

												<div class="text"><?=$model['date'] ?></div>
											</div>

											<div class="box">
												<div class="icon">
													<img src="images/ic_money.svg" alt="">
												</div>

												<div class="name">Стоимость недвижимости:</div>
												<div class="text"><?=$model['ipoteka']['summ_display'] ?></div>
												
												
											</div>

											<div class="box">
												<div class="icon">
													<img src="images/ic_time.svg" alt="">
												</div>

												<div class="name">Срок ипотеки:</div>

												<div class="text"><?=$model['ipoteka']['term_display'] ?></div>
											</div>
										</div>
									
									
									<?
									break;
									case 3:?>
									
										<div class="line_bottom">
											<div class="box">
												<div class="icon">
													<img src="images/ic_srok.svg" alt="">
												</div>

												<div class="name">Дата отправки:</div>

												<div class="text"><?=$model['date'] ?></div>
											</div>

											<div class="box">
												<div class="icon">
													<img src="images/ic_money.svg" alt="">
												</div>

												<div class="name">Сумма вклада:</div>
												<div class="text"><?=$model['debet']['summ_display'] ?></div>
												
												
											</div>

											<div class="box">
												<div class="icon">
													<img src="images/ic_time.svg" alt="">
												</div>

												<div class="name">Срок вклада:</div>

												<div class="text"><?=$model['debet']['term_display'] ?></div>
											</div>
										</div>
									
									
									<?
									break;
								case 4:?>
									
										<div class="line_bottom">
											<div class="box">
												<div class="icon">
													<img src="images/ic_srok.svg" alt="">
												</div>

												<div class="name">Дата отправки:</div>

												<div class="text"><?=$model['date'] ?></div>
											</div>

											<div class="box">
												<div class="icon">
													<img src="images/ic_money.svg" alt="">
												</div>

												<div class="name">Стоимость автомобиля:</div>
												<div class="text"><?=$model['avtokredit']['summ_display'] ?></div>
												
												
											</div>

											<div class="box">
												<div class="icon">
													<img src="images/ic_time.svg" alt="">
												</div>

												<div class="name">Срок кредитования:</div>

												<div class="text"><?=$model['avtokredit']['term_display'] ?></div>
											</div>
										</div>
									
									
									<?
									break;
									case 5:?>
									
										<div class="line_bottom">
											<div class="box">
												<div class="icon">
													<img src="images/ic_srok.svg" alt="">
												</div>

												<div class="name">Дата отправки:</div>

												<div class="text"><?=$model['date'] ?></div>
											</div>

											<div class="box">
												<div class="icon">
													<img src="images/ic_money.svg" alt="">
												</div>

												<div class="name">Желаемый кредитный лимит:</div>
												<div class="text"><?=$model['kreditKards']['summ_display'] ?></div>
												
												
											</div>

										</div>
									
									
									<?
									break;
									case 6:?>
									
										<div class="line_bottom">
											<div class="box">
												<div class="icon">
													<img src="images/ic_srok.svg" alt="">
												</div>

												<div class="name">Дата отправки:</div>

												<div class="text"><?=$model['date'] ?></div>
											</div>

											<div class="box">
												<div class="icon">
													<img src="images/ic_money.svg" alt="">
												</div>

												<div class="name">Покупки по карте в месяц:</div>
												<div class="text"><?=$model['debetCards']['summ_display'] ?></div>
												
												
											</div>

										</div>
									
									
									<?
									break;
								}
							?>	
								
							</a>
							<?if ( $model['apiEvents'] ):?>
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
												<?foreach ( $model['apiEvents'] as $arEvent ):?>
												
													<tr>
														<td class="td_img">
															<img src="<?=Files::getPath($model['banks']->image)?>" alt="<?=$model['banks']->name?>">
														</td>
														<td class="small" data-label="%"></td>
														<td data-label="руб./мес."></td>
														<td class="td_more">
															<?=$arEvent['status']?>
														</td>
													</tr>
													
												<?endforeach;?>
												
											</tbody>
										</table>
									</div>

									
								</div>
							<?endif;?>
						</div>