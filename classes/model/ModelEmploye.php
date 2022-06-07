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
  private $token;

  // CONSTRUCTEUR
  public function __construct($id = null, $nom = null, $prenom = null, $mail = null, $pass = null, $id_role = null, $token = null)
  {
    $this->id = $id;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->mail = $mail;
    $this->pass = $pass;
    $this->id_role = $id_role;
    $this->token = $token;
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT D'AJOUTER UN EMPLOYÉ
  public function ajoutEmploye($nom, $prenom, $mail, $pass, $id_role, $token)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO employe VALUES (null, :nom, :prenom, :mail, :pass, :id_role, :token)
    ");
    return $requete->execute([
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':pass' => $pass,
      ':id_role' => $id_role,
      ':token' => $token,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE LISTANT LES EMPLOYÉS
  public function listeEmploye()
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT E.*, R.nom role FROM employe E INNER JOIN role R ON E.id_role = R.id
    ");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE VOIR LES INFORMATIONS D'UN EMPLOYÉ
  public function voirEmploye($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT E.*, R.nom nom_role FROM employe E INNER JOIN role R ON E.id_role = R.id WHERE E.id=:id;
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
    SELECT E.*, R.perm perm FROM employe E INNER JOIN role R ON E.id_role = R.id WHERE E.mail=:mail
    ");

    $requete->execute([
      ':mail' => $mail,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE MODIFIER LES INFORMATIONS D'UN EMPLOYÉ
  public function modifEmploye($id, $nom, $prenom, $mail, $id_role, $token)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE employe SET nom=:nom, prenom=:prenom, mail=:mail, id_role=:id_role, token=:token WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':id_role' => $id_role,
      ':token' => $token,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT À L'EMPLOYÉ DE MODIFIER SES INFORMATIONS
  public function modifEmployePerso($id, $nom, $prenom, $mail, $token)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE employe SET nom=:nom, prenom=:prenom, mail=:mail, token=:token WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':token' => $token,
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

  // REQUÊTE SQL PRÉPARÉE LISTANT LES EMPLOYÉS APPARTENANT À UN RÔLE DONNÉ
  public function listeEmployeParRole($id_role)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM employe WHERE id_role=:id_role
    ");
    $requete->execute([
      ':id_role' => $id_role,
    ]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE RÉCUPÉRANT LE TOKEN D'UN EMPLOYÉ À PARTIR DE L'ADRESSE MAIL
  public function recupToken($mail)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT mail, token FROM employe WHERE mail=:mail
    ");
    $requete->execute([
      ':mail' => $mail,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE METTANT À JOUR LE MOT DE PASSE D'UN EMPLOYÉ
  public function modifPass($mail, $pass)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE employe SET pass=:pass WHERE mail=:mail
    ");
    return $requete->execute([
      ':mail' => $mail,
      ':pass' => $pass,
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
  public function setId_role($id_role)
  {
    $this->id_role = $id_role;
    return $this;
  }
  public function setToken($token)
  {
    $this->token = $token;
    return $this;
  }
}
