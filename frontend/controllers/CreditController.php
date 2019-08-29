<?php
namespace frontend\controllers;

use backend\models\CreditFilter;
use Yii;
use app\models\Services;
use app\models\ServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OffersCreditSearch;
use frontend\components\ShortTag;

class CreditController extends Controller
{

    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionView($code)
    {

        $model = Services::findOne(['code' => 'credit']);
        if ( !$model )
            throw new NotFoundHttpException;

        $filter = CreditFilter::findOne(['code' => $code]);
        if ( !$filter )
            throw new NotFoundHttpException;

        $offersModel    = new OffersCreditSearch();
        $offersProvider = $offersModel->searchByService();
        $often_seek = CreditFilter::find()->all();

        //информация из фильтра
        if ($filter->name) {
            $model->name = $filter->name;
        }
        if ($filter->top_text) {
            $model->top_text = $filter->top_text;
        }
        if ($filter->title) {
            $model->title = $filter->title;
        }
        if ($filter->description) {
            $model->description = $filter->description;
        }
        if ($filter->seo_text) {
            $model->seo_text_preview = $filter->seo_text;
        }
        
        //шорт теги
        $model->title = ShortTag::cityTag($model->title);
        $model->description = ShortTag::cityTag($model->description);
        $model->name = ShortTag::cityTag($model->name);
        $model->top_text = ShortTag::cityTag($model->top_text);
        $model->text_main = ShortTag::cityTag($model->text_main);
        $model->scheme = ShortTag::cityTag($model->scheme);
        $model->advantages = ShortTag::cityTag($model->advantages);
        $model->short_name = ShortTag::cityTag($model->short_name);
        $model->title_main = ShortTag::cityTag($model->title_main);
        $model->preview_text_main = ShortTag::cityTag($model->preview_text_main);
        $model->text_main_title = ShortTag::cityTag($model->text_main_title);
        $model->text_main_text = ShortTag::cityTag($model->text_main_text);
        $model->seo_text_preview = ShortTag::cityTag($model->seo_text_preview);
        $model->seo_text_detail = ShortTag::cityTag($model->seo_text_detail);
        
        return $this->render('view', [
            'model' => $model,
            'offersProvider' => $offersProvider,
            'often_seek' => $often_seek,
            'filter' => $filter
        ]);
    }
}