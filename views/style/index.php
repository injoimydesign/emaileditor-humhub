<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use humhub\modules\content\widgets\richtext\RichTextField;

/* @var $this yii\web\View */
/* @var $model humhub\modules\emailtemplates\models\EmailStyle */

$this->title = 'Email Style Designer';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-paint-brush"></i> <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'email-style-form']); ?>

                    <!-- Color Settings -->
                    <h4><i class="fa fa-palette"></i> Color Settings</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'primary_color')->input('color', ['class' => 'form-control color-input']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'background_color')->input('color', ['class' => 'form-control color-input']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'text_color')->input('color', ['class' => 'form-control color-input']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'link_color')->input('color', ['class' => 'form-control color-input']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'button_color')->input('color', ['class' => 'form-control color-input']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'button_text_color')->input('color', ['class' => 'form-control color-input']) ?>
                        </div>
                    </div>

                    <hr>

                    <!-- Logo Settings -->
                    <h4><i class="fa fa-image"></i> Logo Settings</h4>
                    <?= $form->field($model, 'logo_url')->textInput(['placeholder' => 'https://example.com/logo.png']) ?>

                    <hr>

                    <!-- Header HTML -->
                    <h4><i class="fa fa-code"></i> Email Header</h4>
                    <div class="alert alert-info">
                        <small>
                            <strong>Available variables:</strong> {logo_url}, {siteName}<br>
                            This HTML will appear at the top of all emails.
                        </small>
                    </div>
                    <?= $form->field($model, 'header_html')->widget(RichTextField::class, [
                        'id' => 'header-html',
                        'placeholder' => 'Enter email header HTML...',
                        'layout' => RichTextField::LAYOUT_INLINE
                    ])->label('Header HTML') ?>

                    <hr>

                    <!-- Footer HTML -->
                    <h4><i class="fa fa-code"></i> Email Footer</h4>
                    <div class="alert alert-info">
                        <small>
                            <strong>Available variables:</strong> {logo_url}, {siteName}, {unsubscribe_url}, {settings_url}<br>
                            This HTML will appear at the bottom of all emails.
                        </small>
                    </div>
                    <?= $form->field($model, 'footer_html')->widget(RichTextField::class, [
                        'id' => 'footer-html',
                        'placeholder' => 'Enter email footer HTML...',
                        'layout' => RichTextField::LAYOUT_INLINE
                    ])->label('Footer HTML') ?>

                    <hr>

                    <!-- Custom CSS -->
                    <h4><i class="fa fa-css3"></i> Custom CSS</h4>
                    <div class="alert alert-info">
                        <small>
                            Add custom CSS styles for your emails. Use standard CSS syntax.
                        </small>
                    </div>
                    <?= $form->field($model, 'custom_css')->textarea([
                        'rows' => 10,
                        'class' => 'form-control code-editor',
                        'style' => 'font-family: monospace; font-size: 13px;'
                    ])->label('Custom CSS') ?>

                    <hr>

                    <!-- Actions -->
                    <div class="form-group">
                        <?= Html::submitButton(
                            '<i class="fa fa-save"></i> Save Style',
                            ['class' => 'btn btn-primary']
                        ) ?>
                        
                        <?= Html::a(
                            '<i class="fa fa-undo"></i> Reset to Defaults',
                            ['reset'],
                            [
                                'class' => 'btn btn-warning',
                                'data-confirm' => 'Are you sure you want to reset all styles to defaults?',
                                'data-method' => 'post'
                            ]
                        ) ?>
                        
                        <?= Html::a(
                            '<i class="fa fa-download"></i> Export',
                            ['export'],
                            ['class' => 'btn btn-default']
                        ) ?>
                        
                        <button type="button" class="btn btn-info" id="refresh-preview">
                            <i class="fa fa-refresh"></i> Update Preview
                        </button>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <!-- Live Preview Panel -->
        <div class="col-md-4">
            <div class="panel panel-default" style="position: sticky; top: 20px;">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-eye"></i> Live Preview
                    </h3>
                </div>
                <div class="panel-body" style="padding: 0;">
                    <iframe id="preview-iframe" 
                            style="width: 100%; height: 600px; border: none; background: white;"
                            title="Email Style Preview">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$previewUrl = Url::to(['preview']);

$this->registerCss("
.color-input {
    height: 40px;
    cursor: pointer;
}
");

$this->registerJs("
// Function to update preview
function updatePreview() {
    var formData = $('#email-style-form').serialize();
    
    $.ajax({
        url: '$previewUrl',
        type: 'POST',
        data: formData,
        success: function(html) {
            var iframe = document.getElementById('preview-iframe');
            iframe.srcdoc = html;
        }
    });
}

// Initial preview load
setTimeout(function() {
    updatePreview();
}, 500);

// Update preview on color changes
$('.color-input').on('change', function() {
    updatePreview();
});

// Manual refresh button
$('#refresh-preview').on('click', function(e) {
    e.preventDefault();
    updatePreview();
});

// Auto-update preview on form changes (debounced)
var updateTimeout;
$('#email-style-form').on('change keyup', 'input, textarea, select', function() {
    clearTimeout(updateTimeout);
    updateTimeout = setTimeout(function() {
        updatePreview();
    }, 1000);
});
");
?>