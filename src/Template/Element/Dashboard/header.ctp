<header class="main-header">
    <a href="<?php echo $this->Url->build(['plugin' => 'Dashboard', 'controller' => 'Dashboard', 'action' => 'index', '_ext' => 'html']) ?>"
       class="logo">
        <span class="logo-mini"><b>C</b>MS</span>
        <span class="logo-lg"><b>Admin</b>CMS</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <?= $this->Element('Dashboard/mailbox'); ?>
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
                                <?php echo $session_user['first_name'] . ' ' . $session_user['last_name']; ?>
                                - <?php echo $session_user['status']; ?>
                                <small>Member
                                    since <?php echo date('M. Y', strtotime($session_user['create_date'])); ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo $this->Url->build(['plugin' => 'Users', 'controller' => 'Users', 'action' => 'profile', '_ext' => 'html?id_user=' . $session_user['user_id'] . '']); ?>"
                                   class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo $this->Url->build(['plugin' => null, 'controller' => 'Login', 'action' => 'logout', '_ext' => 'html']); ?>"
                                   class="btn btn-default btn-flat"
                                   onclick="return confirm('Are you sure to Sign out ?')">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>