<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Document */

$this->title = '创建文档';
$this->params['breadcrumbs'][] = ['label' => '文档', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
