<?php
/**
 * Created by PhpStorm.
 * User: serg
 */

namespace frontend\components;

use yii;
use yii\helpers\Html;
use yii\base\Model;
use backend\models\City;

class CurrentCity extends Model
{
    public static function currentCity()
    {
        //текущий город
        $subdomain = current(explode('.', $_SERVER['HTTP_HOST']));
        $city = array('name' => '', 'dec1' => '', 'dec2' => '', 'dec3' => '', 'dec4' => '');
        $rus = 'в России';
        if ($subdomain == 'dev' || $subdomain == 'marketvibor') {
            $city = array('name' => 'Россия', 'dec1' => 'в России', 'dec2' => 'в Россию', 'dec3' => 'Российский', 'dec4' => 'России');
        } else {
            $city = City::find()->where(['subdomain' => $subdomain])->one();
            $city = (array)$city;
            $city = current($city);
            if (!$city) {
                header('Location: http://marketvibor.ru'.Yii::$app->request->url);
                $city['dec1'] = $rus;
            }
        }
        return $city;
    }

}