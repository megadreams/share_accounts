<?php

class Lib_Util {
	
	//$properties = array(
	//	'class' => 'hoge',
	//	'style' => 'text-align: center; color: #ff0000;"
	//)
	public function getLinkTag($link, $content, $properties = array()) {
		if ($link === null) {
			var_dump('NO LINK');
			exit;
		}
		
		if ($content === null) {
			var_dump('NO CONTENT');
			exit;
		}
		
		$a = '<a ';
		$a .= 'href=' . '"' . $link . '" ';
		foreach ($properties as $property => $value) {
			$a .= $property;
			$a .= '=';
			$a .= '"' . $value . '" ';
		}
		$a .= '>';
		$a .= $content;
		$a .= '</a>';
		return $a;
	}
	
	public function getImageTag($src, $alt, $properties = array()) {
		if ($src === null) {
			var_dump('NO SRC');
			exit;
		}
		
		if ($alt === null) {
			var_dump('NO ALT');
			exit;
		}
		$img = '<img ';
		$img .= 'src=' . '"' . $src .'" ';
		$img .='alt=' . '"' . $alt . '" ';
		foreach ($properties as $property => $value) {
			$img .= $property;
			$img .= '=';
			$img .= '"' . $value . '" ';
		}
		$img .= '>';
		
		return $img;
	}
}
