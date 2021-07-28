<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$this->load->helper(array('url', 'form', 'file'));
		$this->load->library(array('session'));
	}
	
		
	public function index()
	{					
		/*
		$data['all'] = array(
			"JR九州",
			"東京",
			"福岡",
			"JR東日本",
			"札幌",
			"鹿兒島",
			"JR四國",
			"高松",
			"熊本",
			
			"九州挑戰成功",
			"東日本挑戰成功",
			"四國挑戰成功"
		);
		*/
		$data['area'] = array(
			"JR九州",
			"JR東日本",
			"JR四國"
		);
		
		$data['city'] = array(
			
			"東京",
			"福岡",
			
			"札幌",
			"鹿兒島",
			
			"高松",
			"熊本",
			
			"宮崎"
		);
		
		$data['success'] = array(			
			"九州挑戰成功",
			"東日本挑戰成功",
			"四國挑戰成功"
		);
		
		$this->load->view('index', $data);
	}
	
	

	
	
	public function logs(){
		
		$ip=$this->input->ip_address();
		$browser=$_SERVER['HTTP_USER_AGENT'];
		$date=date("Y-m-d H:i:s");

		$data = array(
		   'page' => $this->input->post('page'),
		   'date' => $date,
		   'ip' => $ip,
		   'browser' => $browser
		);

		$this->db->insert('logs', $data); 
		
		exit();
	}
	
	
	/*
	public function post_data()
	{

		$msg = "";
		
		if( $this->input->post('name')!="" ){
			$data['name'] = $this->input->post('name');
		}else{
			$msg = $msg . "請輸入姓名<br />";
		}
		if( $this->input->post('mobile')!="" ){
			$data['mobile'] = $mobile = $this->input->post('mobile');
		}else{
			$msg = $msg . "請輸入電話<br />";
		}		
		if( $this->input->post('email')!="" ){
			$data['email'] = $email = $this->input->post('email');
		}else{
			$msg = $msg . "請輸入Email<br />";
		}		
		if( $this->input->post('address')!="" ){
			$data['address'] = $address = $this->input->post('address');
		}else{
			$msg = $msg . "請輸入地址<br />";
		}
		if( $this->input->post('selectarea') < 3 ){
			$data['area'] = $this->input->post('selectarea');
		}else{
			$msg = $msg . "錯誤操作";
		}
		
		
		if($msg==""){ //沒有錯誤訊息
			
			$data['ip'] = $_SERVER['REMOTE_ADDR'];
			$data['date'] = $date = date("Y-m-d H:i:s");
			$today = date("Y-m-d");
				
			$query = $this->db->query("SELECT * FROM user WHERE (mobile='$mobile' OR email='$email' OR address='$address') AND LEFT(date,10)='$today'");
			$num = $query->num_rows();
			if($num){
				echo "repeat";
			}else{
				$this->db->insert('user', $data); 
				echo "success";
			}
			
		}else{ //有錯誤訊息
			
			echo "error";
			
		}
		
	}
	
	*/


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */