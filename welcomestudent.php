<?php
session_start();

if ($_SESSION["sidx"] == "" || $_SESSION["sidx"] == NULL) {
	header('Location:studentlogin');
}

$userid = $_SESSION["sidx"];
$userfname = $_SESSION["fname"];
$sEno = $_SESSION["seno"];
$userlname = $_SESSION["lname"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome Page</title>
	<style>
		/* Slide bar styling */
		.btn-slider {
			position: fixed;
			left: 0;
			top: 0;
			height: 100vh;
			width: 200px;
			overflow-y: auto;
			background-color: #004d40;
			/* Dark green color */
			padding: 20px;
			z-index: 1000;
			/* Ensure the slide bar is above other content */
			border-top-right-radius: 20px;
			border-bottom-right-radius: 20px;
			padding: 20px 20px 100px;
		}

		.btn-slider img {
			width: 100%;
			margin-top: 120px;
			margin-bottom: 140px;
		}

		.btn-slider button {
			display: block;
			width: 100%;
			margin-bottom: 10px;
			border: none;
			border-radius: 15px;
			background-color: #00695c;
			/* Button color */
			color: white;
			padding: 10px;
			text-align: left;
			cursor: pointer;
			transition: background-color 0.3s ease;
			margin-bottom: 20px;
		}

		.btn-slider button:hover {
			background-color: #004d40;
			/* Button color on hover */
		}

		/* Main content */
		.main-content {
			margin-left: 200px;
			/* Adjust to match slide bar width */
			padding: 20px;
		}

		/* Header styling */
		header {
			position: fixed;
			left: 0;
			top: 0;
			width: 200px;
			background-color: #004d40;
			/* Dark green color */
			color: white;
			padding: 10px;
			text-align: center;
			border-top-right-radius: 20px;
			border-bottom-right-radius: 20px;
			z-index: 1000;
			/* Ensure the header is above other content */
		}

		/* Welcome text styling */
		.welcome-text {
			margin-top: 50px;
			text-align: center;
			font-size: 24px;
			background-color: #b2dfdb;
			/* Greenish background */
			padding: 20px;
			border-radius: 10px;
		}

		body {
			background-image: url('images/logo-color.png');
			/* Background image */
			background-color: white;
			background-size: 1000px 1000px;
			background-repeat: no-repeat;
			background-position: top;
			/* margin-top: 200px; */
			/* margin margin-left: 100px; */

		}
	</style>
</head>

<body>
	<header>
		<h1>Welcome <?php echo "<span style='color:red'>" . $userfname . " " . $userlname . "</span>"; ?></h1>
	</header>

	<div class="btn-slider">
		<img src="images/logo.png" alt="Logo">
		<a href="mydetailsstudent.php?myds=<?php echo $userid; ?>"><button title="My Details">My Profile</button></a>
		<a href="takeassessment.php?seno=<?php echo $sEno; ?>"><button>Take Assessment</button></a>
		<a href="viewresult.php?seno=<?php echo $sEno; ?>"><button>View Results</button></a>
		<a href="askquery.php?eid=<?php echo $userid; ?>"><button>Ask Query</button></a>
		<a href="viewquery.php?eid=<?php echo $userid; ?>"><button>My Query</button></a>
		<a href="viewvideos.php?eid=<?php echo $userid; ?>"><button>Videos (E-Learn)</button></a>

		<a href="logoutstudent"><button>Logout</button></a>
	</div>

	<div class="main-content">
		<!-- Main content goes here -->
		<div class="welcome-text">
			<h2>Welcome <?php echo $userfname . " " . $userlname; ?></h2>
		</div>
		<!-- Add more content here -->
	</div>
</body>

</html>