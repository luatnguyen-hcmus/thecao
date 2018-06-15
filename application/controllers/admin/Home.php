<?php 
	Class Home extends MY_Controller{
		function index(){

			//tai cac fil thanh toan
			$this->load->model('user_model');
			$this->load->model('transaction_model');
			$this->load->model('news_model');

			// //lay tong doanh thu nap the
			$where = array('type_transaction'=>1);
			//pre($where);
			$amount_total1 = $this->transaction_model->get_sum('amount', $where);
			$this->data['amount_total'] = $amount_total1;


			//tong doanh thu mua the cao
			$wherebuycard = array('type_transaction'=>4);
			$amount_total2 = $this->transaction_model->get_sum('amount', $wherebuycard);
			$this->data['day_total'] = $amount_total2;

			// //thong ke tong so
			$inputnap['where'] =  array('type_transaction'=>1,'status'=>0);
			//pre($inputnap);

			$inputbank['where'] =  array('type_transaction'=>2,'status'=>0);
			
			$inputtcsr['where'] =  array('type_transaction'=>3);
			$inputbuy['where'] =  array('type_transaction'=>4);
			$this->data['total_transaction1'] = $this->transaction_model->get_total($inputnap);
			$this->data['total_transaction2'] = $this->transaction_model->get_total($inputbank);
			$this->data['total_transaction3'] = $this->transaction_model->get_total($inputtcsr);
			$this->data['total_transaction4'] = $this->transaction_model->get_total($inputbuy);
			
			
			$this->data['total_new'] = $this->news_model->get_total();
			$this->data['total_user'] = $this->user_model->get_total();
			
			$this->data['total'] = $this->user_model->get_total();
			$this->data['list'] = $this->user_model->get_list();
			
			
			//lay noi dung cua biên message
			$message1 = $this->session->flashdata('message1');
			$this->data['message1'] = $message1;

			$this->data['temp'] = 'admin/home/index';
			$this->load->view('admin/main', $this->data);
		}
		//dang xuat
		function logout(){
			if($this->session->userdata('login')){
				$this->session->unset_userdata('login');
			}
			redirect(admin_url('login'));
		}
	}