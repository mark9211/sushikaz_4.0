<?
?>
<!DOCTYPE html>
<html class="no-js">
<head>
	<?php echo $this->Html->charset('utf-8'); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		#BEGIN GLOBAL MANDATORY STYLES
		echo $this->Html->css('assets/global/plugins/font-awesome/css/font-awesome.min.css');
		echo $this->Html->css('assets/global/plugins/simple-line-icons/simple-line-icons.min.css');
		echo $this->Html->css('assets/global/plugins/bootstrap/css/bootstrap.min.css');
		echo $this->Html->css('assets/global/plugins/uniform/css/uniform.default.css');
		echo $this->Html->css('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');
		#BEGIN THEME STYLES
		echo $this->Html->css('assets/global/css/components.min.css');
		echo $this->Html->css('assets/global/css/plugins.min.css');
		#BEGIN THEME LAYOUT STYLES
		echo $this->Html->css('assets/layouts/layout7/css/layout.min.css');
		echo $this->Html->css('assets/layouts/layout7/css/custom.min.css');

		# <!-- BEGIN CORE PLUGINS -->
		echo $this->Html->script('assets/global/plugins/jquery.min.js');
		echo $this->Html->script('assets/global/plugins/bootstrap/js/bootstrap.min.js');
		echo $this->Html->script('assets/global/plugins/js.cookie.min.js');
		echo $this->Html->script('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');
		echo $this->Html->script('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');
		echo $this->Html->script('assets/global/plugins/jquery.blockui.min.js');
		echo $this->Html->script('assets/global/plugins/uniform/jquery.uniform.min.js');
		echo $this->Html->script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js');
		echo $this->Html->script('assets/global/scripts/app.min.js');
		echo $this->Html->script('assets/layouts/layout7/scripts/layout.min.js');
		echo $this->Html->script('assets/layouts/global/scripts/quick-sidebar.min.js');

	?>
