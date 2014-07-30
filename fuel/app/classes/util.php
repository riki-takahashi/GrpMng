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
        
        /**
         * Where条件の構築（サブルーチン）
         */
        public static function addAndCondition($query = null, $key = null, $value = null) {
            if($query == null) {
                    return;
            }
            
            $query = $query->where($key, $value);

            return $query;
        }

}
