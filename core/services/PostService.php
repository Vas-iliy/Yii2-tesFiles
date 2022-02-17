<?php

namespace core\services;

use core\entities\Post;
use core\entities\PostImages;
use core\forms\PostForm;

class PostService
{
    public function create(PostForm $form)
    {
        $post = Post::create($form->title, $form->description);
        $this->transaction($post, $form);
        return $post;
    }

    public function edit($id, PostForm $form)
    {
        $post = Post::findOne($id);
        $post->edit($form->title, $form->description);
        $this->transaction($post, $form);
        return $post;
    }

    private function transaction(Post $post, PostForm $form)
    {
        $transaction = \Yii::$app->getDb()->beginTransaction();
        if (!$post->save() || !$this->createImages($form, $post)) {
            $transaction->rollBack();
        }
        $transaction->commit();
    }

    private function createImages(PostForm $form, Post $post)
    {
        foreach ($form->images as $image) {
            $image = PostImages::create($image, $post->id);
            if (!$image->save()) {
                return false;
            }
        }
        return true;
    }

}