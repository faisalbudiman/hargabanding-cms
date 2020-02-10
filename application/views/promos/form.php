<?php $this->load->view('_layouts/header'); ?>
<?php $this->load->view('_layouts/header_part'); ?>
<?php $this->load->view('_layouts/sidebar'); ?>
<?php $this->load->view('_layouts/content'); ?>
<?php $this->load->view('_layouts/notification'); ?>

<?php if(empty($data_site)): ?>	
	<div class="alert alert-info">Data Site Masih Kosong, <a href="<?php echo base_url('sites') ?>">isi terlebih dahulu</a></div>
<?php else: ?>

	<form action="<?php echo (!empty($data_promos)) ? base_url('promos/proses_update/'.$data_promos['id']) : base_url('promos/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
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

							<h3 class="mt-0 col-md-12">Site Data</h3>

							<div class="form-group col-md-6">
								<label class="form-label">site_name</label>
								<select required="" name="id_site" class="form-control select-site select2">
									<option value="">- Pilih -</option>
									<?php 
									foreach($data_site as $row)
									{ 
										if ($data_promos['id_site'] == $row->id) {
											echo '<option value="'.$row->id.'" selected="">'.$row->site_name.'</option>';
										}else {
											echo '<option value="'.$row->id.'">'.$row->site_name.'</option>';
										}
									}
									?>
								</select>   
							</div>

							<div class="form-group col-md-6">
								<label for="link_path">link_path</label>
								<div class="input-group">
									<input required="" autocomplete="off" type="text" class="form-control" name="link_path" placeholder="link_path" value="<?php echo (!empty($data_promos['link_path']) ? $data_promos['link_path'] : '') ?>">
								</div>
							</div>

							<div class="form-group col-md-12">
								<label for="headers">headers</label>
								<div class="input-group">
									<textarea required="" autocomplete="off" type="text" class="form-control" name="headers" placeholder="headers"><?php echo (!empty($data_promos['headers']) ? $data_promos['headers'] : '') ?></textarea>
								</div>
							</div>

							<h3 class="mt-0 col-md-12">Site Setting</h3>

							<div class="form-group col-md-6">
								<label class="form-label">type</label>
								<select required="" name="type" class="form-control">
									<option value="" >- Pilih -</option>
									<option value="auto" <?php echo ((!empty($data_promos['type']) AND $data_promos['type'] == 'auto') ? 'selected' : '') ?>>Auto</option>
									<option value="manual" <?php echo ((!empty($data_promos['type']) AND $data_promos['type'] == 'manual') ? 'selected' : '') ?>>Manual</option>
								</select>   
							</div>

							<div class="form-group col-md-6">
								<label for="url_item">url_item</label>
								<div class="input-group">
									<input required="" autocomplete="off" type="text" class="form-control" name="url_item" placeholder="url_item" value="<?php echo (!empty($data_promos['url_item']) ? $data_promos['url_item'] : '') ?>">
								</div>
							</div>

							<div class="form-group col-md-6">
								<label for="title_item">title_item</label>
								<div class="input-group">
									<input required="" autocomplete="off" type="text" class="form-control" name="title_item" placeholder="title_item" value="<?php echo (!empty($data_promos['title_item']) ? $data_promos['title_item'] : '') ?>">
								</div>
							</div>

							<div class="form-group col-md-6">
								<label for="periode_item">periode_item</label>
								<div class="input-group">
									<input required="" autocomplete="off" type="text" class="form-control" name="periode_item" placeholder="periode_item" value="<?php echo (!empty($data_promos['periode_item']) ? $data_promos['periode_item'] : '') ?>">
								</div>
							</div>

							<div class="form-group col-md-6">
								<label for="kode_item">kode_item</label>
								<div class="input-group">
									<input required="" autocomplete="off" type="text" class="form-control" name="kode_item" placeholder="kode_item" value="<?php echo (!empty($data_promos['kode_item']) ? $data_promos['kode_item'] : '') ?>">
								</div>
							</div>

							<div class="form-group col-md-12">
								<label for="image_item"><?php echo ucfirst('image_item') ?></label>
								<?php if (!empty($data_promos['image_item'])): ?>
									<img style="width: 100px;display: block;margin: 10px 0;" src="<?php echo PATH_FILES.$data_promos['image_item'] ?>">
								<?php endif ?>
								<input id="image_item" autocomplete="off" autofocus="" type="file" class="form-control" name="image_item" placeholder="image_item" value="<?php echo (!empty($data_promos['image_item']) ? $data_promos['image_item'] : '') ?>" <?php echo (!empty($data_promos['image_item']) ? '' : 'required') ?>>
							</div>							

							<div class="form-group col-md-6">
								<div class="control-label">banner</div>
								<label class="custom-switch mt-2">
									<input type="checkbox" name="banner" class="custom-switch-input" value="true" <?php echo (!empty($data_promos['banner']) ? 'checked' : '') ?>>
									<span class="custom-switch-indicator"></span>
									<span class="custom-switch-description">On/Off</span>
								</label>
							</div>

							<div class="form-group col-md-6">
								<div class="control-label"><?php echo ucfirst('actived') ?></div>
								<label class="custom-switch mt-2">
									<input type="checkbox" name="actived" class="custom-switch-input" value="1" <?php echo (!empty($data_promos['actived']) ? 'checked' : '') ?>>
									<span class="custom-switch-indicator"></span>
									<span class="custom-switch-description">On / Off</span>
								</label>
							</div>						

						</div>

						<input type='hidden' class='form-control' name='id' value="<?php echo (!empty($data_promos['id']) ? $data_promos['id'] : '') ?>">					
					</div>
				</div>
			</div>
		</div>
	</form>
<?php endif ?>

<?php $this->load->view('_layouts/footer_part'); ?>
<?php $this->load->view('_layouts/footer'); ?>
