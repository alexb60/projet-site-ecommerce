<?php
class Utils
{
  public static function upload($extensions, $fichier)
  {
    // contrôle sur le nom ==> regex (pas de caractères spéciaux)
    // contrôle sur les extensions autorisées
    // contrôle sur la taille
    // ne pas écraser un fichier existant

    $file_name = $fichier['name'];
    $file_size = $fichier['size'];
    $file_tmp = $fichier['tmp_name'];
    $file_ext = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));

    $uploadOk = false; // par défaut false avant que je fasse les contrôles
    $errors = ""; // chaîne contenant les messages d'erreurs s'il y en a

    $pattern = "/^[\p{L}\w\s\-\.]{3,}$/";
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

    while (file_exists("images/$file_name")) {
      $file_name = substr(md5($file_name), 10) . ".$file_ext";
    }

    if ($errors === "") {
      if (move_uploaded_file($file_tmp,  "images/" . $file_name)) {
        $uploadOk = true;
        return ["uploadOk" => $uploadOk, "file_name" => $file_name, "errors" => $errors];
      } else {
        $errors .= "Echec de l'upload. <br/>";
      }
    }

    return ["uploadOk" => false, "file_name" => "", "errors" => "Aucun fichier n'est uploadé.<br>$errors"];
  }

  // validation pour une seule expression
  public static function validation($str, $type)
  {
    $valide = false;
    $str = trim(strip_tags((string)$str));

    //https://www.php.net/manual/fr/regexp.reference.unicode.php
    $tabRegex = [
      "non" => "//",
      "test" => '/[\w]123/',
      "nom" => "/^[\p{L}\s\-]{1,}$/u",
      "prenom" => "/^[\p{L}\s\-]{2,}$/u",
      "tel" => "/^[\+]?[0-9]{10}$/",
      "photo" => "/^[\w\s\-\.]{1,22}(.jpg|.jpeg|.png|.gif)$/",
      "id" => "/[\d]+/",
      "pass" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/",
      "adresse" => "/^[\w\-\s]{5,}$/",
      "ville" => "/^[\p{L}\s\-]{1,}$/u",
      "code_post" => "/^((0[1-9])|([1-8]\d|9[0-578]))\d{3}$/",
      "prix" => "/^\d{1,}(\.\d{2}){0,1}$/",
      "ref" => "/^[a-zA-Z0-9]{1,}$/",
      "quantite" => "/^\d{1,}$/",
      "description" => "/^[\p{L}\s\-\d\?\!\;\,\.\_]{1,}$/u",
      "nom_produit" => "/^[\p{L}\s\-\d\.\,\(\)\'\"]{1,}$/u"
    ];

    //https://www.php.net/manual/fr/filter.filters.validate.php
    switch ($type) {
      case "email":
        if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
          $valide = true;
        }
        break;
      case "url":
        if (filter_var($str, FILTER_VALIDATE_URL)) {
          $valide = true;
        }
        break;
      case "non":
        $valide = true;
      default:
        if (preg_match($tabRegex[$type], $str)) {
          $valide = true;
        }
    }

    $valide === true ? $message = "" : $message = "<div class='alert alert-danger'><i class='fas fa-exclamation-triangle'></i>&nbsp; Le champ $type n'est pas au format demandé. [contrôle serveur]</div>";

    $errorsTab = [$str, $message];
    return $errorsTab;
  }

  public static function valider($donnees, $types)
  {
    $erreurs = "";
    $donneesValides = []; // donnee = str apres nettoyage 
    for ($i = 0; $i < count($donnees); $i++) {
      $tab = Utils::validation($donnees[$i], $types[$i]);
      if ($tab[1]) {
        $erreurs .= $tab[1];
      }
      $donneesValides[] = $tab[0];
    }
    if ($erreurs) {
      echo $erreurs;
      return false;
    }
    return
      $donneesValides;
  }
}
