<?php

require_once "connexion.php";

class ModelProduit
{
  private $id;
  private $nom;
  private $ref;
  private $description;
  private $quantite;
  private $prix;
  private $photo;
  private $id_categorie;
  private $id_marque;

  // CONSTRUCTEUR
  public function __construct($id = null, $nom = null, $ref = null, $description = null, $quantite = null, $prix = null, $photo = null, $id_categorie = null, $id_marque = null)
  {
    $this->id = $id;
    $this->nom = $nom;
    $this->ref = $ref;
    $this->description = $description;
    $this->quantite = $quantite;
    $this->prix = $prix;
    $this->photo = $photo;
    $this->id_categorie = $id_categorie;
    $this->id_marque = $id_marque;
  }

  // REQUÊTE SQL PRÉPARÉE COMPTANT LE NOMBRE DE PRODUITS DANS LA TABLE PRODUIT
  public function compteProduit()
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT COUNT(*) AS nb_produits FROM produit
    ");
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE LISTANT LES PRODUITS AVEC PAGINATION
  public function listeProduit($premier, $parPage)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT P.*, C.nom nom_categorie, M.nom nom_marque FROM produit P INNER JOIN categorie C ON P.id_categorie = C.id INNER JOIN marque M ON P.id_marque = M.id ORDER BY P.id ASC LIMIT :premier, :parPage;
    ");
    $requete->bindValue(':premier', $premier, PDO::PARAM_INT);
    $requete->bindValue(':parPage', $parPage, PDO::PARAM_INT);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE VOIR LES DÉTAILS D'UN PRODUIT
  public function voirProduit($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT P.*, C.nom nom_categorie, M.nom nom_marque FROM produit P 
    INNER JOIN categorie C ON P.id_categorie = C.id
    INNER JOIN marque M ON P.id_marque = M.id
    WHERE P.id=:id;
    ");
    $requete->execute([
      ':id' => $id,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT D'AJOUTER UN PRODUIT
  public function ajoutProduit($nom, $ref, $description, $quantite, $prix, $photo, $id_categorie, $id_marque)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO produit VALUES (null, :nom, :ref, :description, :quantite, :prix, :photo, :id_categorie, :id_marque)
    ");
    return $requete->execute([
      ':nom' => $nom,
      ':ref' => $ref,
      ':description' => $description,
      ':quantite' => $quantite,
      ':prix' => $prix,
      ':photo' => $photo,
      ':id_categorie' => $id_categorie,
      ':id_marque' => $id_marque
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE SUPPRIMER UN PRODUIT
  public function suppProduit($id)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    DELETE FROM produit WHERE id=:id;
    ");
    return $requete->execute([
      ':id' => $id,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE MODIFIER UN PRODUIT
  public function modifProduit($id, $nom, $ref, $description, $quantite, $prix, $photo, $id_categorie, $id_marque)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE produit SET nom=:nom, ref=:ref, description=:description, quantite=:quantite, prix=:prix, photo=:photo, id_categorie=:id_categorie, id_marque=:id_marque WHERE id=:id
    ");
    return $requete->execute([
      ':id' => $id,
      ':nom' => $nom,
      ':ref' => $ref,
      ':description' => $description,
      ':quantite' => $quantite,
      ':prix' => $prix,
      ':photo' => $photo,
      ':id_categorie' => $id_categorie,
      ':id_marque' => $id_marque
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE LISTANT LES 8 DERNIERS PRODUITS DE LA TABLE produit
  public function derniersProduit()
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT P.*, C.nom nom_categorie FROM produit P INNER JOIN categorie C ON P.id_categorie = C.id ORDER BY P.id DESC LIMIT 8
    ");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE LISTANT LES 8 PREMIERS PRODUITS D'UNE CATÉGORIE
  public function produitParCategorieAccueil($id_categorie)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT P.* FROM produit P INNER JOIN categorie C ON P.id_categorie = C.id WHERE id_categorie=:id_categorie ORDER BY P.id ASC LIMIT 8;
    ");
    $requete->execute([
      ':id_categorie' => $id_categorie,
    ]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE LISTANT TOUS LES PRODUITS D'UNE CATÉGORIE
  public function produitParCategorie($id_categorie)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT P.*, M.nom nom_marque FROM produit P INNER JOIN marque M ON P.id_marque = M.id WHERE id_categorie=:id_categorie;
    ");
    $requete->execute([
      ':id_categorie' => $id_categorie,
    ]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE RECHERCHANT UN PRODUIT PEU IMPORTE SON NOM, SA MARQUE OU SA CATÉGORIE
  public function recherche($recherche)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT P.*, C.nom nom_categorie, M.nom nom_marque FROM produit P
INNER JOIN categorie C ON P.id_categorie = C.id
INNER JOIN marque M ON P.id_marque = M.id
WHERE P.nom LIKE '%".$recherche."%' OR C.nom LIKE '%".$recherche."%' OR M.nom LIKE '%".$recherche."%';
    ");
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
  public function getRef()
  {
    return $this->ref;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function getQuantite()
  {
    return $this->quantite;
  }
  public function getPrix()
  {
    return $this->prix;
  }
  public function getPhoto()
  {
    return $this->photo;
  }
  public function getId_categorie()
  {
    return $this->id_categorie;
  }
  public function getId_marque()
  {
    return $this->id_marque;
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
  public function setRef($ref)
  {
    $this->ref = $ref;
    return $this;
  }
  public function setDescription($description)
  {
    $this->description = $description;
    return $this;
  }
  public function setQuantite($quantite)
  {
    $this->quantite = $quantite;
    return $this;
  }
  public function setPrix($prix)
  {
    $this->prix = $prix;
    return $this;
  }
  public function setPhoto($photo)
  {
    $this->photo = $photo;
    return $this;
  }
  public function setId_categorie($id_categorie)
  {
    $this->id_categorie = $id_categorie;
    return $this;
  }
  public function setId_marque($id_marque)
  {
    $this->id_marque = $id_marque;
    return $this;
  }
}
