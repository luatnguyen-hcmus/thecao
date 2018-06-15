<?php 
	Class User extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('user_model');
			$this->load->model('transaction_model');
			$this->load->model('cash_card_model');
		}
		//dang ki thanh vien.
		function register(){
			//neu da dang nhap roi thy chuyen ve trang thong tin thanh vien
			if($this->session->userdata('user_id_login')){
				redirect(base_url('user'));
			}

			$this->load->library('form_validation');
			$this->load->helper('form');
			if($this->input->post()){


				$this->form_validation->set_rules('username', 'Tên đăng nhập', 'required|min_length[8]|callback_check_username');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
				$this->form_validation->set_rules('phone', 'Số điện thoại', 'required|callback_check_phone');
				$this->form_validation->set_rules('password', 'Mật Khẩu', 'required|min_length[6]');
				$this->form_validation->set_rules('againpassword', 'Nhập lại mật khẩu', 'required|matches[password]');
				$this->form_validation->set_rules('password2', 'Mật Khẩu cấp 2', 'required|min_length[6]');
				$this->form_validation->set_rules('againpassword2', 'Nhập lại mật khẩu cấp 2', 'required|matches[password2]');
				$this->form_validation->set_rules('agree', 'Các điều khoản', 'required');
				

				if($this->form_validation->run()){
					
					$password = $this->input->post('password');
					$password = md5($password);
					$password2 = $this->input->post('password2');
					$password2 = md5($password2);

					$data = array(
						'user_name'     => $this->input->post('username'),
						'email'    => $this->input->post('email'),
						'phone'    => $this->input->post('phone'),
						'bag'     => 0,
						'status'  => 1,
						'password' => $password,
						'pass2' => $password2,
						'created'   => now(),
					);
					if($this->user_model->create($data)){
						$this->session->set_flashdata('message', 'Đăng kí thành viên thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không thêm được !');
					}
					redirect(base_url(''));
				}
			}

			//hien thi ra view
			$this->data['temp'] = "site/user/register";
			$this->load->view('site/layout', $this->data);
		}

		function check_username(){
			$username = $this->input->post('username');
			$where = array('user_name' => $username);
			if($this->user_model->check_exists($where)){
				$this->form_validation->set_message(__FUNCTION__, 'Username đã tồn tại');
				return false;
			}
			return true;
		}

		function check_email(){
			$email = $this->input->post('email');
			$where = array('email' => $email);
			if($this->user_model->check_exists($where)){
				$this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại');
				return false;
			}
			return true;
		}

		function check_phone(){
			$phone = $this->input->post('phone');
			if($phone != "" && (strlen($phone) < 10 || strlen($phone) > 11)){
				$this->form_validation->set_message(__FUNCTION__, 'Số điện thoại không đúng');
				return false;
			}
			return true;
		}
		

		//kiem tra dang nhap
		function login(){
			//neu da dang nhap roi thy chuyen ve trang thong tin thanh vien
			if($this->session->userdata('user_id_login')){
				redirect(base_url('home'));
			}

			$this->load->library('form_validation');
			$this->load->helper('form');
			if($this->input->post()){
				$this->form_validation->set_rules('username_login', 'Tên đăng nhập', 'required');
				$this->form_validation->set_rules('password_login', 'Mật Khẩu', 'required|min_length[6]');
				$this->form_validation->set_rules('login', 'login', 'callback_check_login');
				if($this->form_validation->run()){
					//lay thong tin thanh vien
					$user = $this->_get_user_info();
					//gắn sesion id của thành viên đã đăng nhập
					$this->session->set_userdata('user_id_login',$user->id);

					// $this->session->set_flashdata('message', 'Đăng nhập thành công !');
					redirect(base_url());
				}
			}

			//hien thi ra view
			$this->data['temp'] = "site/user/login";
			$this->load->view('site/layout', $this->data);
		}

		function check_login(){
			$user = $this->_get_user_info();
			if($user){
				if($user->status == 1){
					return true;
				}
				else{
					$this->form_validation->set_message(__FUNCTION__, '<p style="font-size:16px; color: red;font-weight: bold;"> Tài Khoản của bạn đang bị khóa , vui lòng liên hệ admin theo hotline trên website! </p>');
					return false;
				}
			}else{
				$this->form_validation->set_message(__FUNCTION__, '<p style="font-size:16px; color: red;font-weight: bold;"> Sai tên đăng nhập hoặc mật khẩu! </p>');
				return false;
			}
		}

		//lay thong tin cua thanh vien
		private function _get_user_info(){
			$email = $this->input->post('username_login');
			$password = $this->input->post('password_login');
			$password = md5($password);

			$this->load->model('user_model');
			$where = array('user_name'=>$email, 'password'=>$password);
			if(!empty($_POST["remember"])) {
				setcookie ("member_login",$_POST["username_login"],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("member_password",$_POST["password_login"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
				if(isset($_COOKIE["member_password"])) {
					setcookie ("member_password","");
				}
			}
			$user = $this->user_model->get_info_rule($where);
			return $user;
		}
		//chinh sua thong tin thanh vien
		function edit(){
			redirect(base_url());
			if(!$this->session->userdata('user_id_login')){
				redirect(base_url('user/login'));
			}
			//lay thong tin cua thanh vien
			$user_id = $this->session->userdata('user_id_login');
			$user = $this->user_model->get_info($user_id);
			if(!$user){
				redirect(base_url());
			}
			$this->data['user'] = $user;

			$this->load->library('form_validation');
			$this->load->helper('form');
			if($this->input->post()){
				$password = $this->input->post('password');
				$this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');

				if($password){
					$this->form_validation->set_rules('password', 'Mật Khẩu', 'required|min_length[6]');
					$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
				}
				
				$this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
				$this->form_validation->set_rules('address', 'Địa chỉ', 'required');

				if($this->form_validation->run()){

					$data = array(
						'name'     => $this->input->post('name'),
						'phone'    => $this->input->post('phone'),
						'address'  => $this->input->post('address'),
					);
					if($password){
						$data['password'] = md5($password);
					}
					if($this->user_model->update($user_id, $data)){
						$this->session->set_flashdata('message', 'Chỉnh sửa thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không sửa được !');
					}
					redirect(base_url('user'));
				}
			}

			//hien thi ra view
			$this->data['temp'] = "site/user/edit";
			$this->load->view('site/layout', $this->data);
		}

		//thong tin cua thanh vien
		function index(){
			redirect(base_url());
			if(!$this->session->userdata('user_id_login')){
				redirect();
			}
			$user_id = $this->session->userdata('user_id_login');
			$user = $this->user_model->get_info($user_id);
			if(!$user){
				redirect();
			}
			$this->data['user'] = $user;

			//hien thi ra view
			$this->data['temp'] = "site/user/index";
			$this->load->view('site/layout', $this->data);
		}

		//thuc hien dang xuat
		function logout(){
			if($this->session->userdata('user_id_login')){
				$this->session->unset_userdata('user_id_login');
			}
			// $this->session->set_flashdata('message', 'Đăng xuất thành công !');
			redirect(base_url());
		}

		// lich su nap the 
		function lichsunap(){
			$user_id = $this->session->userdata('user_id_login');
			//lay thong tin user
			$users = $this->user_model->get_info($user_id);
			$this->data['users'] = $users;

			//lay ta ca cac giao dich cua user
			$input['where'] = array();
			



			//kiem tra co thuc hien loc du lieeu hay khong
			$id = $this->input->get('findid');
			$id = intval($id);
			// $input['where'] = array();
			if($id > 0){
				$input['where']['id'] = $id;
			}
			$code = $this->input->get('findcode');
			if($code){
				$input['where']['pin'] = $code;
			}
			$seri = $this->input->get('findseri');
			if($seri){
				$input['where']['seri'] = $seri;
			}
			
			$findday = $this->input->get('findday');
			if($findday){
				$input['where']['date_create'] = $findday;
			}
			$finddayout = $this->input->get('finddayout');
			if($finddayout && $findday){
				$input['where'] = array('date_create >= ' => $findday, 'date_create <=' => $finddayout);
			}

			$findstatus = $this->input->get('findstatus');
			if($findstatus){
				$input['where']['status'] = $findstatus;
			}
			$input['where']['user_id']=$user_id;
			$input['where']['type_transaction']=1;
			

			$where = array();
			foreach($input as $ip){
				array_push($where, $ip);
			}
		
			$totalget = $this->transaction_model->get_total($input);
			$this->data['totalget'] = $totalget;
			$amount_total1 = $this->transaction_model->get_sum('amount', $where[0]);
			$this->data['amount_total1'] = $amount_total1;
			//pre($amount_total1);

			$user = $this->transaction_model->get_list($input);
			foreach($user as $us){
				$input['where'] = array('id'=>$us->cash);
				$subs = $this->cash_card_model->get_list($input);
				$us->subs = $subs;
			}


			$this->data['user'] = $user;

			$this->data['temp'] = "site/user/lichsunap";
			$this->load->view('site/layout', $this->data);
		}
		function lichsuruttien(){
			$user_id = $this->session->userdata('user_id_login');
			//lay thong tin user
			$users = $this->user_model->get_info($user_id);
			$this->data['users'] = $users;
			//lay ta ca cac giao dich cua user
			$input['where'] = array();

			//kiem tra co thuc hien loc du lieeu hay khong
			$id = $this->input->get('findid');
			$id = intval($id);
			
			if($id > 0){
				$input['where']['id'] = $id;
			}
			$code = $this->input->get('findcode');
			if($code){
				$input['where']['code_bank'] = $code;
			}
			$seri = $this->input->get('findseri');
			if($seri){
				$input['where']['code_open'] = $seri;
			}
			
			$findday = $this->input->get('findday');
			if($findday){
				$input['where']['date_create'] = $findday;
			}
			$finddayout = $this->input->get('finddayout');
			if($finddayout && $findday){
				$input['where'] = array('date_create >= ' => $findday, 'date_create <=' => $finddayout);
			}
			$findstatus = $this->input->get('findstatus');
			if($findstatus){
				$input['where']['status'] = $findstatus;
			}
			 // pre($input);

			$input['where']['user_id']=$user_id;
			$input['where']['type_transaction']=2;
			

			$where = array();
			foreach($input as $ip){
				array_push($where, $ip);
			}
		
			$totalget = $this->transaction_model->get_total($input);
			$this->data['totalget'] = $totalget;
			$amount_total1 = $this->transaction_model->get_sum('current', $where[0]);
			$this->data['amount_total1'] = $amount_total1;



			$user = $this->transaction_model->get_list($input);
			$this->data['user'] = $user;

			$this->data['temp'] = "site/user/lichsuruttien";
			$this->load->view('site/layout', $this->data);
		}
		function lichsuruttientcsr(){
			$user_id = $this->session->userdata('user_id_login');
			//lay thong tin user
			$users = $this->user_model->get_info($user_id);
			$this->data['users'] = $users;

			//lay ta ca cac giao dich cua user
			$input = array();
			$input['where'] = array('user_id'=>$user_id,'type_transaction'=>3);
			$user = $this->transaction_model->get_list($input);
			$this->data['user'] = $user;

			$this->data['temp'] = "site/user/lichsuruttientcsr";
			$this->load->view('site/layout', $this->data);
		}
		function reset(){
			$this->load->library('form_validation');
			$this->load->helper('form');
			if($this->input->post()){
				$this->form_validation->set_rules('email_pass', 'Email', 'required|callback_check_email');
				$this->form_validation->set_rules('username_pass', 'Tên đăng nhập', 'required');
				$this->form_validation->set_rules('login', 'login', 'callback_check_reset');
				if($this->form_validation->run()){	
					$user = $this->_get_user_info_reset();
					$this->user_model->update($user->id,['password'=>md5(123456)]);
					$this->session->set_flashdata('message', 'Đổi mật khẩu thành công, mật khẩu mới của bạn là 123456!');
					redirect(base_url());
				}

			}


			$this->data['temp'] = 'site/user/reset';
			$this->load->view('site/layout', $this->data);
		}
		function check_reset(){
			$user = $this->_get_user_info_reset();
			if($user){
				return true;
			}else{
				$this->form_validation->set_message(__FUNCTION__, '<p style="font-size:16px; color: red;font-weight: bold;"> Sai email hoặc tên đăng nhập! </p>');
				return false;
			}
		}

		//lay thong tin cua thanh vien
		private function _get_user_info_reset(){
			$email = $this->input->post('email_pass');
			$username = $this->input->post('username_pass');
			$this->load->model('user_model');
			$where = array('email'=>$email, 'user_name'=>$username);
			$user = $this->user_model->get_info_rule($where);
			return $user;
		}
		function pass(){
			$this->load->library('form_validation');
			$this->load->helper('form');
			$user_id = $this->session->userdata('user_id_login');
			if($this->input->post()){
				$this->form_validation->set_rules('password_login', 'Email', 'required');
				$this->form_validation->set_rules('repassword_login', 'Xác nhận mật khẩu', 'required|matches[password_login]');
				$this->form_validation->set_rules('password2', 'Mật khẩu cấp 2', 'required|callback_check_pass2');
				if($this->form_validation->run()){
					$data = array(
						'password'  => md5($this->input->post('password_login')),
					);
					
					if($this->user_model->update($user_id, $data)){
						$this->session->set_flashdata('message', 'Dổi mật khẩu thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không đổi được !');
					}
					redirect(base_url());
				}

			}


			$this->data['temp'] = 'site/user/pass';
			$this->load->view('site/layout', $this->data);
		}
		function pass2(){
			$this->load->library('form_validation');
			$this->load->helper('form');
			$user_id = $this->session->userdata('user_id_login');
			if($this->input->post()){
				$this->form_validation->set_rules('password_new', 'Email', 'required');
				$this->form_validation->set_rules('repassword_new', 'Xác nhận mật khẩu cấp 2', 'required|matches[password_new]');
				
				if($this->form_validation->run()){	
					$data = array(
						'pass2'  => md5($this->input->post('password_new')),
					);
					
					if($this->user_model->update($user_id, $data)){
						$this->session->set_flashdata('message', 'Tạo mật khẩu cấp 2 thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không tạo được !');
					}
					redirect(base_url());
				}

			}


			$this->data['temp'] = 'site/user/pass2';
			$this->load->view('site/layout', $this->data);
		}
		function check_pass2(){
			$user = $this->_get_user_info_pass2();
			if($user){
				return true;
			}else{
				$this->form_validation->set_message(__FUNCTION__, '<p style="font-size:16px; color: red;font-weight: bold;"> Sai mật khẩu cấp 2! </p>');
				return false;
			}
		}

		//lay thong tin cua thanh vien
		private function _get_user_info_pass2(){
			$pass2 = $this->input->post('password2');
			$user_id = $this->session->userdata('user_id_login');
			$this->load->model('user_model');
			$where = array('id'=>$user_id, 'pass2'=>md5($pass2));
			$user = $this->user_model->get_info_rule($where);
			return $user;
		}

	}