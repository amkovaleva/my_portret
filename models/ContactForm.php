<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $phone;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'body'], 'required'],
            ['email', 'email'],
            ['phone', 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        $lan_dir = 'app/contacts';
        return [
            'name' => Yii::t($lan_dir, 'name'),
            'email' => Yii::t($lan_dir, 'email'),
            'body' => Yii::t($lan_dir, 'body'),
            'phone' => Yii::t($lan_dir, 'phone'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject(Yii::t('app/contacts', 'email_subject'))
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
