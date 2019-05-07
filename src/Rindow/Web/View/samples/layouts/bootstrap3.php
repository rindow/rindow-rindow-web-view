<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $this->placeholder()->get('title','Title') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/assets/bootstrap3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/assets/bootstrap3/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/css/colors.css" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/css/style.css" />
    <!--[if lt IE 9]>
        <script src="<?= $this->url()->prefix() ?>/js/vendor/html5shiv.min.js"></script>
        <script src="<?= $this->url()->prefix() ?>/js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Static navbar -->
    <header class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= $this->url()->rootPath().'/' ?>"><?= $this->placeholder()->get('brand-title','My Site') ?></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-cog"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!-- /.container -->
    </header>
    <!-- Main Content -->
    <?= $this->displayContent($this->content) ?>
    <script src="<?= $this->url()->prefix() ?>/js/vendor/jquery-1.10.2.min.js"></script>
    <script src="<?= $this->url()->prefix() ?>/assets/bootstrap3/js/bootstrap.min.js"></script>
  </body>
</html>
