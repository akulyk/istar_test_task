<?php

use app\models\Contact;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var View $this
 * @var Contact $model
 */

$this->title = $model->getFullName();
?>
<div class="contact-view">
    <?= Alert::widget()?>
    <p>
        <?= Html::a('Back to list', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'email',
            'birth_date',
            [
                'attribute' => 'phone',
                'value' => static function (Contact $contact) {
                    return $contact->getPhonesList('<br>');
                },
                'format' => 'html'
            ],
        ]
    ]) ?>
</div>
