<?php

/**
 * @group App
 */
use Fuel\Core\TestCase;

class Test_Controller_Welcome extends TestCase {

    /**
     * ステータスコードのテスト
     */
    public function test_action_index() {
        // リクエストオブジェクトを作成、HTTPメソッドも指定可能
        $request = Request::forge('welcome/index')->set_method('GET');
        // リクエストを実行してレスポンスオブジェクトを取得
        $response = $request->execute()->response();
        // ステータスコードを取得
        $test = $response->status; // ステータスコードを取得
        $expected = 200;
        $this->assertEquals($expected, $test);
    }

    public function testExpectFooActualFoo() {
        $this->expectOutputString('foo');
        print 'foo';
    }

    public function testExpectBarActualBaz() {
        $this->expectOutputString('bar');
        print 'baz';
    }

    public function testEquality() {


        // ここで処理を止め、テストが未完成であるという印をつけます。
        $this->markTestIncomplete('このテストは、まだ実装されていません。');

        $this->assertEquals(
                array(1, 2, 3, 4, 5, 6), array(1, 2, 33, 4, 5, 6)
        );
    }

}
