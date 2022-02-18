<?php

namespace core\services;

use core\entities\Post;
use core\entities\PostImages;
use core\entities\Project;
use core\forms\PostForm;
use core\forms\ProjectForm;
use core\forms\ProjectUpdateForm;

class ProjectService
{
    public function create(ProjectForm $form)
    {
        $project = Project::create(
            $form->title, 
            $form->description,
            $form->image
        );
        $project->save();
        
        return $project;
    }

    public function edit($id, ProjectUpdateForm $form)
    {
        $project = Project::findOne($id);
        $project->edit(
            $form->title, 
            $form->description,
            $form->image
        );
        $project->save();

        return $project;
    }

    public function editNo($id, ProjectUpdateForm $form)
    {
        $project = Project::findOne($id);
        $project->noImage(
            $form->title,
            $form->description,
        );
        $project->save();

        return $project;
    }

    public function deleteImage(Project $project)
    {
        if ($project) {
            $arr = explode('.', $project->image);
            $extension = $arr[count($arr)-1];
            if (unlink(\Yii::getAlias("@staticRoot/origin/projects/{$project->id}") . '.' . $extension)) {
                $project->image = null;
                $project->save();
                return true;
            }
        }
        return false;
    }
}