<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Pure css Responsive Masonry Gallery - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .gal {
	
	
	-webkit-column-count: 3; /* Chrome, Safari, Opera */
    -moz-column-count: 3; /* Firefox */
    column-count: 3;
	  
	
	}	
	.gal img{ width: 100%; padding: 7px 0;}
@media (max-width: 500px) {
		
		.gal {
	
	
	-webkit-column-count: 1; /* Chrome, Safari, Opera */
    -moz-column-count: 1; /* Firefox */
    column-count: 1;
	  
	
	}
		
	}


	.row {
	 -moz-column-width: 25em;
	 -webkit-column-width: 25em;
	 -moz-column-gap: .5em;
	 -webkit-column-gap: .5em; 
	  
	}

	.panel {
	 display: inline-block;
	 margin:  .5em;
	 padding:  0; 
	 width:98%;
	}
	.my_panel > .panel-body {
	  padding: 0px;
	}
	.my_panel > .panel-body > img {
	  width: 100%;
	  height: 100%;
	}
	.my_panel > .panel-footer {
	  text-align: center;
	}
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<!-- Start content -->
		<?=$content;?>
	<!-- End Content -->
</div>



<script type="text/javascript">

</script>
</body>
</html>
