<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <title><?= $this->placeholder()->get('title','Title') ?></title>
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/assets/foundation5/css/foundation.min.css" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/css/colors.css" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/css/style.css" />
    <script src="<?= $this->url()->prefix() ?>/assets/foundation5/js/vendor/modernizr.js"></script>
  </head>
  <body>
  	<div class="off-canvas-wrap">
  		<div class="inner-wrap">

<!-- TOP BAR MENU -->
<nav class="top-bar docs-bar hide-for-small" data-topbar>
  <ul class="title-area">
    <li class="name">
      <h1><a href="<?= $this->url()->rootPath().'/' ?>"><?= $this->placeholder()->get('brand-title','My Site') ?></a></h1>
    </li>
  </ul>

  <section class="top-bar-section">
    <!-- Left Nav Section -->
    <ul class="left">
      <li class="active"><a href="#">Item 1</a></li>
      <li class="has-dropdown">
        <a href="#">Item 2</a>
        <ul class="dropdown">
          <li><a href="#">Dropdown 1</a></li>
          <li><a href="#">Dropdown 2</a></li>
        </ul>
      </li>
      <li><a href="#">Item 3</a></li>
    </ul>

    <!-- Right Nav Section -->
    <ul class="right">
      <li><a href="#">Right Nav Button</a></li>
    </ul>
  </section>
</nav>

<!-- SMALL MENU -->
<nav class="tab-bar show-for-small">
  <a class="left-off-canvas-toggle menu-icon">
    <span>MySite</span>
  </a>
</nav>

<aside class="left-off-canvas-menu">
  <ul class="off-canvas-list">
    <li><label>MySite</label></li>
    <li><a href="#">Item 1</a></li>
    <li><a href="#">Item 2</a></li>
    <li><a href="#">Item 3</a></li>
    <li><a href="#">Item 4</a></li>
  </ul>
</aside>

<!-- Main Content -->
<?= $this->displayContent($this->content) ?>

<a class="exit-off-canvas"></a>

        </div><!-- class="inner-wrap" -->
    </div><!-- class="off-canvas-wrap" -->


    <script src="<?= $this->url()->prefix() ?>/assets/foundation5/js/vendor/jquery.js"></script>
    <script src="<?= $this->url()->prefix() ?>/assets/foundation5/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
