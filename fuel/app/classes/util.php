<?php
//ユーティリティ関数群
class Util {
	//引数が空だった場合、NULLに変換
	public static function empty_to_null($var)
	{
		if (empty($var))
		{
			return NULL;
		}
		else 
		{
			return $var;
		}
	}
	
}
