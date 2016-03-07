<?php 
	
	//this is all the php for the contact form

	if (isset($_POST["submit"])) {
		$name = strip_tags($_POST['name']);
		$phone = strip_tags($_POST['phone']);
		$email = strip_tags($_POST['email']);
		$artist = $_POST['artist'];
		$client = $_POST['client'];
		$distance = $_POST['distance'];
		$placement = strip_tags($_POST['placement']);
		$skin = strip_tags($_POST['skin']);
		$message = strip_tags($_POST['message']);
		$location = strip_tags($_POST['location']);
		$from = 'booking@equinoxtattoo.com'; 
		$to = 'booking@equinoxtattoo.com'; // Enter email address to send emails TO here 
		$subject = 'Consultation Request For ' . $artist; //What goes in the subject line of your email here		

		$body = "<html><body>";
		$body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$body .= "<tr><td><strong>From:</strong> </td><td>$name</td></tr>";
		$body .= "<tr><td><strong>Phone Number:</strong> </td><td>$phone</td></tr>";
		$body .= "<tr><td><strong>E-Mail:</strong> </td><td>$email</td></tr>";
		$body .= "<tr><td><strong>Preferred artist:</strong> </td><td>$artist</td></tr>";
		$body .= "<tr><td><strong>Previous client:</strong> </td><td>$client</td></tr>";
		$body .= "<tr><td><strong>Distance from shop:</strong> </td><td>$distance</td></tr>";
		$body .= "<tr><td><strong>Tattoo placement:</strong> </td><td>$placement</td></tr>";
		$body .= "<tr><td><strong>Skin tone:</strong> </td><td>$skin</td></tr>";
		$body .= "<tr><td><strong>Guest spot or convention:</strong> </td><td>$location</td></tr>";
		$body .= "<tr><td><strong>Tattoo idea:</strong> </td><td>$message</td></tr>";
		$body .= "</table></html></body>";

		$hdrs = "MIME-Version: 1.0" . "\r\n";
		$hdrs .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$hdrs .= "From: " . $from . "\r\n";

		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}

		//Check if placement has been entered
		if (!$_POST['placement']) {
			$errPlacement = 'Please enter the placement of your tattoo idea';
		}

		//Check if skin tone has been entered
		if (!$_POST['skin']) {
			$errSkin = 'Please choose your skin tone';
		}
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'Please describe your tattoo idea';
		}

// If there are no errors, send the email
if (!$errName && !$errEmail && !$errPlacement && !$errSkin && !$errMessage ) {
	if (mail ($to, $subject, $body, $hdrs)) {
		$result='<div class="alert alert-success" role="alert">Thank You! We will be in touch.</div>';
	} else {
		$result='<div class="alert alert-danger" role="alert">Sorry there was an error sending your request. Please try again.</div>';
	}
} else {
		$result='<div class="alert alert-danger" role="alert">Sorry there was an error sending your request. Please try again.</div>';
}

}	
?>