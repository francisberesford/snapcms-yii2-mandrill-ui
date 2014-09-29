<?php
/**
 * @var yii\web\View $this
 */
$this->title = Yii::t('snapcms', 'Templates');
$this->params['breadcrumbs'][] = ['label' => 'Mailer', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['template/index']];
$this->params['breadcrumbs'][] = 'Update';

$this->params['header'] = $this->title;
//$this->params['headerSubtext'] = $category;
?>
<?= $this->render('_form',['Template' => $Template]) ?>