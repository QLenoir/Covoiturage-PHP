<?php
class Fonction{
	private $fon_num;
	private $fon_libelle;

	public function __construct($valeurs) {
		if (!empty($valeurs)) {
			$this -> affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){

			switch ($attribut){
				case 'fon_num' : $this->setFonNum($valeur);
					break;
				case 'fon_libelle' : $this->setFonLib($valeur);
					break;
				
			}
		}
	}
	public function setFonNum($num) {
		$this->fon_num = $num;
	}
	public function setFonLib($lib){
		$this->fon_libelle = $lib;
	} 

	public function getFonNum(){
		return $this->fon_num;
	}
	public function getFonLib(){
		return $this->fon_libelle;
	}
}