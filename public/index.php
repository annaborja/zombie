<?php
$pages = array(
    'zombie' => 'Zappos Zombie Zurvival',
    'ninja' => 'Ninjabook',
    'dragon' => 'A Zoo with Dragons',
    'zappos' => 'Zappos',
    'todo' => 'Todo List'
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
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo $title; ?></title>
    <meta name="description" content="Your survival guide for the zombie apocalypse">
    <meta name="author" content="Anna Borja">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--http://mathiasbynens.be/notes/touch-icons-->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">

    <!--1140px Grid styles for IE - http://cssgrid.net/-->
    <!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="css/style.css">
    
    <script src="js/libs/modernizr-2.5.3.min.js"></script>
</head>
<body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

    <section id="top"><div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
                <div class="nav-collapse">
                    <ul class="nav">
<?php foreach($pages as $page => $page_title): ?>
    <li<?php if ($p === $page) echo ' class="active"'; ?>><a href="/index.php?p=<?php
        echo $page; ?>"><?php echo ucfirst($page); ?></a></li>
<?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div></section>
    <div class="container-fluid">
<?php include '../inc/'.$p.'.php'; ?>
    </div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')</script>

<script src="js/plugins.js"></script>
<script src="js/script.js"></script>
</body>
</html>
