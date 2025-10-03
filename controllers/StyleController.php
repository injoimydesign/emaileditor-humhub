<?php

namespace humhub\modules\emailtemplates\controllers;

use Yii;
use humhub\modules\admin\components\Controller;
use humhub\modules\emailtemplates\models\EmailStyle;

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
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Email style saved successfully.');
            return $this->refresh();
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
}