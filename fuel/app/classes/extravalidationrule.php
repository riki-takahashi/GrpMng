<?php
/**
 * バリデーションチェックの拡張用共通クラス
 * @author i-suzuki
 */
class ExtraValidationRule {

    /**
     * 開始日、終了日の大小関係をチェックする。
     * @param type $value
     * @param type $field_start_date
     */
    public static function _validation_enddaterule($value, $field_start_date)
    {
        //このルールを追加する前に、開始日項目のルールを必ず追加しておくこと。
        Validation::active()->set_message('enddaterule', ':label：「:value」は開始日以降の日付を入力してください。');
        
        //こうあるべきだという条件を返す。true:正常　false:バリデーション異常
        return $value >= Validation::active()->input($field_start_date);
    }

    /**
     * 指定されたテーブル、フィールドに、値が既に存在するかチェックする。
     * @param type $value
     * @param type $table
     * @param type $field
     */
    public static function _validation_isExists($value, $table, $field)
    {
        Validation::active()->set_message('isExists', ':label：「:value」に関連する情報が既に登録されているため、削除できません。');
        
        //こうあるべきだという条件を返す。true:正常　false:バリデーション異常
        $result = DB::select("LOWER (\"$field\")")
        ->where($field, '=', Str::lower($value))
        ->from($table)->execute();

        return ! ($result->count() > 0);        
    }
    
}
