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

	public function getVilleDepart() {
		$req = $this->db->prepare('SELECT vil_num1 AS vil_num FROM parcours pa JOIN propose po ON pa.par_num=po.par_num WHERE pro_sens=0 UNION SELECT vil_num2 AS vil_num FROM parcours pa JOIN propose po ON pa.par_num=po.par_num WHERE pro_sens=1;');
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[] = new Ville ($ville);

		}
		var_dump($listeVilles);
		return $listeVilles;

		$req->closeCursor();
	}

	public function recupNomVille($numVille) {
		$req = $this->db->prepare('SELECT vil_nom FROM ville WHERE vil_num="'.$numVille.'";');
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		$ville = new Ville($res);
		return $ville->getVilNom();
	}
}