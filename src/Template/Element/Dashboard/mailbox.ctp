<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>
    <span class="label label-success"><?php if ($global_mailbox->count() != 0) echo $global_mailbox->count(); ?></span>
</a>
<ul class="dropdown-menu">
    <li class="header">You have <?php echo $global_mailbox->count(); ?> messages</li>
    <?php
    foreach ($global_mailbox->toArray() as $item) {
        ?>
        <li>
            <ul class="menu">
                <li>
                    <a href="<?php echo $this->Url->build(['plugin' => 'Message', 'controller' => 'Mailbox', 'action' => 'read', '_ext' => 'html', '?' => ['mailbox_id' => $item['mailbox_id']]]); ?>">
                        <div class="pull-left">
                            <i class="fa fa-fw fa-envelope"></i>
                        </div>
                        <h4>
                            <?php echo $item['name']; ?>
                            <small>
                                <i class="fa fa-clock-o"></i> <?= $item['send_date']; ?>
                            </small>
                        </h4>
                    </a>
                </li>
            </ul>
        </li>
        <?php
    }
    ?>
    <li class="footer"><a
                href="<?php echo $this->Url->build(['plugin' => 'Message', 'controller' => 'Mailbox', 'action' => 'lists', '_ext' => 'html']); ?>">See
            All Messages</a></li>
</ul>
