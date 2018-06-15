<?php 
	Class User extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('user_model');
			
		}
		function index(){
			//kiem tra co thuc hien loc du lieeu hay khong
			$id = $this->input->get('id');
			$id = intval($id);
			$input['where'] = array();
			if($id > 0){
				$input['where']['id'] = $id;
			}
			$email = $this->input->get('findemail');
            if($email){
                $input['where']['email'] = $email;
            }
            $findusername = $this->input->get('findusername');
            if($findusername){
                $input['where']['user_name'] = $findusername;
            }
            $findstatus = $this->input->get('findstatus');
            if($findstatus){
                $input['where']['status'] = $findstatus;
            }

			$list = $this->user_model->get_list($input);
			$this->data['list'] = $list;

			$total = $this->user_model->get_total();
			$this->data['total'] = $total;

			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;

			$this->data['temp'] = 'admin/user/index';
			$this->load->view('admin/main',$this->data);
		}
		function check_username(){
			$username = $this->input->post('username');
			$where = array('username' => $username);
			if($this->user_model->check_exists($where)){
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
				$this->form_validation->set_rules('email', 'Email đăng nhập', 'required|valid_email|callback_check_email');
				$this->form_validation->set_rules('password', 'Mật Khẩu', 'required|min_length[6]');
				$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
				$this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
				$this->form_validation->set_rules('address', 'Địa chỉ', 'required');
				if($this->form_validation->run()){
					
					$password = $this->input->post('password');
					$password = md5($password);

					$data = array(
						'name'     => $this->input->post('name'),
						'email'    => $this->input->post('email'),
						'phone'    => $this->input->post('phone'),
						'address'  => $this->input->post('address'),
						'password' => $password,
						'created'   => now(),
					);
					if($this->user_model->create($data)){
						$this->session->set_flashdata('message', 'Đăng kí thành viên thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không thêm được !');
					}
					redirect(admin_url('user'));
				}
			}

			$this->data['temp'] = 'admin/user/add';
			$this->load->view('admin/main',$this->data);
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
		function edit(){
			$id = $this->uri->rsegment('3');
			$id = intval($id);
			$user = $this->user_model->get_info($id);
			if(!$user){
				$this->session->set_flashdata('message', 'Không tồn tại người dùng này !');
				redirect(admin_url('user'));
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
				
				$this->form_validation->set_rules('status', 'Tình trạng', 'required');

				if($this->form_validation->run()){

					$data = array(
						'name'     => $this->input->post('name'),
						'status'    => $this->input->post('status'),
						
					);
					if($password){
						$data['password'] = md5($password);
					}

					if($this->user_model->update($id, $data)){
						$this->session->set_flashdata('message', 'Chỉnh sửa thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không sửa được !');
					}
					redirect(admin_url('user'));
				}
			}
            
			$this->data['temp'] = 'admin/user/edit';
			$this->load->view('admin/main', $this->data);

		}
		function delete(){
			$id = $this->uri->rsegment('3');
			$id = intval($id);
			$info = $this->user_model->get_info($id);

			//pre($info);

			if(!$info){
				$this->session->set_flashdata('message', 'Không tồn tại người dùng này !');
				redirect(admin_url('user'));
			}
			if($this->user_model->delete($id)){
				$this->session->set_flashdata('message', 'Xóa thành công người dùng có mã số '.$id);
			}else{
					$this->session->set_flashdata('message', 'Không xóa được !');
			}
			redirect(admin_url('user'));
		}
		function lock(){
			$id = $this->uri->rsegment('3');
			$id = intval($id);
			$user = $this->user_model->get_info($id);
			if(!$user){
				$this->session->set_flashdata('message', 'Không tồn tại người dùng này !');
				redirect(admin_url('user'));
			}
			if($user->status == 0){
				$this->session->set_flashdata('message', 'Tài khoản này đã bị khóa rồi !');
				redirect(admin_url('user'));
			}
			if($this->user_model->update($id, ['status'=>0])){
				$this->session->set_flashdata('message', 'Khóa tài khoản thành công !');
			}else{
				$this->session->set_flashdata('message', 'Không sửa được !');
			}
			redirect(admin_url('user'));
		}
	}