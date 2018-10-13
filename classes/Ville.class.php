<?php
class Ville{
	private $vil_num;
	private $vil_nom;

	public function __construct($valeurs) {
		if (!empty($valeurs)) {
			$this -> affecte($valeurs);
		}
	}

	public function affecte($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			
			switch($attribut) {
				case 'vil_num' : $this->setVilNum($valeur);
					break;
				case 'vil_nom' : $this->setVilNom($valeur);
			}
		}
	}

	public function setVilNum($num) {
		$this->vil_num = $num;
	}

	public function setVilNom($nom) {
		$this->vil_nom = $nom;
	}

	public function getVilNum() {
		return $this->vil_num;
	}

	public function getVilNom() {
		return $this->vil_nom;
	}

}