<?php

/**
 * @group App
 */
use Fuel\Core\TestCase;

class Test_Model_Sales_Result extends TestCase {

    
    public function test_create_sales_result(){
      $before_count = count(Model_Sales_Result::find("all"));

      $sales_result = Model_Sales_Result::forge(array(
            'project_id' => 1,
            'sales_result_name' => "てすとうりあげじっせきめい１",
            'sales_date' => "2014-07-25",
            'sales_amount' => 1000000,
            'tax' => 100,
            'note' => "備考１",
      ));

      $sales_result->save();

      $update_count = count(Model_Sales_Result::find("all"));

      $this->assertEquals($before_count+1,$update_count);

    }    

    
    
}
