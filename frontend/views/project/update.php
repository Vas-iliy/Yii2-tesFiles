<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?=$this->render('_form', compact('model'))?>
<?if(!empty($project) && !empty($project->image)):?>
<div class="container-fluid">
    <div class="col-6">
        <?=Html::img($project->getUploadedFileUrl('image'), ['class' => 'img-thumbnail'])?>
    </div>
</div>
<?endif;?>
