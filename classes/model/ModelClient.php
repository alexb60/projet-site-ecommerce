<?php
require_once "connexion.php";

class ModelClient
{
  private $id;
  private $nom;
  private $prenom;
  private $mail;
  private $pass;
  private $adresse;
  private $ville;
  private $code_post;
  private $tel;
  private $token;

  // CONSTRUCTEUR
  public function __construct($id = null, $nom = null, $prenom = null, $mail = null, $pass = null, $adresse = null, $ville = null, $code_post = null, $tel = null, $token = null)
  {
    $this->id = $id;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->mail = $mail;
    $this->pass = $pass;
    $this->adresse = $adresse;
    $this->ville = $ville;
    $this->code_post = $code_post;
    $this->tel = $tel;
    $this->token = $token;
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT D'AJOUTER UN CLIENT
  public function ajoutClient($nom, $prenom, $mail, $pass, $tel, $adresse, $ville, $code_post)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO client (id, nom, prenom, mail, pass, tel, adresse, ville, code_post) VALUES (null, :nom, :prenom, :mail, :pass, :tel, :adresse, :ville, :code_post)
    ");
    return $requete->execute([
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':pass' => $pass,
      ':tel' => $tel,
      ':adresse' => $adresse,
      ':ville' => $ville,
      ':code_post' => $code_post,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE VOIR LES INFORMATIONS D'UN CLIENT
  public function voirClient($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM client WHERE id=:id;
    ");
    $requete->execute([
      ':id' => $id,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT AU CLIENT DE SE CONNECTER
  public function connexionClient($mail)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM client WHERE mail=:mail
    ");

    $requete->execute([
      ':mail' => $mail,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT AU CLIENT DE MODIFIER SES INFORMATIONS
  public function modifClient($id, $nom, $prenom, $mail, $tel, $adresse, $ville, $code_post)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE client SET nom=:nom, prenom=:prenom, mail=:mail, tel=:tel, adresse=:adresse, ville=:ville, code_post=:code_post WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':tel' => $tel,
      ':adresse' => $adresse,
      ':ville' => $ville,
      ':code_post' => $code_post
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT AU CLIENT DE SUPPRIMER SON COMPTE
  public function suppClient($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    DELETE FROM client WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE COMPTANT LE NOMBRE DE CLIENTS
  public function compteClient()
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT COUNT(*) AS nb_clients FROM client
    ");
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE LISTANT LES CLIENTS
  public function listeClient($premier, $parPage)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM client LIMIT :premier, :parPage
    ");
    $requete->bindValue(':premier', $premier, PDO::PARAM_INT);
    $requete->bindValue(':parPage', $parPage, PDO::PARAM_INT);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // GETTERS ET SETTERS
  public function getId()
  {
    return $this->id;
  }
  public function getNom()
  {
    return $this->nom;
  }
  public function getPrenom()
  {
    return $this->prenom;
  }
  public function getMail()
  {
    return $this->mail;
  }
  public function getPass()
  {
    return $this->pass;
  }
  public function getAdresse()
  {
    return $this->adresse;
  }
  public function getVille()
  {
    return $this->ville;
  }
  public function getCode_post()
  {
    return $this->code_post;
  }
  public function getTel()
  {
    return $this->tel;
  }
  public function getToken()
  {
    return $this->token;
  }
  public function setId($id)
  {
    $this->id = $id;
    return $this;
  }
  public function setNom($nom)
  {
    $this->nom = $nom;
    return $this;
  }
  public function setPrenom($prenom)
  {
    $this->prenom = $prenom;
    return $this;
  }
  public function setMail($mail)
  {
    $this->mail = $mail;
    return $this;
  }
  public function setPass($pass)
  {
    $this->pass = $pass;
    return $this;
  }
  public function setAdresse($adresse)
  {
    $this->adresse = $adresse;
    return $this;
  }
  public function setVille($ville)
  {
    $this->ville = $ville;
    return $this;
  }
  public function setCode_post($code_post)
  {
    $this->code_post = $code_post;
    return $this;
  }
  public function setTel($tel)
  {
    $this->tel = $tel;
    return $this;
  }
  public function setToken($token)
  {
    $this->token = $token;
    return $this;
  }
}
