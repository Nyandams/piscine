<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
  <link type="text/css" href="<?php echo base_url('assets/css/piscine.css');?>" rel="stylesheet">
  <link type="text/css" href="<?php echo base_url('assets/css/navbar.css');?>" rel="stylesheet">
  <link type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="icon" href="https://www.festivaldujeu-montpellier.org/wp-content/uploads/2017/03/cropped-Logo_carre-192x192.png">

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php echo site_url('Welcome')?>">Sortons jouer</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo site_url('Festival')?>">Festivals</a></li>
        <li><a href="<?php echo site_url('Editeur'); ?>">Editeurs</a></li>
        <li><a href="<?php echo site_url('Contact');?>">Contacts</a></li>
        <li><a href="<?php echo site_url('organisateur'); ?>">Organisateur</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="#"><span class="glyphicon glyphicon-bell"><span class="badge alarmeSuivi">4</span></span></a></li>
        <li><a href="<?php echo site_url('connexionOrganisateur/deconnexion'); ?>"><span class="glyphicon glyphicon-log-in"></span> Déconnexion</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    
    
 	<nav class="navbar navbar-default sidebar" role="navigation">
    	<div class="container-fluid">
    	<div class="navbar-header">
      	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Suivis<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
        <li><a href="#">Réservations<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-folder-open"></span></a></li>
        <li><a href="#">Zones<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-large"></span></a></li>
        <li><a href="#">Factures<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-duplicate"></span></a></li>
        
      </ul>
    </div>
  </div>
</nav>
    
   
    </div>
    
    
    <div class="col-sm-10 text-left" id="contenuPage">


      <?php echo $page; ?>


      
    </div>
    
    
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
