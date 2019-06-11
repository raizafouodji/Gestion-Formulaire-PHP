<?php

require('bdd/mysql.php');
require('form/validate.php');

if (isset($_POST['author'])){//on verifie que la variable author existe dans la super global $_POST pour savoir si l'utilisateur envoi un formulaire ou si c'est sa permiere visite
 //du coup avec le isset on sait que l'utilisateur nous à envoyé un formulaire
  $resultat=validate($_POST,$sauvegarde,$error);

  if($resultat['valid']){// si le formulaire est valide revient à $resultat['valid']==true
    // On enregistre dans la base de données (Pensez à importer le fichier exemple.sql dans votre phpmyadmin)

    /*

    Warning!Warning!Warning!

    Ici on va directement ajouter les valeurs à la base de donnée sans vérifier que l'on nous attaque pas.
    Vous pouvez voir pour vous documenter: injection sql,php,js.

    Pour se proteger: Voir requete préparé de PDO, les regex,htmlspecialchars()...

    Des bases : https://openclassrooms.com/fr/courses/2091901-protegez-vous-efficacement-contre-les-failles-web/2680180-linjection-sql

    En vrai don't worry, il y a des frameworks qui le font pour vous :)
    */
    set_form_in_BD($resultat['sauvegarde']);//on ajoute dans la BDD base de données
    require('includes/valid.html'); //on ajoute la vue au controller
  }else{
    //si c'est faux
    $sauvegarde=$resultat['sauvegarde'];
    $error=$resultat['error'];
    require('includes/form.php'); //on ajoute la vue au controller
  }
}else{
  //si c'est la premiere visite
  require('includes/form.php'); //on ajoute la vue au controller
}


?>
