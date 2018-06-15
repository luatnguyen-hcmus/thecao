<?php 
	Class Home extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('transaction_model');
			$this->load->model('typecard_model');
			$this->load->model('hunress_model');
			$this->load->model('cash_card_model');
		}
		function index(){
			//lay noi dung cua biên message
			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;
			$input_cash['where'] = array('status'=>1);
			$input_cash['order'] = array('id','ASC');
			$cash_card = $this->cash_card_model->get_list($input_cash);
			$this->data['cash_card'] = $cash_card;

			$this->load->library('form_validation');
			$this->load->helper('form');
			$input_type['where'] = array('type_transaction'=>1,'user_id'=>$this->session->userdata('user_id_login'));
			$transaction_change = $this->transaction_model->get_list($input_type);
			$dem = 0;
			foreach ($transaction_change as $ts) {
				if($ts->pin == $this->input->post('pin') && $ts->seri == $this->input->post('seri')){
					$dem ++;
					// $this->session->set_flashdata('message', 'Mã số sai!');
					// redirect(base_url());
				}
			}
			if($dem >= 2){
				$this->session->set_flashdata('message', 'Bạn đã nhập sai mã số quá 3 lần, tạm thời tài khoản bạn sẽ bị khóa ,vui lòng liên hệ ADMIN theo số hotline trên đầu trang!');
				$id_user = $this->session->userdata('user_id_login');
				$this->user_model->update($id_user,['status'=>0]);
				$this->session->unset_userdata('user_id_login');
				redirect(base_url());
			}


			if($this->input->post()){
				$this->form_validation->set_rules('card_type_id', 'Loại thẻ', 'required');
				$this->form_validation->set_rules('cash', 'Mệnh giá', 'required|callback_check_cash');
				$this->form_validation->set_rules('pin', 'Mã thẻ', 'required');
				$this->form_validation->set_rules('seri', 'Mã số seri', 'required');

				if($this->session->userdata('user_id_login') == ""){
					$this->session->set_flashdata('message', 'Đăng nhập để được nạp tiền !');
					redirect(base_url());
				}

				$type_cards = $this->input->post('card_type_id');
				$typecardd = "";
				if(intval($type_cards) > 0){
					$typecardd = $this->typecard_model->get_info($type_cards);
				}
				if($typecardd != "" && $this->input->post('pin') != "" && $this->input->post('pin') != "" && $this->input->post('seri') != ""){
					if((strlen($this->input->post('pin')) == $typecardd->min_code || strlen($this->input->post('pin')) == $typecardd->max_code) && (strlen($this->input->post('seri')) == $typecardd->min_seri || strlen($this->input->post('seri')) == $typecardd->max_seri)){
					
						//$this->form_validation->set_rules('kieu', 'Kiểu xử lí', 'required|callback_check_kieu');
						$inputsss = array('cate_card'=>$this->input->post('card_type_id'));
						$hunresss = $this->hunress_model->get_info_rule($inputsss);
						// pre($typecardd->featured_change);
						if($typecardd->featured_change == 0){
							$this->session->set_flashdata('message', 'Hiện tại thẻ này đang bảo trì, xin vui lòng quay lại lân sau');
							redirect(base_url());
						}
						if($this->form_validation->run()){
							$input_cashs = array('status'=>1, 'id'=>$this->input->post('cash'));
							$casshh = $this->cash_card_model->get_info_rule($input_cashs);
							if(!$casshh){
								$this->session->set_flashdata('message', 'Sai mệnh giá!');
								redirect(base_url(''));
							}
							$data = array(
								'type'    => $this->input->post('card_type_id'),
								'cash'    => $this->input->post('cash'),
								'pin'     => $this->input->post('pin'),
								'seri'    => $this->input->post('seri'),
								// 'kieu'    => $this->input->post('kieu'),
								'user_id' => $this->session->userdata('user_id_login'),
								'status'  => 0,
								'type_transaction' => 1,
								'amount' => $casshh->cash  - $casshh->cash * ($hunresss->hunress_change / 100),
								'created' => now(),
							);

							if($this->transaction_model->create($data)){
								$this->session->set_flashdata('message', 'Nạp thành công !,nhưng đợi admin duyệt');
							}else{
								$this->session->set_flashdata('message', 'Không nạp được !');
							}
						}
					}

					else{
						$this->session->set_flashdata('message', 'Sai mã thẻ hoặc mã seri!');
						redirect(base_url(''));
					}
				}
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
			$this->data['temp'] = 'site/home/index';
			$this->load->view('site/layout',$this->data);
		}
		
		function check_cash(){
			$cash = $this->input->post('cash');
			if($cash == "Chọn mệnh giá"){
				$this->form_validation->set_message(__FUNCTION__, 'Chưa chọn mệnh giá thẻ');
				return false;
			}
			return true;
		}
		// function check_kieu(){
		// 	$cash = $this->input->post('kieu');
		// 	if($cash == "Chọn kiểu nạp"){
		// 		$this->form_validation->set_message(__FUNCTION__, 'Chưa chọn kiểu nạp');
		// 		return false;
		// 	}
		// 	return true;
		// }
		function rule(){
			$this->data['temp'] = 'site/home/rule';
			$this->load->view('site/layout', $this->data);
		}
	}