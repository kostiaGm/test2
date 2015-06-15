<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Индексировать сайт</h1>
<div id="index-content">
    <div class="row">
        <div class="span-12" >
            <?php $this->renderPartial('optionForm', array('model' => $model)); ?>
        </div>
        <div class="span-10">
            <?php if ($items): ?>
                <?php foreach ($items as $item): ?>
                    <p><?php echo CHtml::link($item->domain, array('site/index/id/' . $item->id)) ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <hr>
  <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sites-grid',
	'dataProvider'=>$modelGrid->search(),
	'filter'=>$modelGrid,
      //'ajaxUrl'=>'/',
	'columns'=>array(
		'id',
		'url',
		'header',
		'title',
		'description',
		'isGa',
            'level'
		/*
		'domain',
		'level',
		'charLength',
		*/
		
	),
)); ?>
</div>
<div id="load-content hide">
    <h2>Данные загружаются. Подождите...</h2>
</div>