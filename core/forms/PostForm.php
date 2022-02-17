<?php

namespace core\forms;

use yii\base\Model;

class PostForm extends Model
{
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }
}