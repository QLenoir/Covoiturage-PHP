<?php
class ProposeManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	//Ajoute un nouveau trajet dans la table propose
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

	//Retourne la liste de toutes les villes de départ de la table propose
	public function getVilleDepart() {
		$req = $this->db->prepare('SELECT vil_num1 AS vil_num FROM parcours pa JOIN propose po ON pa.par_num=po.par_num WHERE pro_sens=0 UNION SELECT vil_num2 AS vil_num FROM parcours pa JOIN propose po ON pa.par_num=po.par_num WHERE pro_sens=1;');
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[] = new Ville ($ville);

		}
		return $listeVilles;

		$req->closeCursor();
	}

	//Retourne la liste des villes d'arrivée selon le numéro de ville en entrée
	public function getVilleArrivee($vil_num1) {
		$req = $this->db->prepare('SELECT vil_num2 AS vil_num FROM parcours WHERE vil_num1=:vil_num1 UNION SELECT vil_num1 AS vil_num FROM parcours WHERE vil_num2=:vil_num1;');
		$req->bindValue(':vil_num1', $vil_num1,PDO::PARAM_STR);
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[] = new Ville ($ville);

		}
		return $listeVilles;

		$req->closeCursor();
	}

	//Retourne la liste des trajets selon les villes, la date l'heure et la précision souhaitées
	public function findTrajet($vil_num1,$vil_num2,$pro_date,$heure,$precision) {
		
		$parcoursManager = new ParcoursManager($this->db);
		$par_num = $parcoursManager->findParNum($vil_num1,$vil_num2);

		$pro_sens= $parcoursManager->findProSens($par_num,$vil_num1);

		$req = $this->db->prepare('SELECT T.pro_date,T.pro_time,T.pro_place,p.per_prenom,p.per_nom,T.per_num FROM 
										(SELECT pro_date,pro_time,pro_place,per_num FROM propose po JOIN parcours pa ON pa.par_num=po.par_num WHERE po.par_num=:par_num AND pro_date>=SUBDATE(:pro_date, INTERVAL :precision DAY) AND pro_date<=ADDDATE(:pro_date, INTERVAL :precision DAY) AND HOUR(pro_time)>=:heure AND pro_sens=:pro_sens )T
									INNER JOIN personne p ON p.per_num=T.per_num
									ORDER BY pro_date,pro_time');
		$req->bindValue(':par_num',$par_num,PDO::PARAM_STR);
		$req->bindValue(':pro_date',$pro_date,PDO::PARAM_STR);
		$req->bindValue(':precision', $precision,PDO::PARAM_STR);
		$req->bindValue(':heure', $heure,PDO::PARAM_STR);
		$req->bindValue(':pro_sens', $pro_sens,PDO::PARAM_STR);
		$req->execute();

		while ($res = $req->fetch(PDO::FETCH_ASSOC)) {
			$listeTrajet[] = $res ;
		}

		if(empty($listeTrajet)){
			return 0;
		} 
		return $listeTrajet;

		$req->closeCursor();
	}

	//Retourne un format correct pour l'affichage dans le tableau de recherche
	public function getFormatDate($pro_date){
		$tab = explode("-",$pro_date);
		return $tab[2]."/".$tab[1]."/".$tab[0];
	}

}