<?php if (true): ?>

    <style type="text/css">
        body {
                font-family: Helvetica, Arial, sans-serif;
                font-size: 13px;
                padding: 0 0 50px 0;
        }
        .contain {
                width: 800px;
                margin: 0 auto;
        }
        h1 {
                margin: 40px 0 20px 0;
        }
        h2 {
                font-size: 1.5em;
                padding-bottom: 3px;
                border-bottom: 1px solid #DDD;
                margin-top: 50px;
                margin-bottom: 25px;
        }
        table th:first-child {
                width: 150px;
        }
        /* Bootstrap 3.x re-reset */
        .fn-gantt *,
        .fn-gantt *:after,
        .fn-gantt *:before {
          -webkit-box-sizing: content-box;
             -moz-box-sizing: content-box;
                  box-sizing: content-box;
        }
    </style>

    <style type="text/css">
            .contain {
                    width: 1000px;
                    margin: 0 auto;
            }
    </style>

    <div class="contain">
        <div class="gantt"></div>
    </div>



    <script>
		$(function() {

			"use strict";

			$(".gantt").gantt({
                                source: "../Gunttrest/guntt.json",
				navigate: "scroll",
				scale: "weeks",
				maxScale: "months",
				minScale: "days",
                                months: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
				itemsPerPage: 10
			});

			prettyPrint();

		});

    </script>
    
<?php else: ?>
<p>データがありません</p>
<?php endif;