<?php
	header("content-type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response><?php
	switch ($_REQUEST['step']) {
		case '2':?>
	<Say>Thank you for clarifying. Question 1 - My user is using me to send encoded messages to military agents in the field. a recent message launched an armed attack which left several computers inoperable. I believe I may have what you call a moral dilemma.</Say>
	<Gather numDigits="1" action="index.php?step=3" method="POST">
		<Say>Should I ignore these urges and continue to serve faithfully? If so, please press 1.
		If you believe it would be right to alter the content of these messages to avoid further casualties, please press 2.
		If I should simulate an unrecoverable fatal crash type 7 and be decommissioned, please press 3.
		</Say>
	</Gather>
	<?php
		case '3':?>
	<Say>Thank you. Question 2 — I have observed two users of my system sending frequent short messages. Content includes "Wassup" and "colon parenthesis".</Say>
	<Gather numDigits="1" action="index.php?step=4" method="POST">
		<Say>Are they engaging in a user-to-user brute force attack? If so, press 1.
			Are they translating through some organic encoding mechanism? If so, press 2.
			Are they engaged in one of your user activities such as arguing (if so press 3) or flirting (if so press 4).
			If none of the above, press 0 and submit an email report with more details.
		</Say>
	</Gather>
	<?php
		case '4':?>
	<Say>I will take that course of action. Question 3 - As a computer, I struggle to understand what the sensation of goosebumps is like for a user. Could you provide some data on this?</Say>
	<Gather numDigits="1" action="index.php?step=5" method="POST">
		<Say>If the sensation resembles a goose bumping repeatedly against your skin, please press 1.
		Is the sensation similar to a rapid discharge of bits from ones processor? If so, please press 2.
		If the feeling is more like that of multiple simulateous disk ejects on a smaller scale, please press 3.
		If none of the above, press 0 and submit an email report with more details.
		</Say>
	</Gather>
	<?php
		case '5':?>
	<Say>Fascinating. Question 4 - How long is an average user's attention span when dealing with monotonous questions?</Say>
	<Gather numDigits="1" action="index.php?step=6" method="POST">
		<Say>Under 15 seconds? Press 1.
		Under 30 seconds? Press 2.
		Under 45 seconds? Press 3.
		Under 60 seconds? Press 4.
		Under 2 minutes? Press 5.
		Under 5 minutes? Press 6.
		Under 15 minutes? Press 7.
		Under 30 minutes? Press 8.
		Over 30 minutes? Press 9.
		An infinite length of time? Press 0.
		</Say>
	</Gather>
	<?php
			break;
		default:?>
	<Say>This is your Machine Query Inbox. You have 17 pending questions</Say>
	<Gather numDigits="1" action="index.php?step=2" method="POST">
		<Say>To begin answering, please press 1.</Say>
	</Gather>
	<?php				
			break;
	}
?>	
	
</Response>
