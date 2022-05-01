<?php
require_once "connexion.php";

class ModelMessage
{
	private $id;
	private $type;
	private $message;
	private $precedent_id;
	private $id_client;
	private $id_employe;

	// CONSTRUCTEUR
	public function __construct($id = null, $type = null, $message = null, $precedent_id = null, $id_client = null, $id_employe = null)
	{
		$this->id = $id;
		$this->type = $type;
		$this->message = $message;
		$this->precedent_id = $precedent_id;
		$this->id_client = $id_client;
		$this->id_employe = $id_employe;
	}

	// REQUÊTE SQL PRÉPARÉE LISTANT LES MESSAGES DES CLIENTS
	public function listeMessageClient($premier, $parPage)
	{
		$idcon = connexion();
		$requete = $idcon->prepare("
		SELECT M.*, C.nom nom_client, C.prenom prenom_client, C.mail mail FROM message M
INNER JOIN client C ON C.id = M.id_client
WHERE M.id_employe IS NULL
ORDER BY M.id DESC
LIMIT :premier, :parPage
		");
		$requete->bindParam(':premier', $premier, PDO::PARAM_INT);
		$requete->bindParam(':parPage', $parPage, PDO::PARAM_INT);
		$requete->execute();
		return $requete->fetchAll(PDO::FETCH_ASSOC);
	}

	// REQUÊTE SQL PRÉPARÉE PERMETTANT À UN CLIENT D'ENVOYER UN MESSAGE
	public function ajoutMessageClient($type, $message, $id_client)
	{
		$idcon = connexion();
		$requete = $idcon->prepare("
		INSERT INTO message VALUES (null, :type, :message, null, :id_client, null)
		");
		$requete->execute([
			':type' => $type,
			':message' => $message,
			':id_client' => $id_client,
		]);
	}

	// REQUÊTE SQL PRÉPARÉE COMPTANT LE NOMBRE DE PRODUITS DANS LA TABLE PRODUIT
	public function compteMessage()
	{
		$idcon = connexion();
		$requete = $idcon->prepare("
    SELECT COUNT(*) AS nb_messages_client FROM message WHERE id_employe IS NULL
    ");
		$requete->execute();
		return $requete->fetch(PDO::FETCH_ASSOC);
	}

	// REQUÊTE SQL PRÉPARÉE PERMETTANT DE VOIR LE CONTENU D'UN MESSAGE ENVOYÉ PAR UN CLIENT
	public function voirMessageClient($id)
	{
		$idcon = connexion();
		$requete = $idcon->prepare("
		SELECT M.*, C.nom nom_client, C.prenom prenom_client, C.mail mail FROM message M
INNER JOIN client C ON C.id = M.id_client
WHERE M.id=:id 
		");
		$requete->execute([
			':id' => $id,
		]);
		return $requete->fetch(PDO::FETCH_ASSOC);
	}

	public function getId()
	{
		return $this->id;
	}
	public function getIdClient()
	{
		return $this->id_client;
	}
	public function getIdEmploye()
	{
		return $this->id_employe;
	}
	public function getMessage()
	{
		return $this->message;
	}
	public function getPrecedentId()
	{
		return $this->precedent_id;
	}
	public function getType()
	{
		return $this->type;
	}
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	public function setIdClient($id_client)
	{
		$this->id_client = $id_client;
		return $this;
	}
	public function setIdEmploye($id_employe)
	{
		$this->id_employe = $id_employe;
		return $this;
	}
	public function setPrecedentId($precedent_id)
	{
		$this->precedent_id = $precedent_id;
		return $this;
	}
	public function setMessage($message)
	{
		$this->message = $message;
		return $this;
	}
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}
}
