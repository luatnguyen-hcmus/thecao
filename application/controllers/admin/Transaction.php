<?php 
	Class Transaction extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('transaction_model');
            $this->load->model('user_model');
            $this->load->model('history_paycard_model');
		}

        function index(){
            redirect(base_url());
            // lay tong so luong tat ca cac giao dich
            $total_rows = $this->transaction_model->get_total();
            $this->data['total_rows'] = $total_rows;
            //load thu vien phan trang
            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;//tong tat ca cac san pham
            $config['base_url'] = admin_url('transaction/index');
            $config['per_page'] = 5;//so luong hien thi tren 1 trang
            $config['uri_segment'] = 4;// pha doan hien thi ra so trang tren url
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
            
            

            //lay danh sach san pham
            $list = $this->transaction_model->get_list($input);
            $this->data['list'] = $list;

            //lay noi dung cua biên message
            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;

            //load view
            $this->data['temp'] = 'admin/transaction/index';
            $this->load->view('admin/main',$this->data);
        }


        //hien thi danh sach giao dich
		function put(){
			// lay tong so luong tat ca cac giao dich
            $input = array();
            $input['where'] = array('type_transaction'=>1);
			
			//kiem tra co thuc hien loc du lieeu hay khong
			$id = $this->input->get('id');
			$id = intval($id);
			$input['where'] = array();
			if($id > 0){
				$input['where']['id'] = $id;
			}
			$code = $this->input->get('findcode');
            if($code){
                $input['where']['pin'] = $code;
            }
            $seri = $this->input->get('findseri');
            if($seri){
                $input['where']['seri'] = $seri;
            }
            
			$findday = $this->input->get('findday');
            if($findday){
                $input['where']['date_create'] = $findday;
            }
            $finddayout = $this->input->get('finddayout');
            if($finddayout && $findday){
                $input['where'] = array('date_create >= ' => $findday, 'date_create <=' => $finddayout);
            }
            $findstatus = $this->input->get('findstatus');
            if($findstatus){
                $input['where']['status'] = $findstatus;
            }
			//lay danh sach san pham
            $input['where']['type_transaction'] = 1;
            
            $total_rows = $this->transaction_model->get_total($input);
            $this->data['total_rows'] = $total_rows;
            //load thu vien phan trang
            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;//tong tat ca cac san pham
            $config['base_url'] = admin_url('transaction/put');
            $config['per_page'] = 15;//so luong hien thi tren 1 trang
            $config['uri_segment'] = 4;// phan doan hien thi ra so trang tren url
            $config['next_link'] = 'Trang kế tiếp';
            $config['prev_link'] = 'Trang trước';
            //khoi tao phan trang
            $this->pagination->initialize($config);

            $segment = $this->uri->segment(4);
            $segment = intval($segment);        
            $input['limit'] = array($config['per_page'], $segment);

           // pre($input);
            $where = array();
            foreach($input as $ip){
                array_push($where, $ip);
            }

            //pre($input);
            $amount_total1 = $this->transaction_model->get_sum('amount', $where[0]);
            $this->data['amount_total1'] = $amount_total1;
            //pre($amount_total1);
			$list = $this->transaction_model->get_list($input);
			$this->data['list'] = $list;

			//lay noi dung cua biên message
			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;

			//load view
			$this->data['temp'] = 'admin/transaction/put';
			$this->load->view('admin/main',$this->data);
		}

        //hien thi danh sach giao dich
        function get_bank(){
            // lay tong so luong tat ca cac giao dich
            $input = array();
            $input['where'] = array('type_transaction'=>2);
            
            //kiem tra co thuc hien loc du lieeu hay khong
            $id = $this->input->get('id');
            $id = intval($id);
            $input['where'] = array();
            if($id > 0){
                $input['where']['id'] = $id;
            }
            $stk = $this->input->get('stk');
            if($stk){
                $input['where']['code_bank'] = $stk;
            }
            $sothe = $this->input->get('sothe');
            if($sothe){
                $input['where']['code_open'] = $sothe;
            }
            
            
            $findday = $this->input->get('findday');
            if($findday){
                $input['where']['date_create'] = $findday;
            }
            $finddayout = $this->input->get('finddayout');
            if($finddayout && $findday){
                $input['where'] = array('date_create >= ' => $findday, 'date_create <=' => $finddayout);
            }
            $findstatus = $this->input->get('findstatus');
            if($findstatus){
                $input['where']['status'] = $findstatus;
            }

            //lay danh sach san pham
            $input['where']['type_transaction'] = 2;

            $total_rows = $this->transaction_model->get_total($input);
            $this->data['total_rows'] = $total_rows;
            //load thu vien phan trang
            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;//tong tat ca cac san pham
            $config['base_url'] = admin_url('transaction/get_bank');
            $config['per_page'] = 5;//so luong hien thi tren 1 trang
            $config['uri_segment'] = 4;// phan doan hien thi ra so trang tren url
            $config['next_link'] = 'Trang kế tiếp';
            $config['prev_link'] = 'Trang trước';
            //khoi tao phan trang
            $this->pagination->initialize($config);

            $segment = $this->uri->segment(4);
            $segment = intval($segment);

            $input['limit'] = array($config['per_page'], $segment);

            //pre($input);
            $where = array();
            foreach($input as $ip){
                array_push($where, $ip);
            }
            //pre($where);
            $amount_total1 = $this->transaction_model->get_sum('current', $where[0]);
            $this->data['amount_total1'] = $amount_total1;

            $list = $this->transaction_model->get_list($input);

            $this->data['list'] = $list;

            //lay noi dung cua biên message
            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;

            //load view
            $this->data['temp'] = 'admin/transaction/bank';
            $this->load->view('admin/main',$this->data);
        }
        //hien thi danh sach giao dich
        function get_tcsr(){

            // lay tong so luong tat ca cac giao dich
            $input = array();
            $input['where'] = array('type_transaction'=>3);
            $total_rows = $this->transaction_model->get_total($input);
            $this->data['total_rows'] = $total_rows;
            //load thu vien phan trang
            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;//tong tat ca cac san pham
            $config['base_url'] = admin_url('transaction/get_bank');
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
            
            

            //lay danh sach san pham
            $input['where']['type_transaction'] = 3;
            $list = $this->transaction_model->get_list($input);

            $this->data['list'] = $list;

            //lay noi dung cua biên message
            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;

            //load view
            $this->data['temp'] = 'admin/transaction/tcsr';
            $this->load->view('admin/main',$this->data);
        }


        //hien thi danh sach giao dich
        function buy(){
            // lay tong so luong tat ca cac giao dich
            $input = array();
            $input['where'] = array('type_transaction'=>4);
            $total_rows = $this->transaction_model->get_total($input);
            $this->data['total_rows'] = $total_rows;
            //load thu vien phan trang
            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;//tong tat ca cac san pham
            $config['base_url'] = admin_url('transaction/get_bank');
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
            
            

            //lay danh sach san pham
            $input['where']['type_transaction'] = 4;
            $list = $this->transaction_model->get_list($input);

            $this->data['list'] = $list;

            //lay noi dung cua biên message
            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;

            //load view
            $this->data['temp'] = 'admin/transaction/buy';
            $this->load->view('admin/main',$this->data);
        }

        // them sp moi
        function add(){
            //lay danh muc san pham
            $this->load->model('catalog_model');
            $input = array();
            $input['where'] = array('parent_id'=>0);
            $catalogs = $this->catalog_model->get_list($input);
            foreach($catalogs as $row){
                $input['where'] = array('parent_id'=>$row->id);
                $subs = $this->catalog_model->get_list($input);
                $row->subs = $subs;
            }
            $this->data['catalogs'] = $catalogs;

            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $this->form_validation->set_rules('name', 'Tên', 'required');
                $this->form_validation->set_rules('catalog', 'Thể Loại', 'required');
                $this->form_validation->set_rules('price', 'Giá', 'required');

                if($this->form_validation->run()){
                    $name = $this->input->post('name');
                    $catalog_id = $this->input->post('catalog');
                    $price = $this->input->post('price');
                    $price = str_replace(',', '', $price);

                    $discount = $this->input->post('discount');
                    $discount = str_replace(',', '', $discount);

                    //lay ten file anh minh hoa duoc update len
                    $this->load->library('upload_library');
                    $upload_path = './upload/transaction';
                    $upload_data = $this->upload_library->upload($upload_path, 'image');

                    $image_link = '';
                    if(isset($upload_data['file_name'])){
                        $image_link = $upload_data['file_name'];
                    }
                    
                    //up load cac anh kem theo
                    $image_list = array();
                    $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                    $image_list = json_encode($image_list);

                    $data = array(
                        'name'     => $name,
                        'catalog_id' => $catalog_id,
                        'price'     => $price,
                        'image_link'     => $image_link,
                        'image_list'     => $image_list,
                        'discount'    => $discount,
                        'warranty'    => $this->input->post('warranty'),
                        'gifts'       => $this->input->post('gifts'),
                        'site_title'  => $this->input->post('site_title'),
                        'meta_desc'  => $this->input->post('meta_desc'),
                        'meta_key'  => $this->input->post('meta_key'),
                        'content'  => $this->input->post('content'),
                    );
                    if($this->transaction_model->create($data)){
                        $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công !');
                    }else{
                        $this->session->set_flashdata('message', 'Không thêm được !');
                    }
                    redirect(admin_url('transaction'));
                }
            }
            //load view
            $this->data['temp'] = 'admin/transaction/add';
            $this->load->view('admin/main',$this->data);
        }

        // sua san pham
        function edit(){

            $id = $this->uri->rsegment('3');
            $transaction = $this->transaction_model->get_info($id);
            if(!$transaction){
                $this->session->set_flashdata('message', 'Không tồn tại sản phẩm có mã này !');
                redirect(admin_url('transaction'));
            }
            $this->data['transaction'] = $transaction;
            
            //lay danh muc san pham
            $this->load->model('catalog_model');
            $input = array();
            $input['where'] = array('parent_id'=>0);
            $catalogs = $this->catalog_model->get_list($input);
            foreach($catalogs as $row){
                $input['where'] = array('parent_id'=>$row->id);
                $subs = $this->catalog_model->get_list($input);
                $row->subs = $subs;
            }
            $this->data['catalogs'] = $catalogs;

            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $this->form_validation->set_rules('name', 'Tên', 'required');
                $this->form_validation->set_rules('catalog', 'Thể Loại', 'required');
                $this->form_validation->set_rules('price', 'Giá', 'required');

                if($this->form_validation->run()){
                    $name = $this->input->post('name');
                    $catalog_id = $this->input->post('catalog');
                    $price = $this->input->post('price');
                    $price = str_replace(',', '', $price);

                    $discount = $this->input->post('discount');
                    $discount = str_replace(',', '', $discount);
                    //lay ten file anh minh hoa duoc update len
                    $this->load->library('upload_library');
                    $upload_path = './upload/transaction';
                    $upload_data = $this->upload_library->upload($upload_path, 'image');

                    $image_link = '';
                    if(isset($upload_data['file_name'])){
                        $image_link = $upload_data['file_name'];
                    }
                    
                    //up load cac anh kem theo
                    $image_list = array();
                    $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                    $image_list_json = json_encode($image_list);

                    $data = array(
                        'name'     => $name,
                        'catalog_id' => $catalog_id,
                        'price'     => $price,
                        'discount'    => $discount,
                        'warranty'    => $this->input->post('warranty'),
                        'gifts'       => $this->input->post('gifts'),
                        'site_title'  => $this->input->post('site_title'),
                        'meta_desc'  => $this->input->post('meta_desc'),
                        'meta_key'  => $this->input->post('meta_key'),
                        'content'  => $this->input->post('content'),
                        'created'   => now(),
                    );
                    if($image_link != ""){
                        $data['image_link']     = $image_link;
                    }
                    if(!empty($image_list)){
                        $data['image_list'] = $image_list_json;
                    }
                    if($this->transaction_model->update($transaction->id, $data)){
                        $this->session->set_flashdata('message', 'Chỉnh sửa thành công !');
                    }else{
                        $this->session->set_flashdata('message', 'Không sửa được !');
                    }
                    redirect(admin_url('transaction'));
                }
            }
            //load view
            $this->data['temp'] = 'admin/transaction/edit';
            $this->load->view('admin/main',$this->data);
        }
        function del(){
            $id = $this->uri->rsegment(3);
            $this->_del_id($id);
            $this->session->set_flashdata('message', 'Xóa thành công !');
            redirect(admin_url('transaction'));
        }
        //xoa nhieu  san pham
        function del_all(){
            $ids = $this->input->post('ids');
            foreach($ids as $id){
                $this->_del_id($id);
            }
        }
        private function _del_id($id){
            $transaction = $this->transaction_model->get_info($id);
            if(!$transaction){
                $this->session->set_flashdata('message', 'Không tồn tại giao dịch này !');
                redirect(admin_url('transaction'));
            }
            //thuc hien xoa san pham
            $this->transaction_model->delete($id);
            


        }
        function pay_card(){
            $id = $this->uri->rsegment('3');
            $where = array('id'=>$id);
            $transaction = $this->transaction_model->get_info_rule($where);
            $this->data['transaction'] = $transaction;
            if(!$transaction){
                $this->session->set_flashdata('message', 'Không tồn tại sản phẩm có mã này !');
                redirect(admin_url('transaction'));
            }

            $user = $this->user_model->get_info($transaction->user_id);
            $this->data['user'] = $user;
            // lay tong so luong tat ca cac giao dich
            $input = array();
            $input['where'] = array('id_transaction'=>$id);
            $total_rows = $this->history_paycard_model->get_total($input);
            $this->data['total_rows'] = $total_rows;

            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;//tong tat ca cac san pham
            $config['base_url'] = admin_url('transaction/pay_card/'.$id);
            $config['per_page'] = 5;//so luong hien thi tren 1 trang
            $config['uri_segment'] = 5;// phan doan hien thi ra so trang tren url
            $config['next_link'] = 'Trang kế tiếp';
            $config['prev_link'] = 'Trang trước';
            //khoi tao phan trang
            $this->pagination->initialize($config);

            $segment = $this->uri->segment(5);
            $segment = intval($segment);

            $input = array();
            $input['limit'] = array($config['per_page'], $segment);
            //kiem tra co thuc hien loc du lieeu hay khong
            $idget = $this->input->get('id');
            $idget = intval($idget);
            $input['where'] = array();
            
            if($idget > 0){
                $input['where']['id'] = $idget;
               
            }
            //lay danh sach san pham
            $input['where']['id_transaction'] = $id;
            
            $list = $this->history_paycard_model->get_list($input);
            $this->data['list'] = $list;

            //lay noi dung cua biên message
            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;

            $this->data['temp'] = 'admin/history_paycard/index';
            $this->load->view('admin/main',$this->data);
        }
        
        function process(){
            $id = $this->uri->rsegment(3);
            $transactions = $this->transaction_model->get_info($id);

            if(!$transactions || $transactions->type_transaction != 1){
                $this->session->set_flashdata('message', 'Không tồn tại giao dịch có mã này !');
                redirect(admin_url('transaction/put'));
            }
            if($transactions->status == 1 || $transactions->status == 2){
                $this->session->set_flashdata('message', 'Giao dịch đã giao dịch rồi !');
                redirect(admin_url('transaction/put'));
            }
            $inputstransaction= array('status' => 1);
            $users = $this->user_model->get_info($transactions->user_id);
            $inputsuser= array('bag' =>  $users->bag + $transactions->amount);
            $this->transaction_model->update($id,$inputstransaction);
            $this->user_model->update($transactions->user_id,$inputsuser);
            $this->session->set_flashdata('message', 'XỦ Lí giao dịch thành công !');
            redirect(admin_url('transaction/put'));
        }
        function process_error(){
            $id = $this->uri->rsegment(3);
            $transactions = $this->transaction_model->get_info($id);
            if(!$transactions || $transactions->type_transaction != 1){
                $this->session->set_flashdata('message', 'Không tồn tại giao dịch có mã này !');
                redirect(admin_url('transaction/put'));
            }
            if($transactions->status == 1 || $transactions->status == 2){
                $this->session->set_flashdata('message', ' Giao dịch đã giao dịch rồi !');
                redirect(admin_url('transaction/put'));
            }
            $inputstransaction= array('status' => 2);
            $this->transaction_model->update($id,$inputstransaction);
            $this->session->set_flashdata('message', 'xử lí giao dịch thành công !');
            redirect(admin_url('transaction/put'));
        }


         function process_bank(){
            $id = $this->uri->rsegment(3);
            $transactions = $this->transaction_model->get_info($id);

            if(!$transactions || $transactions->type_transaction != 2){
                $this->session->set_flashdata('message', 'Không tồn tại giao dịch có mã này !');
                redirect(admin_url('transaction/get_bank'));
            }
            if($transactions->status == 1 || $transactions->status == 2){
                $this->session->set_flashdata('message', 'Giao dịch đã giao dịch rồi !');
                redirect(admin_url('transaction/get_bank'));
            }
            $inputstransaction= array('status' => 1);
            $this->transaction_model->update($id,$inputstransaction);
            $this->session->set_flashdata('message', 'XỦ Lí giao dịch thành công !');
            redirect(admin_url('transaction/get_bank'));
        }
        function process_error_bank(){
            $id = $this->uri->rsegment(3);
            $transactions = $this->transaction_model->get_info($id);
            if(!$transactions || $transactions->type_transaction != 2){
                $this->session->set_flashdata('message', 'Không tồn tại giao dịch có mã này !');
                redirect(admin_url('transaction/get_bank'));
            }
            if($transactions->status == 1 || $transactions->status == 2){
                $this->session->set_flashdata('message', ' Giao dịch đã giao dịch rồi !');
                redirect(admin_url('transaction/get_bank'));
            }
            $users = $this->user_model->get_info($transactions->user_id);
            $inputstransaction= array('status' => 2);
            $inputsusers= array('bag' =>  $users->bag + $transactions->current);

            $this->transaction_model->update($id,$inputstransaction);
            $this->user_model->update($users->id,$inputsusers);
            $this->session->set_flashdata('message', 'xử lí giao dịch thành công !');
            redirect(admin_url('transaction/get_bank'));
        }
        function napthe(){
            
            $input = array();
            $input['where'] = array('type_transaction'=>1,'status'=>0);
            $total_rows = $this->transaction_model->get_total($input);
            echo $total_rows;
        }
        function rutvenh(){
            
            $input = array();
            $input['where'] = array('type_transaction'=>2,'status'=>0);
            $total_rows = $this->transaction_model->get_total($input);
            echo $total_rows;
        }
        

	}