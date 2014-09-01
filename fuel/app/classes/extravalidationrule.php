<?php
/**
 * バリデーションチェックの拡張用共通クラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class ExtraValidationRule {

    /**
     * 開始日、終了日の大小関係をチェックする。
     * このルールでは引数に開始日項目を使用しているため、このルールを追加する前に、開始日項目のルールを必ず追加しておくこと。
     * @param type $value
     * @param type $field_start_date
     * @return bool true:正常　false:異常
     */
    public static function _validation_enddaterule($value, $field_start_date)
    {
        Validation::active()->set_message('enddaterule', ':label：「:value」は開始日以降の日付を入力してください。');
        
        //こうあるべきという条件判定を返す。
        return $value >= Validation::active()->input($field_start_date);
    }

    /**
     * 指定されたテーブル、フィールドに、値が既に存在するかチェックする。
     * @param type $value
     * @param type $table
     * @param type $field
     * @return bool true:正常　false:異常
     */
    public static function _validation_isexists($value, $table, $field, $aaa)
    {
        Validation::active()->set_message('isexists', 'その :label は『 :param:3 』に登録されているため、削除できません。');
        
        //入力パラメータで指定されたテーブルのフィールドに該当するデータを抽出
        $result = DB::select($field)
            ->where($field, '=', $value)
            ->from($table)->execute();

        //こうあるべきという条件判定を返す。
        return ! ($result->count() > 0);        
    }
    
}
