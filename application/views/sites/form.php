<?php $this->load->view('_layouts/header'); ?>
<?php $this->load->view('_layouts/header_part'); ?>
<?php $this->load->view('_layouts/sidebar'); ?>
<?php $this->load->view('_layouts/content'); ?>
<?php $this->load->view('_layouts/notification'); ?>

<form action="<?php echo (!empty($data_sites)) ? base_url('sites/proses_update/'.$data_sites['id']) : base_url('sites/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
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

					<div class="form-row">

						<div class="form-group col-md-6">
							<label for="sort_priority">sort_priority</label>
							<div class="input-group">
								<input autocomplete="off" autofocus="" required="" type="number" class="form-control" name="sort_priority" placeholder="sort_priority" value="<?php echo (!empty($data_sites['sort_priority']) ? $data_sites['sort_priority'] : '') ?>">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label for="site_name">site_name</label>
							<div class="input-group">
								<input autocomplete="off" autofocus="" required="" type="text" class="form-control" name="site_name" placeholder="site_name" value="<?php echo (!empty($data_sites['site_name']) ? $data_sites['site_name'] : '') ?>">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label for="link_site">link_site</label>
							<div class="input-group">
								<input autocomplete="off" autofocus="" required="" type="text" class="form-control" name="link_site" placeholder="link_site" value="<?php echo (!empty($data_sites['link_site']) ? $data_sites['link_site'] : '') ?>">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label for="link_promo">link_promo</label>
							<div class="input-group">
								<input autocomplete="off" autofocus="" required="" type="text" class="form-control" name="link_promo" placeholder="link_promo" value="<?php echo (!empty($data_sites['link_promo']) ? $data_sites['link_promo'] : '') ?>">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label for="termurah_id">termurah_id</label>
							<div class="input-group">
								<input autocomplete="off" autofocus="" required="" type="text" class="form-control" name="termurah_id" placeholder="termurah_id" value="<?php echo (!empty($data_sites['termurah_id']) ? $data_sites['termurah_id'] : '') ?>">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label class="form-label">protocol</label>
							<div class="selectgroup w-100">
								<label class="selectgroup-item">
									<input required="" type="radio" name="protocol" value="http" class="selectgroup-input" <?php echo ((!empty($data_sites['protocol']) AND $data_sites['protocol'] == 'http') ? 'checked' : '') ?>>
									<span class="selectgroup-button"><i class="fas fa-globe"></i> http</span>
								</label>
								<label class="selectgroup-item">
									<input required="" type="radio" name="protocol" value="https" class="selectgroup-input" <?php echo ((!empty($data_sites['protocol']) AND $data_sites['protocol'] == 'https') ? 'checked' : '') ?>>
									<span class="selectgroup-button"><i class="fas fa-globe"></i> https</span>
								</label>
							</div>
						</div>


						<div class="form-group col-md-6">
							<label for="image_path"><?php echo ucfirst('image_path') ?></label>
							<?php if (!empty($data_sites['image_path'])): ?>
								<img style="width: 100px;display: block;margin: 10px 0;" src="<?php echo PATH_FILES.$data_sites['image_path'] ?>">
							<?php endif ?>
							<input id="image_path" autocomplete="off" autofocus="" type="file" class="form-control" name="image_path" placeholder="image_path" value="<?php echo (!empty($data_sites['image_path']) ? $data_sites['image_path'] : '') ?>" <?php echo (!empty($data_sites['image_path']) ? '' : 'required') ?>>
						</div>


						<div class="form-group col-md-6">
							<label for="square_path"><?php echo ucfirst('square_path') ?></label>
							<?php if (!empty($data_sites['square_path'])): ?>
								<img style="width: 100px;display: block;margin: 10px 0;" src="<?php echo PATH_FILES.$data_sites['square_path'] ?>">
							<?php endif ?>
							<input id="square_path" autocomplete="off" autofocus="" type="file" class="form-control" name="square_path" placeholder="square_path" value="<?php echo (!empty($data_sites['square_path']) ? $data_sites['square_path'] : '') ?>" <?php echo (!empty($data_sites['square_path']) ? '' : 'required') ?>>
						</div>  


						<div class="form-group">
							<div class="control-label"><?php echo ucfirst('site_actived') ?></div>
							<label class="custom-switch mt-2">
								<input type="checkbox" name="site_actived" class="custom-switch-input" value="1" <?php echo (!empty($data_sites['site_actived']) ? 'checked' : '') ?>>
								<span class="custom-switch-indicator"></span>
								<span class="custom-switch-description">On / Off</span>
							</label>
						</div>


					</div>

					<input type='hidden' class='form-control' name='id' value="<?php echo (!empty($data_sites['id']) ? $data_sites['id'] : '') ?>">					
				</div>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view('_layouts/footer_part'); ?>
<?php $this->load->view('_layouts/footer'); ?>
