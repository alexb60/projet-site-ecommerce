<?php
class Utils
{
  public static function upload($extensions, $fichier)
  {
    // ctrl sur le nom ==> regex (pas de caract speciaux)
    // ctrl sur les extensions autorisees
    // ctrl sur la taille
    // ne pas ecraser un fichier existant


    $file_name = $fichier['name'];
    $file_size = $fichier['size'];
    $file_tmp = $fichier['tmp_name'];
    $file_ext = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));

    $uploadOk = false; // par defaut false avant que je fasse les controles
    $errors = ""; // chaine contient les messages d'erreurs s'il y en a

    $pattern = "/^[\p{L}\w\d\s\-\.]{3,}$/";
    if (!preg_match($pattern, $file_name)) {
      $errors .= "Nom de fichier non valide. <br/>";
    }

    if (!in_array($file_ext, $extensions)) {
      $errors .= "extension non autorisée. <br/>";
    }

    if ($file_size > 3000000) {
      $errors .= "taille du fichier ne doit pas dépasser 3 Mo. <br/>";
    }

    $file_name = substr(md5($fichier['name']), 10) . ".$file_ext";

    while (file_exists("../../images/marque/$file_name")) {
      $file_name = substr(md5($file_name), 10) . ".$file_ext";
    }

    if ($errors === "") {
      if (move_uploaded_file($file_tmp,  "../../images/marque" . $file_name)) {
        $uploadOk = true;
        return ["uploadOk" => $uploadOk, "file_name" => $file_name, "errors" => $errors];
      } else {
        $errors .= "Echec de l'upload. <br/>";
      }
    }

    return ["uploadOk" => false, "file_name" => "", "errors" => "Aucun fichier n'est uploadé.<br>$errors"];
  }
}
