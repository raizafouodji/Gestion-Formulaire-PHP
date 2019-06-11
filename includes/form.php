<html><head>
  <style>
    .error{
      color: red;
    }
  </style>
</head>
<body cz-shortcut-listen="true">
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="author" value='AB'>
    <input type="text" name="title" value=<?php echo $sauvegarde['title'] ?> >
    <p class="error"><?php echo $error['title'] ?></p>
    <hr>
    <textarea name="message"><?php echo $sauvegarde['message'] ?></textarea>
    <p class="error"><?php echo $error['message'] ?></p>
    <hr>
    <input type="checkbox" name="like[]" value="coffee" <?php if (in_array('coffe',$sauvegarde['like'])) echo 'checked'?>> Café <!--On dit que si il y a la valeur cofee dans like, on active la case avec checked -->
    <input type="checkbox" name="like[]" value="tea" <?php if (in_array('tea',$sauvegarde['like'])) echo 'checked'?>> Thé
    <input type="checkbox" name="like[]" value="cacolac" <?php if (in_array('cacolac',$sauvegarde['like'])) echo 'checked'?>> Cacolac
    <p class="error"><?php echo $error['like'] ?></p>
    <hr>
    <input type="radio" name="gender" value="male" <?php if ($sauvegarde['gender']=='male') echo 'checked'?> > Homme
    <input type="radio" name="gender" value="female"  <?php if ($sauvegarde['gender']=='female') echo 'checked'?>> Femme
    <p class="error"><?php echo $error['gender'] ?></p>
    <hr>
    <input type="file" name="cup" value=<?php echo $sauvegarde['cup'] ?>>
    <p class="error"><?php echo $error['cup'] ?></p>
    <hr>
    <input type="submit" value="Envoyer">
  </form>


</body></html>
