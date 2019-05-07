<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <title><?= $this->placeholder()->get('title','Title') ?></title>
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/assets/foundation6/css/foundation.min.css" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/css/colors.css" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/css/style.css" />
    <!--script src="<?= $this->url()->prefix() ?>/js/modernizr.js"></script-->
  </head>
  <body>

<div class="off-canvas-wrapper">
  <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

    <div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas data-position="left">
      <div class="title-bar">
        <div class="title-bar-left">
          <a class="title-bar-title" href="<?= $this->url()->rootPath().'/' ?>"><?= $this->placeholder()->get('brand-title','My Site') ?></a>
        </div>
        <button class="close-button" aria-label="Close menu" type="button" data-close>
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <ul class="vertical menu" data-responsive-menu="drilldown medium-dropdown">
        <li>
          <a href="#">Subject#1</a>
          <ul class="submenu menu vertical">
            <li><a href="#">Link#1</a></li>
            <li><a href="#">Link#2</a></li>
            <li><a href="#">Link#3</a></li>
          </ul>
        </li>
        
        <li>
          <a href="#">Subject#2</a>
          <ul class="submenu menu vertical">
            <li><a href="#">Link#1</a></li>
            <li><a href="#">Link#2</a></li>
            <li><a href="#">Link#3</a></li>
          </ul>
        </li>
      </ul><!-- class="vertical menu" -->
    </div><!-- class="off-canvas position-left" -->

    <div class="off-canvas-content" data-off-canvas-content>
    
      <div class="title-bar hide-for-medium" data-responsive-toggle="small-menu" data-hide-for="medium">
        <div class="title-bar-left">
          <button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
          <span class="title-bar-title">My Site</span>
        </div>
      </div>
      
      <!-- TOP BAR MENU -->
      <nav class="show-for-medium">
        <div class="top-bar">
          <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
              <li class="menu-text">My Site</li>
              <li><a href="<?= $this->url()->rootPath().'/' ?>">Home</a></li>
              <li>
                <a href="#">One</a>
                <ul class="menu vertical">
                  <li><a href="#">One</a></li>
                  <li><a href="#">Two</a></li>
                  <li><a href="#">Three</a></li>
                </ul>
              </li>
              <li><a href="#">Two</a></li>
              <li><a href="#">Three</a></li>
            </ul>
          </div>
          <div class="top-bar-right">
            <ul class="menu">
              <li><input type="search" placeholder="Search"></li>
              <li><button type="button" class="button">Search</button></li>
            </ul>
          </div>
        </div>
      </nav>
      
      <!-- Main Content -->
      <?= $this->displayContent($this->content) ?>
    
    </div><!-- class="off-canvas-content" -->


  </div><!-- class="off-canvas-wrapper-inner" -->
</div><!-- class="off-canvas-wrapper" -->

<script src="<?= $this->url()->prefix() ?>/assets/foundation6/js/vendor/jquery.js"></script>
<script src="<?= $this->url()->prefix() ?>/assets/foundation6/js/vendor/what-input.js"></script>
<script src="<?= $this->url()->prefix() ?>/assets/foundation6/js/vendor/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>

  </body>
</html>
