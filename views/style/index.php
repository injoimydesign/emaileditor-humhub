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
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="panel-title">
                                <i class="fa fa-paint-brush"></i> <?= Html::encode($this->title) ?>
                            </h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <?= Html::a(
                            '<i class="fa fa-download"></i> Export',
                            ['export'],
                            ['class' => 'btn btn-default btn-sm']
                        ) ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'email-style-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

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
                    
                    <?php if ($model->hasLogo()): ?>
                        <div class="alert alert-success">
                            <strong><i class="fa fa-check-circle"></i> Current Logo:</strong>
                            <?php if (!empty($model->logo_url)): ?>
                                <span class="label label-info">Custom Logo</span>
                            <?php elseif ($model->hasDefaultLogo()): ?>
                                <span class="label label-default">HumHub Appearance Logo</span>
                            <?php endif; ?>
                            <br>
                            <img src="<?= Html::encode($model->getLogoUrl()) ?>" alt="Current Logo" style="max-width: 200px; max-height: 100px; margin-top: 10px; border: 1px solid #ddd; padding: 5px; background: white;">
                            <br>
                            <small class="text-muted"><?= Html::encode($model->getLogoUrl()) ?></small>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <strong><i class="fa fa-exclamation-triangle"></i> No logo configured.</strong><br>
                            Please upload a logo below, use your HumHub appearance logo, or enter a logo URL manually.
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!$model->hasDefaultLogo()): ?>
                        <div class="alert alert-danger">
                            <strong><i class="fa fa-times-circle"></i> HumHub Appearance Logo Not Found</strong><br>
                            No logo is configured in your HumHub appearance settings. 
                            To use the "Use HumHub Appearance Logo" feature, please upload a logo in:
                            <strong>Administration → Settings → Appearance</strong>
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                       <?php if (!$model->hasDefaultLogo()): ?>
                        <?= Html::a(
                            '<i class="fa fa-magic"></i> Use HumHub Appearance Logo',
                            ['use-appearance-logo'],
                            [
                                'class' => 'btn btn-default' . (!$model->hasDefaultLogo() ? ' disabled' : ''),
                                'data-method' => 'post',
                                'title' => $model->hasDefaultLogo() 
                                    ? 'Use the logo from Administration → Settings → Appearance' 
                                    : 'No logo found in HumHub appearance settings',
                                'disabled' => !$model->hasDefaultLogo()
                            ]
                        ) ?>
                            <span class="text-danger small">
                                <i class="fa fa-times"></i> No HumHub logo found.
                            </span>
                        <?php endif; ?>
                        <?php if (!empty($model->logo_url)): ?>
                            <?= Html::a(
                                '<i class="fa fa-trash"></i> Remove Current Logo',
                                ['remove-logo'],
                                [
                                    'class' => 'btn btn-danger',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Are you sure you want to remove the current logo?',
                                    'title' => 'Remove the current custom logo'
                                ]
                            ) ?>
                        <?php endif; ?>
                        
                    </div>
                    
                   <div class="well"> 
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'logo_file')->fileInput([
                                'accept' => 'image/*'
                            ])->label('Upload New Logo')->hint('PNG, JPG, GIF, or SVG. Max 2MB.') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'logo_url')->textInput([
                                'placeholder' => 'Or enter logo URL manually'
                            ])->label('Logo URL') ?>
                        </div>
                    </div>
                    </div>
                    
                    

                    <hr>

                    <!-- Header HTML -->
                    <h4><i class="fa fa-code"></i> Email Header</h4>
                    <div class="alert alert-info">
                        <small>
                            <strong>Available variables:</strong><br>
                            <strong>Site Info:</strong> {logo_url}, {siteName}<br>
                            <strong>Colors:</strong> {primary_color}, {background_color}, {text_color}, {link_color}, {button_color}, {button_text_color}<br>
                            <em>Example:</em> <code>&lt;div style="background-color: {primary_color};"&gt;</code><br>
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
                            <strong>Available variables:</strong><br>
                            <strong>Site Info:</strong> {logo_url}, {siteName}, {unsubscribe_url}, {settings_url}<br>
                            <strong>Colors:</strong> {primary_color}, {background_color}, {text_color}, {link_color}, {button_color}, {button_text_color}<br>
                            <em>Example:</em> <code>&lt;a href="#" style="color: {link_color};"&gt;</code><br>
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
                            Add custom CSS styles for your emails. Use standard CSS syntax.<br>
                            <strong>Color variables available:</strong> {primary_color}, {background_color}, {text_color}, {link_color}, {button_color}, {button_text_color}<br>
                            <em>Example:</em> <code>.my-class { color: {primary_color}; }</code>
                        </small>
                    </div>
                    <?= $form->field($model, 'custom_css')->textarea([
                        'rows' => 10,
                        'class' => 'form-control code-editor',
                        'style' => 'font-family: monospace; font-size: 13px;'
                    ])->label('Custom CSS') ?>

                    <hr>

                    <!-- Actions -->
                    <div class="form-group btn-group btn-group-justified">
                       <div class="btn-group" role="group">
                        <?= Html::submitButton(
                            '<i class="fa fa-save"></i> Save Style',
                            ['class' => 'btn btn-primary ']
                        ) ?>
                        </div>
                        <div class="btn-group" role="group">
                        <button type="button" class="btn btn-info" id="refresh-preview">
                            <i class="fa fa-refresh"></i> Update Preview
                        </button>
                        </div>
                    </div>
                    <div>
                        
                        
                        
                        <?= Html::a(
                            '<i class="fa fa-undo"></i> Reset to Defaults',
                            ['reset'],
                            [
                                'class' => 'btn btn-error btn-sm',
                                'data-confirm' => 'Are you sure you want to reset all styles to defaults?',
                                'data-method' => 'post'
                            ]
                        ) ?>
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