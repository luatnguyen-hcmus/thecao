<?php 
	Class Admin extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('admin_model');
			
		}
		function index(){
			$input = array();
			$list = $this->admin_model->get_list($input);
			$this->data['list'] = $list;

			$total = $this->admin_model->get_total();
			$this->data['total'] = $total;

			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;
			$this->data['temp'] = 'admin/admin/index';
			$this->load->view('admin/main',$this->data);
		}
		function check_username(){
			$username = $this->input->post('username');
			$where = array('username' => $username);
			if($this->admin_model->check_exists($where)){
				$this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
				return false;
			}
			return true;
		}
		function add(){
			$this->load->library('form_validation');
			$this->load->helper('form');
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
				$this->form_validation->set_rules('username', 'Tài Khoản đăng nhập', 'required|callback_check_username');
				$this->form_validation->set_rules('password', 'Mật Khẩu', 'required|min_length[6]');
				$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');

				if($this->form_validation->run()){
					$name = $this->input->post('name');
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$data = array(
						'name'     => $name,
						'username' => $username,
						'password' => md5($password)
					);
					$permissions = $this->input->post('permissions');
					$data['permissions'] = json_encode($permissions);

					if($this->admin_model->create($data)){
						$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không thêm được !');
					}
					redirect(admin_url('admin'));
				}
			}
			$this->config->load('permissions', true);
			
			// $this->config->load('config', true);
			// $configss = $this->config->item('config');
			// $this->config->load('database', true);
			// $database = $this->config->item('database');
			// pre($configss);

			$config_permissions = $this->config->item('permissions');
			$this->data['config_permissions'] = $config_permissions;


			$this->data['temp'] = 'admin/admin/add';
			$this->load->view('admin/main',$this->data);
		}
		function edit(){
			$id = $this->uri->rsegment('3');
			$id = intval($id);

			$this->load->library('form_validation');
			$this->load->helper('form');

			$info = $this->admin_model->get_info($id);

			//pre($info);

			if(!$info){
				$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này !');
				redirect(admin_url('admin'));
			}
			$info->permissions = json_decode($info->permissions);
			$this->data['info'] = $info;

			if($this->input->post()){

				$this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
				$this->form_validation->set_rules('username', 'Tài Khoản đăng nhập', 'required');
				$password = $this->input->post('password');
				if($password){
					$this->form_validation->set_rules('password', 'Mật Khẩu', 'required|min_length[6]');
					$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
				}
				if($this->form_validation->run()){
					$name = $this->input->post('name');
					$username = $this->input->post('username');
					
					$data = array(
						'name'     => $name,
						'username' => $username,
						
					);
					if($password){
						$data['password'] = md5($password);
					}

					$permissions = $this->input->post('permissions');
					$data['permissions'] = json_encode($permissions);

					if($this->admin_model->update($id, $data)){
						$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không cập nhật được !');
					}
					redirect(admin_url('admin'));
				}
				
			}

			$this->config->load('permissions', true);
			$config_permissions = $this->config->item('permissions');
			$this->data['config_permissions'] = $config_permissions;
            
			$this->data['temp'] = 'admin/admin/edit';
			$this->load->view('admin/main', $this->data);

		}
		function delete(){

			$id = $this->uri->rsegment('3');
			$id = intval($id);
			$info = $this->admin_model->get_info($id);

			//pre($info);

			if(!$info){
				$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này !');
				redirect(admin_url('admin'));
			}
			if($this->admin_model->delete($id)){
				$this->session->set_flashdata('message', 'Xóa thành công admin có mã số '.$id);
			}else{
					$this->session->set_flashdata('message', 'Không xóa được !');
			}
			redirect(admin_url('admin'));
		}
		
	}