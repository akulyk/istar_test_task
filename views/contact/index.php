<?php

use app\models\Contact;
use app\models\search\ContactSearch;
use app\widgets\Alert;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\web\View;
use yii\grid\GridView;

/* @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var ContactSearch $searchModel
 */


$this->title = Yii::$app->name;
?>
<div class="contact-index">
    <?= Alert::widget()?>
    <p>
        <?= Html::a('Create new', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'first_name',
            'last_name',
            [
                'attribute' => 'phone',
                'value' => static function (Contact $contact) {
                    return $contact->getPhonesList('<br>');
                },
                'format' => 'html'
            ],
            [
                'class' => ActionColumn::class,
            ]
        ]
    ]) ?>
</div>
