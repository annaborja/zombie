<?php
$title='Zappos Zombie Zurvival';
$page='zombie';

if(isset($_GET['p']))
{
    switch($_GET['p'])
    {
        case 'ninja':
            $title='Ninjabook';
            $page='ninja';
            break;
        case 'dragon':
            $title='A Zoo with Dragons';
            $page='dragon';
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
    <!-- Make the container go all the way to the bottom of the topbar -->
    <style>body{padding-top:60px;}</style>
    <link rel="stylesheet" href="/assets/css/bootstrap-responsive.min.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <div class="navbar navbar-fixed-top"><div class="navbar-inner"><div class="container">
        <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
        <a class="brand" href="/">Zombie</a>
        <div class="nav-collapse">
            <ul class="nav">
                <li<?php if($page==='ninja')
                    echo ' class="active"';?>><a href="/index.php?p=ninja">Ninja</a></li>
                <li<?php if($page==='dragon')
                    echo ' class="active"';?>><a href="/index.php?p=dragon">Dragon</a></li>
            </ul>
        </div>
    </div></div></div>
    <div class="container"><?php require '../inc/'.$page.'.php';?></div>
<script src="/assets/js/jquery-1.7.2.min.js"></script>
<script src="/assets/js/bootstrap-collapse.js"></script>
<script src="/assets/js/bootstrap-transition.js"></script>
</body>
</html>




