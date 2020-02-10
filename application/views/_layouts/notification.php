<?php if($this->session->flashdata('failed')): ?>
	<?php if($this->session->flashdata('failed') == TRUE): ?>
		<div class="alert alert-danger">
			<?php echo $this->session->flashdata('failed_message') ?>                
		</div>
	<?php endif; ?>
<?php endif; ?>

<?php if($this->session->flashdata('success')): ?>
	<?php if($this->session->flashdata('success') == TRUE): ?>
		<div class="alert alert-info">
			<?php echo $this->session->flashdata('success_message') ?>                
		</div>
	<?php endif; ?>
<?php endif; ?>