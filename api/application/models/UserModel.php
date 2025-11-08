<?php
//header('Access-Control-Allow-Origin: *');
Class UserModel extends CI_model
{
    public function get_user_data()
    {
        $this->load->database();
        $param=$this->input->get();
        $this->db->where("id", $param['id']);
        $q=$this->db->get('user');
        $data=$q->result_array();
        echo json_encode($data);
    }
    public function login()
    {
        $this->load->database();
        $param=$this->input->get();
        $array = array("email" => $param['email'], "password" => $param["password"]);
        $this->db->where($array);
        $q=$this->db->get('user');
      	//echo $this->db->last_query();
        $data=$q->result_array();
        $datas=[];
        if (count($data) > 0) 
        {
            $datas['success']=true;
            $datas['data']=$data;
            echo json_encode($datas);
        }
        else
        {            
            $datas['success']=false;
            $datas['data']="Username or password is invalid";
            echo json_encode($datas);
        }
    }    
    public function addUser()
    {
        $this->load->database();
        $param = $this->input->get();
        $param['datetime'] = date('Y-m-d H:i');    
        if ($param['id'] == '') {
            $q=$this->db->insert('user',$param);     
            $data=array("success"=>true,"message"=>"User registered successfully","id"=>$this->db->insert_id());   
            echo json_encode($data);
        }
        else{
            $array = array("id" => $param['id']);
            $this->db->where($array);
            $q = $this->db->get('user');
            $data = $q->result_array();
            if (count($data) > 0) {
                $array = array('id' => $param['id']);
                $this->db->where($array);
                $q = $this->db->update('user', $param);
                $data = array("success" => true, "message" => "Data updated successfully");
                echo json_encode($data);
            } else {
                $data = array("success" => false, "message" => "User does not exist");
                echo json_encode($data);
            }
        }
    }
    public function addSocialUser()
    {
        $this->load->database();
        $param = $this->input->get();
        $array = array("email" => $param['email']);
        $this->db->where($array);
        $q=$this->db->get('user');
        $data=$q->result_array();
        if (count($data) > 0) 
        {
            $array = array('email' => $param['email']);
            $this->db->where($array);
            $q = $this->db->update('user', $param);
            if($data[0]['password']=='' || $data[0]['name']=='')
            {
                $data = array(array("success" => false, "message" => "set_user", "id" => $data[0]['id']));    
                echo json_encode($data);            
            } else {
              	$data=array(array("success"=>true,"message"=>"done","id"=>$data[0]['id'],"email"=>$data[0]['email']));   
                echo json_encode($data);
            }
        }
        else
        {
            $q=$this->db->insert('user',$param);     
            $data=array(array("success"=>true,"message"=>"User registered successfully","id"=>$this->db->insert_id()));   
            echo json_encode($data);
        }
    }

    public function checkUsername()
    {
        $this->load->database();
        $param = $this->input->post();
        if ($param['id'] != '') {
            $array = array("username" => $param['username'], "id NOT LIKE " => $param['id']);
        } else {
            $array = array("username" => $param['username']);
        }
        $this->db->where($array);
        $q = $this->db->get('user');
        $data = $q->result_array();
        if (count($data) > 0) 
        {
            $data = array(array("success" => false, "message" => "Username already exist"));
            echo json_encode($data);
        } else {
            $data = array(array("success" => true));
            echo json_encode($data);
        }
    
    }    
    public function checkEmail()
    {
        $this->load->database();
        $param = $this->input->get();
        if ($param['id'] != '') {
            $array = array("email" => $param['email'], "id NOT LIKE " => $param['id']);
        } else {
            $array = array("email" => $param['email']);
        }
      
        $this->db->where($array);
        $q = $this->db->get('user');
      //echo $this->db->last_query();
        $data = $q->result_array();
        if (count($data) > 0) 
        {
            $data = array(array("success" => false, "message" => "Email already exist"));
            echo json_encode($data);
        } else {
            $data = array(array("success" => true));
            echo json_encode($data);
        }
    
    }    
  	public function checkForgotEmail()
    {
        $this->load->database();
        $param = $this->input->get();
        $array = array("email" => $param['email']);
        $this->db->where($array);
        $q = $this->db->get('user');
        $data = $q->result_array();
        if (count($data) <=0) 
        {
            $data = array(array("success" => false, "message" => "Email not exist"));
            echo json_encode($data);
        } 
        else 
        {          
            $otp=rand(0,9999);

          	$this->db->where($array);
          	$q = $this->db->update('user', array('otp'=>$otp));
            $email_template="<tr bgcolor='#fcfcfc'>
              <td colspan='2' style='padding:0px;text-align:left;'>
                  <div  style='padding:30px 00px; float:left;width:100%'>
                      <div style='float: left;padding-bottom:0px;width:100%'>
                          <span style='font-size:14px;float:left;width:100%;padding-top:10px;text-align:center'>
                              You requested to reset your password for your account.<br><br>
                              Your one time PIN is: <b>".$otp."</b>, and is valid for 30 minutes.
                          </span>
                      </div>
                  </div>
              </td>
          </tr>
          ";
            echo $this->email_alert($param['email'], "Reset your Password", $email_template);
            $data = array(array("success" => true));
          
            echo json_encode($data);
        }    
    }    
    public function send_email()
    {
        $email_template="<tr bgcolor='#fcfcfc'>
              <td colspan='2' style='padding:0px;text-align:left;'>
                  <div  style='padding:30px 00px; float:left;width:100%'>
                      <div style='float: left;padding-bottom:0px;width:100%'>
                          <span style='font-size:14px;float:left;width:100%;padding-top:10px;text-align:center'>
                              You requested to reset your password for your account.<br><br>
                              Your one time PIN is: <b>123</b>, and is valid for 30 minutes.
                          </span>
                      </div>
                  </div>
              </td>
          </tr>
          ";
        echo $this->email_alert("swapnil91991@gmail.com", "Reset your Password", $email_template);
            
    }
    public function verify_OTP()
    {
        $this->load->database();
        $param = $this->input->get();
        $array = array("email" => $param['email'],"otp"=>$param['otp']);
        $this->db->where($array);
        $q = $this->db->get('user');
        $data = $q->result_array();
        if (count($data) <=0) 
        {
            $data = array(array("success" => false, "message" => "OTP is invalid"));
            echo json_encode($data);
        } 
        else 
        {          
            $data = array(array("success" => true));          
            echo json_encode($data);
        }    
    }   
    public function changePassword()
    {
        $this->load->database();
        $param = $this->input->get();
        if(array_key_exists('old_password',$param))
        {
            $array = array("id" => $param['id'],"password"=>$param['old_password']);
            $this->db->where($array);
            $q=$this->db->get("user");
            $data = $q->result_array();
            if (count($data) <=0) 
            {
                $data = array(array("success" => false, "message" => "Old Password not matched"));
            }
            else
            {
                $array = array("id" => $param['id']);
                $this->db->where($array);
                $q = $this->db->update('user', array('password'=>$param['password']));
                $data = array(array("success" => true));                
            }
        }
        else
        {
            $array = array("email" => $param['email']);
            $this->db->where($array);
            $q = $this->db->update('user', array('password'=>$param['password']));
            $data = array(array("success" => true));                        
        }
        echo json_encode($data); 
    }    
    public function upload_base_image()
    {
        $this->load->database();
        $param=file_get_contents("php://input"); 
        $param = json_decode($param,true);
      	
        $this->load->model('Upload');
        $image = str_replace('plussss', '+', $param['image']);
        echo $this->Upload->upload_image($image, 'profile_image'.$param['id'] , 'jpg');
    }
    public function upload_image()
    {
        $this->load->database();
        $param = $this->input->post(); 
        $this->load->model('Upload');
        $image = str_replace('plussss', '+', $param['image']);
        $params['image'] = $this->Upload->upload_image($image, 'profile_image'.$param['id'] , 'jpg');
        $this->db->where('id', $param['id']);
        $q = $this->db->update('user', $params);
    }
    function email_alert($to, $subject, $message)
	{
$message="
<html>
		<head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
			<title>Player OF The Match</title>
		</head>
		<body  style='padding:0px; margin:0px; background:#f7f8f9;'>
			<table width='100%' border='0' style='padding:0px; margin:0px;'>
    			<tr>
        			<td width='100%'>
                		<table width='100%' style='padding:0px; font-family:verdana, arial; font-size:12px; color:#444;' border='0' cellpadding='0' cellspacing='0' bgcolor='#f7f8f9' align='center'>
							<tr style='background:#f7f8f9'>
								<td style='padding:10px 80px; font-size:16px; text-align:left'>
									<a href='https://saventh.com' style='color:#fff;'><img src=\"https://saviour.earth/saventh/image/logoname.png\" style='width:50px' /></a>
								</td>
							</tr>
							".$message."	
							
							<tr>
								<td colspan='2' style='padding:20px 10px; text-align:center'>
									<div style='padding:30px 0; float:left; text-align:center; width:100%;'>
										
									</div>
								</td>
							</tr>
						</table>
	                </td>
            	</tr>
        	</table>
		</body>
		</html>
		";
		include APPPATH."third_party/phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;
		 
		$mail->isSMTP();    
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);                                  // Set mailer to use SMTP
		$mail->Host = 'Localhost';                       // Specify main and backup server
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'hello@saviour.earth';                   // SMTP username
		$mail->Password = 'EWEM6Gzff';               // SMTP password
		$mail->setFrom('hello@saviour.earth', 'Saventh');     //Set who the message is to be sent from
		$mail->addReplyTo('hello@saviour.earth', 'Saventh');  //Set an alternative reply-to address
		$mail->addAddress($to);               // Name is optional
		$mail->isHTML(true);                                  // Set email format to HTML
		 
		$mail->Subject = $subject;
		$mail->Body    = $message;
		$mail->AltBody = $message;
		 
		if(!$mail->send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit;
		}
		return "Please Check Your Email";
	}
}

?>