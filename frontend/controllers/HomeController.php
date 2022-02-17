<?php

namespace frontend\controllers;

use core\entities\Post;
use core\entities\PostImages;
use core\forms\PostForm;
use core\services\PostService;
use yii\web\Controller;

class HomeController extends Controller
{
    private $service;

    public function __construct($id, $module, PostService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $form = new PostForm();
        if ($form->load($this->request->post()) && $form->validate()) {
            $this->service->create($form);
        }
        return $this->render('index', [
            'model' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $post = Post::findOne($id);
        $form = new PostForm($post);
        if ($form->load($this->request->post()) && $form->validate()) {
            $this->service->edit($id,$form);
        }
        return $this->render('update', [
            'model' => $form,
            'post' => $post,
        ]);
    }

    public function actionDeleteImage($id, $image_id)
    {
        $this->service->deleteImage($id, $image_id);
    }
}