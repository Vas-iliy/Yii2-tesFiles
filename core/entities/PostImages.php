<?php

namespace core\entities;

use yii\db\ActiveRecord;

class PostImages extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_images';
    }
}