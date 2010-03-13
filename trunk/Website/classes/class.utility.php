<?php

class Utility{
	public static function optionBind($key, $value)
	{
		return '<option value="'.$key.'">'.$value.'</option>';
	}
	public static function checkPostData($keyValueArray){
		$feedback = array();
		$total = 0;
		foreach($keyValueArray as $item => $value){
			if (is_null($value) || $value == ''){
				$feedback[$total++] = $item;
			}
		}
		return $feedback;
	}
}
?>
