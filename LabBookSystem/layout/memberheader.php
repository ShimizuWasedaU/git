<!DOCTYPE html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IKE-Lab Book System</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   	<!-- SET ACTIVE MENU -->
	<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
    <script>
     $(document).ready(function(){
       if($("#menu").val()=="profile"){$("#profile").attr('class', 'active-menu')};
	   if($("#menu").val()=="borrow"){$("#borrow").attr('class', 'active-menu')};
	   if($("#menu").val()=="book"){$("#book").attr('class', 'active-menu')};
      });
    </script>  
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="memberpage.php">IKE-Lab</a> 
            </div>
        <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;"> 
        <i class="fa fa-user fa-2x"></i><a href="memberpage.php" ><?php echo $_SESSION['username']?>&nbsp; </a><a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
		   <div style=";padding-top:50px">
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
                    <li>
                        <a  id="profile" href="memberpage.php"><i class="fa fa-user fa-2x"></i> My Profile</a>
                    </li>
                      <li>
                        <a id="borrow" href="memberborrow.php"><i class="fa fa-list-alt fa-2x"></i> Borrowing List</a>
                    </li>
                    <li>
                        <a id="book" href="memberbook.php"><i class="fa fa-book fa-2x"></i> Finding Book</a>
                    </li>	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->