</head>
<body class="page-container-bg-solid">
	<div id="container">
		<div id="header">
			<!-- BEGIN HEADER -->
			<div class="page-header navbar-fixed-top">
				<!-- BEGIN HEADER INNER -->
				<div class="clearfix">
					<!-- BEGIN BURGER TRIGGER -->
					<div class="burger-trigger">
						<button class="menu-trigger">
							<?echo $this->Html->image('assets/layouts/layout7/img/m_toggler.png');?>
						</button>
						<div class="menu-overlay menu-overlay-bg-transparent">
							<div class="menu-overlay-content">
								<ul class="menu-overlay-nav text-uppercase">
									<li>
										<a href="<?echo $this->Html->url(array('controller'=>'reserves', 'action'=>'index'));?>">予約画面</a>
									</li>
									<li>
										<?$date = date('Y-m-d');?>
										<a href="<?echo $this->Html->url(array('controller'=>'reserves', 'action'=>'view'));?>">予約一覧</a>
									</li>
									<li>
										<a href="#">Templates</a>
									</li>
									<li>
										<a href="#">Support</a>
									</li>
									<li>
										<a href="#">Settings</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="menu-bg-overlay">
							<button class="menu-close">&times;</button>
						</div>
						<!-- the overlay element -->
					</div>
					<!-- END NAV TRIGGER -->
					<!-- BEGIN LOGO -->
					<div class="page-logo">
						<a href="<?echo $this->Html->url(array('controller'=>'reserves', 'action'=>'index'));?>">
							<?echo $this->Html->image('assets/layouts/layout7/img/logo.png');?>
						</a>
					</div>
					<!-- END LOGO -->
					<!-- BEGIN TOP NAVIGATION MENU -->
					<div class="top-menu">
						<ul class="nav navbar-nav pull-right">
							<!-- BEGIN NOTIFICATION DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-extended dropdown-notification" id="header_inbox_bar">
								<a href="javascript:;" class="dropdown-toggle" data-close-others="true">
									<i class="icon-bell"></i>
									<span class="badge badge-success">
										<?if($this->fetch('reserveNum')!=null):?>
										<?$r=unserialize($this->fetch('reserveNum'));echo count($r);?>
										<?else:?>
											0
										<?endif;?>
									</span>
								</a>
								<ul class="dropdown-menu">
									<li class="external">
										<h3>
											本日
											<span class="bold">
												<?if($this->fetch('reserveNum')!=null):?>
													<?$r=unserialize($this->fetch('reserveNum'));echo count($r);?>
												<?else:?>
													0
												<?endif;?> 件</span>のご予約</h3>
										<a href="#">全て見る</a>
									</li>
									<li>
										<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
											<?if($this->fetch('reserveNum')!=null):?>
											<?foreach($r as $s):?>
											<li>
												<a class="list-toggle-container collapsed" data-toggle="collapse" href="#task-<?echo $s['Reserve']['id']?>" aria-expanded="false">
													<span class="time"><?$time=explode(",", $s['Reserve']['time']);echo $time[0];?> ~</span>
													<span class="details">
														<span class="label label-sm label-icon label-success">
															<i class="fa fa-plus"></i>
														</span>
														<?echo $s['Reserve']['user_name'];?> 様
													</span>
												</a>
												<div class="task-list  panel-collapse collapse" id="task-<?echo $s['Reserve']['id']?>" aria-expanded="false" style="height: 0px;">
													<ul>
														<li>
															人数：<?echo $s['Reserve']['c_num'];?>名
														</li>
														<li>
															卓番：<?foreach($s['table'] as $table){ echo $table['number']."番 ";}?>
														</li>
													</ul>
												</div>
											</li>
											<?endforeach;?>
											<?endif;?>
										</ul>
									</li>
								</ul>
								<script>
									$(function() {
										$(".dropdown-toggle").click(function(){
											$(this).parent().toggleClass('open');
										});
										$(".list-toggle-container").click(function(){
											var icon = $(this).find(".label");
											if(icon.hasClass("label-success")){
												icon.removeClass("label-success").addClass("label-danger");
												icon.find("i").removeClass("fa-plus").addClass("fa-minus");
											}
											else if(icon.hasClass("label-danger")){
												icon.removeClass("label-danger").addClass("label-success");
												icon.find("i").removeClass("fa-minus").addClass("fa-plus");
											}
										});
									});
								</script>
							</li>
							<!-- END NOTIFICATION DROPDOWN -->
							<!-- BEGIN INBOX DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
								<a href="javascript:;" class="dropdown-toggle" data-close-others="true">
									<i class="icon-envelope-open"></i>
									<span class="badge badge-danger"> 0 </span>
								</a>
								<ul class="dropdown-menu">
									<li class="external">
										<h3>You have
											<span class="bold">7 New</span> Messages</h3>
										<a href="#">view all</a>
									</li>
									<li>
										<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
											<li>
												<a href="#">
                                                <span class="photo">
                                                    <img src="" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> Lisa Wong </span>
                                                    <span class="time">Just Now </span>
                                                </span>
													<span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
												</a>
											</li>
											<li>
												<a href="#">
                                                <span class="photo">
                                                    <img src="" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> Richard Doe </span>
                                                    <span class="time">16 mins </span>
                                                </span>
													<span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
												</a>
											</li>
											<li>
												<a href="#">
                                                <span class="photo">
                                                    <img src="" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> Bob Nilson </span>
                                                    <span class="time">2 hrs </span>
                                                </span>
													<span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
												</a>
											</li>
											<li>
												<a href="#">
                                                <span class="photo">
                                                    <img src="" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> Lisa Wong </span>
                                                    <span class="time">40 mins </span>
                                                </span>
													<span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
												</a>
											</li>
											<li>
												<a href="#">
                                                <span class="photo">
                                                    <img src="" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> Richard Doe </span>
                                                    <span class="time">46 mins </span>
                                                </span>
													<span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<!-- END INBOX DROPDOWN -->
							<!-- BEGIN USER LOGIN DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-user">
								<a href="javascript:;" class="dropdown-toggle" data-close-others="true">
									<div class="dropdown-user-inner">
										<span class="username username-hide-on-mobile"> 和光店 </span>
										<?echo $this->Html->image('sushikaz1.jpg');?> </div>
								</a>
								<ul class="dropdown-menu dropdown-menu-default">
									<li>
										<a href="extra_profile.html">
											<i class="icon-user"></i> My Profile </a>
									</li>
									<li>
										<a href="page_calendar.html">
											<i class="icon-calendar"></i> My Calendar </a>
									</li>
									<li>
										<a href="inbox.html">
											<i class="icon-envelope-open"></i> My Inbox
											<span class="badge badge-danger"> 3 </span>
										</a>
									</li>
									<li>
										<a href="page_todo.html">
											<i class="icon-rocket"></i> My Tasks
											<span class="badge badge-success"> 7 </span>
										</a>
									</li>
									<li class="divider"> </li>
									<li>
										<a href="extra_lock.html">
											<i class="icon-lock"></i> Lock Screen </a>
									</li>
									<li>
										<a href="login.html">
											<i class="icon-key"></i> Log Out </a>
									</li>
								</ul>
							</li>
							<!-- END USER LOGIN DROPDOWN -->
						</ul>
					</div>
					<!-- END TOP NAVIGATION MENU -->
				</div>
				<!-- END HEADER INNER -->
			</div>
			<!-- END HEADER -->
		</div>

		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>

		<div id="footer">
			<div class="page-footer">
				<div class="container">

				</div>
				<div class="go2top">
					<i class="icon-arrow-up"></i>
				</div>
			</div>
		</div>

	</div>
</body>
</html>
