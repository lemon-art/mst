<?php
/**
 * Created by PhpStorm.
 * User: serg
 * Date: 27.06.2019
 * Time: 15:09
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
        $city = '';
        $rus = 'в России';
        if ($subdomain == 'dev' || $subdomain == 'marketvibor') {
            $city['dec1'] = $rus;
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