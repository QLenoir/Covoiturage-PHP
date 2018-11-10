<?php
class FonctionManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function getAllFonctions() {
		$req = $this->db->prepare('SELECT fon_num,fon_libelle FROM fonction;');
		$req->execute();

		while ($fonction = $req->fetch(PDO::FETCH_OBJ)) {
			$listeFonctions[] = new Fonction($fonction);
		}

		return $listeFonctions;

		$req->closeCursor();
	}
}