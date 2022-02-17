<?php

namespace core\forms;

use core\entities\Post;
use yii\base\Model;
use yii\web\UploadedFile;

class PostForm extends Model
{
    public $title;
    public $description;
    public $images;
    private $_post;

    public function __construct(Post $post = null,$config = [])
    {
        if ($post) {
            $this->title = $post->title;
            $this->description = $post->description;
        }
        parent::__construct($config);
    }

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