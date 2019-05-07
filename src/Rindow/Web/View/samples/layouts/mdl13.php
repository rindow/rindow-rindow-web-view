<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title><?= $this->placeholder()->get('title','Title') ?></title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="<?= $this->url()->prefix() ?>/images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?= $this->placeholder()->get('title','Title') ?>">
    <link rel="apple-touch-icon-precomposed" href="<?= $this->url()->prefix() ?>/images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="<?= $this->url()->prefix() ?>/images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="<?= $this->url()->prefix() ?>/images/favicon.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/assets/mdl130/material.min.css">
    <!--link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"-->
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/css/colors.css" />
    <link rel="stylesheet" href="<?= $this->url()->prefix() ?>/css/style.css" />
    <style>
    .rindow-mdl-noshow {
      display: none;
    }
    </style>
  </head>
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?= $this->placeholder()->get('navbar-title','My Site') ?></span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-navigation mdl-layout--large-screen-only">
            <nav class="mdl-navigation">
              <a class="mdl-navigation__link" href="<?= $this->url()->rootPath().'/' ?>">Home</a>
              <a class="mdl-navigation__link" href="#">Link</a>
              <a class="mdl-navigation__link" href="#">Link</a>
            </nav>
          </div>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title"><?= $this->placeholder()->get('navbar-title','My Site') ?></span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="<?= $this->url()->rootPath().'/' ?>">Home</a>
          <a class="mdl-navigation__link" href="#">Link</a>
          <a class="mdl-navigation__link" href="#">Link</a>
        </nav>
      </div>
      <?= $this->displayContent($this->content) ?>
    </div>
    <div id="rindow-mdl-alertbox-container" class="mdl-js-snackbar mdl-snackbar">
      <div class="mdl-snackbar__text"></div>
      <div class="mdl-snackbar__action"></div>
    </div>
    <script src="<?= $this->url()->prefix() ?>/assets/mdl130/material.min.js"></script>
    <script>
    (function() {
      'use strict';
      var alertboxContainer = document.querySelector('#rindow-mdl-alertbox-container');
      var alertboxContent   = document.querySelector('#rindow-mdl-alertbox-content');
      if(alertboxContent!=null) {
        alertboxContainer.addEventListener('mdl-componentupgraded', function() {
          'use strict';
          var messages = [];
          alertboxContent.childNodes.forEach(function(item) {
            var content = item.textContent.trim();
            if(content.length>0) {
              messages.push(content);
            }
          });
          var showSnackbar = function() {
            if(messages.length>0) {
              var data = { message: messages.shift() };
              alertboxContainer.MaterialSnackbar.showSnackbar(data);
              if(messages.length>0) {
                console.log('setTimeout');
                setTimeout(showSnackbar,1000);
              }
            }
          };
          showSnackbar();
        });
      }
    }());
    </script>
  </body>
</html>
