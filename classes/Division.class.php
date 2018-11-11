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
				case 'div_num' : $this->setDivNum($valeur);
					break;
				case 'div_nom' : $this->setDivNom($valeur);
					break;
			}
		}
	}
	public function setDivNum($num) {
		$this->div_num = $num;
	}
	public function setDivNom($nom) {
		$this->div_nom = $nom;
	}
	public function getDivNum() {
		return $this->div_num ;
	}
	public function getDivNom() {
		return $this->div_nom;
	}
}