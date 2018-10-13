<?php
class VilleManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function getAllVille() {
		$req = $this->db->prepare('SELECT vil_num,vil_nom FROM ville ORDER BY vil_nom;');
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeClients[] = new Ville ($ville);
		}

		return $listeClients;

		$req->closeCursor();
	}

	public function addVille($ville) {
		
		$req = $this->db->prepare('INSERT INTO VILLE(vil_nom) VALUES (:vil_nom)');
		$req->bindValue(':vil_nom',$ville->getVilNom(),PDO::PARAM_STR);
		$req->execute();
	}
}
