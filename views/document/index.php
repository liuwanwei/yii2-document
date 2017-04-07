<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文档';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建文档', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title',
                'value' => function($model){
                    return StringHelper::truncate($model->title, 20);
                }
            ],
            [
                'attribute' => 'type',
                'value' => function($model){
                    return $model->typeName;
                }
            ],            
            [
                'attribute' => 'category',
                'value' => function($model){
                    return $model->categoryName;
                }
            ],            
            [
                'attribute' => 'content',
                'value' => function($model){
                    return StringHelper::truncate($model->content, 32);
                }
            ],
            'createdAt',
            // 'updatedAt',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}'],
        ],
    ]); ?>
</div>
