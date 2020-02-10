<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>
				<?php if ($this->uri->segment(2)): ?>
					<a href="<?php echo base_url($this->uri->segment(1)); ?>"><i class="fa fa-arrow-left"></i></a>&nbsp;
				<?php endif ?>
				<?php echo $title ?>
				
			</h1>
		</div>

		<div class="section-body">