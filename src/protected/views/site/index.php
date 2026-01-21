<?php
/* @var $this SiteController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name;
?>

<h1>Books Catalog</h1>

<?php $this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_bookItem',
    'emptyText' => 'No books yet.',
]); ?>
