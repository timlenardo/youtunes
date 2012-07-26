<html><head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		
		<title>DataTables example</title>
		
		<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
		<link rel="stylesheet" type="text/css" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="DT_bootstrap.css">

		<script type="text/javascript" charset="utf-8" language="javascript" src="js2/jquery.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="js2/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="DT_bootstrap.js"></script>
	</head>
	<body>
		<div class="container" style="margin-top: 10px">
			
<!--div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
	<!--div class="row"><div class="span6">
		<div id="example_length" class="dataTables_length">
			<label>
				<!--select size="1" name="example_length" aria-controls="example">
					<option value="10" selected="selected">10
					</option>
					<option value="25">25</option><option value="50">50</option><option value="100">100</option></select-->
					records per page
			<!--/label>
		</div>
	</div-->
	<!--div class="span6">
		<div class="dataTables_filter" id="example_filter">
			<label>Search: <input type="text" aria-controls="example">
				
			</label>
		</div>
	</div>
</div-->

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" id="example" aria-describedby="example_info">
	
	<thead>
		<tr role="row">
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 159px; " aria-label="Rendering engine: activate to sort column ascending">
				Rendering engine
			</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 237px; " aria-label="Browser: activate to sort column ascending">
				Browser
			</th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 222px; " aria-sort="ascending" aria-label="Platform(s): activate to sort column descending">
				Platform(s)
			</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 136px; " aria-label="Engine version: activate to sort column ascending">
				Engine version
			</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 100px; " aria-label="CSS grade: activate to sort column ascending">
				CSS grade
			</th>
		</tr>
	</thead>
	
<tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="gradeU odd">
			<td class="">Other browsers</td>
			<td class="">All others</td>
			<td class=" sorting_1">-</td>
			<td class="center ">-</td>
			<td class="center ">U</td>
		</tr><tr class="gradeX even">
			<td class="">Misc</td>
			<td class="">Dillo 0.8</td>
			<td class=" sorting_1">Embedded devices</td>
			<td class="center ">-</td>
			<td class="center ">X</td>
		</tr><tr class="gradeA odd">
			<td class="">Misc</td>
			<td class="">NetFront 3.1</td>
			<td class=" sorting_1">Embedded devices</td>
			<td class="center ">-</td>
			<td class="center ">C</td>
		</tr><tr class="gradeA even">
			<td class="">Misc</td>
			<td class="">NetFront 3.4</td>
			<td class=" sorting_1">Embedded devices</td>
			<td class="center ">-</td>
			<td class="center ">A</td>
		</tr><tr class="gradeA odd">
			<td class="">Gecko</td>
			<td class="">Epiphany 2.20</td>
			<td class=" sorting_1">Gnome</td>
			<td class="center ">1.8</td>
			<td class="center ">A</td>
		</tr><tr class="gradeA even">
			<td class="">Webkit</td>
			<td class="">iPod Touch / iPhone</td>
			<td class=" sorting_1">iPod</td>
			<td class="center ">420.1</td>
			<td class="center ">A</td>
		</tr><tr class="gradeC odd">
			<td class="">KHTML</td>
			<td class="">Konqureror 3.1</td>
			<td class=" sorting_1">KDE 3.1</td>
			<td class="center ">3.1</td>
			<td class="center ">C</td>
		</tr><tr class="gradeA even">
			<td class="">KHTML</td>
			<td class="">Konqureror 3.3</td>
			<td class=" sorting_1">KDE 3.3</td>
			<td class="center ">3.3</td>
			<td class="center ">A</td>
		</tr><tr class="gradeA odd">
			<td class="">KHTML</td>
			<td class="">Konqureror 3.5</td>
			<td class=" sorting_1">KDE 3.5</td>
			<td class="center ">3.5</td>
			<td class="center ">A</td>
		</tr><tr class="gradeC even">
			<td class="">Tasman</td>
			<td class="">Internet Explorer 5.1</td>
			<td class=" sorting_1">Mac OS 7.6-9</td>
			<td class="center ">1</td>
			<td class="center ">C</td>
		</tr></tbody></table><div class="row"><div class="span6"><div class="dataTables_info" id="example_info">Showing 1 to 10 of 57 entries</div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div></div>
			
		</div>
	
</body></html>