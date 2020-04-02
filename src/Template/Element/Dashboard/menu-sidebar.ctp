<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <?php
            $attr = ['class' => 'img-circle', 'alt' => 'User Image', 'onerror' => 'javascript:this.src="' . $base . '/img/no-user.png"'];
            $path_image_session = $session_user['path_img'];
            if ($path_image_session != '-') {
                echo $this->Html->image($session_user['path_img'], $attr);
            } else {
                echo $this->Html->image($base . '/img/no-user.png', $attr);
            }
            ?>
        </div>
        <div class="pull-left info">
            <p><?php echo $session_user['first_name'] . ' ' . $session_user['last_name']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="<?php echo $this->Url->build(['plugin' => 'Dashboard', 'controller' => 'Dashboard', 'action' => 'index', '_ext' => 'html']) ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <?php if ($session_user['status'] == 'Administrator'): ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build(['plugin' => 'Users', 'controller' => 'Users', 'action' => 'add', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
                    <li><a href="<?php echo $this->Url->build(['plugin' => 'Users', 'controller' => 'Users', 'action' => 'lists', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> List User</a></li>
                </ul>
            </li>
        <?php endif; ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-tags"></i>
                <span>Category</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Category', 'controller' => 'Category', 'action' => 'form', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> Add Category</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Category', 'controller' => 'Category', 'action' => 'lists', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> List Category</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-file-text-o"></i>
                <span>Content</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Content', 'controller' => 'Content', 'action' => 'formArticle', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> Create New Article</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Content', 'controller' => 'Content', 'action' => 'formPage', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> Create Page</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Content', 'controller' => 'Content', 'action' => 'formSection', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> Create New Section</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Content', 'controller' => 'Content', 'action' => 'listsArticle', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> List Article</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Content', 'controller' => 'Content', 'action' => 'listsPage', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> List Page</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Content', 'controller' => 'Content', 'action' => 'listsSection', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> List Section</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-fw fa-opencart"></i>
                <span>Products</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Products', 'controller' => 'Products', 'action' => 'formProduct', '_ext' => 'html']); ?>"><i class="fa fa-cart-plus"></i> Add Item</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Products', 'controller' => 'Products', 'action' => 'lists', '_ext' => 'html']); ?>"><i class="fa fa-th-list"></i> List Product</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Products', 'controller' => 'Products', 'action' => 'formArticle', '_ext' => 'html']); ?>"><i class="fa fa-asterisk"></i> Featured Category</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-envelope"></i>
                <span>Message</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Message', 'controller' => 'Mailbox', 'action' => 'lists', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> MailBox</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-comments"></i>
                <span>Comments</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Comments', 'controller' => 'Reviews', 'action' => 'lists', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> Reviews</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-fw fa-image"></i>
                <span>Gallery</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Gallery', 'controller' => 'SliderBanner', 'action' => 'form', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> Add Slider Banner</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Gallery', 'controller' => 'SliderBanner', 'action' => 'lists', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> Slider Banner</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-fw fa-file-image-o"></i>
                <span>Images Manage</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Images', 'controller' => 'Images', 'action' => 'form', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> Upload Images</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Images', 'controller' => 'Images', 'action' => 'lists', '_ext' => 'html']); ?>"><i class="fa fa-circle-o"></i> List Images</a></li>
            </ul>
        </li>
        <li>
            <a href="<?php echo $this->Url->build(['plugin' => 'Plugins', 'controller' => 'Plugins', 'action' => 'lists', '_ext' => 'html']) ?>">
                <i class="fa fa-plug"></i> <span>Plugins</span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-fw fa-th-large"></i>
                <span>Themes</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Themes', 'controller' => 'Themes', 'action' => 'lists', '_ext' => 'html']); ?>"><i class="fa fa-th-list"></i> List Themes</a></li>
                <li><a href="<?php echo $this->Url->build(['plugin' => 'Themes', 'controller' => 'Menu', 'action' => 'lists', '_ext' => 'html']);   ?>"><i class="fa fa-th-list"></i> List Menu</a></li>
            </ul>
        </li>
    </ul>
</section>
