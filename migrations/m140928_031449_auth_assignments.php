<?php

use yii\db\Schema;
use yii\db\Migration;

class m140928_031449_auth_assignments extends Migration
{
    public function up()
    {
        $auth=Yii::$app->authManager;

        $useMailer = $auth->createPermission("Use Mailer");
        $useMailer->description = "Send emails through the admin interface";
        $auth->add($useMailer);
        
        $updateMailerTemplates = $auth->createPermission("Update Mailer Templates");
        $updateMailerTemplates->description = "Update the Mandrill Mailchimp style templates";
        $auth->add($updateMailerTemplates);
        
        //Tasks used for grouping
        $mailer=$auth->createPermission("Mailer");
        $auth->add($mailer);
        $auth->addChild($mailer, $useMailer);
        $auth->addChild($mailer, $updateMailerTemplates);
        
        $admin=$auth->getRole("Admin");
        $auth->addChild($admin, $useMailer);
        $auth->addChild($admin, $updateMailerTemplates);
    }

    public function down()
    {
        echo "m140928_031449_auth_assignments cannot be reverted.\n";

        return false;
    }
}
