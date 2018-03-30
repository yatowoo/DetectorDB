<!DOCTYPE html>
<html>

<head>
	<title>Detector Database</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://cdn.bootcss.com/flat-ui/2.3.0/css/flat-ui.min.css" rel="stylesheet">
	<link href="https://cdn.bootcss.com/bootstrap-table/1.11.1/bootstrap-table.css" rel="stylesheet">
	<script src="https://cdn.bootcss.com/flat-ui/2.3.0/js/vendor/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
	<script src="https://cdn.bootcss.com/flat-ui/2.3.0/js/flat-ui.min.js"></script>
	<script src="https://cdn.bootcss.com/flat-ui/2.3.0/js/vendor/respond.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap-table/1.11.1/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
	<script src="//static.kcwiki.org/FileSaver.js/2014-11-29/FileSaver.min.js"></script>
	<script src="//static.kcwiki.org/poi-static/tableExport.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap-table/1.11.1/extensions/export/bootstrap-table-export.min.js"></script>
</head>
<body>
    <?php 
        include_once 'navbar.html';
        include_once 'DB.html';
        include_once 'footer.html';
    ?>

    <script>
		<?php
			// Set table name by $_GET?
			$tbname = $_GET['tbname'];
			if(!$tbname){
				$tbname = 'epd-fee';
			}
			echo "var tbname = '" . $tbname . "';" ;
            $tbheader = json_decode(file_get_contents('tbheader.json'), true);
            echo "var tbheader=";
            echo json_encode($tbheader[$tbname]);
            echo ";\n";
		?>
		$('#'+tbname).attr('class','list-group-item active');
    </script>
    <script src="load.js"></script>
</body>
</html>
