<?php if (true): ?>

    <style type="text/css">
        body {
                font-family: Helvetica, Arial, sans-serif;
                font-size: 13px;
                padding: 0 0 50px 0;
        }
        .contain {
                width: 100%;
                height: 100%;
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
                width: 15%;
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

    <div class="contain">
        <div  type="image/svg+xml" class="gantt"></div>
        
<object id="gazo" type="image/svg+xml" data="a.svg">
        <svg id="svgelem" xmlns="http://www.w3.org/2000/svg">
            <circle id="redcircle" cx="50" cy="50" r="50" fill="red" />
        </svg>
</object>
        
        
<svg id="left-arrow"
  viewBox="0 0 64 64"
  version="1.1"
  xmlns="http://www.w3.org/2000/svg">
  <g transform="translate(32), rotate(-45, 32, 32)">
    <g fill="none"
      stroke="#fff"
      stroke-width="8">
      <line x1="0" y1="4" x2="24" y2="4"/>
      <line x1="4" y1="0" x2="4" y2="24"/>
    </g>
  </g>
</svg>        
        
        
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
                            itemsPerPage: 10,
                            onItemClick: function(data) {
                                location.href="member/"+data;
                            }
                                
			});
		});
    </script>
    
<?php else: ?>
<p>データがありません</p>
<?php endif;