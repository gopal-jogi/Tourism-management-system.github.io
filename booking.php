<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE HTML>
<html>
<head>
<title>TMS |Boking</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/main.css" rel="stylesheet">
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
	<script>
		 new WOW().init();
	</script>
	</head>
	
	<!-- HEAD TAG ENDS -->
	
	<!-- BODY TAG STARTS -->
	
	<body>
    <!-- top-header -->
           <?php include('includes/header.php');?>
           <div class="slider-3">
	        <div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TMS -Booking</h1>
	</div>
</div>
  <!--- /slider ---->
		
		<?php include("common/headerLoggedIn.php"); ?>
		
		<?php
		
			$mode=$_POST["modeHidden"];
		
		?>
		
		<?php
		
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "tms1";
			
			// Creating a connection to tms1 MySQL database
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			// Checking if we've successfully connected to the database
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
		
		?>
		
		<div class="spacer">a</div>
		
		<div class="bookingWrapper">
			
			<div class="headingOne">
				
				Please review and confirm your booking
				
			</div>
			
			<!-- changing contents of the page based on mode -->
			
			
			<!----------------------------- ONE WAY FLIGHT --------------------------------->
			
			
			<?php if($mode=="OneWayFlight"): ?>
			
			<div class="col-sm-12 bookingOneWayFlight">
			
			<?php
				
				$type=$_POST["typeHidden"];
				$class=$_POST["classHidden"];
				$origin=$_POST["originHidden"];
				$destination=$_POST["destinationHidden"];
				$depart=$_POST["departHidden"];
				$return=$_POST["returnHidden"];
				$adults=$_POST["adultsHidden"];
				$children=$_POST["childrenHidden"];
				$noOfPassengers=(int)$adults+(int)$children;
			
				if($type=="Return Trip") {
					$flightNoOutbound=$_POST["flightNoOutboundHidden"];
					$flightNoInbound=$_POST["flightNoInboundHidden"];
				}
				elseif($type=="One Way") {
					$flightNoOutbound=$_POST["flightNoOutboundHidden"];
				}
			
				if($class=="Economy Class")
					$className="Economy";
				else
					$className="Business";
				
				$outboundFlightSQL = "SELECT * FROM `flights` WHERE flight_no='$flightNoOutbound'";
				$outboundFlightQuery = $conn->query($outboundFlightSQL);
				$row = $outboundFlightQuery->fetch_assoc();
				//$outboundFlightFare = $outboundFlightQuery->fetch_array(MYSQLI_NUM);
				
			?>
				
				<div class="col-sm-7"> <!-- departure container -->
				
				<div class="col-sm-12">
				
					<div class="boxLeftOneWayFlight">
					
						<div class="col-sm-12 mode">Departure</div>
						
						<div class="col-sm-4">
						
						<div class="origin"><?php echo $origin; ?></div>
						<div class="departs">Departs <?php echo $depart; ?> at: <?php echo $row["departs"]; ?></div>
						
						</div>
						
						<div class="col-sm-4">
							
							<div class="arrow"></div>
							
						</div>
						
						<div class="col-sm-4">
						
						<div class="destination"><?php echo $destination; ?></div>
						<div class="arrives">Arrives <?php echo $depart; ?> at: <?php echo $row["arrives"]; ?></div>
						
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="operator"><?php echo $row["operator"]; ?></div>
							<div class="operatorSubscript">Operator</div>
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="class"><?php echo $className; ?></div>
							<div class="classSubscript">Class</div>
						</div>
						
						
						<div class="col-sm-3 borderRight">
							<div class="adults"><?php echo $adults; ?></div>
							<div class="adultsSubscript">Adults</div>
						</div>
						
						<div class="col-sm-3">
							<div class="children"><?php echo $children; ?></div>
							<div class="childrenSubscript">Children</div>
						</div>
					
					</div> <!-- boxLeft -->
				
				</div> <!-- col-sm-7 Departure -->
				
				</div>
				
				<div class="col-sm-5"> <!-- fare container -->
				
				<div class="col-sm-12">
				
					<div class="boxRightOneWayFlight">
					
					<div class="col-sm-12 fareSummary">Fare Summary</div>
						
					<div class="col-sm-8">
						<div class="heading"><?php echo $adults; ?> Adults</div>
						<div class="heading"><?php echo $children; ?> Children</div>
						<div class="heading">Convenience Fee</div>	
					</div>
					
					<div class="col-sm-4">
						<div class="price"><span class="sansSerif">₹ </span><?php echo $adults*$row["fare"]; ?></div>
						<div class="price"><span class="sansSerif">₹ </span><?php echo $children*$row["fare"]; ?></div>
						<div class="price"><span class="sansSerif">₹ </span>250</div>
					</div>	
					
					<div class="col-sm-12">
							
							<div class="calcBar"></div>
							
					</div>
					
					<div class="col-sm-8">
						<div class="headingTotal">Total Fare</div>
					</div>
					
					<div class="col-sm-4">
						<div class="priceTotal"><span class="sansSerif">₹ </span><?php echo ($adults*$row["fare"])+($children*$row["fare"])+250; ?></div>
					</div>
					
					<form action="passengers.php" method="POST">
					
						<div class="bookingButton text-center">
							<input type="submit" class="confirmButton" value="Confirm Booking">
						</div>
						
						<?php $totalFare = ($adults*$row["fare"])+($children*$row["fare"])+250 ?>
						
						<input type="hidden" name="fareHidden" value="<?php echo $totalFare; ?>">
						<input type="hidden" name="typeHidden" value="<?php echo $type; ?>">
						<input type="hidden" name="classHidden" value="<?php echo $class; ?>">
						<input type="hidden" name="originHidden" value="<?php echo $origin; ?>">
						<input type="hidden" name="destinationHidden" value="<?php echo $destination; ?>">
						<input type="hidden" name="departHidden" value="<?php echo $depart; ?>">
						<input type="hidden" name="returnHidden" value="<?php echo $return; ?>">
						<input type="hidden" name="adultsHidden" value="<?php echo $adults; ?>">
						<input type="hidden" name="childrenHidden" value="<?php echo $children; ?>">
						<input type="hidden" name="flightNoOutboundHidden" value="<?php echo $row["flight_no"]; ?>">
						<input type="hidden" name="modeHidden" value="<?php echo "OneWayFlight" ?>">
					
					</form>
					
				</div>
				
			</div> <!-- col-sm-5 Fare -->
			
				</div> <!-- fare container -->
				
			</div> <!-- bookingOneWayFlight -->
			
			
			<!----------------------------- RETURN TRIP FLIGHT --------------------------------->
			
			
			<?php elseif($mode=="ReturnTripFlight"): ?>
			
			<div class="col-sm-12 bookingReturnTripFlight">
			
			<?php
				
				$type=$_POST["typeHidden"];
				$class=$_POST["classHidden"];
				$origin=$_POST["originHidden"];
				$destination=$_POST["destinationHidden"];
				$depart=$_POST["departHidden"];
				$return=$_POST["returnHidden"];
				$adults=$_POST["adultsHidden"];
				$children=$_POST["childrenHidden"];
				$noOfPassengers=(int)$adults+(int)$children;
			
				if($type=="Return Trip") {
					$flightNoOutbound=$_POST["flightNoOutboundHidden"];
					$flightNoInbound=$_POST["flightNoInboundHidden"];
				}
				elseif($type=="One Way") {
					$flightNoOutbound=$_POST["flightNoOutboundHidden"];
				}
			
				if($class=="Economy Class")
					$className="Economy";
				else
					$className="Business";
				
				$outboundFlightSQL = "SELECT * FROM `flights` WHERE flight_no='$flightNoOutbound'";
				$outboundFlightQuery = $conn->query($outboundFlightSQL);
				$rowOutbound = $outboundFlightQuery->fetch_assoc();
				
				$inboundFlightSQL = "SELECT * FROM `flights` WHERE flight_no='$flightNoInbound'";
				$inboundFlightQuery = $conn->query($inboundFlightSQL);
				$rowInbound = $inboundFlightQuery->fetch_assoc();
				
			?>
			
				<div class="col-sm-7"> <!-- departure return container -->
			
				<div class="col-sm-12">
				
					<div class="boxLeftOneWayFlight">
					
						<div class="col-sm-12 mode">Departure</div>
						
						<div class="col-sm-4">
						
						<div class="origin"><?php echo $rowOutbound["origin"]; ?></div>
						<div class="departs">Departs <?php echo $depart; ?> at: <?php echo $rowOutbound["departs"]; ?></div>
						
						</div>
						
						<div class="col-sm-4">
							
							<div class="arrow"></div>
							
						</div>
						
						<div class="col-sm-4">
						
						<div class="destination"><?php echo $rowOutbound["destination"]; ?></div>
						<div class="arrives">Arrives <?php echo $depart; ?> at: <?php echo $rowOutbound["arrives"]; ?></div>
						
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="operator"><?php echo $rowOutbound["operator"]; ?></div>
							<div class="operatorSubscript">Operator</div>
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="class"><?php echo $className; ?></div>
							<div class="classSubscript">Class</div>
						</div>
						
						
						<div class="col-sm-3 borderRight">
							<div class="adults"><?php echo $adults; ?></div>
							<div class="adultsSubscript">Adults</div>
						</div>
						
						<div class="col-sm-3">
							<div class="children"><?php echo $children; ?></div>
							<div class="childrenSubscript">Children</div>
						</div>
					
					</div> <!-- boxLeft -->
				
				</div> <!-- col-sm-7 Departure -->
					
				<div class="col-sm-12">
					
						<div class="boxLeftOneWayFlight">
						
							<div class="col-sm-12 mode">Return</div>
							
							<div class="col-sm-4">
							
							<div class="origin"><?php echo $rowInbound["origin"]; ?></div>
							<div class="departs">Departs <?php echo $return; ?> at: <?php echo $rowInbound["departs"]; ?></div>
							
							</div>
							
							<div class="col-sm-4">
								
								<div class="arrow"></div>
								
							</div>
							
							<div class="col-sm-4">
							
							<div class="destination"><?php echo $rowInbound["destination"]; ?></div>
							<div class="arrives">Arrives <?php echo $return; ?> at: <?php echo $rowInbound["arrives"]; ?></div>
							
							</div>
							
							<div class="col-sm-3 borderRight">
								<div class="operator"><?php echo $rowInbound["operator"]; ?></div>
								<div class="operatorSubscript">Operator</div>
							</div>
							
							<div class="col-sm-3 borderRight">
								<div class="class"><?php echo $className; ?></div>
								<div class="classSubscript">Class</div>
							</div>
							
							
							<div class="col-sm-3 borderRight">
								<div class="adults"><?php echo $adults; ?></div>
								<div class="adultsSubscript">Adults</div>
							</div>
							
							<div class="col-sm-3">
								<div class="children"><?php echo $children; ?></div>
								<div class="childrenSubscript">Children</div>
							</div>
						
						</div> <!-- boxLeft -->
					
					</div> <!-- col-sm-7 Return -->
					
				</div> <!-- departure return container -->
					
				<div class="col-sm-5"> <!-- fare container -->
				
				<div class="col-sm-12">
				
					<div class="boxRightOneWayFlight">
					
					<div class="col-sm-12 fareSummary">Fare Summary</div>
						
					<div class="col-sm-8">
						<div class="heading"><?php echo $adults; ?> Adults</div>
						<div class="heading"><?php echo $children; ?> Children</div>
						<div class="heading">Convenience Fee</div>	
					</div>
					
					<div class="col-sm-4">
						<div class="price"><span class="sansSerif">₹ </span><?php echo $adults*($rowOutbound["fare"]+$rowInbound["fare"]); ?></div>
						<div class="price"><span class="sansSerif">₹ </span><?php echo $children*($rowOutbound["fare"]+$rowInbound["fare"]); ?></div>
						<div class="price"><span class="sansSerif">₹ </span>250</div>
					</div>	
					
					<div class="col-sm-12">
							
							<div class="calcBar"></div>
							
					</div>
					
					<div class="col-sm-8">
						<div class="headingTotal">Total Fare</div>
					</div>
					
					<div class="col-sm-4">
						<div class="priceTotal"><span class="sansSerif">₹ </span><?php echo ($adults*($rowOutbound["fare"]+$rowInbound["fare"]))+($children*($rowOutbound["fare"]+$rowInbound["fare"]))+250; ?></div> <!-- CHANGE -->
					</div>
					
					<form action="passengers.php" method="POST">
					
						<div class="bookingButton text-center">
							<input type="submit" class="confirmButton" value="Confirm Booking">
						</div>
						
						<?php $totalFare = ($adults*($rowOutbound["fare"]+$rowInbound["fare"]))+($children*($rowOutbound["fare"]+$rowInbound["fare"]))+250 ?>
						<!-- CHANGE -->
						
						<input type="hidden" name="fareHidden" value="<?php echo $totalFare; ?>">
						<input type="hidden" name="typeHidden" value="<?php echo $type; ?>">
						<input type="hidden" name="classHidden" value="<?php echo $class; ?>">
						<input type="hidden" name="originHidden" value="<?php echo $origin; ?>">
						<input type="hidden" name="destinationHidden" value="<?php echo $destination; ?>">
						<input type="hidden" name="departHidden" value="<?php echo $depart; ?>">
						<input type="hidden" name="returnHidden" value="<?php echo $return; ?>">
						<input type="hidden" name="adultsHidden" value="<?php echo $adults; ?>">
						<input type="hidden" name="childrenHidden" value="<?php echo $children; ?>">
						<input type="hidden" name="flightNoOutboundHidden" value="<?php echo $rowOutbound["flight_no"]; ?>">
						<input type="hidden" name="flightNoInboundHidden" value="<?php echo $rowInbound["flight_no"]; ?>">
						<input type="hidden" name="modeHidden" value="<?php echo "ReturnTripFlight" ?>">
					
					</form>
					
				</div>
				
			</div> <!-- col-sm-5 Fare -->
			
				</div> <!-- fare return container -->
				
			</div> <!-- bookingReturnTripFlight -->
			
			
			<!----------------------------- HOTEL --------------------------------->
			
			
			<?php elseif($mode=="hotel"): ?>
			
			<div class="col-sm-12 bookingHotel">
			
			<?php
				
				$hotelID = $_POST["hotelIDHidden"];
				
				$hotelSQL = "SELECT * FROM `hotels` WHERE hotelID='$hotelID'";
				$hotelQuery = $conn->query($hotelSQL);
				$row = $hotelQuery->fetch_assoc();
				
			?>
				
				<div class="col-sm-7"> <!-- hotel summary container -->
				
				<div class="col-sm-12">
				
					<div class="boxLeftHotel">
					
						<div class="col-sm-12 hotelMode">Booking Summary</div>
						
						<div class="col-sm-12 hotelName">
							
							Name of the hotel: <span class="nameText"><?php echo $row["hotelName"].', '.$row["locality"].', '.$row["city"]; ?></span>
							
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="checkIn"><?php echo $_SESSION["checkIn"]; ?></div>
							<div class="checkInSubscript">Check In Date</div>
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="checkOut"><?php echo $_SESSION["checkOut"]; ?></div>
							<div class="checkOutSubscript">Check Out Date</div>
						</div>
						
						
						<div class="col-sm-3 borderRight">
							<div class="noOfRooms"><?php echo $_SESSION["noOfRooms"]; ?></div>
							<div class="noOfRoomsSubscript">No. of rooms</div>
						</div>
						
						<div class="col-sm-3">
							<div class="noOfGuests"><?php echo $_SESSION["noOfGuests"]; ?></div>
							<div class="noOfGuestsSubscript">No. of guests</div>
						</div>
					
					</div> <!-- boxLeft -->
				
				</div> <!-- col-sm-7 Departure -->
				
				</div>
				
				<div class="col-sm-5"> <!-- fare container -->
				
				<div class="col-sm-12">
				
					<div class="boxRightHotel">
					
					<div class="col-sm-12 fareSummary">Payment Summary</div>
						
					<div class="col-sm-8">
					
					<?php
						
						$var1 = $_SESSION["checkIn"];
						$var2 = $_SESSION["checkOut"];
						$date1 = date_create(str_replace('/', '-', $var1));
						$date2 = date_create(str_replace('/', '-', $var2));
						$diff=date_diff($date1,$date2);
					
					?>
					
						<div class="heading"><?php echo $_SESSION["noOfRooms"]; ?> Rooms x <?php echo $diff->format("%a Days"); ?></div>
						<div class="heading">Convenience Fee</div>	
					</div>
					
					<?php $noOfDays = $diff->format("%a"); ?>
					
					<div class="col-sm-4">
						<div class="price"><span class="sansSerif">₹ </span><?php echo $_SESSION["noOfRooms"]*$row["price"]*$noOfDays; ?></div>
						<div class="price"><span class="sansSerif">₹ </span>250</div>
					</div>	
					
					<div class="col-sm-12">
							
							<div class="calcBar"></div>
							
					</div>
					
					<div class="col-sm-8">
						<div class="headingTotal">Total Payment</div>
					</div>
					
					<div class="col-sm-4">
						<div class="priceTotal"><span class="sansSerif">₹ </span><?php echo ($_SESSION["noOfRooms"]*$row["price"]*$noOfDays)+250; ?></div>
					</div>
					
					<form action="payment.php" method="POST">
					
						<div class="bookingButton text-center">
							<input type="submit" class="confirmButton" value="Confirm Booking">
						</div>
						
						<?php $totalFare = ($_SESSION["noOfRooms"]*$row["price"]*$noOfDays)+250; ?>
						
						<input type="hidden" name="fareHidden" value="<?php echo $totalFare; ?>">
						<input type="hidden" name="hotelIDHidden" value="<?php echo $hotelID; ?>">
						<input type="hidden" name="modeHidden" value="<?php echo "hotel" ?>">
					
					</form>
					
				</div>
				
			</div> <!-- col-sm-5 Fare -->
			
				</div> <!-- fare container -->
				
			</div> <!-- hotel -->
			
			<!------------------------------------- CABS ---------------------------------------->
			
			<?php elseif($mode=="cabs"): ?>
			
			<div class="col-sm-12 bookingCabs">
			
			<?php
				
				$origin = $_POST["originCity"];
				$destination = $_POST["destinationCity"];
				$date = $_POST["date"];
				$time = $_POST["time"];
				$carType = $_POST["carType"];
				
				$_SESSION["originCabs"] = $origin;
				$_SESSION["destinationCabs"] = $destination;
				$_SESSION["dateCabs"] = $date;
				$_SESSION["timeCabs"] = $time;
				$_SESSION["carTypeCabs"] = $carType;
				
				$cabSQL = "SELECT * FROM `cabs` WHERE origin='$origin' AND destination='$destination'";
				$cabQuery = $conn->query($cabSQL);
				$rowCab = $cabQuery->fetch_assoc();
				
			?>
				
				<div class="col-sm-7"> <!-- hotel summary container -->
				
				<div class="col-sm-12">
				
					<div class="boxLeftCabs">
					
						<div class="col-sm-12 cabMode">Booking Summary</div>
						
						<div class="col-sm-12 cabsDummy">
						
							<div class="col-sm-4">
							
							<div class="origin"><?php echo $rowCab["origin"]; ?></div>
							
							</div>
							
							<div class="col-sm-4">
								
								<div class="arrowCabs"></div>
								
							</div>
							
							<div class="col-sm-4">
							
							<div class="destination"><?php echo $rowCab["destination"]; ?></div>
								
							</div>
							
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="checkIn"><?php echo $_SESSION["dateCabs"]; ?></div>
							<div class="checkInSubscript">Pickup Date</div>
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="checkOut"><?php echo $_SESSION["timeCabs"]; ?></div>
							<div class="checkOutSubscript">Pickup Time</div>
						</div>
						
						
						<div class="col-sm-3 borderRight">
							<div class="noOfRooms"><?php echo $_SESSION["carTypeCabs"]; ?></div>
							<div class="noOfRoomsSubscript">Type of Car</div>
						</div>
						
						<div class="col-sm-3">
							<div class="noOfGuests"><?php echo $rowCab["distance"]." km"; ?></div>
							<div class="noOfGuestsSubscript">Distance</div>
						</div>
						
						<div class="col-sm-12 distanceNotif text-center">
							
							The distance shown is approximate and is based on pre-selected pickup and dropoff points. The exact distance will depend upon the actual pickup and dropoff points.
							
						</div>
					
					</div> <!-- boxLeft -->
				
				</div> <!-- col-sm-7 Departure -->
				
				</div>
				
				<div class="col-sm-5"> <!-- fare container -->
				
				<div class="col-sm-12">
				
					<div class="boxRightCab">
					
					<div class="col-sm-12 fareSummary">Payment Summary</div>
					
					<?php if($carType=="Hatchback"): ?>
						
					<div class="col-sm-8">
						<div class="heading">Distance (<?php echo $rowCab["distance"]; ?>km @ <span class="sansSerif">₹ </span> 5.5/km) </div>
						<div class="heading">Time (<?php echo $rowCab["time"]; ?> min @ <span class="sansSerif">₹ </span> 1.25/min) </div>
						<div class="heading">Convenience Fee</div>	
					</div>
					
					<div class="col-sm-4">
						<div class="price"><span class="sansSerif">₹ </span><?php echo $rowCab["distance"]*5.5; ?></div>
						<div class="price"><span class="sansSerif">₹ </span><?php echo $rowCab["time"]*1.25; ?></div>
						<div class="price"><span class="sansSerif">₹ </span>250</div>
					</div>
					
					<?php $totalFare=($rowCab["distance"]*5.5)+($rowCab["time"]*1.25+250); ?>
					
					<?php elseif($carType=="Sedan"): ?>
					
					<div class="col-sm-8">
						<div class="heading">Distance (<?php echo $rowCab["distance"]; ?>km @ <span class="sansSerif">₹ </span> 8.75/km) </div>
						<div class="heading">Time (<?php echo $rowCab["time"]; ?> min @ <span class="sansSerif">₹ </span> 2/min) </div>
						<div class="heading">Convenience Fee</div>	
					</div>
					
					<div class="col-sm-4">
						<div class="price"><span class="sansSerif">₹ </span><?php echo $rowCab["distance"]*8.75; ?></div>
						<div class="price"><span class="sansSerif">₹ </span><?php echo $rowCab["time"]*2; ?></div>
						<div class="price"><span class="sansSerif">₹ </span>250</div>
					</div>
					
					<?php $totalFare=($rowCab["distance"]*8.75)+($rowCab["time"]*2+250); ?>
					
					<?php elseif($carType=="SUV"): ?>
					
					<div class="col-sm-8">
						<div class="heading">Distance (<?php echo $rowCab["distance"]; ?>km @ <span class="sansSerif">₹ </span> 13.25/km) </div>
						<div class="heading">Time (<?php echo $rowCab["time"]; ?> min @ <span class="sansSerif">₹ </span> 3.75/min) </div>
						<div class="heading">Convenience Fee</div>	
					</div>
					
					<div class="col-sm-4">
						<div class="price"><span class="sansSerif">₹ </span><?php echo $rowCab["distance"]*13.25; ?></div>
						<div class="price"><span class="sansSerif">₹ </span><?php echo $rowCab["time"]*3.75; ?></div>
						<div class="price"><span class="sansSerif">₹ </span>250</div>
					</div>
					
					<?php $totalFare=($rowCab["distance"]*13.25)+($rowCab["time"]*3.75+250); ?>
					
					<?php endif; ?>
					
					<div class="col-sm-12">
							
							<div class="calcBar"></div>
							
					</div>
					
					<div class="col-sm-8">
						<div class="headingTotal">Total Payment</div>
					</div>
					
					<div class="col-sm-4">
						<div class="priceTotal"><span class="sansSerif">₹ </span><?php echo $totalFare; ?></div>
					</div>
					
					<form action="searchCabs.php" method="POST">
					
						<div class="bookingButton text-center">
							<input type="submit" class="confirmButton" value="Confirm and find driver">
						</div>
						
						<input type="hidden" name="fareHidden" value="<?php echo $totalFare; ?>">
						<input type="hidden" name="modeHidden" value="<?php echo "cabs" ?>">
						<?php $_SESSION["cabsFare"]=$totalFare; ?>
					
					</form>
					
					<div class="col-sm-12 fareNotif text-center">
						
						The total amount is approximate. The final amount will depend on the actual distance covered.
						
					</div>
					
				</div>
				
			</div> <!-- col-sm-5 Fare -->
			
				</div> <!-- fare container -->
				
			</div> <!-- hotel -->
			
			<!------------------------------------- BUSES ---------------------------------------->
			
			<?php elseif($mode=="bus"): ?>
			
			<div class="col-sm-12 bookingBus">
			
			<?php
				
				$busID = $_POST["busIDPass"];
				$date=$_POST["dateHidden"];
				$origin=$_POST["originHidden"];
				$destination=$_POST["destinationHidden"];
				$depart=$_POST["departHidden"];
				$return=$_POST["returnHidden"];
				$noOfPassengers= $_POST["passengersHidden"];
				
				$busFinderSQL = "SELECT * FROM `bus` WHERE busID='$busID'";
				$busFinderQuery = $conn->query($busFinderSQL);
				$row = $busFinderQuery->fetch_assoc();
				//$outboundFlightFare = $outboundFlightQuery->fetch_array(MYSQLI_NUM);
				
			?>
				
				<div class="col-sm-7"> <!-- departure container -->
				
				<div class="col-sm-12">
				
					<div class="boxLeftBus">
					
						<div class="col-sm-12 mode">Departure</div>
						
						<div class="col-sm-4">
						
						<div class="origin"><?php echo $origin; ?></div>
						<div class="departs">Departs <?php echo $row["originArea"]; ?> at: <?php echo $row["departure"]; ?></div>
						
						</div>
						
						<div class="col-sm-4">
							
							<div class="arrow"></div>
							
						</div>
						
						<div class="col-sm-4">
						
						<div class="destination"><?php echo $destination; ?></div>
						<div class="arrives">Arrives <?php echo $row["destinationArea"]; ?> at: <?php echo $row["arrival"]; ?></div>
						
						</div>
						
						<div class="col-sm-6 borderRight">
							<div class="operator"><?php echo $row["operator"]; ?></div>
							<div class="operatorSubscript">Operator</div>
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="class"><?php echo $date; ?></div>
							<div class="classSubscript">Date of journey</div>
						</div>
						
						<div class="col-sm-3">
							<div class="adults"><?php echo $noOfPassengers; ?></div>
							<div class="adultsSubscript">No. of passengers</div>
						</div>
					
					</div> <!-- boxLeft -->
				
				</div> <!-- col-sm-7 Departure -->
				
				</div>
				
				<div class="col-sm-5"> <!-- fare container -->
				
				<div class="col-sm-12">
				
					<div class="boxRightBus">
					
					<div class="col-sm-12 fareSummary">Fare Summary</div>
						
					<div class="col-sm-8">
						<div class="heading"><?php echo $noOfPassengers; ?> Passengers</div>
						<div class="heading">Convenience Fee</div>	
					</div>
					
					<div class="col-sm-4">
						<div class="price"><span class="sansSerif">₹ </span><?php echo $noOfPassengers*$row["fare"]; ?></div>
						<div class="price"><span class="sansSerif">₹ </span>250</div>
					</div>	
					
					<div class="col-sm-12">
							
							<div class="calcBar"></div>
							
					</div>
					
					<div class="col-sm-8">
						<div class="headingTotal">Total Fare</div>
					</div>
					
					<div class="col-sm-4">
						<div class="priceTotal"><span class="sansSerif">₹ </span><?php echo ($noOfPassengers*$row["fare"])+250; ?></div>
					</div>
					
					<form action="passengers.php" method="POST">
					
						<div class="bookingButton text-center">
							<input type="submit" class="confirmButton" value="Confirm Booking">
						</div>
						
						<?php $totalFare = ($noOfPassengers*$row["fare"])+250; ?>
						
						<input type="hidden" name="fareHidden" value="<?php echo $totalFare; ?>">
						<input type="hidden" name="typeHidden" value="<?php echo $type; ?>">
						<input type="hidden" name="originHidden" value="<?php echo $origin; ?>">
						<input type="hidden" name="destinationHidden" value="<?php echo $destination; ?>">
						<input type="hidden" name="departHidden" value="<?php echo $depart; ?>">
						<input type="hidden" name="returnHidden" value="<?php echo $return; ?>">
						<input type="hidden" name="noOfPassengersHidden" value="<?php echo $noOfPassengers; ?>">
						<input type="hidden" name="flightNoOutboundHidden" value="<?php echo $row["flight_no"]; ?>">
						<input type="hidden" name="modeHidden" value="<?php echo "bus"; ?>">
						<input type="hidden" name="busIDHidden" value="<?php echo $busID; ?>">
						<input type="hidden" name="dateHidden" value="<?php echo $date; ?>">
						<input type="hidden" name="classHidden" value="null">
						<input type="hidden" name="adultsHidden" value="0">
						<input type="hidden" name="childrenHidden" value="0">
					
					</form>
					
				</div>
				
			</div> <!-- col-sm-5 Fare -->
			
				</div> <!-- fare container -->
				
			</div> <!-- bus -->
			
			<?php elseif($mode=="train"): ?>
			
			<div class="col-sm-12 bookingTrain">
			
			<?php
				
				$trainID = $_POST["trainIdPass"];
				$date=$_POST["dateHidden"];
				$day=$_POST["dayHidden"];
				$origin=$_POST["originHidden"];
				$destination=$_POST["destinationHidden"];
				$class=$_POST["classHidden"];
				$noOfPassengers= $_POST["passengersHidden"];
				$priceClass = trim('price'.$class);
				
				$trainFinderSQL = "SELECT * FROM `trains` WHERE trainNo='$trainID'";
				$trainFinderQuery = $conn->query($trainFinderSQL);
				$row = $trainFinderQuery->fetch_assoc();
				//$outboundFlightFare = $outboundFlightQuery->fetch_array(MYSQLI_NUM);
				
			?>
				
				<div class="col-sm-7"> <!-- departure container -->
				
				<div class="col-sm-12">
				
					<div class="boxLeftBus">
					
						<div class="col-sm-12 mode">Departure</div>
						
						<div class="col-sm-4">
						
						<div class="origin"><?php echo $origin; ?></div>
						<div class="departs">Departs at: <?php echo $row["originTime"]; ?></div>
						
						</div>
						
						<div class="col-sm-4">
							
							<div class="arrow"></div>
							
						</div>
						
						<div class="col-sm-4">
						
						<div class="destination"><?php echo $destination; ?></div>
						<div class="arrives">Arrives at: <?php echo $row["destinationTime"]; ?></div>
						
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="class"><?php echo $date; ?></div>
							<div class="classSubscript">Date of journey</div>
						</div>
						
						<div class="col-sm-5 borderRight">
							<div class="operator"><?php echo $row["trainName"]; ?></div>
							<div class="operatorSubscript">Name of the train</div>
						</div>
						
						<div class="col-sm-2 borderRight">
							<div class="operator"><?php echo $class; ?></div>
							<div class="operatorSubscript">Class</div>
						</div>
						
						<div class="col-sm-2">
							<div class="adults"><?php echo $noOfPassengers; ?></div>
							<div class="adultsSubscript">Passengers</div>
						</div>
					
					</div> <!-- boxLeft -->
				
				</div> <!-- col-sm-7 Departure -->
				
				</div>
				
				<div class="col-sm-5"> <!-- fare container -->
				
				<div class="col-sm-12">
				
					<div class="boxRightBus">
					
					<div class="col-sm-12 fareSummary">Fare Summary</div>
						
					<div class="col-sm-8">
						<div class="heading"><?php echo $noOfPassengers; ?> Passengers</div>
						<div class="heading">Convenience Fee</div>	
					</div>
					
					<div class="col-sm-4">
						<div class="price"><span class="sansSerif">₹ </span><?php echo $noOfPassengers*$row[$priceClass]; ?></div>
						<div class="price"><span class="sansSerif">₹ </span>250</div>
					</div>	
					
					<div class="col-sm-12">
							
							<div class="calcBar"></div>
							
					</div>
					
					<div class="col-sm-8">
						<div class="headingTotal">Total Fare</div>
					</div>
					
					<div class="col-sm-4">
						<div class="priceTotal"><span class="sansSerif">₹ </span><?php echo ($noOfPassengers*$row[$priceClass])+250; ?></div>
					</div>
					
					<form action="passengers.php" method="POST">
					
						<div class="bookingButton text-center">
							<input type="submit" class="confirmButton" value="Confirm Booking">
						</div>
						
						<?php $totalFare = ($noOfPassengers*$row[$priceClass])+250; ?>
						
						<input type="hidden" name="fareHidden" value="<?php echo $totalFare; ?>">
						<input type="hidden" name="dateHidden" value="<?php echo $date; ?>">
						<input type="hidden" name="dayHidden" value="<?php echo $day; ?>">
						<input type="hidden" name="originHidden" value="<?php echo $origin; ?>">
						<input type="hidden" name="destinationHidden" value="<?php echo $destination; ?>">
						<input type="hidden" name="classHidden" value="<?php echo $class; ?>">
						<input type="hidden" name="noOfPassengersHidden" value="<?php echo $noOfPassengers; ?>">
						<input type="hidden" name="modeHidden" value="<?php echo "train"; ?>">
						<input type="hidden" name="trainIDHidden" value="<?php echo $trainID; ?>">
					
					</form>
					
				</div>
				
			</div> <!-- col-sm-5 Fare -->
			
				</div> <!-- fare container -->
				
			</div> <!-- train -->
			
			<?php endif; ?>
			
		</div> <!--bookingWrapper -->
		
	<div class="spacerLarge">.</div> <!-- just a dummy class for creating some space -->
    
    <!--- /rooms ---->
		
<!--- /footer-top ---->
<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>			
<!-- //write us -->
				
	</body>
	
	<!-- BODY TAG ENDS -->
	
</html>