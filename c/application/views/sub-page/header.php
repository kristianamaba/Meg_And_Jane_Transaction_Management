<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	echo "<!-- Loader -->
        <div id=\"preloader\"><div id=\"status\"><div class=\"spinner\"></div></div></div>

        <!-- Begin page -->
        <div id=\"wrapper\">

            <!-- ========== Left Sidebar Start ========== -->
            <div class=\"left side-menu\">

                <!-- LOGO -->
                <div class=\"topbar-left\">
                    <div class=\"\">
                        <!--<a href=\"index.html\" class=\"logo text-center\">Admiria</a>-->
                        <a href=\"home\" class=\"logo font-weight-bold\"><span> Meg & Jane Studio</span></a>
                    </div>
                </div>

                <div class=\"sidebar-inner slimscrollleft\">
                    <div id=\"sidebar-menu\">
                        <ul>

                            <li class=\"menu-title\">Main</li>
							
							<li>
                                <a href=\"home\" class=\"waves-effect\"><i class=\"mdi mdi-view-dashboard\"></i> <span> Dashboard </span> </a>
                            </li>

                            <li>
                                <a href=\"calendar\" class=\"waves-effect\"><i class=\"mdi mdi-calendar-check\"></i><span> Calendar </span></a>
                            </li>

                            <li class=\"menu-title\">Features</li>
							
                            <li class=\"has_sub\">
                                <a href=\"javascript:void(0);\" class=\"waves-effect\"><i class=\"mdi mdi-format-list-bulleted-type\"></i><span> Transactions Table <span class=\"pull-right\"><i class=\"mdi mdi-chevron-right\"></i></span> </span></a>
                                <ul class=\"list-unstyled\">
                                    <li><a href=\"transactions-table\">View Transactions</a></li>
                                    <li><a href=\"transaction-create\">Create Transaction</a></li>
                                </ul>
                            </li>
							
							".($rank == 1 ? "
							<li class=\"has_sub\">
                                <a href=\"javascript:void(0);\" class=\"waves-effect\"><i class=\"mdi mdi-clipboard-outline\"></i><span> Logs <span class=\"pull-right\"><i class=\"mdi mdi-chevron-right\"></i></span> </span></a>
								<ul class=\"list-unstyled\">
                                    <li><a href=\"transaction-logs\">Trasaction Logs</a></li>
                                    <li><a href=\"accounts-logs\">Accounts Logs</a></li>
                                </ul>
                            </li>

                            <li class=\"has_sub\">
                                <a href=\"javascript:void(0);\" class=\"waves-effect\"><i class=\"mdi mdi-account-location\"></i><span>Account Management <span class=\"pull-right\"><i class=\"mdi mdi-chevron-right\"></i></span> </span></a>
                                <ul class=\"list-unstyled\">
                                    <li><a href=\"accounts-management\">Manage Accounts</a></li>
                                    <li><a href=\"create-account\">Create Accounts</a></li>
                                </ul>
                            </li>
							":"")."
                            

                            <li class=\"menu-title\">Account</li>

                            <li>
                                <a href=\"user-profile\" class=\"waves-effect\"><i class=\"dripicons-user text-muted\"></i><span> User Profile </span></a>
                            </li>

                            <li>
                                <a href=\"logout\" class=\"waves-effect\"><i class=\"dripicons-exit text-muted\"></i><span> Logout </span></a>
                            </li>
							

                        </ul>
                    </div>
                    <div class=\"clearfix\"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->


            <!-- Start right Content here -->
            <div class=\"content-page\">
                <!-- Start content -->
                <div class=\"content\">

                    <!-- Top Bar Start -->
                    <div class=\"topbar\">

                        <nav class=\"navbar-custom\">

                            <ul class=\"list-inline float-right mb-0\">
                                <!-- Fullscreen -->
                                <li class=\"list-inline-item dropdown notification-list hidden-xs-down\">
                                    <a class=\"nav-link waves-effect\" href=\"#\" id=\"btn-fullscreen\">
                                        <i class=\"mdi mdi-fullscreen noti-icon\"></i>
                                    </a>
                                </li>
                                <!-- notification-->
                                <li class=\"list-inline-item dropdown notification-list\">
                                    <a class=\"nav-link dropdown-toggle arrow-none waves-effect\" data-toggle=\"dropdown\" href=\"#\" role=\"button\"
                                       aria-haspopup=\"false\" aria-expanded=\"false\">
                                        <i class=\"ion-ios7-bell noti-icon\"></i>
										".($notif>=1 ? "<span class=\"badge badge-danger noti-icon-badge\" id='notifCount'>$notif</span>":"")."
                                        
                                    </a>
                                    <div class=\"dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg\" id=\"user-notif\">
                                        <!-- item-->
                                        <div class=\"dropdown-item noti-title\">
                                            <h5>".($notif>=1 ? "Notification ($notif)":"No New Notifications")."</h5>
                                        </div>

										".($notif>=1 ? "<a href=\"user-inbox\" class=\"dropdown-item notify-item\">
															<div class=\"notify-icon bg-warning\"><i class=\"mdi mdi-message\"></i></div>
															<p class=\"notify-details\"><b>New System Messages</b><small class=\"text-muted\">You have $notif unread messages</small></p>
														</a>":"")."
                                        

                                        <!-- All-->
                                        <a href=\"user-inbox\" class=\"dropdown-item notify-item\">
                                            View All
                                        </a>

                                    </div>
                                </li>
                                <!-- User-->
                                <li class=\"list-inline-item dropdown notification-list\">
                                    <a class=\"nav-link dropdown-toggle arrow-none waves-effect nav-user\" data-toggle=\"dropdown\" href=\"#\" role=\"button\"
                                       aria-haspopup=\"false\" aria-expanded=\"false\">
                                        <img src=\"assets/images/users/avatar.jpg\" alt=\"user\" class=\"rounded-circle\">
                                    </a>
                                    <div class=\"dropdown-menu dropdown-menu-right profile-dropdown \">
                                        <a class=\"dropdown-item\" href=\"user-profile\"><i class=\"dripicons-user text-muted\"></i> Profile</a>
                                        <div class=\"dropdown-divider\"></div>
                                        <a class=\"dropdown-item\" href=\"logout\"><i class=\"dripicons-exit text-muted\"></i> Logout</a>
                                    </div>
                                </li>
                            </ul>

                            <!-- Page title -->
                            <ul class=\"list-inline menu-left mb-0\">
                                <li class=\"list-inline-item\">
                                    <button type=\"button\" class=\"button-menu-mobile open-left waves-effect\">
                                        <i class=\"ion-navicon\"></i>
                                    </button>
                                </li>
                            </ul>

                            <div class=\"clearfix\"></div>
                        </nav>

                    </div>
                    <!-- Top Bar End -->";

?>