<?php 
	session_start();

	// connect to database
    $link = mysqli_connect("localhost", "root", "mysql", "calender");

	if (!$link) {
		die("Error connecting to database: " . mysqli_connect_error());
	}

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/complete-blog-php/');
?>

<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Todo List</title>
	<link rel="stylesheet" type="text/css" href="assests/css/todos.css">
	<!-- google font -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
	<!-- font-awesome -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<!-- font-awesome 
		https://fontawesome.com/v4.7.0/icon/plus
	-->
	<!-- This iis todolist with jQuery -->
		<script type="text/javascript" src="assests/js/lib/jquery-3.4.1.min.js" ></script>
<!-- ============================== -->

</head>
<body>

	<div id="container">
		<h1>Todo Day Lists <a href="editdaylist.php">Edit</a> <i class="fa fa-plus"></i></h1>








		<input type="text" name="" id="tododay" placeholder="Add New Todo">
		<ul>
			<!-- <li> <span class="halo"><i class="fa fa-trash"></i></span> wake up at 6h30</li> -->
	<?php
    // session_start();
    // include ("connection.php");
    
    $link = mysqli_connect("localhost", "root","mysql","calender");

    // Check connection
    if ($link->connect_error) {
      die("Connection failed: " . $link->connect_error);
    }
    $sql = "SELECT id, tododay  FROM todo WHERE usertodo ='Loc' AND donedate != CURRENT_DATE() ";
    $result = mysqli_query($link,$sql);

    ?>  

    <?php
     while($row = mysqli_fetch_array($result)) {  
      $ids=$row['id'];     
    
      $tododay = $row['tododay'];
      // $created =$row['created_at'];
           ?>
        <li> <span id="<? echo $row['id'] ?>" class="halo"  ><i class="fa fa-trash"></i></span> 
       <? echo $tododay ?>   
       </li>
        
     <?php }
     
   
    ?>


		</ul>

	<!-- 	<h1> Specical Todo<i class="fa fa-plus"></i></h1>
		<input type="text" name="" placeholder="Add New Todo"> -->

	</div>



<script type="text/javascript" src="assests/js/todos.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
// the #tododay is the id in the input
$("#tododay").keypress(function(event){
	// the event.which===13 is the keyprees enter
	if(event.which===13){
		//grabbing new todo text
		var todoText=$(this).val();
		$(this).val("")//give an empty box
		// borrow the ajax to seen the data to php database
			$.ajax({
                    url: 'server.php',
                    type: 'POST',
                    data: {
                    	// the save is the name that the same name of input such as submit
                        'save': 1,
                        // this is stote the value that have type in
                        'tododay': todoText,
                    },
                    success: function(){
                        
                    }
                    });

$("ul").append("<li><span class = 'halo' ><i class='fa fa-trash'></i></span> "+ todoText +"</li>")
	}
});

$("span.halo").on("click",function(){
     var idstr = this.id;
    //  var firstDivID = $(this).getElementByTagName("button").id;
  console.log(idstr);
  if(confirm("You done this task today, it will show back tommorrow.\n Congratulations!"))
 	{
    $.ajax({
        url: 'server.php',
        type: 'POST',
        data: {
          'update':1,
          'id':idstr,
        },
        success: function(){
        }
    });
    $(this).parent().remove();
 	}
  });

</script>
</body>
</html>
