<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Project extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }

    public static function create($title, $description)
    {
        $post = new static();
        $post->title = $title;
        $post->description = $description;
        return $post;
    }

    public function edit($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function getImages()
    {
        return $this->hasMany(PostImages::class, ['post_id' => 'id']);
    }
}