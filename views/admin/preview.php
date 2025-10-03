<?php

/* @var $this yii\web\View */
/* @var $content string */

?>

<div class="email-preview">
    <div style="background: #f5f5f5; padding: 20px; border-radius: 4px;">
        <div style="background: white; padding: 30px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <?= $content ?>
        </div>
    </div>
    
    <div class="alert alert-info" style="margin-top: 20px;">
        <strong>Note:</strong> This is a preview with sample data. Actual emails will contain real user and content information.
    </div>
</div>