<?php
class PersonneManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	//Retourne le liste de toutes les personnes de la base de données
	public function getAllPersonne() {
		$req = $this->db->prepare('SELECT * FROM personne ORDER BY per_nom;');
		$req->execute();

		while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
			$listePersonnes[] = new Personne ($personne);
		}

		return $listePersonnes;

		$req->closeCursor();
	}

	//Ajoute une personne dans la base de données
	public function addPersonne($personne) {
		
		$req = $this->db->prepare('INSERT INTO personne(per_nom,per_prenom,per_tel,per_mail, per_login, per_pwd) VALUES (:p_nom, :p_prenom, :p_tel, :p_mail, :p_login, :p_mdp)');
		$req->bindValue(':p_nom', $personne->getPNom(),PDO::PARAM_STR);
		$req-> bindValue(':p_prenom', $personne->getPPrenom(),PDO::PARAM_STR);
		$req-> bindValue(':p_tel', $personne->getPTel(),PDO::PARAM_STR);
		$req-> bindValue(':p_mail', $personne->getPMail(),PDO::PARAM_STR);
		$req-> bindValue(':p_login', $personne->getPLogin(),PDO::PARAM_STR);
		$req-> bindValue(':p_mdp', $personne->getPMdp(),PDO::PARAM_STR);
		$req->execute();
	}

	//Retourne true si le mail ou le login est déja utilisé et false sinon
	public function exists($personne) {

		$req = $this->db->prepare('SELECT per_mail, per_login FROM personne WHERE per_login=:login AND per_mail=:mail');
		$req->bindValue(':login', $personne->getPLogin());
		$req->bindValue(':mail', $personne->getPMail());
		$req->execute();

		$resultat = $req->fetch(PDO::FETCH_OBJ);
		$req->closeCursor();

		return $resultat != null;

		//$req->closeCursor();
	}

	//retourne le nombre total de personne dans la base de données
	public function getNbPersonne(){
		$req = $this->db->prepare('SELECT * FROM personne');
		$req->execute();
		return $req->rowCount();
	}

	//Retourne le numéro d'une personne en fonction de son login
	public function perNumLogin($login){
		$req = $this->db->prepare('SELECT per_num FROM personne WHERE per_login=:per_login;');
		$req->bindValue(':per_login',$login,PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		$pers = new Personne($res);
		return $pers->getPNum();

		$req->closeCursor();
	}

	public function modifierPersonne($personne) {
		
		if (exists($personne)){
			$req = $this->db->prepare('UPDATE personne(per_nom,per_prenom,per_tel,per_mail, per_login, per_pwd) VALUES (:p_nom, :p_prenom, :p_tel, :p_mail, :p_login, :p_mdp) where per_num=$personne->getPNum');
			$req->bindValue(':p_nom', $personne->getPNom(),PDO::PARAM_STR);
			$req->bindValue(':p_prenom', $personne->getPPrenom(),PDO::PARAM_STR);
			$req->bindValue(':p_tel', $personne->getPTel(),PDO::PARAM_STR);
			$req->bindValue(':p_mail', $personne->getPMail(),PDO::PARAM_STR);
			$req->bindValue(':p_login', $personne->getPLogin(),PDO::PARAM_STR);
			$req->bindValue(':p_mdp', $personne->getPMdp(),PDO::PARAM_STR);
			$req->execute();
		}
	}

	public function isEtu($etuNum
	) {

		$req = $this->db->prepare('SELECT per_num  FROM etudiant WHERE per_num=:num ');
		$req->bindValue(':num', $etuNum);
		$req->execute();

		$resultat = $req->fetch(PDO::FETCH_OBJ);
		$req->closeCursor();

		return $resultat != null;
	}
	
	public function isSal($num
	) {

		$req = $this->db->prepare('SELECT per_num  FROM salarie WHERE per_num=:num ');
		$req->bindValue(':num', $num);
		$req->execute();

		$resultat = $req->fetch(PDO::FETCH_OBJ);
		$req->closeCursor();

		return $resultat != null;
	}
	
	

	//Retourne le nom et prénom d'une personne en fonction de son numéro
	public function nomPrenomParPerNum($per_num){
		$req = $this->db->prepare('SELECT per_nom,per_prenom FROM personne WHERE per_num=:per_num;');
		$req->bindValue(':per_num',$per_num,PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		$pers = new Personne($res);
		
		return $pers;

		$req->closeCursor();
	}

	//Supprime la personne de la base de données
	public function supprimerPersonne($per_num){
		$req = $this->db->prepare('DELETE FROM avis WHERE per_num=:per_num;');
		$req->bindValue(':per_num',$per_num,PDO::PARAM_STR);
		$req->execute();

		$req = $this->db->prepare('DELETE FROM avis WHERE per_per_num=:per_num;');
		$req->bindValue(':per_num',$per_num,PDO::PARAM_STR);
		$req->execute();

		$req = $this->db->prepare('DELETE FROM propose WHERE per_num=:per_num;');
		$req->bindValue(':per_num',$per_num,PDO::PARAM_STR);
		$req->execute();

		if ($this->isEtu($per_num)){
			$req = $this->db->prepare('DELETE FROM etudiant WHERE per_num=:per_num;');
			$req->bindValue(':per_num',$per_num,PDO::PARAM_STR);
			$req->execute();
		} else {
			$req = $this->db->prepare('DELETE FROM salarie WHERE per_num=:per_num;');
			$req->bindValue(':per_num',$per_num,PDO::PARAM_STR);
			$req->execute();
		}

		$req = $this->db->prepare('DELETE FROM personne WHERE per_num=:per_num;');
		$req->bindValue(':per_num',$per_num,PDO::PARAM_STR);
		$req->execute();
	}

	//fonction permettant d'obtenir toutes les infos d'une personne
		public function getPersonne($numP){
		$req = $this->db->prepare('SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login FROM personne WHERE per_num = :num');
		$req->bindValue(':num', $numP);
		$req->execute();

		$pers = $req->fetch(PDO::FETCH_OBJ);
		$req->closeCursor();
		$npers = new Personne($pers);
		return $npers;
	}
}