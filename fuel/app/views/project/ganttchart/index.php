<?php if (true): ?>

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
				source: [{
					name: "項目01",
					desc: "項目01の01",
					values: [{
						from: "/Date(1320192000000)/",
						to: "/Date(1322401600000)/",
						label: "項目01の説明01のラベル", 
						customClass: "ganttRed",

					}]
				},{
					name: " ",
					desc: "項目01の02",
					values: [{
						from: "/Date(1322611200000)/",
						to: "/Date(1323502400000)/",
						label: "項目01の説明02のラベル", 
						customClass: "ganttRed"
					}]
				},{
					name: "項目02",
					desc: "項目02の01",
					values: [{
						from: "/Date(1323802400000)/",
						to: "/Date(1325685200000)/",
						label: "項目02の説明01のラベル", 
						customClass: "ganttGreen"
					}]
				},{
					name: " ",
					desc: "項目02の02",
					values: [{
						from: "/Date(1325685200000)/",
						to: "/Date(1325695200000)/",
						label: "項目02の説明02のラベル", 
						customClass: "ganttBlue"
					}]
				},{
					name: "項目03",
					desc: "項目03の01",
					values: [{
						from: "/Date(1326785200000)/",
						to: "/Date(1325785200000)/",
						label: "項目03の説明01のラベル", 
						customClass: "ganttGreen"
					}]
				},{
					name: " ",
					desc: "項目03の02",
					values: [{
						from: "/Date(1328785200000)/",
						to: "/Date(1328905200000)/",
						label: "項目03の説明02のラベル", 
						customClass: "ganttBlue"
					}]
				},{
					name: "項目04",
					desc: "項目04の01",
					values: [{
						from: "/Date(1330011200000)/",
						to: "/Date(1336611200000)/",
						label: "項目04の説明01のラベル", 
						customClass: "ganttOrange"
					}]
				},{
					name: " ",
					desc: "項目04の02",
					values: [{
						from: "/Date(1336611200000)/",
						to: "/Date(1336911200000)/",
						label: "項目04の説明02のラベル", 
						customClass: "ganttRed"
					}]
				}],
				navigate: "scroll",
				scale: "weeks",
				maxScale: "months",
				minScale: "days",
                                months: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
				itemsPerPage: 4,
				onItemClick: function(data) {
					alert("チャートのクリックイベント");
				},
				onAddClick: function(dt, rowId) {
					alert("チャート外のクリックイベント");
				}
			});

			$(".gantt").popover({
				selector: ".bar",
				title: "ポップアップ",
				content: "これは別のプラグインで生成する"
			});

			prettyPrint();

		});

    </script>
    
<?php else: ?>
<p>データがありません</p>
<?php endif;