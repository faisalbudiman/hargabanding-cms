<?php $this->load->view('_layouts/header'); ?>
<?php $this->load->view('_layouts/header_part'); ?>
<?php $this->load->view('_layouts/sidebar'); ?>
<?php $this->load->view('_layouts/content'); ?>
<?php $this->load->view('_layouts/notification'); ?>

<form id="elementer-form" action="<?php echo base_url('promos/multiple'); ?>" method="POST">
	<div class="row">
		<div class="col-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header" style="display: block;">
					<div class="dropdown d-inline float-left">
						<a class="btn btn-primary" href='<?php echo base_url('promos/tambah') ?>'>
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
								<th class="desktop"><?php echo ucfirst('id') ?></th>
								<th class="desktop"><?php echo ucfirst('site_name') ?></th>
								<th class="none"><?php echo ucfirst('link_path') ?></th>
								<th class="none"><?php echo ucfirst('last_updated') ?></th>
								<th class="none"><?php echo ucfirst('headers') ?></th>
								<th class="none"><?php echo ucfirst('selector_url') ?></th>
								<th class="none"><?php echo ucfirst('selector_image') ?></th>
								<th class="none"><?php echo ucfirst('selector_title') ?></th>
								<th class="none"><?php echo ucfirst('selector_periode') ?></th>
								<th class="none"><?php echo ucfirst('selector_kode') ?></th>
								<th class="none "><?php echo ucfirst('type') ?></th>
								<th class="none"><?php echo ucfirst('url_item') ?></th>
								<th class="none"><?php echo ucfirst('image_item') ?></th>
								<th class="all"><?php echo ucfirst('title_item') ?></th>
								<th class="none"><?php echo ucfirst('periode_item') ?></th>
								<th class="none"><?php echo ucfirst('kode_item') ?></th>		
								<th class="none"><?php echo ucfirst('banner') ?></th>						
								<th class="desktop"><?php echo ucfirst('actived') ?></th>	
								<th class="all no-sort"><?php echo ucfirst('alat') ?></th>
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
