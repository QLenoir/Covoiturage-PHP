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

		$req->closeCursor();
	}

	public function getVilleDepart() {
		$req = $this->db->prepare('SELECT vil_num1 AS vil_num FROM parcours pa JOIN propose po ON pa.par_num=po.par_num WHERE pro_sens=0 UNION SELECT vil_num2 AS vil_num FROM parcours pa JOIN propose po ON pa.par_num=po.par_num WHERE pro_sens=1;');
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[] = new Ville ($ville);

		}
		return $listeVilles;

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

	public function getVilleArrivee($vil_num1) {
		$req = $this->db->prepare('SELECT vil_num2 AS vil_num FROM parcours WHERE vil_num1="'.$vil_num1.'" UNION SELECT vil_num1 AS vil_num FROM parcours WHERE vil_num2="'.$vil_num1.'";');
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[] = new Ville ($ville);

		}
		return $listeVilles;

		$req->closeCursor();
	}

	public function findTrajet($vil_num1,$vil_num2,$pro_date,$heure,$precision) {
		$par_num = $this->recupParNum($vil_num1,$vil_num2);
		$req = $this->db->prepare('SELECT vil_num1,vil_num2,pro_date,pro_time,pro_place,per_num FROM propose po JOIN parcours pa ON pa.par_num=po.par_num WHERE po.par_num='.$par_num.' AND pa.vil_num1="'.$vil_num1.'" AND pro_date>=SUBDATE("'.$pro_date.'", INTERVAL '.$precision.' DAY) AND pro_date<=ADDDATE("'.$pro_date.'", INTERVAL '.$precision.' DAY) AND HOUR(pro_time)>='.$heure.' ORDER BY pro_date,pro_time;');
		$req->execute();
		while ($res = $req->fetch(PDO::FETCH_ASSOC)) {
			$listeTrajet[] = $res ;
		}

		if(empty($listeTrajet)){
			return 0;
		} else {
			return $listeTrajet;
		}

		$req->closeCursor();
	}

	public function getPrenomNomFromNum($per_num){
		$req = $this->db->prepare('SELECT per_prenom,per_nom FROM personne WHERE per_num="'.$per_num.'";');
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		return $res->per_prenom." ".$res->per_nom;

		$req->closeCursor();
	}

	public function recupParNum($vil_num1,$vil_num2){
		$req = $this->db->prepare('SELECT par_num FROM parcours WHERE vil_num1="'.$vil_num1.'" AND vil_num2="'.$vil_num2.'" UNION SELECT par_num FROM parcours WHERE vil_num1="'.$vil_num2.'" AND vil_num2="'.$vil_num1.'";');
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		return $res->par_num;

		$req->closeCursor();
	}

	public function getFormatDate($pro_date){
		$tab = explode("-",$pro_date);
		return $tab[2]."/".$tab[1]."/".$tab[0];
	}

	public function getMoyenneAvis($per_num){
		$req = $this->db->prepare('SELECT ROUND(AVG(avi_note),1) AS moy FROM avis WHERE per_num="'.$per_num.'";');
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);

		return $res->moy;

		$req->closeCursor();
	}

	public function getDernierAvis($per_num) {
		$req = $this->db->prepare('SELECT avi_comm AS com FROM avis WHERE per_num='.$per_num.' ORDER BY avi_date DESC LIMIT 1');
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);

		return $res->com;

		$req->closeCursor();
	}
}