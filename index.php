<!DOCTYPE html>
<html>
<head>
    <title> Ajax_Pagination </title>
	
	<!-- Meta Tags Satrt -->
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
	<link rel="icon" type="text/css" href="">
	<!-- Meta Tags Close -->
     
    <!-- CSS start -->
      
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="css/all.min.css">
   <link rel="stylesheet" type="text/css" href="css/animate.min.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- CSS close -->

    <style type="text/css">
    </style>

</head>
<body>

<div class="container-fluid">
	<div class="container">
		
		<div class="row text-center">
			<div class="col-md-4"></div>
			<div class="col-md-4">
          		 <h1>Ajax_Pagination</h1>
				  <div id="table-data">
					  
				  </div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</div>

<!-- Js Files Start -->
<script type="text/javascript" src="js/all.min.js"></script>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


<script  type="text/javascript">
	$(document).ready(function() {
			function loadTable(page){
				$.ajax({
				url : "ajax-Pagination.php",
				type : "POST",
				data: {page_no: page},
				success : function(data){
					$("#table-data").html(data);
				}
			});
			}
			loadTable();

		// Pagination Code
		$(document).on("click", "#pagination a", function(e){
			e.preventDefault();
			$page_id = $(this).attr("id");

			loadTable($page_id);
		}) 
	});


	// Load More Pagination
	$(document).ready(function() {
			function loadTable2(page){
				$.ajax({
				url : "load_more.php",
				type : "POST",
				data: {page_No : page},
				success : function(data){
					if(data){
						$("#Pagination2").remove();
						$("#load_data2").append(data);
					}else{
						$("#ajaxbtn").html("Finished");
            			$("#ajaxbtn").prop("disabled",true);
					}
				}
			});
			}
			loadTable2();
		// Add Click Event on ajaxbtn
		$(document).on("click","#ajaxbtn",function(){
     	 $("#ajaxbtn").html("Loading...");
      	var pid = $(this).data("Id");
      	loadTable2(pid);
   			 });

	});

</script>

</body>
</html>