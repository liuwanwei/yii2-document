<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Document */

$this->title = '更新文档: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '文档', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title];
?>
<div class="document-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
