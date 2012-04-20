<?php
	header("content-type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response><?php
	switch ($_REQUEST['step']) {
		case '2':?>
	<Say>We are happy to help with your Mental problem. Please help us by providing some further information:</Say>
	<Gather numDigits="1" action="index.php?step=3" method="POST">
		<Say>If you are experiencing pains in your head, please press 1.
		If you are under stress or experiencing tension, please press 2.
		Hearing voices? please press 3.
		Seeing unexplained phenomenon or deceased friends or relatives, please press 4.
		If you believe you are a Messianic figure, please press 5 quickly.
		For magical powers and other delusions, summon 6.
		For all other Mental quandries, problems and questions, please press 0.
		</Say>
	</Gather>
	<?php
		case '3':?>
	<Say>We understand you are hearing voices:</Say>
	<Gather numDigits="1" action="index.php?step=3" method="POST">
		<Say>Are these voices telling you to hurt yourself or others? If so, please press 1.
		If these voices are encouraging you to buy particular products or subscribe to specific services, please press 2.
		If these voices are followed by phone menu options, with a choice of number to press in response, press 3.
		Are you hearing the voice of your favorite Disney character? Press 4.
		If the voices are indecipherable or from another source, please press 0.
		</Say>
	</Gather>
	<?php
			break;
		default:?>
	<Say>Welcome to Encylo-Therapy Computer-aided assistance services. Please listen carefully to the following options.</Say>
	<Gather numDigits="1" action="index.php?step=2" method="POST">
		<Say>If you are experiencing a Mental problem, please press 1.
		If you are experiencing a Physical problem, please press 2.
		For Intellectual problems, please press 3.
		For Technical problems, please press 4.
		For Relational problems, please press 5.
		For Metaphysical problems, please press 6.
		For all other problems or to be spoken to by an operator, please press 0.
		</Say>
	</Gather>
	<?php				
			break;
	}
?>	
	
</Response>
