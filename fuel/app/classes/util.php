<?php

//ユーティリティ関数群
class Util {

    /**
     * 引数が空だった場合、NULLに変換
     * @param type $var
     * @return null
     */
    public static function empty_to_null($var) {
        if (empty($var)) {
            return NULL;
        } else {
            return $var;
        }
    }

    /**
     * Where条件文の構築（ANDでイコール条件追加）
     * @param type $query Where条件を追加するクエリーは、予め用意してください。
     * @param type $key 検索する項目名
     * @param type $value 検索する値
     * @param type $condition あいまい検索する場合にはここに'like'を指定してください。
     * @return type $query 与えられたクエリーに検索条件を追加してクエリーを返します。
     */
    public static function addAndCondition($query = null, $key = null, $value = null, $condition = '=') {
        //指定された項目名と値でWHERE文を組み立て返します。
        //$valueに %foo% が入った場合に 0と等価と判定されてしまったため、厳密な比較をすることにしました。
        if ($query == null or $value == null or $value === '0' or $value == '%%') {
            return $query;
        }
        $query = $query->where($key, $condition, $value);
        return $query;
    }
    
    /**
     * Where条件文の構築（ANDでイコール条件追加）
     * @param type $query Where条件を追加するクエリーは、予め用意してください。
     * @param type $condition 検索条件文
     * @return type $query 与えられたクエリーに検索条件を追加してクエリーを返します。
     */
    public static function addAndConditionDirect($query = null, $condition = null) {
        //指定された項目名と値でWHERE文を組み立て返します。
        //$valueに %foo% が入った場合に 0と等価と判定されてしまったため、厳密な比較をすることにしました。
        if ($query == null or $condition == null) {
            return $query;
        }
        $query = $query->where(DB::expr($condition));
        return $query;
    }

    /**
     * Where条件文の構築（ANDで日付期間条件追加）
     * @param type $query Where条件を追加するクエリーは、予め用意してください。
     * @param type $key 検索する項目名
     * @param type $value_from 検索する開始年月日（yyyy/mm/dd形式）Nullなら検索条件に含めません。
     * @param type $value_to 検索する終了年月日（yyyy/mm/dd形式）Nullなら検索条件に含めません。
     * @return type 与えられたクエリーに検索条件を追加してクエリーを返します。
     */
    public static function addAndDateCondition($query = null, $key = null, $value_from = null, $value_to = null) {
        //指定された期間でWHERE文を組み立て返します。
        if ($query == null or ($value_from == null and $value_to == null)) {
            return $query;
        }
        
        if ($value_from != null and $value_to != null) {
            $query = $query->where($key, 'between', array($value_from, $value_to));
        }

        if ($value_from == null) {
            $query = $query->where($key, '<=', $value_to);
        }
        
        if ($value_to == null) {
            $query = $query->where($key, '>=', $value_from);
        }
        
        return $query;
    }

}
