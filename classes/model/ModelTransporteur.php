<?php
require_once "connexion.php";

class ModelTransporteur
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

  // REQUÊTE SQL PRÉPARÉE COMPTANT LE NOMBRE DE TRANSPORTEURS
  public function compteTransporteur()
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT COUNT(*) AS nb_transporteurs FROM transporteur
    ");
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE LISTANT LES TRANSPORTEURS
  public function listeTransporteur()
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM transporteur
    ");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE VOIR LES DÉTAILS D'UN TRANSPORTEUR
  public function voirTransporteur($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM transporteur WHERE id=:id;
    ");
    $requete->execute([
      ':id' => $id,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT D'AJOUTER UN TRANSPORTEUR
  public function ajoutTransporteur($nom, $logo)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO transporteur VALUES (null, :nom, :logo);
    ");
    return $requete->execute([
      ':nom' => $nom,
      ':logo' => $logo,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE SUPPRIMER UN TRANSPORTEUR
  public function suppTransporteur($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    DELETE FROM transporteur WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE MODIFIER UN TRANSPORTEUR
  public function modifTransporteur($id, $nom, $logo)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE transporteur SET nom=:nom, logo=:logo WHERE id=:id;
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
