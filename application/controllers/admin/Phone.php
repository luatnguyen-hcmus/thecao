<?php 
	Class Phone extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('phone_model');
			
		}
		function index(){
			$input = array();
			$list = $this->phone_model->get_list($input);
			$this->data['list'] = $list;

			$total = $this->phone_model->get_total();
			$this->data['total'] = $total;

			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;
			$this->data['temp'] = 'admin/phone/index';
			$this->load->view('admin/main',$this->data);
		}
		function check_username(){
			$username = $this->input->post('username');
			$where = array('phone_show' => $username);
			if($this->phone_model->check_exists($where)){
				$this->form_validation->set_message(__FUNCTION__, 'Hotline tồn tại');
				return false;
			}
			return true;
		}
		function add(){
			$this->load->library('form_validation');
			$this->load->helper('form');
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'Hotline', 'required');
				$this->form_validation->set_rules('username', 'Hotline Hiển Thị', 'required|callback_check_username');
				

				if($this->form_validation->run()){
					$name = $this->input->post('name');
					$username = $this->input->post('username');
					$phone = $this->input->post('phone');
					$data = array(
						'phone'     => $name,
						'phone_show' => $username,
						'status' => $phone,
					);
					

					if($this->phone_model->create($data)){
						$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không thêm được !');
					}
					redirect(admin_url('phone'));
				}
			}
			

			$this->data['temp'] = 'admin/phone/add';
			$this->load->view('admin/main',$this->data);
		}
		function edit(){
			$id = $this->uri->rsegment('3');
			$id = intval($id);

			$this->load->library('form_validation');
			$this->load->helper('form');

			$info = $this->phone_model->get_info($id);

			//pre($info);

			if(!$info){
				$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này !');
				redirect(admin_url('phone'));
			}
			$this->data['info'] = $info;

			if($this->input->post()){

				$this->form_validation->set_rules('name', 'Holine', 'required');
				$this->form_validation->set_rules('username', 'Hotline Hiển Thị', 'required');
				
				
				if($this->form_validation->run()){
					$name = $this->input->post('name');
					$username = $this->input->post('username');
					$phone = $this->input->post('phone');
					
					$data = array(
						'phone'     => $name,
						'phone_show' => $username,
						'status'    => $phone,
					);					

					if($this->phone_model->update($id, $data)){
						$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công !');
					}else{
						$this->session->set_flashdata('message', 'Không cập nhật được !');
					}
					redirect(admin_url('phone'));
				}
				
			}

			
            
			$this->data['temp'] = 'admin/phone/edit';
			$this->load->view('admin/main', $this->data);

		}
		function delete(){

			$id = $this->uri->rsegment('3');
			$id = intval($id);
			$info = $this->phone_model->get_info($id);

			//pre($info);

			if(!$info){
				$this->session->set_flashdata('message', 'Không tồn tại hotlineviên này !');
				redirect(admin_url('phone'));
			}
			if($this->phone_model->delete($id)){
				$this->session->set_flashdata('message', 'Xóa thành công hotline có mã số '.$id);
			}else{
					$this->session->set_flashdata('message', 'Không xóa được !');
			}
			redirect(admin_url('phone'));
		}
		
	}