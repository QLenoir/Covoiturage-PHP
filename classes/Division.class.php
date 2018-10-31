<?php
class Division{
	private $div_num;
	private $div_nom;


	public function __construct($valeurs) {
		if (!empty($valeurs)) {
			$this -> affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){

			switch ($attribut){
				case 'div_num' : $this->setDNum($valeur);
					break;
				case 'div_nom' : $this->setDNom($valeur);
					break;
			}
		}
	}
	public function setDNum($num) {
		$this->dep_num = $num;
	}
	public function setDNom($nom) {
		$this->dep_nom = $nom;
	}
	public function getDNum() {
		return $this->div_num ;
	}
	public function getDNom() {
		return $this->div_nom;
	}
}