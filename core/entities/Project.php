<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

class Project extends ActiveRecord
{
    public static function tableName()
    {
        return 'project';
    }

    public static function create($title, $description, $file)
    {
        $project = new static();
        $project->title = $title;
        $project->description = $description;
        $project->image = $file;
        return $project;
    }

    public function edit($title, $description, $file)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $file;
    }

    public function noImage($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/projects/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/projects/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/projects/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/projects/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'catalog_list' => ['width' => 228, 'height' => 228],
                ],
            ],
        ];
    }
}