<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php

$this->widget(
    'booster.widgets.TbJumbotron',
    array(
        'heading' => 'Welcome to ' . CHtml::encode(Yii::app()->name),
    )
);

?>
