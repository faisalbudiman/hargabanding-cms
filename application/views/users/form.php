<?php $this->load->view('_layouts/header'); ?>
<?php $this->load->view('_layouts/header_part'); ?>
<?php $this->load->view('_layouts/sidebar'); ?>
<?php $this->load->view('_layouts/content'); ?>
<?php $this->load->view('_layouts/notification'); ?>

<form action="<?php echo (!empty($data_user)) ? base_url('users/proses_update/'.$data_user['id']) : base_url('users/proses_tambah') ?>" method="POST">
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
						<label for="username"><?php echo ucfirst('username') ?></label>
						<div class="input-group">
							<input autocomplete="off" autofocus="" required="" type="text" class="form-control" name="username" placeholder="username" value="<?php echo (!empty($data_user['username']) ? $data_user['username'] : '') ?>">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i class="fas fa-user"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="password"><?php echo ucfirst('password') ?></label>
						<div class="input-group">
							<input autocomplete="off" type="password" class="form-control" placeholder="password" name="password" required="" value="<?php echo (!empty($data_user['password']) ? $data_user['password'] : '') ?>">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i class="fas fa-lock"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="control-label"><?php echo ucfirst('actived') ?></div>
						<label class="custom-switch mt-2">
							<input type="checkbox" name="actived" class="custom-switch-input" value="1" <?php echo (!empty($data_user['actived']) ? 'checked' : '') ?>>
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description">On / Off</span>
						</label>
					</div>

					<input type='hidden' class='form-control' name='password-old' value="<?php echo (!empty($data_user['password']) ? $data_user['password'] : '') ?>">
					<input type='hidden' class='form-control' name='id' value="<?php echo (!empty($data_user['id']) ? $data_user['id'] : '') ?>">					
				</div>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view('_layouts/footer_part'); ?>
<?php $this->load->view('_layouts/footer'); ?>