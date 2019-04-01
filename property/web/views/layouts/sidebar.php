			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

<!--				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success" onclick="$('.sidebar_menu').toggle();">
							<i class="ace-icon fa fa-list"></i>
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
				</div> /.sidebar-shortcuts -->

<!--				<ul class="nav nav-list">
                                    
					<li class="sidebar_menu active">
						<a href="#">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Conrtol Panel </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="sidebar_menu">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Website Administration
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>

									Users &amp; Security
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secusers">
											<i class="menu-icon fa fa-leaf green"></i>
											Users
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secroles">
											<i class="menu-icon fa fa-leaf green"></i>
											User Roles
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secroletypes">
											<i class="menu-icon fa fa-leaf green"></i>
											User Role Types
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secrolecategory">
											<i class="menu-icon fa fa-leaf green"></i>
											User Role Categories
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secrolerights">
											<i class="menu-icon fa fa-leaf green"></i>
											Rights
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="#" class="dropdown-toggle">
											<i class="menu-icon fa fa-pencil orange"></i>

											eSystem Modules
											<b class="arrow fa fa-angle-down"></b>
										</a>

										<b class="arrow"></b>

										<ul class="submenu">
											<li class="">
												<a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmodules">
													<i class="menu-icon fa fa-plus purple"></i>
													Manage Modules
												</a>

												<b class="arrow"></b>
											</li>

											<li class="">
												<a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmoduleactions">
													<i class="menu-icon fa fa-eye pink"></i>
													Manage Screens
												</a>

												<b class="arrow"></b>
											</li>
										</ul>
									</li>
								</ul>
							</li>

                                                        <li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>

									Content Management
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="top-menu.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Slider
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="two-menu-1.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Pages
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="two-menu-2.html">
											<i class="menu-icon fa fa-caret-right"></i>
											News &amp; Events
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-1.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Picture Gallery
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-2.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Splash Screen
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-3.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Settings
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-3.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Downloads
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
						</ul>
					</li>

					<li class="sidebar_menu">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Property Management </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="tables.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Forms
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="jqgrid.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Balloting
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="sidebar_menu">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Finance </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="active">
								<a href="form-elements.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Form Elements
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="form-elements-2.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Form Elements 2
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="form-wizard.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Wizard &amp; Validation
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="wysiwyg.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Wysiwyg &amp; Markdown
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="dropzone.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Dropzone File Upload
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="sidebar_menu">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Marketting </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="active">
								<a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits">
									<i class="menu-icon fa fa-caret-right"></i>
									Visitors
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
                                        
				</ul> /.nav-list -->

                                        <div id="search_nav">
                                            <?php if (isset($this->blocks['pagesidebar'])): ?>
                                                <?= $this->blocks['pagesidebar'] ?>
                                            <?php endif; ?>                                                
                                        </div>
<!--				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>-->
			</div>
