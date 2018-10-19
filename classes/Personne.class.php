<?php
class Personne{
	private $p_num;
	private $p_nom;
	private $p_prenom;
	private $p_tel;
	private $p_login;
	private $p_mdp;
	private $p_mail;

	public function __construct($valeurs) {
		if (!empty($valeurs)) {
			$this -> affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){

			switch ($attribut){
				case 'per_num' : $this->setPNum($valeur);
					break;
				case 'per_nom' : $this->setPNom($valeur);
					break;
				case 'per_prenom' : $this->setPPrenom($valeur);
					break;
				case 'per_tel' : $this->setPTel($valeur);
					break;
				case 'per_login' : $this->setPLogin($valeur);
					break;
				case 'per_pwd' : $this->setPMdp($valeur);
					break;
				case 'per_mail' : $this->setPMail($valeur);
					break;
			}
		}
	}
	public function setPNum($num) {
		$this->p_num = $num;
	}
	public function setPNom($nom) {
		$this->p_nom = $nom;
	}
	public function setPPrenom($prenom){
		$this->p_prenom = $prenom;
	}
	public function setPTel($tel){
		$this->p_tel = $tel;
	}
	public function setPLogin($login){
		$this->p_login = $login;
	}
	public function setPMdp($mdp){
		$this->p_mdp = $mdp;
	}
	public function setPMail($mail){
		$this->p_mail = $mail;
	}


	public function getPNum() {
		return $this->p_num;
	}
	public function getPNom() {
		return $this->p_nom;
	}
	public function getPPrenom() {
		return $this->p_prenom;
	}
	public function getPTel() {
		return $this->p_tel;
	}
	public function getPLogin() {
		return $this->p_login;
	}
	public function getPMdp() {
		return $this->p_mdp;
	}
	public function getPMail() {
		return $this->p_mail;
	}

}