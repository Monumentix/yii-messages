<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Messages:sent"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Sent"),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_styles') ?>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_flash') ?>

<div class="row">

	<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>
	<div class="span13">
	<h2><?php echo MessageModule::t('Sent'); ?></h2>

		<?php if ($messagesAdapter->data): ?>
			<?php $form = $this->beginWidget('CActiveForm', array(
				'id'=>'message-delete-form',
				'enableAjaxValidation'=>false,
				'action' => $this->createUrl('delete/')
			)); ?>

			<table class="bordered-table zebra-striped">
				<tr>
					<th  class="from-to">To</th>
					<th>Subject</th>
				</tr>
				<?php foreach ($messagesAdapter->data as $index => $message): ?>
					<tr>
						<td>
							<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
							<?php echo $form->hiddenField($message,"[$index]id"); ?>
							<?php echo $message->getReceiverName() ?>
						</td>
						<td><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
					</tr>
				<?php endforeach ?>
			</table>

			<div>
				<button class="btn danger"><?php echo MessageModule::t("Delete Selected") ?></button>
			</div>

			<?php $this->endWidget(); ?>

			<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
		<?php endif; ?>
	</div>
</div>
