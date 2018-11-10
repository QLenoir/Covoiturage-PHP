<?php
class EtudiantManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function getAllEtudiants() {
		$req = $this->db->prepare('SELECT * FROM etudiant ORDER BY per_num;');
		$req->execute();

		while ($etudiant = $req->fetch(PDO::FETCH_OBJ)) {
			$listeEtudiants[] = new Etudiant($etudiant);
		}

		return $listeEtudiants;

		$req->closeCursor();
	}

	public function addEtudiant($etudiant) {
		
		$req = $this->db->prepare('INSERT INTO etudiant(per_num,dep_num,div_num) VALUES (:p_num, :dep_num, :div_num)');
		$req->bindValue(':p_num', $this->db->lastInsertId(),PDO::PARAM_STR);
		$req->bindValue(':dep_num', $etudiant->getDepNum(),PDO::PARAM_STR);
		$req->bindValue(':div_num', $etudiant->getDivNum(),PDO::PARAM_STR);
		
		$req->execute();
	}
}