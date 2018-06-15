<?php 
	Class Pay_card extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('transaction_model');
            $this->load->model('user_model');
            $this->load->model('history_paycard_model');
		}
		function add(){
			$segment = $this->uri->segment(4);
            $segment = intval($segment);
            $transaction = $this->transaction_model->get_info($segment);
            $cashh = 0;
            if(($transaction->cash) == 1){
            	$cashh = 10000;
            }
            else if(($transaction->cash) == 2){
            	$cashh = 20000;
            }
            else if(($transaction->cash) == 3){
            	$cashh = 30000;
            }
            else if(($transaction->cash) == 4){
            	$cashh = 50000;
            }
            else if(($transaction->cash) == 5){
            	$cashh = 100000;
            }
            else if(($transaction->cash) == 6){
            	$cashh = 200000;
            }
            else if(($transaction->cash) == 7){
            	$cashh = 500000;
            }
            else if(($transaction->cash) == 8){
            	$cashh = 1000000;
            }
            
			$this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $this->form_validation->set_rules('seri', 'Mã seri', 'required');
                $this->form_validation->set_rules('code', 'Mã thẻ', 'required');

                if($this->form_validation->run()){
                    $seri = $this->input->post('seri');
                    $code = $this->input->post('code');
                    $user = $this->user_model->get_info($transaction->user_id);
            		$user->bag = $user->bag - $cashh;
                    $data = array(
                    	'id_transaction' => $segment,
                        'seri'     => $seri,
                        'code' => $code,
                        'status' =>1,
                        'created'   => now(),
                    );
                    $user = $this->user_model->get_info($transaction->user_id);
            		$user->bag = $user->bag - $cashh;
                    if($this->history_paycard_model->create($data)){
                        $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công !');
                    }else{
                        $this->session->set_flashdata('message', 'Không thêm được !');
                    }
                    redirect(admin_url('transaction/pay_card/'.$segment));
                }
            }

			//load view
            $this->data['temp'] = 'admin/pay_card/add';
            $this->load->view('admin/main',$this->data);
		}
		function edit(){
			$segment = $this->uri->segment(4);
            $segment = intval($segment);

            $pay_card = $this->history_paycard_model->get_info($segment);
            $this->data['pay_card'] = $pay_card;

			$this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $this->form_validation->set_rules('seri', 'Mã seri', 'required');
                $this->form_validation->set_rules('code', 'Mã thẻ', 'required');

                if($this->form_validation->run()){
                    $seri = $this->input->post('seri');
                    $code = $this->input->post('code');
                    $data = array(
                        'seri'     => $seri,
                        'code' => $code,
                    );
                    if($this->history_paycard_model->update($segment,$data)){
                        $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công !');
                    }else{
                        $this->session->set_flashdata('message', 'Không thêm được !');
                    }
                    redirect(admin_url('transaction/pay_card/'.$_GET['ids']));
                }
            }
			//load view
            $this->data['temp'] = 'admin/pay_card/edit';
            $this->load->view('admin/main',$this->data);
		}
	}
