<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $this->placeholder()->get('title','Title') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/assets/bootstrap4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/css/colors.css" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/css/style.css" />
  </head>
  <body>
    <!-- Static navbar -->
    <header class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="<?= $this->url()->rootPath().'/' ?>"><?= $this->placeholder()->get('brand-title','My Site') ?></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="#">Link</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
                <a class="dropdown-item" href="#">One more separated link</a>
              </div>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!-- /.container -->
    </header>
    <!-- Main Content -->
    <?= $this->displayContent($this->content) ?>
    <script src="<?= $this->url()->prefix() ?>/assets/jquery/jquery-3.3.1.slim.min.js"></script>
    <script src="<?= $this->url()->prefix() ?>/assets/bootstrap4/js/bootstrap.min.js"></script>
  </body>
</html>
