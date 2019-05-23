<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'category_id',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category->name;
                }
            ],
            'name',
            // 'content:ntext',
            'price',
            //'keywords',
            //'description',
            //'img',
            //'hit',
            //'new',
            //'sale',
            [
                'attribute' => 'hit',
                'value' => function($model) {
                    return $model->hit ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'new',
                'value' => function($model) {
                    return $model->new ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'sale',
                'value' => function($model) {
                    return $model->sale ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>';
                },
                'format' => 'html'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
