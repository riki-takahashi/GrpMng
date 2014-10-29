<?php

namespace Fuel\Migrations;

class Create_f_getprojectstatus
{
	public function up()
	{
                // MySQLiを使用するのであれば、DELIMITERは不要
                $sql = "CREATE FUNCTION f_getProjectStatus(paramProjectId INT) ";
                $sql .= "RETURNS INT  LANGUAGE SQL NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER ";
                $sql .= "BEGIN ";
                $sql .= "set @countResult = 0;   select count(*) INTO @countResult from sales_results   where project_id = paramProjectId; ";
                $sql .= "if @countResult > 0 then return 4;   end if; set @orderAmount = null; ";
                $sql .= "select order_amount INTO @orderAmount from projects   where id = paramProjectId; ";
                $sql .= "if @orderAmount is not null then return 3; end if; set @orderAmount = null; ";
                $sql .= "select est_amount INTO @estAmount from projects   where id = paramProjectId; ";
                $sql .= "if @estAmount is not null then return 2; else return 1; end if; return 0; ";
                $sql .= "END";
		\DB::query($sql, \DB::UPDATE)->execute();
	}

	public function down()
	{
		$sql = "DROP FUNCTION f_getProjectStatus;";
                \DB::query($sql, \DB::UPDATE)->execute();
	}
}