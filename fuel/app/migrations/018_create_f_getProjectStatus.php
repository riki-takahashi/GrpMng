<?php

namespace Fuel\Migrations;

class Create_f_getprojectstatus
{
	public function up()
	{
		\DB::expr(preg_replace("/\s+/", " ",
"
DELIMITER //;

CREATE FUNCTION `f_getProjectStatus`(`paramProjectId` INT)
	RETURNS int(11)
	LANGUAGE SQL
	NOT DETERMINISTIC
	CONTAINS SQL
	SQL SECURITY DEFINER
	COMMENT ''
BEGIN
		-- 指定されたプロジェクトIDの状態取得
	
		-- 売上実績情報が登録済　→　4:売上
		set @countResult = 0;
		select count(*) INTO @countResult from sales_results
		where project_id = paramProjectId;
		
		if @countResult > 0 then
			return 4;
		end if;


		-- プロジェクト情報の受注金額が入力済　→　3:受注
		set @orderAmount = null;
		select order_amount INTO @orderAmount from projects
		where id = paramProjectId;
		
		if @orderAmount is not null then
			return 3;
		end if;


		-- プロジェクト情報の見積金額が入力済　→　2:見積
		-- プロジェクト情報の見積金額が未入力　→　1:引合
		set @orderAmount = null;
		select est_amount INTO @estAmount from projects
		where id = paramProjectId;
		
		if @estAmount is not null then
			return 2;
		else
			return 1;
		end if;


		-- 上記以外　→　0:(該当なし)
		return 0;

	END

DELIMITER ;//

"
                    )
		);
	}

	public function down()
	{
		\DB::expr('DROP FUNCTION f_getProjectStatus;');
	}
}