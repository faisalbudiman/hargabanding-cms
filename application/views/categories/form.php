<?php $this->load->view('_layouts/header'); ?>
<?php $this->load->view('_layouts/header_part'); ?>
<?php $this->load->view('_layouts/sidebar'); ?>
<?php $this->load->view('_layouts/content'); ?>
<?php $this->load->view('_layouts/notification'); ?>

<form action="<?php echo (!empty($data_category)) ? base_url('categories/proses_update/'.$data_category['id']) : base_url('categories/proses_tambah') ?>" method="POST">
	<div class="row">
		<div class="col-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header" style="display: block;">
					<div class="float-left">
						<button class="btn btn-primary" type="submit">
							Simpan	
						</button>
					</div>
				</div>
				<div class="card-body">

					<div class="form-group">
						<label for="category_name"><?php echo ucfirst('category_name') ?></label>
						<input autocomplete="off" autofocus="" required="" type="text" class="form-control" name="category_name" placeholder="category_name" value="<?php echo (!empty($data_category['category_name']) ? $data_category['category_name'] : '') ?>">
					</div>

					<div class="form-group">
						<label for="deskripsi"><?php echo ucfirst('category_description') ?></label>
						<div class="input-group">
							<textarea rows="5" autocomplete="off" type="category_description" class="form-control" placeholder="category_description" name="category_description" style="height: initial !important;"><?php echo (!empty($data_category['category_description']) ? $data_category['category_description'] : '') ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="control-label"><?php echo ucfirst('actived') ?></div>
						<label class="custom-switch mt-2">
							<input type="checkbox" name="actived" class="custom-switch-input" value="1" <?php echo ((!empty($data_category['actived']) AND $data_category['actived'] == '1') ? 'checked' : '') ?>>
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description">On / Off</span>
						</label>
					</div>

					<input type='hidden' class='form-control' name='id' value="<?php echo (!empty($data_category['id']) ? $data_category['id'] : '') ?>">					
				</div>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view('_layouts/footer_part'); ?>
<?php $this->load->view('_layouts/footer'); ?>