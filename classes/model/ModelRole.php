<?php
require_once "connexion.php";

class ModelRole
{
  private $id;
  private $nom;
  private $perm;

  // CONSTRUCTEUR
  public function __construct($id = null, $nom = null, $perm = null)
  {
    $this->id = $id;
    $this->nom = $nom;
    $this->perm = $perm;
  }

  // REQUÊTE SQL PRÉPARÉE LISTANT LES RÔLES
  public function listeRole()
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM role
    ");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE VOIR LES DÉTAILS D'UN RÔLE
  public function voirRole($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM role WHERE id=:id;
    ");
    $requete->execute([
      ':id' => $id,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT D'AJOUTER UN RÔLE
  public function ajoutRole($nom, $perm)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO role VALUES (null, :nom, :perm);
    ");
    return $requete->execute([
      ':nom' => $nom,
      ':perm' => $perm,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE SUPPRIMER UN RÔLE
  public function suppRole($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    DELETE FROM role WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE MODIFIER UN RÔLE
  public function modifRole($id, $nom, $perm)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE role SET nom=:nom, perm=:perm WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
      ':nom' => $nom,
      ':perm' => $perm,
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
  public function getPerm()
  {
    return $this->perm;
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
  public function setPerm($perm)
  {
    $this->perm = $perm;
    return $this;
  }
}
