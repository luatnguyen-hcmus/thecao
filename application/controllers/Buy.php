<?php 
	Class Buy extends MY_Controller{
		function __construct(){
			parent::__construct();
			//load model san pham
			$this->load->model('transaction_model');
			$this->load->model('hunress_model');
		}

		function index(){
			if(!$this->session->userdata('user_id_login')){
				$this->session->set_flashdata('message', 'Đăng nhập mới được mua thẻ !');
				redirect(base_url());
			}
			$user_id = $this->session->userdata('user_id_login');
			$user = $this->user_model->get_info($user_id);
			if(!$user){
				$this->session->set_flashdata('message', 'có lỗi!');
				redirect(base_url());
			}
			$this->data['user'] = $user;
			$this->db->select('*');
			$this->db->from('transaction', 'id');
			$this->db->join('history_paycard', 'history_paycard.id_transaction = transaction.id');
			$this->db->where('transaction.user_id',$user_id);
			$this->db->where('transaction.type_transaction',4);
			$result = $this->db->get();
			$datas = $result->result_array();
			$this->data['users'] = $datas;

			$input = array();
			$input['where'] = array("status_buy"=>"1");
			$input['order'] = array("id","ASC");

			$typecard = $this->typecard_model->get_list($input);
			//pre($typecard);
			$input = array();
			foreach($typecard as $tc){
				$input['where'] = array('cate_card'=>$tc->id);
				$subs = $this->hunress_model->get_list($input);
				$tc->subs = $subs;
				
			}
			$this->data['typecard'] = $typecard;

			// lay tong so luong tat ca cac giao dich
            $input = array();
            $input['where'] = array('type_transaction'=>4);
            $total_rows = $this->transaction_model->get_total($input);
            $this->data['total_rows'] = $total_rows;
            //load thu vien phan trang
            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;//tong tat ca cac san pham
            $config['base_url'] = site_url('transaction/get_bank');
            $config['per_page'] = 5;//so luong hien thi tren 1 trang
            $config['uri_segment'] = 4;// phan doan hien thi ra so trang tren url
            $config['next_link'] = 'Trang kế tiếp';
            $config['prev_link'] = 'Trang trước';
            //khoi tao phan trang
            $this->pagination->initialize($config);

            $segment = $this->uri->segment(4);
            $segment = intval($segment);

            $input = array();
            $input['limit'] = array($config['per_page'], $segment);
            //kiem tra co thuc hien loc du lieeu hay khong
            $id = $this->input->get('id');
            $id = intval($id);
            $input['where'] = array();
            if($id > 0){
                $input['where']['id'] = $id;
            }

            //lay danh sach giao dich mua the
            $input['where']['type_transaction'] = 4;
            $list = $this->transaction_model->get_list($input);

            $this->data['list'] = $list;



			$this->load->library('form_validation');
			$this->load->helper('form');
			if($this->input->post()){
				$this->form_validation->set_rules('card_type_id', 'Loại thẻ', 'required|callback_check_typecard');
				$this->form_validation->set_rules('cash', 'Mệnh giá', 'required|callback_check_cash');
				$this->form_validation->set_rules('fb', 'Tài khoản facebook', 'required|callback_check_fb');
				$this->form_validation->set_rules('phone', 'Số điện thoại ', 'required');
				$this->form_validation->set_rules('soluong', 'Số lượng thẻ', 'required');
				$user_id = "";
				if($this->session->userdata('user_id_login')){
					$user_id = $this->session->userdata('user_id_login');
				}

				$mg = 0;
				if($this->input->post('cash') == 1){
					$mg =10000;
				}
				else if($this->input->post('cash') == 2){
					$mg =20000;
				}
				else if($this->input->post('cash') == 3){
					$mg =30000;
				}
				else if($this->input->post('cash') == 4){
					$mg =50000;
				}
				else if($this->input->post('cash') == 5){
					$mg =100000;
				}
				else if($this->input->post('cash') == 6){
					$mg =200000;
				}
				else if($this->input->post('cash') == 7){
					$mg =500000;
				}
				else if($this->input->post('cash') == 8){
					$mg =1000000;
				}
				$typee = $this->input->post('card_type_id');
				$inputt = array('cate_card'=>$typee);

				$hunresss = $this->hunress_model->get_info_rule($inputt);
				// echo "chiec khau ".$hunresss->hunress_buy;
				// echo "so tien ".$mg;
				// echo "so luong".$this->input->post('soluong');

				$sotien = $mg * $this->input->post('soluong');
				$amountt = $sotien - ($hunresss->hunress_buy*$mg/100) * $this->input->post('soluong');
				// pre($amountt);

				if($this->form_validation->run()){
					$data = array(
						'type' => $this->input->post('card_type_id'),
						'cash' => $this->input->post('cash'),
						'fb' => $this->input->post('fb'),
						'phone' => $this->input->post('phone'),
						'num' => $this->input->post('soluong'),
						'user_id' => $user_id,
						'type_transaction' => 4,
						'status' => 0,
						'amount' => $amountt,
						'created'   => now(),
					);

					//pre($data['amount']);

					$user_id = $this->session->userdata('user_id_login');
					$user = $this->user_model->get_info($user_id);

					if($user->bag < $data['amount']){
						$this->session->set_flashdata('message', 'Tài khoản không đủ để mua thẻ!');
						redirect(base_url(''));
					}else{
						if($this->transaction_model->create($data)){
							$this->session->set_flashdata('message', 'Mua thành công , nhưng cần phải đợi quản trị viên duyệt!');
						}else{
							$this->session->set_flashdata('message', 'Không rút được !');
						}
						redirect(base_url(''));
					}
				}
			}
	        //hiển thị ra view
	        $this->data['temp'] = 'site/buy/index';
	        $this->load->view('site/layout', $this->data);
		}
		function check_money(){
			sleep(2);
			echo "<script>document.getElementById('msg_err_bank').style.display='none';</script>";
			if((int)$_POST['cs'] == 0){
				echo "chưa nhập mệnh giá";
			}
			else{
				$mg = 0;
				if((int)$_POST['cs'] == 1){
					$mg =10000;
				}
				else if((int)$_POST['cs'] == 2){
					$mg =20000;
				}
				else if((int)$_POST['cs'] == 3){
					$mg =30000;
				}
				else if((int)$_POST['cs'] == 4){
					$mg =50000;
				}
				else if((int)$_POST['cs'] == 5){
					$mg =100000;
				}
				else if((int)$_POST['cs'] == 6){
					$mg =200000;
				}
				else if((int)$_POST['cs'] == 7){
					$mg =500000;
				}
				else if((int)$_POST['cs'] == 8){
					$mg =1000000;
				}

				$tong = $mg * $_POST['sl'];
				echo number_format($tong).' vnd';
			}
		}
		function check_fb(){
			if($this->input->post('fb')){
				$fb = $this->input->post('fb');
				if(strlen(strstr($fb,"https://www.facebook.com/")) > 0){
					return true;
				}else{
					$this->form_validation->set_message(__FUNCTION__, 'Link facebook sai! ');
					return false;
				}
			}
			
		}
		function check_cash(){
			if($this->input->post('cash')){
				$cash = $this->input->post('cash');
				if($cash == "Chọn mệnh giá"){
					$this->form_validation->set_message(__FUNCTION__, 'Chưa chọn mệnh giá thẻ');
					return false;
				}
				return true;
			}
		}
		function check_typecard(){
			if($this->input->post('card_type_id')){
				$cash = $this->input->post('card_type_id');
				if($cash == "Chọn loại thẻ"){
					$this->form_validation->set_message(__FUNCTION__, 'Chưa chọn loại thẻ');
					return false;
				}
				return true;
			}
		}


	}