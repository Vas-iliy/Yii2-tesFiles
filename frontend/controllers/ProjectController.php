<?php

namespace frontend\controllers;

use core\entities\Post;
use core\entities\Project;
use core\forms\PostForm;
use core\forms\ProjectForm;
use core\forms\ProjectUpdateForm;
use core\services\ProjectService;
use yii\web\Controller;
use yii\web\UploadedFile;

class ProjectController extends Controller
{
    private $service;

    public function __construct($id, $module, ProjectService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $form = new ProjectForm();
        if ($form->load($this->request->post()) && $form->validate()) {
            $this->service->create($form);
        }
        return $this->render('index', [
            'model' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $project = Project::findOne($id);
        $form = new ProjectUpdateForm($project);
        if ($form->load($this->request->post()) && $form->validate()) {
            if (UploadedFile::getInstance($form, 'image')) {
                $this->service->edit($id,$form);
            } else {
                $this->service->editNo($id, $form);
            }
        }
        return $this->render('update', [
            'model' => $form,
            'project' => $project,
        ]);
    }
}