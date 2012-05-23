<?php
$pages=array('zombie','ninja','dragon');
$title='Zappos Zombie Zurvival';
$p='zombie';

if(isset($_GET['p']))
{
    switch($_GET['p'])
    {
        case 'ninja':
            $title='Ninjabook';
            $p='ninja';
            break;
        case 'dragon':
            $title='A Zoo with Dragons';
            $p='dragon';
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Anna Borja">
    <meta name="description" content="Your survival guide for the zombie apocalypse">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-responsive.min.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <div class="navbar"><div class="navbar-inner"><div class="container">
        <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
        <div class="nav-collapse">
            <ul class="nav">
                <?php foreach($pages as $page):?>
                <li<?php if($p===$page) echo ' class="active"';?>><a href="/index.php?p=<?php
                    echo $page;?>"><?php echo ucfirst($page);?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
    </div></div></div>
    <div class="container-fluid">
        <?php require '../inc/'.$p.'.php';?>
    </div>
<script src="/assets/js/jquery-1.7.2.min.js"></script>
<script src="/assets/js/bootstrap-collapse.js"></script>
<script src="/assets/js/bootstrap-transition.js"></script>
<script>
$(document).ready(function() {
  function filterPath(string) {
  return string
    .replace(/^\//,'')
    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
    .replace(/\/$/,'');
  }
  var locationPath = filterPath(location.pathname);
  var scrollElem = scrollableElement('html', 'body');

  $('a[href*=#]').each(function() {
    var thisPath = filterPath(this.pathname) || locationPath;
    if (  locationPath == thisPath
    && (location.hostname == this.hostname || !this.hostname)
    && this.hash.replace(/#/,'') ) {
      var $target = $(this.hash), target = this.hash;
      if (target) {
        var targetOffset = $target.offset().top;
        $(this).click(function(event) {
          event.preventDefault();
          $(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
            location.hash = target;
          });
        });
      }
    }
  });

  function scrollableElement(els) {
    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
      var el = arguments[i],
          $scrollElement = $(el);
      if ($scrollElement.scrollTop()> 0) {
        return el;
      } else {
        $scrollElement.scrollTop(1);
        var isScrollable = $scrollElement.scrollTop()> 0;
        $scrollElement.scrollTop(0);
        if (isScrollable) {
          return el;
        }
      }
    }
    return [];
  }
});
</script>
</body>
</html>
