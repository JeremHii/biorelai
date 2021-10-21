<?php

class dispatcher{

	public static function dispatch($unMenuP){
		$unMenuP = "controleur" . ucfirst($unMenuP) ;
		$unMenuP .= ".php";
		$unMenuP = "controleurs/" . $unMenuP;
		return $unMenuP ;
	}
}

function equals($a, $b){
	$min = $a;
	$max = $b;
	if($a > $b){
		$min = $b;
		$max = $a;
	}

	for ($i=$min-100; $i < $max+100; $i++) { 
		if($i == $min && $i == $max){
			return true;
		}
	}
	return false;
}