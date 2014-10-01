<?php

namespace snapcms\mandrill\ui;

class Module extends \snapcms\components\SnapCMSModule
{   
    public static $primaryMenu = [];
    public static $secondaryMenu = [];
    
    public function init()
    {
        parent::init();
        $user = \Yii::$app->user;
        static::$primaryMenu = [
            'mailer' => ['label' => 'Mailer', 'url' => ['/mailer/default/index'], 
                'visible' => 
                    $user->can('Use Mailer') || 
                    $user->can('Update Mailer Templates'),
                'items' => [
                    'templates' => ['label' => 'Templates', 'url' => ['/mailer/template/index'],
                        'visible' => $user->can('Update Mailer Templates')
                    ],
                    'subscribers' => ['label' => 'Subscribers', 'url' => ['/mailer/default/subscribers'],
                        'visible' => $user->can('Use Mailer')
                    ],
                ],
            ],
        ];
    }
}