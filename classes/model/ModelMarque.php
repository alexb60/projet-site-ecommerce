<?php
require_once "connexion.php";

class ModelMarque
{
  private $id;
  private $nom;
  private $logo;

  // CONSTRUCTEUR
  public function __construct($id = null, $nom = null, $logo = null)
  {
    $this->id = $id;
    $this->nom = $nom;
    $this->logo = $logo;
  }

  // REQUÊTE SQL PRÉPARÉE LISTANT LES MARQUES
  public function listeMarque()
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM marque
    ");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE VOIR LES DÉTAILS D'UNE MARQUE
  public function voirMarque($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM marque WHERE id=:id;
    ");
    $requete->execute([
      ':id' => $id,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT D'AJOUTER UNE MARQUE
  public function ajoutMarque($nom, $logo)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO marque VALUES (null, :nom, :logo);
    ");
    return $requete->execute([
      ':nom' => $nom,
      ':logo' => $logo,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE SUPPRIMER UNE MARQUE
  public function suppMarque($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    DELETE FROM marque WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE MODIFIER UNE CATÉGORIE
  public function modifMarque($id, $nom, $logo)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE marque SET nom=:nom, logo=:logo WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
      ':nom' => $nom,
      ':logo' => $logo
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
  public function getLogo()
  {
    return $this->logo;
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
  public function setLogo($logo)
  {
    $this->logo = $logo;
    return $this;
  }
}
