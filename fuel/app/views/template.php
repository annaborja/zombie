
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Zappos Zombie Zurvival</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your survival guide for the zombie apocalypse">
    <meta name="author" content="Anna Borja">

    <!-- Le styles -->
    <?php echo Asset::css('bootstrap.min.css'); ?>
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <?php echo Asset::css('bootstrap-responsive.min.css'); ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/favicon.ico">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/welcome">Zombie</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li<?php if (Uri::segment(2) === 'ninja') echo ' class="active"'; ?>><a href="/welcome/ninja">Ninja</a></li>
              <li<?php if (Uri::segment(2) === 'dragon') echo ' class="active"'; ?>><a href="/welcome/dragon">Dragon</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
        <?php echo $content; ?>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<?php
echo Asset::js('jquery-1.7.2.min.js');
echo Asset::js('bootstrap-collapse.js');
echo Asset::js('bootstrap-transition.js');
//echo Asset::js('bootstrap-tooltip.js');
//echo Asset::js('bootstrap-popover.js');
//echo Asset::js('bootstrap-dropdown.js');
//echo Asset::js('bootstrap-alert.js');
//echo Asset::js('bootstrap-modal.js');
//echo Asset::js('bootstrap-scrollspy.js');
//echo Asset::js('bootstrap-tab.js');
//echo Asset::js('bootstrap-button.js');
//echo Asset::js('bootstrap-carousel.js');
//echo Asset::js('bootstrap-typeahead.js');
?>
  </body>
</html>
