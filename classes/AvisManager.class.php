<?php
class AvisManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	//Récupère la moyenne arrondie à 1 chiffre des notes pour un numéro de personne donné
	public function getMoyenneAvis($per_num){
		$req = $this->db->prepare('SELECT ROUND(AVG(avi_note),1) AS moy FROM avis WHERE per_num=:per_num;');
		$req->bindValue(':per_num', $per_num,PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);

		return $res->moy;

		$req->closeCursor();
	}

	//Récupère le dernier avis posté pour un numéro de personne donné
	public function getDernierAvis($per_num) {
		$req = $this->db->prepare('SELECT avi_comm AS com FROM avis WHERE per_num=:per_num ORDER BY avi_date DESC LIMIT 1');
		$req->bindValue(':per_num', $per_num,PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);

		return $res->com;

		$req->closeCursor();
	}
}