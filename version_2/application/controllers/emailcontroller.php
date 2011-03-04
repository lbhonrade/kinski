<?php
class EmailController extends CI_Controller {
	function initializeMailer(){
		$this->load->library("phpmailer");
		
		$mail = new PHPMailer();  // Instantiate your new class
		$mail->IsSMTP();          // set mailer to use SMTP
		$mail->SMTPAuth = true;   // turn on SMTP authentication
		$mail->Host = "smtp.gmail.com"; // specify main and backup server
		$mail->SMTPSecure= 'ssl'; //  Used instead of TLS when only POP mail is selected
		$mail->Port = 465;        //  Used instead of 587 when only POP mail is selected

		$mail->Username = "cas.transactions@gmail.com";  // SMTP username, you could use your google apps address too.
		$mail->Password = "kinski2011"; // SMTP password

		$mail->From = "cas.transactions@gmail.com"; //Aparently must be the same as the UserName
		$mail->FromName = "CAS-OCS Administrator";
		return $mail;
	}
	function sendLoginInfo(){
		$this->load->model('UserUtil');
		$this->load->helper('url');
		$user=$this->UserUtil->getEmailPassword($_POST["stdNo"]);
		if($user==null){
			echo "Student number not in database.";
			exit;
		}
		$mail=$this->initializeMailer();
		
		$mail->Subject = 'Window Transactions User Password Reset';
		$mail->Body = "Click on the link below to change your password.\n".base_url()."index.php/UserController/resetPassword/".$_POST["stdNo"]."/".$user[1]."\n\n";

		$mail->AddAddress($user[0],$_POST["stdNo"]);//Recipients
		
		if(!$mail->Send()){
			echo "There was an error sending the message:\n" . $mail->ErrorInfo;
			exit;
		}
		echo "Done Sending. Please check the email that you registered in CAS-OCS.\n";
	}
}
?>