<?php
/* @var $data Book */
?>

<div class="book-item">
	<?php echo CHtml::link(
	    CHtml::encode($data->title),
	    ['book/view', 'id' => $data->id],
	); ?>
	<?php if ($data->year): ?>
		<span>(<?php echo (int) $data->year; ?>)</span>
	<?php endif; ?>
</div>
