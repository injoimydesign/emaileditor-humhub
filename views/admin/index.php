<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $templates array */
/* @var $customTemplates array */

$this->title = 'Email Templates';
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <p>Customize email templates sent by the system. Click on a template to edit it.</p>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Template Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templates as $key => $template): ?>
                        <tr>
                            <td>
                                <strong><?= Html::encode($template['name']) ?></strong>
                                <br>
                                <small class="text-muted">
                                    Available placeholders: <?= Html::encode(implode(', ', $template['placeholders'])) ?>
                                </small>
                            </td>
                            <td>
                                <?php if (isset($customTemplates[$key])): ?>
                                    <span class="label label-info">Customized</span>
                                <?php else: ?>
                                    <span class="label label-default">Default</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= Html::a(
                                    '<i class="fa fa-pencil"></i> Edit', 
                                    ['edit', 'key' => $key], 
                                    ['class' => 'btn btn-sm btn-primary']
                                ) ?>
                                
                                <?php if (isset($customTemplates[$key])): ?>
                                    <?= Html::a(
                                        '<i class="fa fa-undo"></i> Reset', 
                                        ['reset', 'key' => $key], 
                                        [
                                            'class' => 'btn btn-sm btn-warning',
                                            'data-confirm' => 'Are you sure you want to reset this template to defaults?',
                                            'data-method' => 'post'
                                        ]
                                    ) ?>
                                <?php endif; ?>
                                
                                <button type="button" 
                                        class="btn btn-sm btn-default preview-btn" 
                                        data-preview-url="<?= Url::to(['preview', 'key' => $key]) ?>"
                                        data-template-name="<?= Html::encode($template['name']) ?>"
                                        aria-label="Preview <?= Html::encode($template['name']) ?>">
                                    <i class="fa fa-eye"></i> Preview
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="preview-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close preview dialog">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="preview-modal-title">Template Preview</h4>
            </div>
            <div class="modal-body" id="preview-modal-body">
                <div class="text-center">
                    <i class="fa fa-spinner fa-spin fa-2x"></i>
                    <p>Loading preview...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs("
$(document).on('click', '.preview-btn', function(e) {
    e.preventDefault();
    var btn = $(this);
    var url = btn.data('preview-url');
    var templateName = btn.data('template-name');
    var modal = $('#preview-modal');
    var modalBody = $('#preview-modal-body');
    var modalTitle = $('#preview-modal-title');
    
    // Update modal title
    modalTitle.text('Preview: ' + templateName);
    
    // Show loading state
    modalBody.html('<div class=\"text-center\"><i class=\"fa fa-spinner fa-spin fa-2x\"></i><p>Loading preview...</p></div>');
    
    // Show modal
    modal.modal('show');
    
    // Load preview content
    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            modalBody.html(data);
        },
        error: function() {
            modalBody.html('<div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-triangle\"></i> Error loading preview. Please try again.</div>');
        }
    });
});

// Clear modal content when closed
$('#preview-modal').on('hidden.bs.modal', function() {
    $('#preview-modal-body').html('<div class=\"text-center\"><i class=\"fa fa-spinner fa-spin fa-2x\"></i><p>Loading preview...</p></div>');
    $('#preview-modal-title').text('Template Preview');
});
");
?>