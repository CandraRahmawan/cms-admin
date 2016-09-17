<section class="content-header">
    <h1>
        <?php echo ucfirst($this->request->params['controller']) . ' ' . ucfirst($this->request->params['action']); ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['plugin' => 'Dashboard', 'controller' => 'Dashboard', 'action' => 'index', '_ext' => 'html']); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <?php
            if ($this->request->params['plugin'] != 'Dashboard') {
                echo "<li><a href=\"" . $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => $this->request->params['controller'], 'action' => $this->request->params['action'], '_ext' => 'html']) . "\">" . $this->request->params['plugin'] . "</a></li>";
                echo '<li class="active">' . ucfirst($this->request->params['action']) . '</li>';
            } else {
                echo '<li class="active">' . ucfirst($this->request->params['action']) . '</li>';
            }
            ?>
    </ol>
</section>