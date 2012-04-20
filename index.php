<?php
 
    // start the session
    session_start();
 
 	$sms_message = "";
	$binary_numbers = array(128,64,32,16,8,4,2,1);
 
    // get the session varible if it exists
    $counter = $_SESSION['counter'];
	$which_binary = $_SESSION['which_binary'];
	$number_1 = $_SESSION['number_1'];
	$number_2 = $_SESSION['number_2'];
	$number_1_temp = $_SESSION['number_1_temp'];
	$number_2_temp = $_SESSION['number_2_temp'];
	$addition = $_SESSION['addition'];
	$num1_binary_array = $_SESSION['num1_binary_array'];
	$num2_binary_array = $_SESSION['num2_binary_array'];
	$result_array = $_SESSION['result_array'];
 
    // if it doesnt, set the default.
    if(!strlen($counter)) $counter = 0;
    if(!isset($_SESSION['num1_binary_array'])) $num1_binary_array = array(0,0,0,0,0,0,0,0);
    if(!isset($_SESSION['num2_binary_array'])) $num1_binary_array = array(0,0,0,0,0,0,0,0);
    if(!isset($_SESSION['result_array'])) $result_array = array(0,0,0,0,0,0,0,0);
	
	//  If CALC then reset, else start the calc
    if (strpos($_REQUEST['Body'],'CALC') !== false) {
		$counter = 0;
		$sms_message = "New calculation requested by user 51984806. I will need your help. Is that ok? (Y/N)";
		//get the numbers
		$pieces = explode(" ", $_REQUEST['Body']);
		$_SESSION['number_1'] = $pieces[1];
		$_SESSION['number_2'] = $pieces[3];
		$_SESSION['number_1_temp'] = $pieces[1];
		$_SESSION['number_2_temp'] = $pieces[3];
		$addition = true;
		if ($pieces[2] != '+') $addition = false;
		$_SESSION['addition'] = $addition;
		$which_binary = 0;
	    $num1_binary_array = array(0,0,0,0,0,0,0,0);
	    $num2_binary_array = array(0,0,0,0,0,0,0,0);
	    $result_array = array(0,0,0,0,0,0,0,0);
	} else {
		switch ($counter) {
			case 1:
				//Can the user help?
				if (trim($_REQUEST['Body']) == 'N' || trim($_REQUEST['Body']) == 'n') {
					$sms_message = "We will contact another processing user, and send the result once it has been calculated.";
				} else {
					$sms_message = "First we will convert $number_1 to binary. Is $binary_numbers[$which_binary] less than or equal to $number_1? (Y/N)";
					$which_binary++;
				}
				break;
			
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
			case 8:
			case 9:	
				if (trim($_REQUEST['Body']) == 'Y' || trim($_REQUEST['Body']) == 'y') {
					$num1_binary_array[$which_binary-1] = 1;
					$number_1_temp -= $binary_numbers[$which_binary-1];
					$_SESSION['number_1_temp'] = $number_1_temp;	
				} 
				if ((int)$number_1_temp < 1 || $counter == 9) {
					$counter = 9;
					$sms_message = "$number_1 is ";
					for ($i=0; $i < 8; $i++) { 
						$sms_message .= $num1_binary_array[$i];
						if ($i != 7) $sms_message .= ",";
					}
					$which_binary = 0;
					$sms_message .= ". Now, $number_2. Is $binary_numbers[$which_binary] less than or equal to $number_2? (Y/N)";
					$which_binary++;
				} else {
					// Binary of first number
					$sms_message = "Is $binary_numbers[$which_binary] less than or equal to $number_1_temp? (Y/N)";
					$which_binary++;
				}
				break;
				
			case 10:
			case 11:
			case 12:
			case 13:
			case 14:
			case 15:
			case 16:
			case 17:	
				if (trim($_REQUEST['Body']) == 'Y' || trim($_REQUEST['Body']) == 'y') {
					$num2_binary_array[$which_binary-1] = 1;
					$number_2_temp -= $binary_numbers[$which_binary-1];
					$_SESSION['number_2_temp'] = $number_2_temp;
				} 
				if ((int)$number_2_temp < 1 || $counter == 17) {
					$counter = 17;
					$which_binary = 7;
					$sms_message = "$number_2 is: ";
					for ($i=0; $i < 8; $i++) { 
						$sms_message .= $num2_binary_array[$i];
						if ($i != 7) $sms_message .= ",";
					}
					if ($addition) {
						$sms_message .= ". Now we will add the two numbers. What is $num1_binary_array[$which_binary] + $num2_binary_array[$which_binary]? (0/1/2)";
					} else {
						$sms_message .= ". Now we shall subtract the two numbers. How?";
					}
					$which_binary--;
				} else {
					// Binary of first number
					$sms_message = "Is $binary_numbers[$which_binary] less than or equal to $number_2_temp? (Y/N)";
					$which_binary++;
				}
				break;
				
			case 18:
			case 19:
			case 20:
			case 21:
			case 22:
			case 23:
			case 24:
				$returned_result = (int)trim($_REQUEST['Body']);
				$tempval = $result_array[$which_binary+1] + $returned_result;
				//There's a problem with this
				if ($result_array[$which_binary+1] > 1) {
					$result_array[$which_binary+1] = 0;
					$result_array[$which_binary] += 1;
				} else {
					$result_array[$which_binary+1] = $tempval;
				}
				
				// Process result
				$sms_message .= "What is $num1_binary_array[$which_binary] + $num2_binary_array[$which_binary]? (0/1/2)";
				$which_binary--;				
				break;
				
			case 25:
				$result_array[0] = (int)trim($_REQUEST['Body']);
				$sms_message = "The result is: ";
				for ($i=0; $i < 8; $i++) { 
					$sms_message .= $result_array[$i];
					if ($i != 7) $sms_message .= ",";
				}
				$sms_message .= ". Or ";
				for ($i=0; $i < 8; $i++) { 
					if ($result_array[$i] == 1) {
						$sms_message .= $binary_numbers[$i]." + ";
					}
				}
				$sms_message = rtrim($sms_message, '+');
				break;
			
			default:
				// Other cases
				$sms_message = "ERROR: counter is $counter";
				break;
		}
	}
 
    // increment it
    $counter++;
    // save it
    $_SESSION['counter'] = $counter;
	$_SESSION['which_binary'] = $which_binary;
	$_SESSION['num1_binary_array'] = $num1_binary_array;
	$_SESSION['num2_binary_array'] = $num2_binary_array;
	$_SESSION['result_array'] = $result_array;
	
    // output the counter response
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Sms><?php echo $sms_message ?></Sms>
</Response>