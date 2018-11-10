<?php
class DepartementManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}
	public function getAllDepartements() {
		$req = $this->db->prepare('SELECT dep_num,dep_nom,vil_num FROM departement;');
		$req->execute();

		while ($departement = $req->fetch(PDO::FETCH_OBJ)) {
			$listeDepartements[] = new Departement($departement);
		}

		return $listeDepartements;

		$req->closeCursor();
	}
	public function recupNomVille($numVille) {
		$req = $this->db->prepare('SELECT vil_nom FROM ville WHERE vil_num="'.$numVille.'";');
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		$ville = new Ville($res);
		return $ville->getVilNom();

		$req->closeCursor();
	}

	
}