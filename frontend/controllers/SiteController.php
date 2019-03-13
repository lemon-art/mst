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
use yii\helpers\Url;
use app\models\AtriclesSearch;
use app\models\ServicesSearch;
use app\models\BanksSearch;
use app\models\OffersSearch;
use app\models\OrdersSearch;
use app\models\ReviewsSearch;
use app\models\Request;
use app\models\RequestPartners;
use app\models\Pages;
use backend\models\Search;
use dektrium\user\models\Profile;
use backend\models\Mailer;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
	
		$articlesModel = new AtriclesSearch();
		$servicesModel = new ServicesSearch();
		$banksModel    = new BanksSearch();
		$offersModel   = new OffersSearch();
		$reviewsModel  = new ReviewsSearch();
		$reqModel 	   = new Request();
		
			$articlesProvider   = $articlesModel->search();
			$servicesProvider   = $servicesModel->search();
			$banksProvider      = $banksModel->search();
			$reviewsProvider    = $reviewsModel->search();
			$bestOffersProvider = $offersModel -> searchMainSpecial();
		
			if ($reqModel->load(Yii::$app->request->post())) {
				
				if ( $reqModel->type == 'indexPage' ){
					if ( $reqModel->save()){
						Mailer::sendCallbackMessage( 'Заявка с сайта (обратная связь) ', $reqModel );
						Yii::$app->session->setFlash('requestFormSubmitted');
					}
					else {
						Yii::$app->session->setFlash('requestFormFalse');
					}
				}
			}


		
		return $this->render('index', [
			'articlesProvider'   => $articlesProvider,
			'servicesProvider'   => $servicesProvider,
			'banksProvider'      => $banksProvider,
			'reqModel'    	     => $reqModel,
			'bestOffersProvider' => $bestOffersProvider,
			'reviewsProvider'    => $reviewsProvider
		]);
    

    }
	
	
	public function actionPersonal()
    {
		if (Yii::$app->user->isGuest){
			
			//return Yii::$app->getResponse()->redirect(array(Url::to(['/user/login'],302)));
			Yii::$app->user->loginUrl = ['user/login', 'return' => \Yii::$app->request->url];
			return $this->redirect(Yii::$app->user->loginUrl)->send();
		}
		else {
			$user_id = Yii::$app->user->identity->id;
			$profileUser = Profile::find()->where(['user_id' => $user_id])->one();
			
			$ordersModel    = new OrdersSearch();
			$ordersProvider = $ordersModel->searchUserOrders();
			
			

			return $this->render('personal', [
				'profileUser' => $profileUser,
				'ordersProvider' => $ordersProvider,
			]);
		}
    

    }
	

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
	
	
	public function actionTest()
    {
		
	
		
		return $this->render('test', [
           // 'model' => $output,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
	public function actionPages( $action )
    {
		$model = Pages::find()->where(['code' => $action])->one();

		if ( !$model )
			throw new NotFoundHttpException;


			
		if ( $action == 'terms_of_cooperation' || $action == 'terms_of_banks' || $action == 2 || $action == 3){
			$reqModel 	   = new RequestPartners();
			$mailSubject = 'Заявка с сайта (обратная связь) ';
		}
		else {
			$reqModel 	   = new Request();
			$mailSubject = 'Заявка с сайта (сотрудничество) ';
		}
		
		if ($reqModel->load(Yii::$app->request->post())) {
				
			    $reqModel->type = $action;
				if ( $reqModel->save()){
					Yii::$app->session->setFlash('requestFormSubmitted');
						Mailer::sendCallbackMessage( $mailSubject, $reqModel );
					}
				else {
					Yii::$app->session->setFlash('requestFormFalse');
				}
			
		}
		
		if ( $model ){
			return $this->render('pages', [
				'model' => $model,
				'reqModel' => $reqModel
			]);
		}
		else {
			return $this->render('error');
		}

    } 
	 
	 
	/** 
    public function actionAbout()
    {
        return $this->render('about');
    }

    
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
	
	public function actionSearch() {
        
		$q = Yii::$app->request->get('q');
		
		$offersModel    = new OffersSearch();
		$offersProvider = $offersModel->searchSearch( $q );

		$searchProvider = Search::GetSearchResult( $q );
		
		 return $this->render('search', [
            'q' => $q,
			'offersProvider'  => $offersProvider,
			'searchProvider' => $searchProvider,
        ]);
		
		/*
		$query = Extrime::find()->where(['like', 'title', $q]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('search',compact('post','models','q','cat','friend'));
        */
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
