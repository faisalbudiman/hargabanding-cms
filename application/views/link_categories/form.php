<?php $this->load->view('_layouts/header'); ?>
<?php $this->load->view('_layouts/header_part'); ?>
<?php $this->load->view('_layouts/sidebar'); ?>
<?php $this->load->view('_layouts/content'); ?>
<?php $this->load->view('_layouts/notification'); ?>

<?php if (empty($data_kategori)): ?>
	<div class="alert alert-info">Tidak ada data kategori yang dapat dipilih, <a href="<?php echo base_url('categories') ?>">cek data kategori</a></div>
<?php elseif(empty($data_site)): ?>	
	<div class="alert alert-info">Data Site Masih Kosong, <a href="<?php echo base_url('sites') ?>">isi terlebih dahulu</a></div>
<?php else: ?>

	<form action="<?php echo (!empty($data_link_category)) ? base_url('link_categories/proses_update/'.$data_link_category['id']) : base_url('link_categories/proses_tambah') ?>" method="POST">
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
							<label class="form-label"><?php echo ucfirst('category_name') ?></label>
							<select autofocus="" required="" name="id_category" class="form-control select-category select2">
								<option value="">- Pilih -</option>
								<?php 
								foreach($data_kategori as $row)
								{ 

									if ($data_link_category['id_category'] == $row->id) {
										echo '<option value="'.$row->id.'" selected="">'.$row->category_name.'</option>';
									}else {
										echo '<option value="'.$row->id.'">'.$row->category_name.'</option>';
									}
								}
								?>
							</select>	
						</div>

						<div class="form-group">
							<label class="form-label"><?php echo ucfirst('site_name') ?></label>
							<select required="" name="id_site" class="form-control select-site select2">
								<option value="">- Pilih -</option>
								<?php 
								foreach($data_site as $row)
								{ 

									if ($data_link_category['id_site'] == $row->id) {
										echo '<option value="'.$row->id.'" selected="">'.$row->site_name.'</option>';
									}else {
										echo '<option value="'.$row->id.'">'.$row->site_name.'</option>';
									}
								}
								?>
							</select>	
						</div>

						<div class="form-group">
							<label for="<?php echo ucfirst('link_category') ?>"><?php echo ucfirst('link_category') ?></label>
							<div class="input-group">
								<input autocomplete="off" required="" type="text" class="form-control" name="link_category" placeholder="<?php echo ucfirst('link_category') ?>" value="<?php echo (!empty($data_link_category['link_category']) ? $data_link_category['link_category'] : '') ?>">
							</div>
						</div>

						<div class="form-group">
							<div class="control-label"><?php echo ucfirst('active') ?></div>
							<label class="custom-switch mt-2">
								<input type="checkbox" name="active" class="custom-switch-input" value="1" <?php echo (!empty($data_link_category['active']) ? 'checked' : '') ?>>
								<span class="custom-switch-indicator"></span>
								<span class="custom-switch-description"><?php echo ucfirst('on/off') ?></span>
							</label>
						</div>

						<input type='hidden' class='form-control' name='id' value="<?php echo (!empty($data_link_category['id']) ? $data_link_category['id'] : '') ?>">	

					</div>
				</div>
			</div>
		</div>
	</form>

<?php endif ?>

<?php $this->load->view('_layouts/footer_part'); ?>
<?php $this->load->view('_layouts/footer'); ?>
