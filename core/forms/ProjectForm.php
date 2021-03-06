<?php

namespace core\forms;

use core\entities\Post;
use core\entities\Project;
use yii\base\Model;
use yii\web\UploadedFile;

class ProjectForm extends Model
{
    public $title;
    public $description;
    public $image;

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->image = UploadedFile::getInstance($this, 'image');
            return true;
        }
        return false;
    }
}