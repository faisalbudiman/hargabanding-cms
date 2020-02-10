<?php $this->load->view('_layouts/header'); ?>
<div class="container mt-5">
	<div class="row">
		<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

			<div class="login-brand">
				<img src="<?php echo APP_LOGO ?>" alt="logo" width="100" class="shadow-light rounded-circle">
			</div>

			<div class="card card-primary">

				<div class="card-header"><h4>Login</h4></div>

				<div class="card-body">

					<?php if($this->session->flashdata('failed')): ?>
						<?php if($this->session->flashdata('failed') == TRUE): ?>
							<div class="alert alert-danger">
								<?php echo $this->session->flashdata('failed_message') ?>                
							</div>
						<?php endif; ?>
					<?php endif; ?>

					<form method="POST" action="<?php echo base_url('auth/process'); ?>" class="needs-validation" novalidate="">
						<div class="form-group">
							<label for="username"><?php echo ucfirst('username') ?></label>
							<input autofocus="" autocomplete="off" id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
							<div class="invalid-feedback">
								username masih kosong
							</div>
						</div>

						<div class="form-group">
							<div class="d-block">
								<label for="password" class="control-label"><?php echo ucfirst('password') ?></label>
							</div>
							<input autocomplete="off" id="password" type="password" class="form-control" name="password" tabindex="2" required>
							<div class="invalid-feedback">
								password masih kosong
							</div>
						</div>

						<div class="form-group">
							<input type="hidden" name="csrf_code" value="<?php echo $this->session->userdata('csrf_code') ?>">
							<button type="submit" class="btn btn-primary btn-lg" tabindex="4">
								Masuk
							</button>
						</div>
					</form>   

				</div>
			</div>

			<div class="simple-footer">
				&copy; <?php echo APP_NAME ?>
			</div>

		</div>

	</div>
</div>
<?php $this->load->view('_layouts/footer'); ?>