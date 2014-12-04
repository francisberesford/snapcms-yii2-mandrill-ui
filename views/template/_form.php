<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

?>
<?php $form = ActiveForm::begin(); ?>
    <div class="mandrill-templates row snap-tabs">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($Template, 'name')->textInput(['maxlength' => 255]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($Template, 'slug') ?>
                </div>
                <?php //$form->field($Template, 'template_labels')->textInput(['maxlength' => 255]) ?>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($Template, 'subject')->textInput(['maxlength' => 255]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($Template, 'from_email')->textInput(['maxlength' => 255]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($Template, 'from_name')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a data-toggle="tab" role="tab" href="#html">HTML</a></li>
                <li><a data-toggle="tab" role="tab" href="#text">Text</a></li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-body tab-content">
                    <div id="html" class="tab-pane active">
                        <?= $form->field($Template, 'code',['template' => "{label}\n{input}\n{hint}\n{error}"])->widget(CKEditor::className(), [
                            'clientOptions' => ['height' => 500],
                            'preset' => 'basic'
                        ]) ?>
                    </div>
                    <div id="text" class="tab-pane">
                        <?= $form->field($Template, 'text', [
                            'template' => "{label}\n{input}\n{hint}\n{error}",
                            'labelOptions' => ['class' => '']])->textArea(['rows'=>20]); ?>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->render('//global/_form_sidebar',['showSaveButton'=>true]) ?>
    </div>
<?php ActiveForm::end(); ?>