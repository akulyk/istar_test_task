<?php

use app\models\Contact;
use yii\helpers\Html;
use yii\web\View;

/* @var View $this
 * @var Contact $model
 */


$this->title = 'Create Contact';
?>
<div class="contact-create">
    <p>
        <?= Html::a('Back to list', ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
</div>
