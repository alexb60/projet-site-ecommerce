<?php
require_once "connexion.php";

class ModelCommande
{
  private $id;
  private $date;
  private $etat;
  private $mode;
  private $id_client;
  private $id_transporteur;

  // CONSTRUCTEUR
  public function __construct($id = null, $date = null, $etat = null, $mode = null, $id_client = null, $id_transporteur = null)
  {
    $this->id = $id;
    $this->date = $date;
    $this->etat = $etat;
    $this->mode = $mode;
    $this->id_client = $id_client;
    $this->id_transporteur = $id_transporteur;
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE CRÉER UNE COMMANDE
  public function creerCommande($date, $etat, $mode, $montant, $id_client, $id_transporteur)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO commande VALUES (null, :date, :etat, :mode, :montant, :id_client, :id_transporteur);
    ");
    $requete->execute([
      ':date' => $date,
      ':etat' => $etat,
      ':mode' => $mode,
      ':montant' => $montant,
      ':id_client' => $id_client,
      ':id_transporteur' => $id_transporteur,
    ]);
    return $idcon->lastInsertId();
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT D'AJOUTER LES DÉTAILS DE LA COMMANDE
  public function ajoutDetailsCommande($id_commande, $id_produit, $prix, $quantite)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    INSERT INTO details_commande VALUES (:id_commande, :id_produit, :prix, :quantite)
    ");
    $requete->execute([
      ':id_commande' => $id_commande,
      ':id_produit' => $id_produit,
      ':prix' => $prix,
      ':quantite' => $quantite,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE METTRE À JOUR LE STOCK
  public function majStock($id_produit, $qte)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    UPDATE produit SET quantite=(quantite-:qte) WHERE id=:id_produit
    ");
    $requete->execute([
      ':qte' => $qte,
      ':id_produit' => $id_produit,
    ]);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE LISTER LES COMMANDES
  public function listeCommande($premier, $parPage)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM commande LIMIT :premier, :parPage
    ");
    $requete->bindValue(':premier', $premier, PDO::PARAM_INT);
    $requete->bindValue(':parPage', $parPage, PDO::PARAM_INT);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE VOIR UNE COMMANDE
  public function voirCommande($id_commande)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM commande WHERE id=:id
    ");
    $requete->execute([
      ':id' => $id_commande,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE COMPTANT LE NOMBRE DE COMMANDES DANS LA TABLE COMMANDE
  public function compteCommande()
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT COUNT(*) AS nb_commandes FROM commande
    ");
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE LISTER LE DÉTAIL D'UNE COMMANDE
  public function voirDetails($id_commande)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT D.*, P.nom nom_produit, P.ref ref, M.nom nom_marque, K.nom nom_categorie FROM commande C
INNER JOIN details_commande D ON C.id = D.id_commande
INNER JOIN produit P ON P.id = D.id_produit
INNER JOIN marque M ON M.id = P.id_marque
INNER JOIN categorie K ON K.id = P.id_categorie
WHERE C.id=:id_commande;
    ");
    $requete->execute([
      ':id_commande' => $id_commande,
    ]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE LISTER LES COMMANDES D'UN CLIENT
  public function listeCommandeClient($id_client)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
    SELECT * FROM commande WHERE id_client=:id
    ");
    $requete->execute([
      ':id' => $id_client,
    ]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  // REQUÊTE SQL PRÉPARÉE PERMETTANT DE LISTER LE DÉTAIL D'UNE COMMANDE

  // GETTERS ET SETTERS
  public function getId()
  {
    return $this->id;
  }
  public function getDate()
  {
    return $this->date;
  }
  public function getEtat()
  {
    return $this->etat;
  }
  public function getMode()
  {
    return $this->mode;
  }
  public function getId_client()
  {
    return $this->id_client;
  }
  public function getId_transporteur()
  {
    return $this->id_transporteur;
  }
  public function setId($id)
  {
    $this->id = $id;
    return $this;
  }
  public function setDate($date)
  {
    $this->date = $date;
    return $this;
  }
  public function setEtat($etat)
  {
    $this->etat = $etat;
    return $this;
  }
  public function setMode($mode)
  {
    $this->mode = $mode;
    return $this;
  }
  public function setId_client($id_client)
  {
    $this->id_client = $id_client;
    return $this;
  }
  public function setId_transporteur($id_transporteur)
  {
    $this->id_transporteur = $id_transporteur;
    return $this;
  }
}
