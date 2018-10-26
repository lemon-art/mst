<?
// ���������� ������������ ����
namespace app\components;
// ����������� ����� Windget � Html ������
use yii\base\Widget;
use yii\helpers\Html;
// ��������� ����� Widget
class TranslitWidget extends Widget
{
    public $url;
    // ������� ��������� ������������ ��������
    public function init(){
        parent::init();
            // ������������� ��������� 
            mb_http_input('UTF-8');
            mb_http_output('UTF-8');
            mb_internal_encoding("UTF-8");
            
            $this->url = (string )$this->url; // ����������� � ��������� ��������
            $this->url = strip_tags($this->url); // ������� HTML-����
            $this->url = str_replace(array("\n", "\r"), " ", $this->url); // ������� ������� �������
            $this->url = preg_replace("/\s+/", ' ', $this->url); // ������� ����������� �������
            $this->url = trim($this->url); // ������� ������� � ������ � ����� ������
                        
            $this->url = function_exists('mb_strtolower') ? mb_strtolower($this->url) : strtolower($this->url); // ��������� ������ � ������ ������� (������ ���� ������ ������)
            $this->url = strtr($this->url, array('�' => 'a','�' => 'b','�' => 'v','�' => 'g','�' => 'd','�' => 'e','�' => 'e','�' => 'j','�' => 'z','�' => 'i','�' => 'y','�' => 'k',
                '�' => 'l','�' => 'm','�' => 'n','�' => 'o','�' => 'p','�' => 'r','�' => 's','�' => 't','�' => 'u','�' => 'f','�' => 'h','�' => 'c','�' => 'ch','�' => 'sh','�' => 'shch',
                '�' => 'y','�' => 'e','�' => 'yu','�' => 'ya','�' => '','�' => ''));
            $this->url = preg_replace("/[^0-9a-z-_ ]/i", "", $this->url); // ������� ������ �� ������������ ��������
            $this->url = str_replace(" ", "-", $this->url); // �������� ������� ������ �����
    }
    // ���������� ���������
    public function run(){
        return Html::encode($this->url);
    }
}
?>