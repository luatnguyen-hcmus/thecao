<?php 
	Class MY_Controller extends CI_Controller{
		public $data = array();
		
		function __construct(){
			parent::__construct();
			$this->load->model('transaction_model');
			$controller = $this->uri->segment(1);
			switch ($controller) {
				case 'admin':
					# code...
				$this->load->helper('admin');
				$this->_check_login();
					$inputnap['where'] =  array('type_transaction'=>1,'status'=>0);
					$inputbank['where'] =  array('type_transaction'=>2,'status'=>0);
					$this->data['total_transaction_get'] = $this->transaction_model->get_total($inputnap);
					$this->data['total_transaction_bank'] = $this->transaction_model->get_total($inputbank);

				//kiem tra xem thanh vien da dang nhap chua 
					$admin_id = $this->session->userdata('admin_id');
					$this->data['admin_id'] = $admin_id;
					//neu da dang nhap thanh cong thy lay thong tin thanh vien
					if($admin_id){
						$this->load->model('admin_model');
						$admin_info = $this->admin_model->get_info($admin_id);
						$this->data['admin_info'] = $admin_info;
					}
					break;
				
				default:
					//lay thong bao dau trang
					$this->load->model('info_model'); 
					$where = array();
					$where = array('status'=>1);
					$info_top = $this->info_model->get_info_rule($where);
					//pre($info_top);
					$this->data['info_top'] = $info_top;
					// pre($info_list);
					// //lay thong bao trang dat the
					$this->load->model('info_model');
					$info_change = $this->info_model->get_info(2);
					$this->data['info_change'] = $info_change;

					// //lay thong bao trang mua the
					$this->load->model('info_model');
					$info_buy = $this->info_model->get_info(4);
					$this->data['info_buy'] = $info_buy;

					// //lay thong bao trang rut ve ngan hang
					$this->load->model('info_model');
					$info_bank = $this->info_model->get_info(5);
					$this->data['info_bank'] = $info_bank;

					// //lay thong bao tran rut chuyen tien cho thanh vien
					$this->load->model('info_model');
					$info_menber = $this->info_model->get_info(6);
					$this->data['info_menber'] = $info_menber;

					//lay danh sach HotLine.
					$this->load->model('phone_model');
					$input = array();
					$input['where'] = array('status' => 1);
					$input['limit'] = array(1, 0);
					$phone_list = $this->phone_model->get_list($input);
					$this->data['phone_list'] = $phone_list;

					//lay danh sach cac loai the cao
					$this->load->model('typecard_model');
					$input = array();
					$input['where'] = array('status_change' => 1);
					$input['order'] = array('sort_order','ASC');
					$card_list = $this->typecard_model->get_list($input);
					$this->data['card_list'] = $card_list;

					//lay danh sach danh muc san pham.
					$this->load->model('catalog_model');
					$input = array();
					$input['where'] = array('parent_id' => 0);
					$catalog_list = $this->catalog_model->get_list($input);
					foreach($catalog_list as $row){
						$input['where'] = array('parent_id' => $row->id);
						$subs = $this->catalog_model->get_list($input);
						$row->subs = $subs;
					}
					$this->data['catalog_list'] = $catalog_list;

					//lay danh sach bai viet moi.
					$this->load->model('news_model');
					$input = array();
					$input['limit'] = array(5, 0);
					$news_list = $this->news_model->get_list($input);
					$this->data['news_list'] = $news_list;

					//kiem tra xem thanh vien da dang nhap chua 
					$user_id_login = $this->session->userdata('user_id_login');
					$this->data['user_id_login'] = $user_id_login;
					//neu da dang nhap thanh cong thy lay thong tin thanh vien
					if($user_id_login){
						$this->load->model('user_model');
						$user_info = $this->user_model->get_info($user_id_login);
						$this->data['user_info'] = $user_info;
					}

					


					//goi toi thu vien cart
					$this->load->library('cart');
					$this->data['total_items'] = $this->cart->total_items();
					break;
			}
		}
		private function _check_login(){
			$controller = $this->uri->rsegment('1');
			$controller = strtolower($controller);

			$login = $this->session->userdata('login');
			if(!$login  && $controller != 'login'){
				redirect(admin_url('login'));
			}
			if($login && $controller == 'login'){
				redirect(admin_url('home'));
			}else if(!in_array($controller, array('login', 'home'))){
				// kiem tra quyen
				$admin_id = $this->session->userdata('admin_id');
				$admin_root = $this->config->item('root_admin');

				if($admin_id != $admin_root){
					$permissions_admin = $this->session->userdata('permissions');
					$controller = $this->uri->rsegment(1);
					$action = $this->uri->rsegment(2);
					$check = true;


					if(!isset($permissions_admin->{$controller})){
						$check = false;
					}

					$permissions_actions = $permissions_admin->{$controller};

					if(!in_array($action, $permissions_actions)){
						$check = false;
					}
					if(!$check){
						$this->session->set_flashdata('message1', 'Bạn Không có Quyền truy cập vào trang này !');
						redirect(base_url('admin'));
					}
				}
				

			}
		}
	}
 