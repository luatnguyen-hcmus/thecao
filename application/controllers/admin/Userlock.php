<?php 
	Class Userlock extends MY_Controller{
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
			$input['where']['status'] = 0;
			$list = $this->user_model->get_list($input);
			$this->data['list'] = $list;

			$total = $this->user_model->get_total($input);
			$this->data['total'] = $total;

			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;
			$this->data['temp'] = 'admin/userlock/index';
			$this->load->view('admin/main',$this->data);
		}
		function edit(){
			$id = $this->uri->rsegment('3');
			$id = intval($id);
			$user = $this->user_model->get_info($id);
			if(!$user){
				$this->session->set_flashdata('message', 'Không tồn tại người dùng này !');
				redirect(admin_url('userlock'));
			}
			$this->data['user'] = $user;
			$this->load->library('form_validation');
			$this->load->helper('form');
			if($this->input->post()){
				$password = $this->input->post('password');
				$this->form_validation->set_rules('user', 'Tên', 'required|min_length[8]');

				if($password){
					$this->form_validation->set_rules('password', 'Mật Khẩu', 'required|min_length[6]');
					$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
				}
				

				if($this->form_validation->run()){

					$data = array(
						'status'     => $this->input->post('status'),
					);
					if($password){
						$data['password'] = md5($password);
					}

					if($this->user_model->update($id, $data)){
						$this->session->set_flashdata('message', 'Chỉnh sửa thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không sửa được !');
					}
					redirect(admin_url('userlock'));
				}
			}
            
			$this->data['temp'] = 'admin/userlock/edit';
			$this->load->view('admin/main', $this->data);

		}
	}
