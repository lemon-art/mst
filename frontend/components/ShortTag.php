<?php
/**
 * Created by PhpStorm.
 * User: serg
 */

namespace frontend\components;

use yii;
use yii\helpers\Html;
use yii\base\Model;
use frontend\components\CurrentCity;

class ShortTag extends Model
{
    public static function cityTag($text)
    {
        $city = CurrentCity::currentCity();
        
        $text = str_replace('{city}', $city['name'], $text);
        $text = str_replace('{city-gde}', $city['dec1'], $text);
        $text = str_replace('{city-kuda}', $city['dec2'], $text);
        $text = str_replace('{city-kakoi}', $city['dec3'], $text);
        $text = str_replace('{city-chego}', $city['dec4'], $text);
        
        return $text;
    }

}