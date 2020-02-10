<nav class="navbar navbar-expand-lg main-navbar">
	<ul class="navbar-nav mr-auto"">
		<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
			<i class="fas fa-bars"></i></a>
		</li>
	</ul>
	<ul class="navbar-nav navbar-right">
		<li>
			<a href="<?php echo base_url('auth/logout') ?>" class="nav-link nav-link-user">
				LogOut
			</a>

		</li>
	</ul>
</nav>

<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="<?php echo base_url() ?>"><?php echo APP_NAME ?></a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="<?php echo base_url() ?>">HB</a>
		</div>
		<ul class="sidebar-menu">

			<li <?php if($this->uri->segment(1)=='' OR $this->uri->segment(2)=='dashboard'){echo "class='active'";} ?>>
				<a class="nav-link" href="<?php echo base_url() ?>">
					<i class="fas fa-fire"></i> <span><?php echo ucfirst('dashboard') ?></span>
				</a>
			</li>

			<li <?php if($this->uri->segment(1)=='users'){echo "class='active'";} ?>>
				<a class="nav-link" href="<?php echo base_url('users') ?>">
					<i class="fas fa-user"></i> <span><?php echo ucfirst('user') ?></span>
				</a>
			</li>

			<li <?php if($this->uri->segment(1)=='categories'){echo "class='active'";} ?>>
				<a class="nav-link" href="<?php echo base_url('categories') ?>">
					<i class="fas fa-folder"></i> <span><?php echo ucfirst('categories') ?></span>
				</a>
			</li>

			<li <?php if($this->uri->segment(1)=='link_categories'){echo "class='active'";} ?>>
				<a class="nav-link" href="<?php echo base_url('link_categories') ?>">
					<i class="fas fa-folder"></i> <span><?php echo ucfirst('link categories') ?></span>
				</a>
			</li>

			<li <?php if($this->uri->segment(1)=='sites'){echo "class='active'";} ?>>
				<a class="nav-link" href="<?php echo base_url('sites') ?>">
					<i class="fas fa-folder"></i> <span><?php echo ucfirst('site') ?></span>
				</a>
			</li>

			<li <?php if($this->uri->segment(1)=='promos'){echo "class='active'";} ?>>
				<a class="nav-link" href="<?php echo base_url('promos') ?>">
					<i class="fas fa-folder"></i> <span><?php echo ucfirst('promo') ?></span>
				</a>
			</li>

			<li <?php if($this->uri->segment(1)=='product_choise'){echo "class='active'";} ?>>
				<a class="nav-link" href="<?php echo base_url('product_choise') ?>">
					<i class="fas fa-folder"></i> <span><?php echo ucfirst('product choise') ?></span>
				</a>
			</li>

			<li <?php if($this->uri->segment(1)=='special_offers'){echo "class='active'";} ?>>
				<a class="nav-link" href="<?php echo base_url('special_offers') ?>">
					<i class="fas fa-folder"></i> <span><?php echo ucfirst('special offers') ?></span>
				</a>
			</li>			
			
		</ul>
	</aside>
</div>
