<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dektrium\user\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\components\CurrentCity;
use yii\helpers\Url;
use app\models\Atricles;
use app\models\AtriclesSearch;
use app\models\Services;
use app\models\ServicesSearch;
use app\models\Banks;
use app\models\BanksSearch;
use app\models\OffersSearch;
use app\models\OrdersSearch;
use app\models\Reviews;
use app\models\ReviewsSearch;
use app\models\Request;
use app\models\RequestPartners;
use app\models\Pages;
use backend\models\Search;
use dektrium\user\models\Profile;
use backend\models\Mailer;
use yii\web\NotFoundHttpException;
use common\models\CuiteCrm;

class CreditController extends Controller
{
    public function actionIndex()
    {
        $model = Services::findOne(['code' => 1]);
        if ( !$model )
            throw new NotFoundHttpException;

        $offersModel    = new OffersSearch();
        $offersProvider = $offersModel->searchByService(1);


        return $this->render('index', [
            'model' => $model,
            'offersProvider' => $offersProvider,
            //'code_credit_filter' => $code
        ]);
        //return $this->render('about');
    }
    
}