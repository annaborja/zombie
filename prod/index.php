<?php
$pages = array(
  'zombie' => 'Zappos Zombie Zurvival',
  'ninja' => 'Ninjabook',
  'dragon' => 'A Zoo with Dragons',
  'zappos' => 'Zappos',
  'todo' => 'TODO'
);
$p = 'zombie';
$title = $pages['zombie'];

if (isset($_GET['p']) && array_key_exists($input_p = strtolower($_GET['p']), $pages))
{
  $p = $input_p;
  $title = $pages[$p];
}
?>
<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=en><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang=en><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang=en><![endif]-->
<!--[if gt IE 8]><!--> <html class=no-js lang=en> <!--<![endif]-->
<head>
  <meta charset=utf-8>
  <meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1">

  <title><?php echo $title; ?></title>
  <meta name=description content="Your survival guide for the zombie apocalypse">
  <meta name=author content="Anna Borja">

  <meta name=viewport content="width=device-width, initial-scale=1.0">

  
  <link rel=apple-touch-icon-precomposed sizes=144x144 href="apple-touch-icon-144x144-precomposed.png">
  <link rel=apple-touch-icon-precomposed sizes=114x114 href="apple-touch-icon-114x114-precomposed.png">
  <link rel=apple-touch-icon-precomposed sizes=72x72 href="apple-touch-icon-72x72-precomposed.png">
  <link rel=apple-touch-icon-precomposed href="apple-touch-icon-precomposed.png">

  <link rel=stylesheet href='css/ecee1d3.css'>
    
  <script src="js/libs/modernizr-2.5.3.min.js"></script>
</head>
<body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

  <nav id=top><ul>
<?php foreach($pages as $page => $page_title): ?>
    <li><a class="btn btn-danger<?php if ($p === $page) echo ' active'; ?>"
    href="/index.php?p=<?php echo $page; ?>"><?php echo ucfirst($page); ?></a></li>
<?php endforeach; ?>
  </ul></nav>

  <div class=content>
<?php include '../inc/'.$p.'.php'; ?>
  </div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery||document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>');</script>

<script src="js/a7f84a0.js"></script>
</body>
</html>
