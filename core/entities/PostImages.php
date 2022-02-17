<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

class PostImages extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_images';
    }

    public static function create(UploadedFile $file, $id)
    {
        $image = new static();
        $image->image = $file;
        $image->post_id = $id;
        return $image;
    }


    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/posts/[[attribute_post_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/posts/[[attribute_post_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/posts/[[attribute_post_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/posts/[[attribute_post_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'catalog_list' => ['width' => 228, 'height' => 228],
                ],
            ],
        ];
    }
}