<!--html-header-->
<!-- Navigation - Barra de Menus-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container container-style">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Navegação</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url();?>">D&D On Flow</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href=" <?php echo base_url('taberna'); ?>">Taberna</a>
                </li>
                <li>
                    <a href=" <?php echo base_url('masmorra'); ?> ">Masmorras</a>
                </li>
                <li>
                    <a href="<?php echo base_url('contato'); ?> ">Comunhão</a>
                </li>
                <li>
                    <a href="<?php echo base_url('sobre'); ?> ">Sobre</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<!--Inicio.php-->