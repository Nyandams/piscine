<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Connexion</title>

    <!-- Bootstrap -->
    <link type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url('assets/css/connexion.css');?>" rel="stylesheet">
  </head>
  
 <body>

<div class="container">

      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading">Connectez vous</h2>
        <label for="pseudo" class="sr-only">pseudo</label>
        <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="login" value="<?php echo set_value('pseudo'); ?>">
        <?php echo form_error('pseudo'); ?>
        <label for="mdp" class="sr-only">mot de passe</label>
        <input type="password" id="mdp" name="mdp" class="form-control" placeholder="mot de passe" value="">
        <?php echo form_error('mdp'); ?>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
      </form>

</div> <!-- /container -->



</body>
</html>