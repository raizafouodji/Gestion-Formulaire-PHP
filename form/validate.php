<?php

/*
----------------------------------
Dans un premier temp on va définir les VARIABLES qui vont nous servir.
----------------------------------
*/
$sauvegarde=[
 'author' => "",
 'title' => "",
 'message' => "",
 'gender' => "",
 'cup' =>"",
 'like'=>[]
];

/* Voir les tableaux associatif : http://php.net/manual/fr/language.types.array.php
 Le tableau sauvegarde va contenir l'ensemble des variables de la super globale $_POST et que l'on va donner à la vue si l'utilisateur à mal remplie le formulaire (On redonne les valeurs pour éviter qu'il ai à tout reremplir si il à fait seulement une faute).
like on ne lui donne pas la valeur "" mais [] car c'est un tableau (http://php.net/manual/fr/language.types.array.php voir pour la difference entre [] et array() )*/

//------------

$error=[
 'author' => "",
 'title' => "",
 'message' => "",
 'gender' => "",
 'cup' =>"",
 'like'=>"",
 'link'=>""
];

//La normalement certain se sont dit "Bah Michel c'est quoi cette M*****", no stress se sont juste les variables qui vont nous servir à afficher s'il y a une erreur (voir dans le view.php)


/*
----------------------------------
Dans un second temp on va définir les FONCTIONS qui vont nous servir.
----------------------------------
*/

function uploadFile($file){//upload un fichier
    $uploads_dir = 'fichiers/';
    move_uploaded_file($file['tmp_name'],$uploads_dir.$file['name']);
    return $uploads_dir.$file['name']; //return le lien du fichier pour l'enregistrer dans la bdd
}


function validate($tab,$sauvegarde,$error){
/*
une fonction qui retourne un boolean pour savoir si nos valeurs envoyé en POST sont OK
J'ai mis un global dans le nom pas pour faire joli mais car dans cette fonction on pourrait avoir des sous fonctions qui gerent chacun un truc :
exemple une fonction qui valide qu'il y a bien un email, une autre qui verifie qu'il n'y ai pas d'attaque par injection, que le fichier dans CUP est valide....
*/

    function return_Error(){ //return juste une phrase de base si il y a une erreur
      return 'Merci de compléter le champ';
    }

    $valid=true; //Boolean qui va nous dire si le formulaire est juste, par défaut il est juste.
    $values_to_check=['author','title','message','like','gender'];
    // je ne verifie pas le cup car comme c'est un input de type file c'est particulié


    //ici on va juste vérifier que les valeurs écrites dans $values_to_check existes et ne sont pas vides
    //on aurait put vérifier que pour gender par exemple, il y a bien la valeur soit 'male' ou 'female'

    foreach ($values_to_check as $value_to_check) {
      if(array_key_exists($value_to_check, $tab) && !empty($tab[$value_to_check]) ){ //si dans post on à la variable auteur par exemple qui EXISTE "isset()"ou "array_key_exists()"          ET      qu'elle N'EST PAS VIDE "!empty()" ce qui revient à dire "empty()==true"
        $sauvegarde[$value_to_check]=$tab[$value_to_check];
      }else{
        $valid=false;
        $error[$value_to_check]=return_Error();
      }
    }
    //si valid=true alors si il y a un fichier on peut l'upload
    //Warning j'upload mais il faut vérifier avant qu'il n'y a pas une attaque par injection de fichier, je vous laisse regarder sur internet, je ne vais pas le faire ici
    $sauvegarde['link']="";
    if($valid==true && isset($_FILES["cup"])){
      $sauvegarde['link']=uploadFile($_FILES["cup"]);//voir la superglobale $_FILES sur internet
    }

  /* À la fin on retourne $valid pour dire si le formulaire est valide ou pas
  On retourne aussi la sauvegarde car si le formulaire n'est pas valide on va redonner à l'utilisateur les variables qui sont justes et qu'il à déjà rentrés.
  On retourne aussi le tableau d'erreurs pour les faires afficher.
  */
  return ['valid'=>$valid,
'sauvegarde'=>$sauvegarde,
'error'=>$error];

}

?>
