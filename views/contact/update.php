<?php

use app\models\Contact;
use yii\helpers\Html;
use yii\web\View;

/* @var View $this
 * @var Contact $model
 */


$this->title = 'Update '.$model->getFullName();
?>
<div class="contact-create">
    <p>
        <?= Html::a('Back to view', ['view','id'=>$model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Back to list', ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
</div>
