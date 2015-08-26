<?php
namespace snapcms\mandrill\ui\models;

use Yii;
use yii\base\Model;

/**
 * Template form
 */
class Template extends Model
{
    public $slug;
    public $name;
    public $published_at;
    public $publish = true;
    //public $created_at;
    //public $updated_at;
    //public $publish_name;
    public $labels = [];
    
    public $text;
    public $code;
    public $subject;
    public $from_email;
    public $from_name;
    
    public $publish_text;
    public $publish_code;
    public $publish_subject;
    public $publish_from_email;
    public $publish_from_name;
    
    public $isNew = true;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name'], 'required'],
            [['slug', 'from_name', 'from_email', 'subject'], 'string', 'max' => 255],
            [['text', 'code'], 'safe'],
            [['from_email','publish_from_email'], 'email'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text' => Yii::t('snapcms', 'Text'),
            'code' => Yii::t('snapcms', 'HTML'),
        ];
    }

    public function save()
    {
        $mandrill = Yii::$app->mailer->mandrill;
        if($this->isNew)
        {
            $result = $mandrill->templates->add(
                $this->name, $this->from_email, $this->from_name, $this->subject, 
                $this->code, $this->text, $this->publish, $this->labels);
        }
        else
        {
            $result = $mandrill->templates->update(
                $this->name, $this->from_email, $this->from_name, $this->subject, 
                $this->code, $this->text, $this->publish, $this->labels);
        }
        return true;
    }
    
    public static function findOne($id)
    {
        $mandrill = Yii::$app->mailer->mandrill;
        $result = $mandrill->templates->info($id);
        $Template = new self();
        $Template->attributes = $result;
        $Template->isNew = false;
        return $Template;
    }
    
    public static function findAll()
    {
        $mandrill = Yii::$app->mailer->mandrill;
        $list = $mandrill->templates->getList();
        $Templates = [];
        foreach($list as $attrs)
        {
            $Template = new Template;
            $Template->attributes = $attrs;
            $Templates[] = $Template;
        }
        return $Templates;
    }
    
    public function delete()
    {
        $mandrill = Yii::$app->mailer->mandrill;
        $result = $mandrill->templates->delete($this->slug);
        return true;
    }
    
}
