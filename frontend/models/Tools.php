<?php

namespace app\models;
use dektrium\user\models\User;
use Yii;


class Tools 
{
    
	
	public function numUpdate( $value ) {
		
		$arValue = explode('|', $value);
		$value = $arValue[0];
		$tmp = htmlentities($value);
		return str_replace("&nbsp;",'',$tmp);

	}
	
	
	public function true_wordform($num, $form_for_1, $form_for_2, $form_for_5){
	
		$num = abs($num) % 100; // берем число по модулю и сбрасываем сотни (делим на 100, а остаток присваиваем переменной $num)
		$num_x = $num % 10; // сбрасываем десятки и записываем в новую переменную
		if ($num > 10 && $num < 20) // если число принадлежит отрезку [11;19]
			return $form_for_5;
		if ($num_x > 1 && $num_x < 5) // иначе если число оканчивается на 2,3,4
			return $form_for_2;
		if ($num_x == 1) // иначе если оканчивается на 1
			return $form_for_1;
		return $form_for_5;
	}

   
}
