<?php 
	Class Login extends MY_Controller{
		function index(){
			$this->load->library('form_validation');
			$this->load->helper('form');
			if($this->input->post()){
				$this->form_validation->set_rules('login', 'login', 'callback_check_login');
				if($this->form_validation->run()){
					$this->session->set_userdata('login',true);
					
					redirect(admin_url('home'));
				}
			}
			$this->load->view('admin/login/index');
		}
		function check_login(){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$password = md5($password);
			$this->load->model('admin_model');

			$where = array('username'=>$username, 'password'=>$password);
			$admin = $this->admin_model->get_info_rule($where);
			if($admin){
				$this->session->set_userdata('permissions', json_decode($admin->permissions));
				$this->session->set_userdata('admin_id', $admin->id);
				return true;
			}else{
				$this->form_validation->set_message(__FUNCTION__, '<p style="color: red;font-weight: bold;"> Không Đăng nhập thành công! </p>');
				return false;
			}
		}
	}