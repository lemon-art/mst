<?php
use yii\helpers\Html;
?> 

<p>Поля заявки:</p>

<p><b>Имя</b>: <?=$model->name?></p>
<p><b>Фамилия</b>: <?=$model->last_name?></p>
<p><b>Отчество</b>: <?=$model->second_name?></p>
<p><b>Телефон</b>: <?=$model->phone?></p>
<p><b>Email</b>: <?=$model->email?></p>
<p><b>Стоимость автомобиля</b>: <?=$model->summ?></p>
<p><b>Первоначальный взнос</b>: <?=$model->first_payment?></p>
<p><b>Уровень дохода</b>: <?=$model->income?></p>
<p><b>Подтверждение дохода</b>: <?=$model->confirmation_income?></p>
<p><b>Состояние</b>: <?=$model->condition?></p>
<p><b>Тип транспорта</b>: <?=$model->type?></p>
<p><b>На какой срок (месяцев)</b>: <?=$model->term?></p>
