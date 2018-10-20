<?php
class ProposeManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function addTrajet($trajet) {
		
		$req = $this->db->prepare('INSERT INTO propose(par_num,per_num,pro_date,pro_time, pro_place, pro_sens) VALUES (:par_num, :per_num, :pro_date, :pro_time, :pro_place, :pro_sens)');
		$req->bindValue(':par_num', $trajet->getParNum(),PDO::PARAM_STR);
		$req-> bindValue(':per_num', $trajet->getPerNum(),PDO::PARAM_STR);
		$req-> bindValue(':pro_time', $trajet->getProTime(),PDO::PARAM_STR);
		$req-> bindValue(':pro_date', $trajet->getProDate(),PDO::PARAM_STR);
		$req-> bindValue(':pro_place', $trajet->getProPlace(),PDO::PARAM_STR);
		$req-> bindValue(':pro_sens', $trajet->getProSens(),PDO::PARAM_STR);
		$req->execute();
	}

	public function perNumLogin($login){
		$req = $this->db->prepare('SELECT per_num FROM personne WHERE per_login="'.$login.'";');
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		$pers = new Personne($res);
		return $pers->getPNum();
	}
}