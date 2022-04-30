<?php
require_once "connexion.php";

class ModelRole
{
  private $id;
  private $nom;

  // CONSTRUCTEUR
  public function __construct($id = null, $nom = null)
  {
    $this->id = $id;
    $this->nom = $nom;
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
  public function ajoutRole($nom)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO role VALUES (null, :nom);
    ");
    return $requete->execute([
      ':nom' => $nom,
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
  public function modifRole($id, $nom)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE role SET nom=:nom WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
      ':nom' => $nom
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
}
