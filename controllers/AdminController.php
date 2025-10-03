<?php

namespace humhub\modules\emailtemplates\controllers;

use Yii;
use humhub\modules\admin\components\Controller;
use humhub\modules\emailtemplates\models\EmailTemplate;
use humhub\modules\emailtemplates\Module;

class AdminController extends Controller
{
    /**
     * List all email templates
     */
    public function actionIndex()
    {
        $templates = Module::getAvailableTemplates();
        $customTemplates = EmailTemplate::find()->indexBy('template_key')->all();
        
        return $this->render('index', [
            'templates' => $templates,
            'customTemplates' => $customTemplates
        ]);
    }

    /**
     * Edit a specific template
     * @param string $key
     */
    public function actionEdit($key)
    {
        $templates = Module::getAvailableTemplates();
        
        if (!isset($templates[$key])) {
            Yii::$app->session->setFlash('error', 'Template not found.');
            return $this->redirect(['index']);
        }
        
        $templateInfo = $templates[$key];
        $model = EmailTemplate::findOne(['template_key' => $key]);
        
        if (!$model) {
            $model = new EmailTemplate();
            $model->template_key = $key;
            $model->loadDefaults($templateInfo);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Template saved successfully.');
            return $this->redirect(['index']);
        }
        
        return $this->render('edit', [
            'model' => $model,
            'templateInfo' => $templateInfo
        ]);
    }

    /**
     * Reset template to defaults
     * @param string $key
     */
    public function actionReset($key)
    {
        $model = EmailTemplate::findOne(['template_key' => $key]);
        
        if ($model && $model->delete()) {
            Yii::$app->session->setFlash('success', 'Template reset to defaults.');
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Preview template
     * @param string $key
     */
    public function actionPreview($key)
    {
        $model = EmailTemplate::findOne(['template_key' => $key]);
        
        if (!$model) {
            $templates = Module::getAvailableTemplates();
            if (isset($templates[$key])) {
                $model = new EmailTemplate();
                $model->template_key = $key;
                $model->loadDefaults($templates[$key]);
            }
        }
        
        if ($model) {
            // Replace placeholders with sample data
            $preview = $model->getPreview();
            return $this->renderAjax('preview', ['content' => $preview]);
        }
        
        return 'Template not found';
    }
}