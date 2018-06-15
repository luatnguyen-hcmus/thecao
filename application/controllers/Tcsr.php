<?php 
	Class Tcsr extends MY_Controller{
		function index(){
			//lay danh sach slide
			$this->load->model('transaction_model');
			$this->load->model('hunress_model');

			//lay noi dung cua biên message
			$message1 = $this->session->flashdata('message1');
			$this->data['message1'] = $message1;

			//lay danh sach san pham moi
			
			if($this->session->userdata('user_id_login') == ""){
				$this->session->set_flashdata('message', 'Đăng nhập mới được rút tiền về tài khoản siêu rẻ !');
				redirect(base_url());
			}
			$input = array();
			$input['where'] = array("status_change"=>"1");
			$input['order'] = array("id","ASC");

			$typecard = $this->typecard_model->get_list($input);
			$input = array();
			foreach($typecard as $tc){
				$input['where'] = array('cate_card'=>$tc->id);
				$subs = $this->hunress_model->get_list($input);
				$tc->subs = $subs;
				
			}
			$this->data['typecard'] = $typecard;
			$this->load->library('form_validation');
			$this->load->helper('form');
			if($this->input->post()){
				$this->form_validation->set_rules('tktcsr', 'Tên chủ thẻ', 'required');
				$this->form_validation->set_rules('sotien', 'Số tiền rút', 'required');
				$this->form_validation->set_rules('sdt', 'Số điện thoại', 'required');
				$this->form_validation->set_rules('pass2', 'Mật khẩu cấp 2', 'required');

				if($this->form_validation->run()){

					$this->load->model('user_model');
					$pass2 = md5($this->input->post('pass2'));
					$where = array('pass2'=>$pass2);
					$user = $this->user_model->get_info_rule($where);
					if($user == ""){
						$this->session->set_flashdata('message1', 'Mật khẩu cấp 2 không trùng khớp !');
						redirect(base_url("/tcsr"));
					}
					$data = array(
						'name_bank' => $this->input->post('tktcsr'),
						'current' => $this->input->post('sotien'),
						'phone' => $this->input->post('sdt'),
						'user_id' => $this->session->userdata('user_id_login'),
						'type_transaction' => 3,
						'status' => 0,
						'created'   => now(),
					);
					
					if($this->transaction_model->create($data)){
						$this->session->set_flashdata('message', 'Rút thành công , nhưng cần phải đợi quản trị viên duyệt!');
					}else{
						$this->session->set_flashdata('message', 'Không rút được !');
					}
					redirect(base_url(''));
				}
			}
			$this->data['temp'] = 'site/tcsr/index';
			$this->load->view('site/layout',$this->data);
		}
	}