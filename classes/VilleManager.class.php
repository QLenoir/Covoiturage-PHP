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
			$listeVilles[] = new Ville ($ville);
		}

		return $listeVilles;

		$req->closeCursor();
	}

	public function addVille($ville) {
		
		$req = $this->db->prepare('INSERT INTO ville(vil_nom) VALUES (:vil_nom)');
		$req->bindValue(':vil_nom',$ville->getVilNom(),PDO::PARAM_STR);
		$req->execute();
	}

	public function exists($ville) {

		$req = $this->db->prepare('SELECT vil_nom FROM ville');
		$req->execute();
		
		while ($res = $req->fetch(PDO::FETCH_OBJ)) {	
			$villeTable = new Ville($res);
			if($ville === $villeTable->getVilNom()){
				return true;
			}
		}
		return false;

		$req->closeCursor();
	}

	public function getNbVille(){
		$req = $this->db->prepare('SELECT * FROM ville');
		$req->execute();
		return $req->rowCount();
	}

	public function recupNomVille($numVille) {
		$req = $this->db->prepare('SELECT vil_nom FROM ville WHERE vil_num=:numVille;');
		$req->bindValue(':numVille', $numVille,PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		$ville = new Ville($res);
		return $ville->getVilNom();

		$req->closeCursor();
	}
}
