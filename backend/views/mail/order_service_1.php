<?php
use yii\helpers\Html;
?> 

<p>Поля заявки:</p>

<p><b>Имя</b>: <?=$model->name?></p>
<p><b>Фамилия</b>: <?=$model->last_name?></p>
<p><b>Отчество</b>: <?=$model->second_name?></p>
<p><b>Телефон</b>: <?=$model->phone?></p>
<p><b>Email</b>: <?=$model->email?></p>
<p><b>Сумма кредита</b>: <?=$model->summ?></p>
<p><b>На какой срок (месяцев)</b>: <?=$model->term?></p>
<p><b>Город получения</b>: <?=$model->city?></p>
<p><b>Тип занятости</b>: <?=$model->employment?></p>
<p><b>Начало работы на последнем месте</b>: <?=$model->work_month?>/<?=$model->work_year?></p>
<p><b>Ежемесячный доход</b>: <?=$model->income?></p>


