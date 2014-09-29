<?php

namespace snapcms\mandrill\ui;

class Module extends \snapcms\components\SnapCMSModule
{   
    public function init()
    {
        parent::init();
        $user = \Yii::$app->user;
        $this->primaryMenu = [
            ['label' => 'Mailer', 'url' => ['/mailer/default/index'], 
                'visible' => 
                    $user->can('Use Mailer') || 
                    $user->can('Update Mailer Templates'),
                'items' => [
                    ['label' => 'Templates', 'url' => ['/mailer/template/index'],
                        'visible' => $user->can('Update Mailer Templates')],
                    ['label' => 'Subscribers', 'url' => ['/mailer/default/subscribers'],
                        'visible' => $user->can('Use Mailer')],
                ],
            ],
        ];
    }
}