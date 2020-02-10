<?php $this->load->view('_layouts/header'); ?>
<?php $this->load->view('_layouts/header_part'); ?>
<?php $this->load->view('_layouts/sidebar'); ?>
<?php $this->load->view('_layouts/content'); ?>
<?php $this->load->view('_layouts/notification'); ?>

<?php if(empty($data_site)): ?>	
	<div class="alert alert-info">Data Site Masih Kosong, <a href="<?php echo base_url('sites') ?>">isi terlebih dahulu</a></div>
<?php else: ?>

	<form action="<?php echo (!empty($data_product_choise)) ? base_url('product_choise/proses_update/'.$data_product_choise['id']) : base_url('product_choise/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
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
								<label class="form-label">site_name</label>
								<select required='' name="id_site" class="form-control select-site select2">
									<option value="">- Pilih -</option>
									<?php 
									foreach($data_site as $row)
									{ 
										if ($data_product_choise['id_site'] == $row->id) {
											echo '<option value="'.$row->id.'" selected="">'.$row->site_name.'</option>';
										}else {
											echo '<option value="'.$row->id.'">'.$row->site_name.'</option>';
										}
									}
									?>
								</select>   
							</div>

							<div class="form-group col-md-6">
								<label for="product_name">product_name</label>
								<div class="input-group">
									<input autocomplete="off" autofocus="" required="" type="text" class="form-control" name="product_name" placeholder="product_name" value="<?php echo (!empty($data_product_choise['product_name']) ? $data_product_choise['product_name'] : '') ?>">
								</div>
							</div>

							<div class="form-group col-md-6">
								<label for="product_link">product_link</label>
								<div class="input-group">
									<input autocomplete="off" autofocus="" required="" type="text" class="form-control" name="product_link" placeholder="product_link" value="<?php echo (!empty($data_product_choise['product_link']) ? $data_product_choise['product_link'] : '') ?>">
								</div>
							</div>

							<div class="form-group col-md-6">
								<label for="product_price">product_price</label>
								<div class="input-group">
									<input autocomplete="off" autofocus="" required="" type="number" class="form-control" name="product_price" placeholder="product_price" value="<?php echo (!empty($data_product_choise['product_price']) ? $data_product_choise['product_price'] : '') ?>">
								</div>
							</div>

							<div class="form-group col-md-6">
								<label for="store_name">store_name</label>
								<div class="input-group">
									<input autocomplete="off" autofocus="" required="" type="text" class="form-control" name="store_name" placeholder="store_name" value="<?php echo (!empty($data_product_choise['store_name']) ? $data_product_choise['store_name'] : '') ?>">
								</div>
							</div>

							<div class="form-group col-md-6">
								<label for="product_rating">product_rating</label>
								<div class="input-group">
									<input autocomplete="off" autofocus="" required="" type="number" class="form-control" name="product_rating" placeholder="product_rating" value="<?php echo (!empty($data_product_choise['product_rating']) ? $data_product_choise['product_rating'] : '') ?>">
								</div>
							</div>

							<div class="form-group col-md-6">
								<label for="product_origin">product_origin</label>
								<div class="input-group">
									<input autocomplete="off" autofocus="" required="" type="text" class="form-control" name="product_origin" placeholder="product_origin" value="<?php echo (!empty($data_product_choise['product_origin']) ? $data_product_choise['product_origin'] : '') ?>">
								</div>
							</div>                                                                      

							<div class="form-group col-md-12">
								<label for="image_path"><?php echo ucfirst('image_path') ?></label>
								<?php if (!empty($data_product_choise['image_path'])): ?>
									<img style="width: 100px;display: block;margin: 10px 0;" src="<?php echo PATH_FILES.$data_product_choise['image_path'] ?>">
								<?php endif ?>
								<input id="image_path" autocomplete="off" autofocus="" type="file" class="form-control" name="image_path" placeholder="image_path" value="<?php echo (!empty($data_product_choise['image_path']) ? $data_product_choise['image_path'] : '') ?>" <?php echo (!empty($data_product_choise['image_path']) ? '' : 'required') ?>>
							</div>

							<div class="form-group col-md-12">
								<div class="control-label"><?php echo ucfirst('actived') ?></div>
								<label class="custom-switch mt-2">
									<input type="checkbox" name="actived" class="custom-switch-input" value="1" <?php echo (!empty($data_product_choise['actived']) ? 'checked' : '') ?>>
									<span class="custom-switch-indicator"></span>
									<span class="custom-switch-description">On / Off</span>
								</label>
							</div>	

						</div>

						<input type='hidden' class='form-control' name='id' value="<?php echo (!empty($data_product_choise['id']) ? $data_product_choise['id'] : '') ?>">					
					</div>
				</div>
			</div>
		</div>
	</form>
<?php endif ?>

<?php $this->load->view('_layouts/footer_part'); ?>
<?php $this->load->view('_layouts/footer'); ?>
