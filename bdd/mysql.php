<?php

function connectBD(){//Pour se connecter à la base de donnée
  $cnx= new PDO('mysql:host=localhost;dbname=pmd2021', 'root', 'root');//pensez à changer les valeurs PDO('mysql:dbname=testdb;host=127.0.0.1', 'user', 'mdp')
  if ($cnx == NULL) {
  echo "Echec BD";
  die();
  }
  return $cnx;
}

function set_form_in_BD($tab){ //quand vous allez mettre quelque chose dans la base de données c'est bien de mettre set en début de nom pour dire que c'est un "setter", on attribut une valeur et si on récupere c'est bient get pour "getter"
  /*

   Warning!Warning!Warning!

   Ici on va directement ajouter les valeurs à la base de donnée sans vérifier que l'on nous attaque pas.
   Vous pouvez voir pour vous documenter: injection sql,php,js.

   Pour se proteger: Voir requete préparé de PDO, les regex,htmlspecialchars()...

   Des bases : https://openclassrooms.com/fr/courses/2091901-protegez-vous-efficacement-contre-les-failles-web/2680180-linjection-sql

   En vrai don't worry, il y a des frameworks qui le font pour vous :)
   */

  //on convertie le tableau $asauv['like'] en chaine de caractère car on ne peut pas directement enregistrer des tableaux en MYSQL.
  $tab['like']=implode(",", $tab['like']);
  // on dit que male=1 et female=2; ca prend moins de place en base de donnée.
  if($tab['gender']=='male'){
    $tab['gender']=1;
  }else{
    $tab['gender']=2;
  }
  
  $cnx=connectBD();
  $req = $cnx->prepare("INSERT INTO formulaire (author,title,message,likes,gender,cup) VALUES (?,?,?,?,?,?)");
  $req->execute(array($tab['author'],$tab['title'],$tab['message'],$tab['like'],$tab['gender'],$tab['link']));
}


?>
