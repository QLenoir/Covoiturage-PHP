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

	public function exists($etudiant) {

		$req = $this->db->prepare('SELECT per_num  FROM etudiant WHERE per_num=:num ');
		$req->bindValue(':num', $etudiant->getEtuNum());
		$req->execute();

		$resultat = $req->fetch(PDO::FETCH_OBJ);
		$req->closeCursor();

		return $resultat != null;
	}

	public function getEtudiant($pers,$num_p){

		$req = $this->db->prepare('SELECT  dep_num, div_num FROM etudiant WHERE per_num=:num ');
		$req->bindValue(':num', $num_p);
		$req->execute();

		$etu = $req->fetch(PDO::FETCH_OBJ);
		$req->closeCursor();
		$netu= new Etudiant($pers,$req);


		return $netu;

	}
}