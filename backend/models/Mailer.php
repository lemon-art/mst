<?php
namespace backend\models;

use Yii;
use yii\base\Component;
use backend\models\Settings;

class Mailer extends Component
{
    public $viewPath = 'backend/views/mail';

    public $sender = 'mst-mwi@yandex.ru';

    public $mailerComponent;

    /** @var string */
    protected $welcomeSubject;

    /** @var string */
    protected $newPasswordSubject;

    /** @var string */
    protected $confirmationSubject;

    /** @var string */
    protected $reconfirmationSubject;

    /** @var string */
    protected $recoverySubject;

    /** @var \dektrium\user\Module */
    protected $module;

    

    /**
     * Sends an email to a user with recovery link.
     *
     * @param User  $user
     * @param Token $token
     *
     * @return bool
     */
    public function sendAdminOrderMessage( $subject, $model )
    {
	
		$admin_email = Settings::GetSettings()->admin_email;
	
        return Mailer::sendMessage(
            $admin_email,
            $subject,
            'AdminOrder',
            ['model' => $model]
        );
    }
	
	 public function sendAdminDebetMessage( $subject, $model )
    {
	
		$admin_email = Settings::GetSettings()->admin_email;
	
        return Mailer::sendMessage(
            $admin_email,
            $subject,
            'DebetOrder',
            ['model' => $model]
        );
    }
	
	public function sendUserOrderMessage( $subject, $model, $service )
    {
	
        return Mailer::sendMessage(
            $model->email,
            $subject,
            'UserOrder',
            ['model' => $model, 'service' => $service]
        );
    }
	


    /**
     * @param string $to
     * @param string $subject
     * @param string $view
     * @param array  $params
     *
     * @return bool
     */
    protected function sendMessage($to, $subject, $view, $params = [])
    {
        $mailer = Yii::$app->mailer;
        $mailer->viewPath = '@backend/views/mail';
        //$mailer->getView()->theme = Yii::$app->view->theme;

       

        return $mailer->compose(['html' => $view, 'text' => $view], $params)
            ->setTo($to)
            ->setFrom('mst-mwi@yandex.ru')
            ->setSubject($subject)
            ->send();
    }
}
