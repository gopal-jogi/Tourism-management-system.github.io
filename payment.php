<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>


<!DOCTYPE HTML>
<html>
<!-- HEAD TAG STARTS -->
<head>
<title>TMS |Payment</title>
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
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TMS -Payment</h1>
	</div>
</div>
  <!--- /slider ---->
		
		<?php include("common/headerLoggedIn.php"); ?>
		
		<?php
		
			$mode=$_POST["modeHidden"];
		
			if($mode=="ReturnTripFlight" or $mode=="OneWayFlight") {
		
				$totalPassengers=$_POST["totalPassengersHidden"];
			
				for($i=1; $i<=$totalPassengers; $i++) {
					$name[$i]=$_POST["name$i"];
					$gender[$i]=$_POST["gender$i"];
				}
			
				$fare=$_POST["fareHidden"];
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
			
			} // for flights
		
			elseif($mode=="hotel") {
				$fare=$_POST["fareHidden"];
				$hotelID=$_POST["hotelIDHidden"];
			} //for hotels
		
			elseif($mode=="cabs") {
				$fare=$_SESSION["cabsFare"];
				$carID=$_SESSION["carID"];
			} //for hotels
		
			elseif($mode=="bus") {
				$totalPassengers=$_POST["totalPassengersHidden"];
				$fare=$_POST["fareHidden"];
				$busID=$_POST["busIDHidden"];
				$origin=$_POST["originHidden"];
				$destination=$_POST["destinationHidden"];
				
				for($i=1; $i<=$totalPassengers; $i++) {
					$name[$i]=$_POST["name$i"];
					$gender[$i]=$_POST["gender$i"];
				}
			} //for bus
		
			elseif($mode=="train") {
				$totalPassengers=$_POST["totalPassengersHidden"];
				$fare=$_POST["fareHidden"];
				$trainID=$_POST["trainIDHidden"];
				$origin=$_POST["originHidden"];
				$destination=$_POST["destinationHidden"];
				$date=$_POST["dateHidden"];
				$day=$_POST["dayHidden"];
				$class=$_POST["classHidden"];
				
				for($i=1; $i<=$totalPassengers; $i++) {
					$name[$i]=$_POST["name$i"];
					$gender[$i]=$_POST["gender$i"];
				}
			} //for train
		
		?>
		
		<div class="spacer">a</div>
		
		<div class="col-sm-12 paymentWrapper">
			
			<div class="headingOne">
				
				Payment
				
			</div>
			
			<div class="totalAmount">
				
				Amount to be paid: <span class="sansSerif">₹</span> <?php echo $fare; ?>
				
			</div>
			
			<!--<div class="col-sm-3"></div>-->
				
				
			<div class="col-sm-3"></div>
			
			<div class="col-sm-6">
				
				<div class="boxCenter">
				
				<div class="col-sm-12 tag">
					
					Card Number:
					
				</div>
				
				<div class="col-sm-12">
					
					<input type="text" class="input" name="cardNumber" placeholder="Enter the card number" id="cardNumber"/>
					
				</div>
				
				<div class="col-sm-12 tag">
					
					Name on Card:
					
				</div>
				
				<div class="col-sm-12">
					
					<input type="text" class="input" name="nameOnCard" placeholder="Enter the name of the card holder" id="nameOnCard"/>
					
				</div>
				
				<div class="col-sm-6 tag">
					
					CVV:
					
				</div>
				
				<div class="col-sm-6 tag">
					
					Expiry:
					
				</div>
				
				<div class="col-sm-6">
					
					<input type="password" class="inputSmall" name="cvv" placeholder="CVV" id="cvv"/>
					
				</div>
				
				<div class="col-sm-6">
					
					<input type="text" class="inputSmall" name="expiry" placeholder="MM/YY" id="cardExpiry"/>
					
				</div>
				
				<!-- flights -->
				
				<?php if($mode=="ReturnTripFlight" or $mode=="OneWayFlight"): ?>
				
				<form action="generateTicket.php" method="POST">
				
					<div class="col-sm-12 bookingButton text-center">
						<input type="submit" class="paymentButton" value="Pay Now">
					</div>
					
					<input type="hidden" name="totalPassengersHidden" value="<?php echo $totalPassengers; ?>">
						
					<input type="hidden" name="fareHidden" value="<?php echo $fare; ?>">
					<input type="hidden" name="typeHidden" value="<?php echo $type; ?>">
					<input type="hidden" name="classHidden" value="<?php echo $class; ?>">
					<input type="hidden" name="originHidden" value="<?php echo $origin; ?>">
					<input type="hidden" name="destinationHidden" value="<?php echo $destination; ?>">
					<input type="hidden" name="departHidden" value="<?php echo $depart; ?>">
					<input type="hidden" name="returnHidden" value="<?php echo $return; ?>">
					<input type="hidden" name="adultsHidden" value="<?php echo $adults; ?>">
					<input type="hidden" name="childrenHidden" value="<?php echo $children; ?>">
					<input type="hidden" name="modeHidden" value="<?php echo $mode ?>">
					
					<?php for($i=1; $i<=$totalPassengers; $i++) {?>
					
						<input type="hidden" name="nameHidden<?php echo $i; ?>" value="<?php echo $name[$i]; ?>">
						<input type="hidden" name="genderHidden<?php echo $i; ?>" value="<?php echo $gender[$i]; ?>">
					
					<?php } ?>
					
					<?php if($type=="Return Trip") { ?>
					<input type="hidden" name="flightNoOutboundHidden" value="<?php echo $flightNoOutbound; ?>">
					<input type="hidden" name="flightNoInboundHidden" value="<?php echo $flightNoInbound; ?>">
					<?php } elseif($type=="One Way") { ?>
					<input type="hidden" name="flightNoOutboundHidden" value="<?php echo $flightNoOutbound; ?>">
					<?php } ?>
					
				</form>
				
				<!-- hotels -->
				
				<?php elseif($mode=="hotel"): ?>
				
				<form action="generateReceipt.php" method="POST">
				
					<div class="col-sm-12 bookingButton text-center">
						<input type="submit" class="paymentButton" value="Pay Now">
					</div>
					
					<input type="hidden" name="hotelIDHidden" value="<?php echo $hotelID; ?>">
					<input type="hidden" name="fareHidden" value="<?php echo $fare; ?>">
					
				</form>
				
				<?php elseif($mode=="cabs"): ?>
				
				<form action="generateRiderReceipt.php" method="POST">
				
					<div class="col-sm-12 bookingButton text-center">
						<input type="submit" class="paymentButton" value="Pay Now">
					</div>
					
				</form>
				
				<?php elseif($mode=="bus"): ?>
				
				<form action="generateBusTicket.php" method="POST">
				
					<div class="col-sm-12 bookingButton text-center">
						
						<?php $date=$_POST["dateHidden"]; ?>
					
						<input type="hidden" name="dateHidden" value="<?php echo $date; ?>">
						<input type="submit" class="paymentButton" value="Pay Now">
					</div>
					
					<input type="hidden" name="totalPassengersHidden" value="<?php echo $totalPassengers; ?>">
					<input type="hidden" name="fareHidden" value="<?php echo $fare; ?>">
					<input type="hidden" name="originHidden" value="<?php echo $origin; ?>">
					<input type="hidden" name="destinationHidden" value="<?php echo $destination; ?>">
					<input type="hidden" name="departHidden" value="<?php echo $depart; ?>">
					<input type="hidden" name="returnHidden" value="<?php echo $return; ?>">
					<input type="hidden" name="modeHidden" value="<?php echo $mode ?>">
					
					<?php for($i=1; $i<=$totalPassengers; $i++) {?>
					
						<input type="hidden" name="nameHidden<?php echo $i; ?>" value="<?php echo $name[$i]; ?>">
						<input type="hidden" name="genderHidden<?php echo $i; ?>" value="<?php echo $gender[$i]; ?>">
					
					<?php } ?>
					
					<input type="hidden" name="busIDHidden" value="<?php echo $busID; ?>">
					
				</form>
				
				<?php elseif($mode=="train"): ?>
				
				<form action="generateTrainTicket.php" method="POST">
				
					<div class="col-sm-12 bookingButton text-center">
						
						<?php $date=$_POST["dateHidden"]; ?>
					
						<input type="hidden" name="dateHidden" value="<?php echo $date; ?>">
						<input type="hidden" name="dayHidden" value="<?php echo $day; ?>">
						<input type="hidden" name="classHidden" value="<?php echo $class; ?>">
						<input type="submit" class="paymentButton" value="Pay Now">
					</div>
					
					<input type="hidden" name="totalPassengersHidden" value="<?php echo $totalPassengers; ?>">
					<input type="hidden" name="fareHidden" value="<?php echo $fare; ?>">
					<input type="hidden" name="originHidden" value="<?php echo $origin; ?>">
					<input type="hidden" name="destinationHidden" value="<?php echo $destination; ?>">
					<input type="hidden" name="modeHidden" value="<?php echo $mode ?>">
					
					<?php for($i=1; $i<=$totalPassengers; $i++) {?>
					
						<input type="hidden" name="nameHidden<?php echo $i; ?>" value="<?php echo $name[$i]; ?>">
						<input type="hidden" name="genderHidden<?php echo $i; ?>" value="<?php echo $gender[$i]; ?>">
					
					<?php } ?>
					
					<input type="hidden" name="trainIDHidden" value="<?php echo $trainID; ?>">
					
				</form>
				
				<?php endif; ?>
				
				
				</div>
				
			</div>
			
			<div class="col-sm-3"></div>
			
		</div> <!-- paymentWrapper -->
	
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