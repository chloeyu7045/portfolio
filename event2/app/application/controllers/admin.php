<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
   {
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url', 'form', 'file'));
        $this->load->library(array('session', 'grocery_CRUD'));

   }
    public function index()
    {
	   redirect('/admin/login/', 'refresh');
    }
	

	function login()
    {	
		$data['title'] = '系統登入';
		$data['slogan'] = '系統登入';
        $this->load->view('admin/admin_login', $data);
    }
	
	//系統登出
	function logout()
    {	
		$this->session->unset_userdata('auth');
		$this->chk_auth();
    }  
	
	//確認管理登入帳號密碼
	function chk_login()
    {	
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($username == "jrpass" && $password == "powerful"){
			$this->session->set_userdata('auth', 'admin');
			echo "success";
		}else{
			echo "err";
		}
    }  
	
	//管理頁面確認登入狀態
	function chk_auth()
    {	
		if(!$this->session->userdata('auth')){
			redirect('/admin/login/', 'refresh');
		}
    }     
	
	public function _callback_user_status($value, $row)
	{
		if($value){
			return '<input type="button" key="'.$row->uid.'" val="0" value="通過" op="status" class="status status-0 my-button" />';
		}else{
			return '<input type="button" key="'.$row->uid.'" val="1" value="未通過" op="status" class="status status-1 my-button" />';
		}
	} 
	
	public function _callback_user_vote($value, $row)
	{
		return $this->db->query("SELECT * FROM vote WHERE uid='$row->uid' AND status='1'")->num_rows();
	} 
	
	public function _callback_ddvalue($value, $row)
	{
		if($row->dd!=""){
			return "V";
		}else{
			return "&nbsp;";
		}
	} 
	
	public function change_user_status()
	{
		$key = $this->input->post('key');
		$val = $this->input->post('val');
		$op = $this->input->post('op');
		$data = array( 'status' => $val );
		$this->db->where('uid', $key);
		$this->db->update('user', $data);
	} 
	
	public function area()
    {
		return $data=array("九州JR路線圖","東日本JR路線圖","四國JR路線圖");
	}
	
	public function user()
    {	
		
		$this->chk_auth();
		$crud = new grocery_CRUD();
		
		
		$crud->set_theme('datatables')
			->set_subject('參與名單')
			->set_table('user');
		
		
		$data['name'] = '';
		$data['title'] = '參與名單';
		$data['h2'] = '參與名單';
		
		
		$crud->columns('name', 'mobile', 'email', 'address', 'area', 'ip', 'date');
		$crud->add_fields('name', 'mobile', 'email', 'address', 'area', 'ip', 'date');
		$crud->edit_fields('name', 'mobile', 'email', 'address', 'area', 'ip', 'date');
				
		
		$crud->field_type('status', 'true_false' );
		$crud->callback_column('status', array($this, '_callback_user_status'));
		$crud->field_type('area', 'dropdown', $this->area() );		
	
		$crud->change_field_type('status', 'hidden');
		$crud->change_field_type('stid', 'hidden');
		
		$state = $crud->getState();
		
		
		$crud->display_as('name','姓名');
		$crud->display_as('mobile','電話');
		$crud->display_as('email','Email');
		$crud->display_as('address','地址');

		$crud->display_as('area','選擇區域');	
				
		$crud->display_as('status','審核');
		$crud->display_as('ip','IP');
		$crud->display_as('date','時間');
		
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_edit();
		$crud->unset_read();
		//$crud->unset_operations();		
		//$crud->where('LEFT(date, 10) >=','2015-09-17');
		$crud->order_by('uid', 'desc');
		//$crud->unset_texteditor('');
		$data['crud'] = $crud->render(); 
		
		$this->load->view('admin/admin_user', $data);
    }	
	
	/*
	public function _callback_vote_status($value, $row)
	{
		if($value){
			return '<input type="button" key="'.$row->id.'" val="0" value="通過" op="status" class="status status-0 my-button" />';
		}else{
			return '<input type="button" key="'.$row->id.'" val="1" value="未通過" op="status" class="status status-1 my-button" />';
		}
	} 
	
	public function _callback_uid($value, $row)
	{
		$data = $this->db->query("SELECT * FROM user WHERE uid='$row->uid' AND status='1'")->row();
		return $data->name;
	} 
	
	public function change_vote_status()
	{
		$key = $this->input->post('key');
		$val = $this->input->post('val');
		$op = $this->input->post('op');
		$data = array( 'status' => $val );
		$this->db->where('id', $key);
		$this->db->update('vote', $data);
	} 
	
	//event2
	public function event2()
    {	
		
		$this->chk_auth();
		$crud = new grocery_CRUD();
		
		$this->db
		->order_by('date', 'desc');
		
		$crud->set_theme('datatables')
			->set_subject('第2階段 代言人票選')
			->set_table('vote');
		
		
		$data['name'] = '';
		$data['title'] = '前進紐西蘭‧旅人玩家頻道';
		$data['h2'] = '第2階段 代言人票選';
		
		
		//第2階段
		$crud->columns('name', 'email', 'uid', 'date', 'ip', 'status', 'authdate');		
		
		$crud->field_type('status', 'true_false' );
		$crud->callback_column('status', array($this, '_callback_vote_status'));
		$crud->callback_column('uid', array($this, '_callback_uid'));
		
		$state = $crud->getState();
		
		if($state == 'add' || $state == 'edit'){
			
		}else{
			
		}
		
		
		$crud->display_as('name','姓名');
		$crud->display_as('uid','投票給');
		$crud->display_as('email','EMAIL');	
		
		$crud->display_as('status','授權');
		$crud->display_as('authdate','授權時間');
		$crud->display_as('ip','IP');
		$crud->display_as('date','投票時間');
		
		
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_edit();
		$crud->unset_read();
		//$crud->unset_operations();		
		$data['crud'] = $crud->render(); 
		
		$this->load->view('admin/admin_vote', $data);
    }	
	*/
	

	
	public function _callback_stage_draw($value, $row)
	{
		//$this->db->where('stid', $row->stid);
		//$num = $this->db->count_all_results('user');
		$num = $this->db->get_where('user', array('stid' => $row->stid))->num_rows();
		if($num){
			//return "<a href='".base_url()."index.php/admin/draw/".$row->stid."' class='my-button iframe fancybox'>獎項巳抽出</a>";
			return "<a href='".base_url()."index.php/admin/draw/".$row->stid."' class='my-button iframe fancybox'>查看得獎名單</a>";
		}else{
			return "<a href='".base_url()."index.php/admin/draw/".$row->stid."' class='my-button iframe fancybox'>抽獎</a>";
		}
		
	}
	
	public function get_stage($stid = FALSE)
	{
		if ($stid === FALSE)
		{
			return FALSE;
		}
		
		$query = $this->db->get_where('stage', array('stid' => $stid));
		return $query->row();
	}
	
	public function user_stage_delete($primary_key)
	{
		//return $this->db->insert('user',array('user_id' => $primary_key,'action'=>'delete', 'updated' => date('Y-m-d H:i:s')));
		$data = array(
		   'stid' => 0
		);
		$this->db->where('stid', $primary_key);
		$this->db->update('user', $data); 
	}
	
	
	public function stage()
    {	
		$this->chk_auth();
		
		$crud = new grocery_CRUD();
		
		$crud->set_theme('datatables')
			->set_subject('獎項')
			->set_table('stage');
			
		$data['name'] = '';
		$data['title'] = '活動抽獎';
		$data['h2'] = '活動抽獎';
		
		$crud->columns('gift', 'num', 'draw', 'date');
		$crud->add_fields('gift', 'num', 'date');
		$crud->edit_fields('gift', 'num', 'date');
		
		
		$crud->field_type('date', 'date');
		$crud->field_type('status', 'true_false' );
		$crud->callback_column('draw', array($this, '_callback_stage_draw'));
		$crud->callback_after_delete(array($this,'user_stage_delete'));
		
		$crud->display_as('stid','ID');
		$crud->display_as('gift','場次');
		$crud->display_as('num','名額');
		$crud->display_as('draw','抽獎');
		$crud->display_as('date','抽獎時間');
		
		//$crud->unset_add();
		//$crud->unset_delete();
		//$crud->unset_edit();
		$crud->unset_read();
		//$crud->unset_operations();
		
		$data['crud'] = $crud->render(); 
		
		$this->load->view('admin/admin_stage_template', $data);
    }
	
	public function draw($stid=0)
    {	
		$data['stage'] = $stage = $this->get_stage($stid);
		$data['title'] = '抽獎';		
		
		//取出得獎名單
		$query = $this->db->query("SELECT * FROM user WHERE stid='$stage->stid'");
		$data['num'] = $query->num_rows();
		$data['result'] = $query->result();		
	
		$this->load->view('admin/admin_draw_template', $data);
    }
	
	
	public function draw_user()
    {	
		$response = "";
		$stid = $this->input->post('stid');
		$stage = $this->get_stage($stid);
		//$result = $this->db->query("SELECT * FROM user WHERE stid='0' AND status='1' ORDER BY RAND() LIMIT $stage->num")->result();
		//如果使用group by一個條件的話,得到的結果會少了很多
		$result = $this->db->query("SELECT * FROM user WHERE status='1' GROUP BY mobile HAVING stid='0' ORDER BY RAND() LIMIT $stage->num")->result();
		
		$response .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		$response .= '<tr><th>姓名</th><th>Email</th><th>電話</th><th>地址</th></tr>';
		foreach($result as $row){
			$response .= '<tr>';
			$response .= '<td>'.$row->name.'</td>';
			$response .= '<td>'.$row->email.'</td>';
			$response .= '<td>'.$row->mobile.'</td>';			
			$response .= '<td>'.$row->address.'</td>';
			$response .= '</tr>';
			$response .= '<input name="uid[]" type="hidden" class="uid" value="'.$row->uid.'" />';
		}
		
		$response .= '</table>';
		echo $response;
    }
	
	public function lucky()
    {	
		$stid = $this->input->post('stid');
		$uidArr = $this->input->post('uid');//is array
		
		//清除原抽中名單的stid對應
		$data = array(
               'stid' => 0
            );	
		$this->db->where('stid', $stid);
		$this->db->update('user', $data);
		
		//寫入新中獎者
		foreach($uidArr as $uid){
			$data = array(
               'stid' => $stid
            );	
			
			$this->db->where('uid', $uid);
			$this->db->update('user', $data);
		}
    }
	/*
	public function clear_all_lucky($u=0,$key=0)
    {	
		if($u=="smartidea-tw.com" && $key == "admin"){
		
			$data = array(
				   'stid' => 0
				);	
			$this->db->update('user', $data);
			
			echo "CLEAR ALL LUCKY ... OK";
		}else{
			echo "CLEAR ALL LUCKY ... ERROR";
		}
		
    }
	
	public function clear_all_stage($u=0,$key=0)
    {	
		if($u=="smartidea-tw.com" && $key == "admin"){
		
			$this->db->query('TRUNCATE TABLE stage');
			
			$data = array(
				   'stid' => 0
				);	
			$this->db->update('user', $data);
			echo "CLEAR ALL STAGE AND LUCKY ... OK";
		}else{
			echo "CLEAR ALL STAGE AND LUCKY ... ERROR";
		}
		
    }
	*/
	/*
	//獎項
	public function gifts()
	{
		$data = array();
		$str="SELECT * FROM stage";
		$result = mysql_query($str);
		while($row = mysql_fetch_object($result)){
			$data[$row->stid] = $row->gift;
		}
		return $data;
	}
	
	//活動抽獎
	public function lottery()
    {
	
		$this->chk_auth();
	  
	  //$this->config->load('app_config');
	  
	   $data['gifts'] = $this->gifts();//獎項
	  // $data['t'] = $this->config->item('t');//場次
	  // $data['b'] = $this->config->item('b');//抽獎資格
	   $this->load->view('admin_lottery', $data);
    }
	
	public function lottery_data()
    {
	   
	   $response = "";
		$stid = $this->input->post('stid');
		$stage = $this->get_stage($stid);
		$result = $this->db->query("SELECT * FROM user WHERE stid='0' AND status='1' ORDER BY RAND() LIMIT $stage->num")->result();
		$data = array(
		   'stid' => $stid
		);
		
		$response .= '<table width="60%" align="center" border="0" cellspacing="0" cellpadding="0" class="list_tab">';
		//$response .= '<tr><th>FB</th><th>姓名</th><th>手機號碼</th><th>Email</th><th>地址</th></tr>';
		foreach($result as $row){
			$response .= '<tr>';
			$response .= '<td valign="middle"><img src="http://graph.facebook.com/'.$row->fbuid.'/picture" height="50px" /></td>';
			$response .= '<td>'.$row->name.'</td>';
			$response .= '<td>'.$row->mobile.'</td>';
			$response .= '<td>'.$row->email.'</td>';
			$response .= '<td>'.$row->address.'</td>';
			$response .= '</tr>';
			$response .= '<input name="uid[]" type="hidden" class="uid" value="'.$row->uid.'" />';
			
			

			$this->db->where('uid', $row->uid);
			$this->db->update('user', $data); 
			
		}
		
		$response .= '</table>';
		echo $response;

    }
	
	*/
	
	//清除
	/*
	public function lottery_clear()
    {
	   
		$gifts = $this->gifts();//獎項
		$data = array(
		   'stid' => 0
		);
		foreach($gifts as $key=>$gift)
		{
			$this->db->where('stid', $key);
			$this->db->update('user', $data); 
		}
		echo '<script>location.href="'.base_url().'index.php/admin/stage/";</script>';
    }
	*/	
	
	public function _callback_column_ut($value, $row)
	{
		$num = $this->db->query("SELECT * FROM logs WHERE LEFT(date,10)='$row->gd1' GROUP BY ip")->num_rows();
		return $num;
	}
	
	public function _callback_column_uts($value, $row)
	{
		$num = $this->db->query("SELECT * FROM logs WHERE LEFT(date,10)='$row->gd1'")->num_rows();
		return $num;
	}
	
	public function logs()
    {	
		
		$this->chk_auth();
		$crud = new grocery_CRUD();
		
		$this->db->select('LEFT(logs.date, 10) AS gd1', FALSE)->group_by('gd1')->order_by('gd1', 'desc');
		
		$crud->set_theme('datatables')
			->set_subject('瀏覽記錄')
			->set_table('logs');
			
		$data['name'] = '';
		$data['title'] = '瀏覽記錄';
		$data['h2'] = '瀏覽記錄';
		$crud->columns('gd1', 'uts', 'ut');
		//$crud->add_fields('uid', 'ename', 'ticket', 'travel', 'item');
		//$crud->edit_fields('uid', 'ename', 'ticket', 'travel', 'item');
		
		$crud->callback_column('uts', array($this, '_callback_column_uts'));
		$crud->callback_column('ut', array($this, '_callback_column_ut'));
		
		$crud->display_as('gd1', '日期');
		$crud->display_as('uts', '瀏覽人次');
		$crud->display_as('ut', '瀏覽人數');
		
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_edit();
		$crud->unset_read();
		//$crud->unset_operations();
		
		
		$data['crud'] = $crud->render(); 
		
		$this->load->view('admin/admin_template', $data);
    }
	
	/*
	public function _callback_column_outlink_link1($value, $row)
	{
		$num = $this->db->query("SELECT * FROM outlink WHERE LEFT(date,10)='$row->gd1' AND page='t01'")->num_rows();
		return $num;
	}
	public function _callback_column_outlink_link2($value, $row)
	{
		$num = $this->db->query("SELECT * FROM outlink WHERE LEFT(date,10)='$row->gd1' AND page='t02'")->num_rows();
		return $num;
	}
	public function _callback_column_outlink_link3($value, $row)
	{
		$num = $this->db->query("SELECT * FROM outlink WHERE LEFT(date,10)='$row->gd1' AND page='t03'")->num_rows();
		return $num;
	}
	public function _callback_column_outlink_link4($value, $row)
	{
		$num = $this->db->query("SELECT * FROM outlink WHERE LEFT(date,10)='$row->gd1' AND page='t04'")->num_rows();
		return $num;
	}
	public function _callback_column_outlink_link5($value, $row)
	{
		$num = $this->db->query("SELECT * FROM outlink WHERE LEFT(date,10)='$row->gd1' AND page='t05'")->num_rows();
		return $num;
	}
	public function _callback_column_outlink_link6($value, $row)
	{
		$num = $this->db->query("SELECT * FROM outlink WHERE LEFT(date,10)='$row->gd1' AND page='t06'")->num_rows();
		return $num;
	}
	public function _callback_column_outlink_link7($value, $row)
	{
		$num = $this->db->query("SELECT * FROM outlink WHERE LEFT(date,10)='$row->gd1' AND page='t07'")->num_rows();
		return $num;
	}
	public function _callback_column_outlink_link8($value, $row)
	{
		$num = $this->db->query("SELECT * FROM outlink WHERE LEFT(date,10)='$row->gd1' AND page='t08'")->num_rows();
		return $num;
	}
	*/
	/*
	public function travel()
    {	
		
		$this->chk_auth();
		$crud = new grocery_CRUD();
		
		$this->db->select('LEFT(outlink.date, 10) AS gd1', FALSE)->group_by('gd1')->order_by('gd1', 'desc');
		
		$crud->set_theme('datatables')
			->set_subject('業者行程')
			->set_table('outlink');
			
		$data['name'] = '';
		$data['title'] = '業者行程';
		$data['h2'] = '業者行程';
		$crud->columns('gd1', 'link1', 'link2', 'link3', 'link4', 'link5', 'link6', 'link7', 'link8');
		
		$crud->callback_column('link1', array($this, '_callback_column_outlink_link1'));
		$crud->callback_column('link2', array($this, '_callback_column_outlink_link2'));
		$crud->callback_column('link3', array($this, '_callback_column_outlink_link3'));
		$crud->callback_column('link4', array($this, '_callback_column_outlink_link4'));
		$crud->callback_column('link5', array($this, '_callback_column_outlink_link5'));
		$crud->callback_column('link6', array($this, '_callback_column_outlink_link6'));
		$crud->callback_column('link7', array($this, '_callback_column_outlink_link7'));
		$crud->callback_column('link8', array($this, '_callback_column_outlink_link8'));
		
		$crud->display_as('gd1', '日期');
		$crud->display_as('link1', '可樂');
		$crud->display_as('link2', '雄獅');
		$crud->display_as('link3', '東南');
		$crud->display_as('link4', '享趣');
		$crud->display_as('link5', '鴻大');
		$crud->display_as('link6', '鳳凰');
		$crud->display_as('link7', '華泰');
		$crud->display_as('link8', '巨匠');
		
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_edit();
		$crud->unset_read();
		//$crud->unset_operations();
		
		
		$data['crud'] = $crud->render(); 
		
		$this->load->view('admin/admin_template', $data);
    }
	

	public function _callback_column_outlink_ad1($value, $row){
		return $this->db->query("SELECT * FROM ad WHERE LEFT(date,10)='$row->gd1' AND page='fb'")->num_rows();
	}
	public function _callback_column_outlink_ad2($value, $row){
		return $this->db->query("SELECT * FROM ad WHERE LEFT(date,10)='$row->gd1' AND page='skype'")->num_rows();
	}
	public function _callback_column_outlink_ad3($value, $row){
		return $this->db->query("SELECT * FROM ad WHERE LEFT(date,10)='$row->gd1' AND page='rtb'")->num_rows();
	}
	public function _callback_column_outlink_ad4($value, $row){
		return $this->db->query("SELECT * FROM ad WHERE LEFT(date,10)='$row->gd1' AND page='thenewslens'")->num_rows();
	}
	public function _callback_column_outlink_ad5($value, $row){
		return $this->db->query("SELECT * FROM ad WHERE LEFT(date,10)='$row->gd1' AND page='chinatimes'")->num_rows();
	}
	public function _callback_column_outlink_ad6($value, $row){
		return $this->db->query("SELECT * FROM ad WHERE LEFT(date,10)='$row->gd1' AND page='intel'")->num_rows();
	}
	public function _callback_column_outlink_ad7($value, $row){
		return $this->db->query("SELECT * FROM ad WHERE LEFT(date,10)='$row->gd1' AND page='apple'")->num_rows();
	}
	public function _callback_column_outlink_ad8($value, $row){
		return $this->db->query("SELECT * FROM ad WHERE LEFT(date,10)='$row->gd1' AND page='sharpdaily'")->num_rows();
	}
	public function _callback_column_outlink_ad9($value, $row){
		return $this->db->query("SELECT * FROM ad WHERE LEFT(date,10)='$row->gd1' AND page='nextmag'")->num_rows();
	}
	*/
		
	/*
	FACEBOOK
	http://powerful-ad.com/christchurch/index.php/page/ad/fb
	SKYPT
	http://powerful-ad.com/christchurch/index.php/page/ad/skype
	RTB
	http://powerful-ad.com/christchurch/index.php/page/ad/rtb
	關鍵評論網 
	http://powerful-ad.com/christchurch/index.php/page/ad/thenewslens
	中時電子報
	http://powerful-ad.com/christchurch/index.php/page/ad/chinatimes
	英特爾
	http://powerful-ad.com/christchurch/index.php/page/ad/intel
	手機網-蘋果日報
	http://powerful-ad.com/christchurch/index.php/page/ad/apple
	爽報數位
	http://powerful-ad.com/christchurch/index.php/page/ad/sharpdaily
	壹週刊
	http://powerful-ad.com/christchurch/index.php/page/ad/nextmag
	*/
	
	/*
	public function ad()
    {			
		$this->chk_auth();
		$crud = new grocery_CRUD();
		
		$this->db->select('LEFT(ad.date, 10) AS gd1', FALSE)->group_by('gd1')->order_by('gd1', 'desc');
		
		$crud->set_theme('datatables')
			->set_subject('媒體記錄')
			->set_table('ad');
			
		$data['name'] = '';
		$data['title'] = '媒體記錄';
		$data['h2'] = '媒體記錄';
		$crud->columns('gd1', 'ad1', 'ad2', 'ad3', 'ad4', 'ad5', 'ad6', 'ad7', 'ad8', 'ad9');
		
		$crud->callback_column('ad1', array($this, '_callback_column_outlink_ad1'));
		$crud->callback_column('ad2', array($this, '_callback_column_outlink_ad2'));
		$crud->callback_column('ad3', array($this, '_callback_column_outlink_ad3'));
		$crud->callback_column('ad4', array($this, '_callback_column_outlink_ad4'));
		$crud->callback_column('ad5', array($this, '_callback_column_outlink_ad5'));
		$crud->callback_column('ad6', array($this, '_callback_column_outlink_ad6'));
		$crud->callback_column('ad7', array($this, '_callback_column_outlink_ad7'));
		$crud->callback_column('ad8', array($this, '_callback_column_outlink_ad8'));
		$crud->callback_column('ad9', array($this, '_callback_column_outlink_ad9'));
		
	
		$crud->display_as('gd1', '日期');
		$crud->display_as('ad1', 'FB');
		$crud->display_as('ad2', 'SKYPT');
		$crud->display_as('ad3', 'RTB');
		$crud->display_as('ad4', '關鍵');
		$crud->display_as('ad5', '中時');
		$crud->display_as('ad6', '英特爾');
		$crud->display_as('ad7', '蘋果');
		$crud->display_as('ad8', '爽報');
		$crud->display_as('ad9', '壹週刊');
		
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_edit();
		$crud->unset_read();
		//$crud->unset_operations();
		
		
		$data['crud'] = $crud->render(); 
		
		$this->load->view('admin/admin_template', $data);
    }
	
	
	public function _callback_column_ltn_link1($value, $row)
	{
		$num = $this->db->query("SELECT * FROM ltn WHERE LEFT(date,10)='$row->gd1' AND page='colatour'")->num_rows();
		return $num;
	}
	public function _callback_column_ltn_link2($value, $row)
	{
		$num = $this->db->query("SELECT * FROM ltn WHERE LEFT(date,10)='$row->gd1' AND page='galilee'")->num_rows();
		return $num;
	}
	public function _callback_column_ltn_link3($value, $row)
	{
		$num = $this->db->query("SELECT * FROM ltn WHERE LEFT(date,10)='$row->gd1' AND page='artisan'")->num_rows();
		return $num;
	}
	public function _callback_column_ltn_link4($value, $row)
	{
		$num = $this->db->query("SELECT * FROM ltn WHERE LEFT(date,10)='$row->gd1' AND page='mitravel'")->num_rows();
		return $num;
	}
	public function _callback_column_ltn_link5($value, $row)
	{
		$num = $this->db->query("SELECT * FROM ltn WHERE LEFT(date,10)='$row->gd1' AND page='settour'")->num_rows();
		return $num;
	}
	public function _callback_column_ltn_link6($value, $row)
	{
		$num = $this->db->query("SELECT * FROM ltn WHERE LEFT(date,10)='$row->gd1' AND page='liontravel'")->num_rows();
		return $num;
	}
	public function _callback_column_ltn_link7($value, $row)
	{
		$num = $this->db->query("SELECT * FROM ltn WHERE LEFT(date,10)='$row->gd1' AND page='travel'")->num_rows();
		return $num;
	}
	
	public function ltn()
    {	
		
		$this->chk_auth();
		$crud = new grocery_CRUD();
		
		$this->db->select('LEFT(ltn.date, 10) AS gd1', FALSE)->group_by('gd1')->order_by('gd1', 'desc');
		
		$crud->set_theme('datatables')
			->set_subject('自由時報焦點新聞')
			->set_table('ltn');
			
		$data['name'] = '';
		$data['title'] = '自由時報焦點新聞';
		$data['h2'] = '自由時報焦點新聞';
		$crud->columns('gd1', 'ltn1', 'ltn2', 'ltn3', 'ltn4', 'ltn5', 'ltn6', 'ltn7');
		
		$crud->callback_column('ltn1', array($this, '_callback_column_ltn_link1'));
		$crud->callback_column('ltn2', array($this, '_callback_column_ltn_link2'));
		$crud->callback_column('ltn3', array($this, '_callback_column_ltn_link3'));
		$crud->callback_column('ltn4', array($this, '_callback_column_ltn_link4'));
		$crud->callback_column('ltn5', array($this, '_callback_column_ltn_link5'));
		$crud->callback_column('ltn6', array($this, '_callback_column_ltn_link6'));
		$crud->callback_column('ltn7', array($this, '_callback_column_ltn_link7'));
		
		$crud->display_as('gd1', '日期');
		//$crud->display_as('uts', '瀏覽人次');
		//$crud->display_as('ut', '瀏覽人數');
		$crud->display_as('ltn1', '可樂');
		$crud->display_as('ltn2', '加利利');
		$crud->display_as('ltn3', '巨匠');
		$crud->display_as('ltn4', '華友');
		$crud->display_as('ltn5', '東南');
		$crud->display_as('ltn6', '雄獅');
		$crud->display_as('ltn7', '鳳凰');
		
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_edit();
		$crud->unset_read();
		//$crud->unset_operations();
		
		
		$data['crud'] = $crud->render(); 
		
		$this->load->view('admin_template', $data);
    }
	*/
	function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
	{
		if($code == 'UTF-8')
		{
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
		preg_match_all($pa, $string, $t_string);
		if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen));
		return join('', array_slice($t_string[0], $start, $sublen));
		}
		else
		{
		$start = $start*2;
		$sublen = $sublen*2;
		$strlen = strlen($string);
		$tmpstr = '';
		for($i=0; $i< $strlen; $i++)
		{
		if($i>=$start && $i< ($start+$sublen))
		{
		if(ord(substr($string, $i, 1))>129)
		{
		$tmpstr.= substr($string, $i, 2);
		}
		else
		{
		$tmpstr.= substr($string, $i, 1);
		}
		}
		if(ord(substr($string, $i, 1))>129) $i++;
		}
		//if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
		return $tmpstr;
		}
	}
	/*
	public function del_test_data()
    {			
		$this->db->query("DELETE FROM vote WHERE email='emity7045@gmail.com' OR email='emity7045@yahoo.com.tw' OR email='emity7045@hotmail.com' OR email='pei@passion-ad.com.tw'");
    }
	*/
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */