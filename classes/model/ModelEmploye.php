<?php
require_once "connexion.php";

class ModelEmploye
{
  private $id;
  private $nom;
  private $prenom;
  private $mail;
  private $pass;
  private $id_role;

  // CONSTRUCTEUR
  public function __construct($id = null, $nom = null, $prenom = null, $mail = null, $pass = null, $id_role = null)
  {
    $this->id = $id;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->mail = $mail;
    $this->pass = $pass;
    $this->id_role = $id_role;
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT D'AJOUTER UN EMPLOYÉ
  public function ajoutEmploye($nom, $prenom, $mail, $pass, $id_role)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO employe VALUES (null, :nom, :prenom, :mail, :pass, :id_role)
    ");
    return $requete->execute([
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':pass' => $pass,
      ':id_role' => $id_role,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE VOIR LES INFORMATIONS D'UN EMPLOYÉ
  public function voirEmploye($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM employe WHERE id=:id;
    ");
    $requete->execute([
      ':id' => $id,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT À L'EMPLOYÉ DE SE CONNECTER
  public function connexionEmploye($mail)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM employe WHERE mail=:mail
    ");

    $requete->execute([
      ':mail' => $mail,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT À L'EMPLOYÉ DE MODIFIER SES INFORMATIONS
  public function modifEmploye($id, $nom, $prenom, $mail)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE employe SET nom=:nom, prenom=:prenom, mail=:mail WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT LA SUPPRESSION DU COMPTE D'UN EMPLOYÉ
  public function suppEmploye($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    DELETE FROM employe WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
    ]);
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
  public function getId_role()
  {
    return $this->id_role;
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
  public function setId_role($id_role)
  {
    $this->id_role = $id_role;
    return $this;
  }
}
