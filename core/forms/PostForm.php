<?php

namespace core\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class PostForm extends Model
{
    public $title;
    public $description;
    public $images;

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            ['images', 'each', 'rule' => ['image']],
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->images = UploadedFile::getInstances($this, 'images');
            return true;
        }
        return false;
    }
}