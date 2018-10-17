<?php
class Ville{
	private $per_login;
	private $per_pwd;

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
			}
		}
	}

	public function setPerLogin($login) {
		$this->per_login = $login;
	}

	public function setPerPwd($pwd) {
		$this->per_pwd = $pwd;
	}

	public function getPerLogin() {
		return $this->per_login;
	}

	public function getPerPwd() {
		return $this->per_pwd;
	}
}