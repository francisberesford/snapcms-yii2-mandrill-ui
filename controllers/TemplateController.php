<?php

namespace snapcms\mandrill\ui\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use snapcms\components\SnapCMSController;
use snapcms\mandrill\ui\models\Template;

class TemplateController extends SnapCMSController
{
    public function actionIndex()
    {
        $Templates = Template::findAll();
        
        $DP = new ArrayDataProvider([
            'allModels' => $Templates,
            'sort' => [
                'attributes' => ['name', 'subject'],
            ],
            'key' => 'slug',
        ]);
        
        $this->layout = '//column2';
        return $this->render('index', [
            'DP' => $DP,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $Template = Template::findOne($id);
        
        if ($Template->load(Yii::$app->request->post()) && $Template->save()) {
            Yii::$app->session->setFlash('success','Template Updated.');
        }
        
        return $this->render('update', [
            'Template' => $Template,
        ]);
    }
    
    public function actionCreate()
    {
        $Template = new Template;
        if ($Template->load(Yii::$app->request->post()) && $Template->save()) {
            Yii::$app->session->setFlash('success','Template Created.');
            $this->redirect(['template/index']);
        }
        return $this->render('create', [
            'Template' => $Template,
        ]);
    }
    
    public function actionDelete($id)
    {
        $Template = Template::findOne($id);
        if($Template->delete()) {
            Yii::$app->session->setFlash('warning', Yii::t('snapcms', 'Template Deleted'));
        }
        return $this->redirect(['index']);
    }
}
