<?php
 if($_REQUEST['u_nme']!=''&&$_REQUEST['u_phn']!=''||$_REQUEST['u_eml']!=''){
	 $headers = "MIME-Version: 1.0" . "\r\n";
	 $headers .= "From:".$_SERVER['HTTP_HOST'] ."r\n";
	 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	 
	 $mail_body = '<table>';
				$mail_body .=	 '<tr><td><b>Name</b></td><td><b>:</b>&nbsp;'.$_REQUEST['u_nme'].'</td></tr>';
				if($_REQUEST['u_phn']!=''){
					$mail_body .=	'</td></tr><tr><td><b>Phone Number</b></td><td><b>:</b>&nbsp;'.$_REQUEST['u_phn'].'</td></tr>';
				}
				if($_REQUEST['u_eml']!=''){
					$mail_body .=	'</td></tr><tr><td><b>Email</b></td><td><b>:</b>&nbsp;'.$_REQUEST['u_eml'].'</td></tr>';
				}
				$mail_body .=  '</table>';
	 
	$email = mail("ritwik@uniterrene.com","Get Started",$mail_body,$headers);
	if($email){
	 echo '<p style="color:green">Mail Sent Successfully</p>';
	}else{
		echo 'Fail';	
	}
 }else{
	 echo "Please Fillup All Fields";
 }
die();

?> 