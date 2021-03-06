<?php

namespace backend\models;
use dektrium\user\models\User;
use Yii;


class Tools 
{
    
	
	public function numUpdate( $value ) {
		
			$tmp = htmlentities($value);
			$tmp = str_replace("&nbsp;",'',$tmp);
			$tmp = str_replace(" ",'',$tmp);
			$tmp = preg_replace('/\s/', '', $tmp);
			return $tmp;

	}
	
	public function numDisplay( $value ) {
		
		if ( $value ){
			$tmp = htmlentities($value);
			return number_format( (int)$tmp, 0, ' ', ' ');
		}
		else {
			return false;
		}

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
