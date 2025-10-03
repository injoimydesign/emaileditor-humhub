<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model humhub\modules\emailtemplates\models\EmailTemplate */
/* @var $templateInfo array */

$this->title = 'Edit Template: ' . $templateInfo['name'];
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="alert alert-info">
                <strong>Available Placeholders:</strong><br>
                <?= Html::encode(implode(', ', $templateInfo['placeholders'])) ?>
                <br><br>
                <small>Use these placeholders in your template and they will be replaced with actual values when emails are sent.</small>
            </div>

            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'body')->textarea([
                'rows' => 15,
                'placeholder' => 'Enter your email template here...'
            ])->hint('You can use HTML tags for formatting.') ?>

            <div class="form-group">
                <?= Html::submitButton(
                    '<i class="fa fa-save"></i> Save Template', 
                    ['class' => 'btn btn-primary']
                ) ?>
                
                <?= Html::a(
                    '<i class="fa fa-times"></i> Cancel', 
                    ['index'], 
                    ['class' => 'btn btn-default']
                ) ?>
                
                <?= Html::a(
                    '<i class="fa fa-eye"></i> Preview', 
                    ['preview', 'key' => $model->template_key], 
                    [
                        'class' => 'btn btn-info',
                        'data-target' => '#preview-modal',
                        'data-toggle' => 'modal'
                    ]
                ) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="preview-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Template Preview</h4>
            </div>
            <div class="modal-body">
                <!-- Preview content loaded via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>