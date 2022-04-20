<?php
require_once "connexion.php";

class ModelCategorie
{
  private $id;
  private $nom;

  // CONSTRUCTEUR
  public function __construct($id = null, $nom = null)
  {
    $this->id = $id;
    $this->nom = $nom;
  }

  // REQUÊTE SQL PRÉPARÉE LISTANT LES CATÉGORIES
  public function listeCategorie()
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM categorie
    ");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE VOIR LES DÉTAILS D'UNE CATÉGORIE
  public function voirCategorie($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM categorie WHERE id=:id;
    ");
    $requete->execute([
      ':id' => $id,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT D'AJOUTER UNE CATÉGORIE
  public function ajoutCategorie($nom)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO categorie VALUES (null, :nom);
    ");
    return $requete->execute([
      ':nom' => $nom,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE SUPPRIMER UNE CATÉGORIE
  public function suppCategorie($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    DELETE FROM categorie WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE MODIFIER UNE CATÉGORIE
  public function modifCategorie($id, $nom)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE categorie SET nom=:nom WHERE id=:id;
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
