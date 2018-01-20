# installation du projet sur un serveur

1. Récupération du projet sur votre serveur (pour un serveur linux)

    1. Tout d'abord placez vous dans /var/www/html.
    
    2. Effectuez la commande suivante : git clone https://github.com/Nyandams/piscine.git.
    
    3. Créez un utilisateur mysql sur phpmyadmin qui permettra de se connecter à la base de donnée.
    
    4. Créez une nouvelle base de données sur phpmyadmin.
    
    5. Placez vous dans cette base de données, puis soit vous importez le fichier piscine.sql dans la base, soit dans l'onglet "SQL" vous recopier le code et validez.
    
    6. La base de données est maintenant installé, il faut alors faire le lien avec le projet, cela se passe dans /application/config/database.php , il faut modifier username, password et database en fonction de l'utilisateur mysql et de la table que vous avez créé :
    
    ```php
    $db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'piscine',
    'password' => 'piscine',
    'database' => 'piscine',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
    );
    ```
    
    7. enfin, dans application/config/config.php, modifiez la ligne
    ```php
    $config['base_url'] = 'http://localhost/piscine/';
    ```
    
    en changeant le localhost par le nom de domaine de votre site
    
    
    
    8. des utilisateurs de bases existent déjà, vous pouvez vous connecter sur l'utilisateur piscine (mdp : piscine) pour vous créer de nouveaux utilisateurs et les modifier.