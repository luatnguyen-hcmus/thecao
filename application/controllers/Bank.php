<?php 
	Class Bank extends MY_Controller{
		function index(){
			//lay danh sach slide
			$this->load->model('transaction_model');
			$this->load->model('hunress_model');
			//lay noi dung cua biên message
			$message1 = $this->session->flashdata('message1');
			$this->data['message1'] = $message1;

			//lay danh sach san pham moi
			
			if($this->session->userdata('user_id_login') == ""){
				$this->session->set_flashdata('message', 'Đăng nhập mới được rút tiền về tài khoản ngân hàng !');
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
				$this->form_validation->set_rules('tenchuthe', 'Tên chủ thẻ', 'required');
				$this->form_validation->set_rules('stk', 'Số tài khoản', 'required');
				$this->form_validation->set_rules('sothe', 'Mã số trên thẻ', 'required');
				$this->form_validation->set_rules('type_bank', 'Tên ngân hàng và chi nhánh ', 'required');
				$this->form_validation->set_rules('sotien', 'Số tiền rút', 'required');
				$this->form_validation->set_rules('sdt', 'Số điện thoại', 'required');
				$this->form_validation->set_rules('pass2', 'Mật khẩu cấp 2', 'required');

				if($this->form_validation->run()){

					$this->load->model('user_model');
					$pass2 = md5($this->input->post('pass2'));
					$where = array('id'=>$this->session->userdata('user_id_login'), 'pass2'=>$pass2);
					$user = $this->user_model->get_info_rule($where);

					if($user == ""){
						$this->session->set_flashdata('message1', 'Mật khẩu cấp 2 không trùng khớp !');
						redirect(base_url("/bank"));
					}
					
					if($user->bag < 100000){
						$this->session->set_flashdata('message1', 'Số tiền rút phải từ 100.000 vnd trở lên!');
						redirect(base_url("/bank"));
					}

					if(strlen($this->input->post('sdt')) < 10 || strlen($this->input->post('sdt')) > 11){
						$this->session->set_flashdata('message1', 'Số điện thoại không đúng!');
						redirect(base_url("/bank"));
					}

					if($this->input->post('sotien') >= ($user->bag - 11000)){
						$this->session->set_flashdata('message1', 'Số dư hiện tại không đủ!');
						redirect(base_url("/bank"));
					}



					$data = array(
						'name_bank' => $this->input->post('tenchuthe'),
						'code_bank' => $this->input->post('stk'),
						'code_open' => $this->input->post('sothe'),
						'type_bank' => $this->input->post('type_bank'),
						'type_place' => $this->input->post('type_place'),
						'current' => $this->input->post('sotien'),
						'phone' => $this->input->post('sdt'),
						'user_id' => $this->session->userdata('user_id_login'),
						'type_transaction' => 2,
						'status' => 0,
						'created'   => now(),
						'date_create' => date('Y-m-d', now()),
					);
					if($this->transaction_model->create($data)){
						$this->user_model->update($this->session->userdata('user_id_login'),['bag'=>$user->bag - $this->input->post('sotien')-11000]);
						$this->session->set_flashdata('message', 'Rút thành công , nhưng cần phải đợi quản trị viên duyệt!');
					}else{
						$this->session->set_flashdata('message', 'Không rút được !');
					}
					redirect(base_url(''));
				}
			}

			$this->data['temp'] = 'site/bank/index';
			$this->load->view('site/layout',$this->data);
		}
	}