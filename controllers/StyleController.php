<?php

namespace humhub\modules\emailtemplates\controllers;

use Yii;
use humhub\modules\admin\components\Controller;
use humhub\modules\emailtemplates\models\EmailStyle;
use yii\web\UploadedFile;

class StyleController extends Controller
{
    /**
     * Edit email styling
     */
    public function actionIndex()
    {
        $model = EmailStyle::getActive();
        
        // If no style exists, create one with defaults
        if ($model->isNewRecord) {
            $model->save();
        }
        
        if ($model->load(Yii::$app->request->post())) {
            // Handle logo upload
            $logoFile = UploadedFile::getInstance($model, 'logo_file');
            
            if ($logoFile) {
                $uploadPath = Yii::getAlias('@webroot/uploads/emailtemplates/');
                
                // Create directory if it doesn't exist
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                $fileName = 'logo_' . time() . '.' . $logoFile->extension;
                $filePath = $uploadPath . $fileName;
                
                if ($logoFile->saveAs($filePath)) {
                    $model->logo_url = Yii::$app->request->getHostInfo() . '/uploads/emailtemplates/' . $fileName;
                    Yii::$app->session->setFlash('success', 'Logo uploaded successfully.');
                }
            }
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Email style saved successfully.');
                // Refresh to reload the model with saved data
                return $this->redirect(['index']);
            }
        }
        
        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Preview email style
     */
    public function actionPreview()
    {
        $model = EmailStyle::getActive();
        
        // Load POST data if available (for live preview)
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
        }
        
        return $this->renderAjax('preview', [
            'model' => $model
        ]);
    }

    /**
     * Reset to default styles
     */
    public function actionReset()
    {
        $model = EmailStyle::getActive();
        
        if (!$model->isNewRecord) {
            $model->delete();
        }
        
        Yii::$app->session->setFlash('success', 'Email style reset to defaults.');
        return $this->redirect(['index']);
    }

    /**
     * Export current style as JSON
     */
    public function actionExport()
    {
        $model = EmailStyle::getActive();
        
        $export = [
            'header_html' => $model->header_html,
            'footer_html' => $model->footer_html,
            'primary_color' => $model->primary_color,
            'background_color' => $model->background_color,
            'text_color' => $model->text_color,
            'link_color' => $model->link_color,
            'button_color' => $model->button_color,
            'button_text_color' => $model->button_text_color,
            'custom_css' => $model->custom_css,
            'logo_url' => $model->logo_url,
        ];
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->headers->set('Content-Disposition', 'attachment; filename="email-style-export.json"');
        
        return $export;
    }

    /**
     * Use HumHub's appearance logo
     */
    public function actionUseAppearanceLogo()
    {
        $model = EmailStyle::getActive();
        
        // Check if HumHub has a logo configured
        if (!$model->hasDefaultLogo()) {
            Yii::$app->session->setFlash('error', 'No logo found in HumHub appearance settings. Please upload a logo in Administration → Settings → Appearance first, or upload a custom logo here.');
            return $this->redirect(['index']);
        }
        
        // Get the default logo from HumHub
        $defaultLogo = $model->getDefaultLogoUrl();
        
        $model->logo_url = $defaultLogo;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'HumHub appearance logo applied successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to save logo settings.');
        }
        
        return $this->redirect(['index']);
    }
    
    /**
     * Remove/clear the current logo
     */
    public function actionRemoveLogo()
    {
        $model = EmailStyle::getActive();
        
        $model->logo_url = '';
        
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Logo removed successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to remove logo.');
        }
        
        return $this->redirect(['index']);
    }
}