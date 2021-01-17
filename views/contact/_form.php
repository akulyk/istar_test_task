<?php

use app\models\Contact;
use app\models\form\ContactFormModel;
use kartik\date\DatePicker;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var ContactFormModel $model
 */

$form = ActiveForm::begin();

?>


<?= $form->field($model, 'first_name') ?>
<?= $form->field($model, 'last_name') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'birth_date')->widget(DatePicker::class, [
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose' => true,
    ]
]) ?>

<?php
echo $form->field($model, 'userPhones')->widget(MultipleInput::className(), [
    'max' => $model->getMaxAmountOfPhones(),
    'min' => 1,
    'allowEmptyList' => false,
    'enableGuessTitle' => true,
    'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
])
    ->label(false);
?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
</div>
<? ActiveForm::end(); ?>
