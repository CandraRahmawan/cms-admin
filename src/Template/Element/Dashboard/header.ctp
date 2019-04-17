<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $this->Url->build(['plugin' => 'Dashboard', 'controller' => 'Dashboard', 'action' => 'index', '_ext' => 'html']) ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>C</b>MS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>CMS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success"><?php if ($global_guestbook->count() != 0) echo $global_guestbook->count(); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have <?php echo $global_guestbook->count(); ?> messages</li>
                        <?php
                        foreach ($global_guestbook->toArray() as $item) {
                            ?>
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="<?php echo $this->Url->build(['plugin' => 'Message', 'controller' => 'Guestbook', 'action' => 'read', '_ext' => 'html', '?' => ['guestbook_id' => $item['guestbook_id']]]); ?>">
                                            <div class="pull-left">
                                                <i class="fa fa-fw fa-envelope"></i>
                                            </div>
                                            <h4>
                                                <?php echo $item['full_name']; ?>
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p><?php echo $item['subject']; ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="footer"><a href="<?php echo $this->Url->build(['plugin' => 'Message', 'controller' => 'Guestbook', 'action' => 'lists', '_ext' => 'html']); ?>">See All Messages</a></li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        $attr = ['class' => 'user-image', 'alt' => 'User Image', 'onerror' => 'javascript:this.src="' . $base . '/img/no-user.png"'];
                        $path_image_session = $session_user['path_img'];
                        if ($path_image_session != '-') {
                            echo $this->Html->image($session_user['path_img'], $attr);
                        } else {
                            echo $this->Html->image($base . '/img/no-user.png', $attr);
                        }
                        ?>
                        <span class="hidden-xs"><?php echo $session_user['first_name'] . ' ' . $session_user['last_name']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php
                            $attr = ['class' => 'user-circle', 'alt' => 'User Image', 'onerror' => 'javascript:this.src="' . $base . '/img/no-user.png"'];
                            $path_image_session = $session_user['path_img'];
                            if ($path_image_session != '-') {
                                echo $this->Html->image($session_user['path_img'], $attr);
                            } else {
                                echo $this->Html->image($base . '/img/no-user.png', $attr);
                            }
                            ?>
                            <p>
                                <?php echo $session_user['first_name'] . ' ' . $session_user['last_name']; ?> - <?php echo $session_user['status']; ?>
                                <small>Member since <?php echo date('M. Y', strtotime($session_user['create_date'])); ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo $this->Url->build(['plugin' => 'Users', 'controller' => 'Users', 'action' => 'profile', '_ext' => 'html?id_user=' . $session_user['user_id'] . '']); ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo $this->Url->build(['plugin' => null, 'controller' => 'Login', 'action' => 'logout', '_ext' => 'html']); ?>" class="btn btn-default btn-flat" onclick="return confirm('Are you sure to Sign out ?')">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>