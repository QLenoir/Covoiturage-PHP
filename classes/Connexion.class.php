<?php
class Connexion{
	private $per_login;
	private $per_pwd;
	private $captcha;
	private $reponse;

	public function __construct($valeurs) {
		if (!empty($valeurs)) {
			$this -> affecte($valeurs);
		}
	}

	public function affecte($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			
			switch($attribut) {
				case 'per_login' : $this->setPerLogin($valeur);
					break;
				case 'per_pwd' : $this->setPerPwd($valeur);
					break;
				case 'captcha' : $this->setCaptcha($valeur);
					break;
				case 'reponse' : $this->setReponse($valeur);
					break;
			}
		}
	}

	public function setPerLogin($login) {
		$this->per_login = $login;
	}

	public function setPerPwd($pwd) {
		$this->per_pwd = $pwd;
	}

	public function setCaptcha($captcha) {
			$this->captcha = $captcha;
	}

	public function setReponse($reponse) {
		$this->reponse = $reponse;
	}

	public function getPerLogin() {
		return $this->per_login;
	}

	public function getPerPwd() {
		return $this->per_pwd;
	}

	public function getCaptcha() {
		return $this->captcha;
	}

	public function getReponse() {
		return $this->reponse;
	}
}