	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<?= $this->tag->linkTo(['/management', '<small>
							<i class=\'fa fa-leaf\'></i>
							Management Hubphoto.io
						</small>', 'class' => 'navbar-brand']) ?>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<?= $this->tag->image(['img/avatar5.png', 'alt' => 'Tadashi\'s Photo', 'class' => 'nav-user-photo']) ?>
								<span class="user-info">
									<small>Tadashi Same</small>
								</span>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active">
						<?= $this->tag->linkTo(['/management', '<i class=\'menu-icon fa fa-tachometer\'></i>
							<span class=\'menu-text\'> Dashboard </span>']) ?>

						<b class="arrow"></b>
					</li>

					<li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-book"></i>

							<span class="menu-text">
								Articles

								<span class="badge badge-primary">2</span>
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<?= $this->tag->linkTo(['/management/create-an-article', '<i class=\'menu-icon fa fa-caret-right\'></i>
									Create New']) ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?= $this->tag->linkTo(['/management/list-articles', '<i class=\'menu-icon fa fa-caret-right\'></i>
									Lists articles']) ?>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>

							<span class="menu-text">
								Menu

								<span class="badge badge-primary">2</span>
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<?= $this->tag->linkTo(['/management/create-a-page', '<i class=\'menu-icon fa fa-caret-right\'></i>
									Create New']) ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?= $this->tag->linkTo(['/management/list-pages', '<i class=\'menu-icon fa fa-caret-right\'></i>
									Menu']) ?>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="">
                    	<?= $this->tag->linkTo(['/management/gallery', '<i class=\'menu-icon fa fa-photo\'></i>
                            <span class=\'menu-text\'> Gallery </span>']) ?>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                    	<?= $this->tag->linkTo(['/management/user-profile', '<i class=\'menu-icon fa fa-user\'></i>
                            <span class=\'menu-text\'> Profile </span>']) ?>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                    	<?= $this->tag->linkTo(['/management/timeline', '<i class=\'menu-icon fa fa-clock-o\'></i>
                            <span class=\'menu-text\'> Timeline </span>']) ?>

                        <b class="arrow"></b>
                    </li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#"> Home </a>
							</li>

							<li>
								<?php if (isset($link_group)) { ?> 
									<?php $name = $link_group['name']; ?>
									<?php $relative_link = $link_group['link']; ?>
								<?php } ?>
								<?php if (isset($relative_link)) { ?>
									<?= $this->tag->linkTo([$relative_link, $name]) ?>
								<?php } else { ?>
									<?= $this->tag->linkTo(['#', 'Undefined']) ?>
								<?php } ?>
							</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                    <?= $this->getContent() ?>
								<!-- PAGE CONTENT ENDS -->
							