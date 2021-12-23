<?php 
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
$mail=mail("dhavaljani1990@gmail.com","My subject",$msg);
if(!$mail){
	echo "There is some problem dear";
}