<?php

namespace app\controllers;

use Yii;
use app\models\ContactForm;

class SiteController extends BaseSiteController
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->view->title = Yii::t('app/index', 'title');
        Yii::$app->view->params['is_h1_logo'] = true;
        Yii::$app->view->params['need_footer'] = true;
        Yii::$app->view->params['html_class'] = 'index';
        return $this->render('index');
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted',  true);

            return $this->refresh();
        }

        $this->view->title = Yii::t('app/contacts', 'title');
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionGallery()
    {
        return $this->render('gallery');
    }
}
