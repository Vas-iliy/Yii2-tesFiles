<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?=$this->render('_form', compact('model'))?>
<?if(!empty($post) && !empty($post->images)):?>
<div class="container-fluid">
    <div class="row">
        <?foreach ($post->images as $image):?>
        <div class="col-6">
            <?=Html::img($image->getUploadedFileUrl('image'), ['class' => 'img-thumbnail'])?>
            <a href="<?=Url::to(['delete-image', 'id' => $post->id, 'image_id' => $image->id])?>">Delete</a>
        </div>
        <?endforeach;?>
    </div>
</div>
<?endif;?>
