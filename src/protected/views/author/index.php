<?php
/* @var $this AuthorController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'Authors';
?>

<h1>Authors</h1>

<?php if (!Yii::app()->user->isGuest): ?>
	<p><?php echo CHtml::link('Create Author', ['create']); ?></p>
<?php endif; ?>

<?php $this->widget('zii.widgets.grid.CGridView', [
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        [
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'update' => ['visible' => '!Yii::app()->user->isGuest'],
                'delete' => ['visible' => '!Yii::app()->user->isGuest'],
            ],
        ],
    ],
]); ?>
