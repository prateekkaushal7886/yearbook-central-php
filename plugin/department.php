<?php
	ob_start();
	require 'connection.php';
	session_start();
	if (isset($_SESSION['rollno'])) {
		
	}else{
  		echo '<script>alert("You need to Log In");window.location.href="login.php";</script>';
	}
	$value1=$_SESSION['rollno'];
	$query = "select * from register where rollno = '$value1'"; 
	$result = mysql_query($query); 
	$line = mysql_fetch_array($result, MYSQL_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>List</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="animate.css">
	<style>


body
{
	background-image: url('bck.jpg');
  background-size: 100vw;
  background-repeat:repeat;
}
.toggle{
	display: none;
}
 @font-face {
     font-family:pacifico;
     src: url('Pacifico.ttf');
 }
 .btn
 {
 	text-transform: lowercase;
 	font-family: pacifico;
 }

td.roll,td.name,th.roll,th.name
{
	width: 150px;
	padding-left: 40px;
}
td.views
{
	width: 200px;
}
.box2
	{
		color: #707070;
		font-family: 'pacifico';
		font-size: 30px;
	}
</style>
</head>
<body>
	<div class="container">
<div class="row">
			<div class="col s3 l3 m3 offset-l1">
			    <button type="button"class="waves-effect waves-light btn" onclick="location.href='register.php'">HOME</button>

			</div>
			<div class="col s3 l6 m3"><h3 class="upload"style="font-family:pacifico;font-size:500%;color:#707070">Yearbook'16</h3><br>		<p class="box2">Write about your classmates!</p> 

</div>
<div class="col l2 s3 m3 ">
    <button type="button"class="waves-effect waves-light btn" onclick="location.href='login.php'">LOGOUT </button>


</div>
		</div>
		
		<div class="fixed-action-btn" style="bottom: 45px; right: 260px;font-family: 'pacifico';color: #707070;">
			<button class="btn waves-effect waves-light" type="submit">submit</button>
		</div>
		<table class="highlight">
	        <thead>
	          <tr>
	              <th class="roll" data-field="rollno">Roll No.</th>
	              <th  class="name" data-field="name">Name</th>
	          </tr>


	        </thead>

	        <tbody>
	          <?php
	          	$dept = $line['department'];
	          	$course=$line['course'];
	          	$query_select = "select * from register where department = '$dept' and course='$course'";
	          	$query_select_run = mysql_query($query_select);
	          	while ($list = mysql_fetch_assoc($query_select_run)) {
	          		$list_students[] = $list;
	          	}
	          	echo '<form method="POST" action="department.php">';
	          	for($i=0;$i<count($list_students);$i++){
	          		echo '<tr><td class="roll">'.$list_students[$i]['rollno'].'</td><td class="name">'.$list_students[$i]['name'].'</td><td class="view">
	          			  
						    
						      <div class="row">
						        <div class="input-field col s12">
						          <input id="views" type="text" class="validate" name="views'.$i.'">
						          <label for="views" data-error="wrong" data-success="right">Write here!</label>
						        </div>
						      </div>
						    
						  
	          		</td></tr>';
	          	}
		        //if(isset($_POST['views'.$i.''])){ 
		          	for($i=0;$i<count($list_students);$i++){
		          		//$query_save_views = "insert into views values ('', ".$line['rollno'].", ".$list_students[$i]['rollno'].", 'views".$i."')";	
		          		//$_POST['views'.$i.''] = 'default';
		          		if(isset($_POST['views'.$i.''])){
			          		if(!empty($_POST['views'.$i.''])){
				          		$views = $_POST['views'.$i.''];
				          		$rollno = $line['rollno'];
				          		$deptmate = $list_students[$i]['rollno'];
				          		$query_save_views = "insert into views values ('', '$rollno','$deptmate', '$views')";	
				          		$query_save_views_run = mysql_query($query_save_views);
				          		if ($i == count($list_students)-1) {
				          			header('Location:register.php');
				          		}
				          	}else{
				          		if ($i == count($list_students)-1) {
				          			header('Location:register.php');
				          		}
				          	}	
			          	}

		          	}
		         //}  	
	          ?>
	        </tbody>
      	</table>
	</div>
</body>
</html>