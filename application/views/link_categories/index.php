<?php $this->load->view('_layouts/header'); ?>
<?php $this->load->view('_layouts/header_part'); ?>
<?php $this->load->view('_layouts/sidebar'); ?>
<?php $this->load->view('_layouts/content'); ?>
<?php $this->load->view('_layouts/notification'); ?>

<form id="elementer-form" action="<?php echo base_url('link_categories/multiple'); ?>" method="POST">
	<div class="row">
		<div class="col-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header" style="display: block;">
					<div class="dropdown d-inline float-left">
						<a class="btn btn-primary" href='<?php echo base_url('link_categories/tambah') ?>'>
							Tambah	
						</a>
					</div>					
					<div class="float-right">												
						<button type="submit" name="action" value="hapus" class="btn btn-danger btn-opsi tombol-hapus-multiple">
							Hapus
						</button>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered" id='table' width="100%">
						<thead>
							<tr>
								<th class="text-center no-sort all">
									<div class="custom-checkbox custom-control">
										<input name="select_all" type="checkbox" class="custom-control-input" id="checkbox-all">
										<label for="checkbox-all" class="custom-control-label">&nbsp;</label>
									</div>
								</th>
								<th class="none"><?php echo ucfirst('id') ?></th>
								<th class="desktop"><?php echo ucfirst('category_name') ?></th>
								<th class="desktop"><?php echo ucfirst('site_name') ?></th>
								<th class="all"><?php echo ucfirst('link_category') ?></th>
								<th class="desktop"><?php echo ucfirst('active') ?></th>								
								<th class="none"><?php echo ucfirst('created_date') ?></th>
								<th class="none"><?php echo ucfirst('updated_date') ?></th>
								<th class="no-sort all"><?php echo ucfirst('alat') ?></th>
							</tr>
						</thead>
						<tbody>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view('_layouts/footer_part'); ?>
<?php $this->load->view('_layouts/footer'); ?>