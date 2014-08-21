<?php
/**
 * バリデーションチェックの拡張用共通クラス
 * @author i-suzuki
 */
class ExtraValidationRule {

    /**
     * バリデーションを拡張して、開始日、終了日の大小関係をチェックする。
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
    
}
