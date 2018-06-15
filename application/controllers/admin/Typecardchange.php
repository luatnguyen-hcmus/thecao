<?php 
	Class typecardchange extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('typecard_model');
            $this->load->model('hunress_model');
		}
		function index(){
			// lay tong so luong tat ca cac loai the 
            $totalss = array(); 
            $totalss['where']['type_change'] = 1;
            
			$total_rows = $this->typecard_model->get_total($totalss);
			$this->data['total_rows'] = $total_rows;
			//load thu vien phan trang
			$this->load->library('pagination');
			$config = array();
			$config['total_rows'] = $total_rows;//tong tat ca cac loai the
			$config['base_url'] = admin_url('typecardchange/index');
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
			$name = $this->input->get('name');
			if($name){
				$input['like'] = array('name', $name);
			}
			$catalog_id = $this->input->get('catalog');
			$catalog_id = intval($catalog_id);
			if($catalog_id > 0){
				$input['where']['catalog_id'] = $catalog_id;
			}

			//lay danh sach loai the
            $input['where']['type_change'] = 1;
            $input['order'] = array("sort_order","ASC");

			$list = $this->typecard_model->get_list($input);
			$this->data['list'] = $list;

			//lay danh muc loai the
			$input = array();
            $input['where'] = array("status"=>"1");
            $input['order'] = array("id","ASC");

            $this->load->model('hunress_model');
            $input = array();
            foreach($list as $tc){
                $input['where'] = array('cate_card'=>$tc->id);
                $subs = $this->hunress_model->get_list($input);
                $tc->subs = $subs;
            }
            
			//lay noi dung cua biên message
			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;

			//load view
			$this->data['temp'] = 'admin/typecardchange/index';
			$this->load->view('admin/main',$this->data);
		}
        // them sp moi
        function add(){

            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $this->form_validation->set_rules('name', 'Tên thẻ', 'required');
                $this->form_validation->set_rules('hunress', 'Chiếc khấu', 'required');
                $this->form_validation->set_rules('mincode', 'Số lượng kí tự mã thẻ min', 'required');
                $this->form_validation->set_rules('maxcode', 'Số lượng kí tự mã thẻ max', 'required');
                $this->form_validation->set_rules('minseri', 'Số lượng kí tự mã seri min', 'required');
                $this->form_validation->set_rules('maxseri', 'Số lượng kí tự mã seri max', 'required');
                $this->form_validation->set_rules('sort_card', 'thứ tự hiển thị', 'required');

                if($this->form_validation->run()){
                    $name = $this->input->post('name');
                    $hunress = $this->input->post('hunress');
                    $sort_card = $this->input->post('sort_card');
                    
                    //lay ten file anh minh hoa duoc update len
                    $this->load->library('upload_library');
                    $upload_path = './upload/typecard';
                    $upload_data = $this->upload_library->upload($upload_path, 'image');

                    $image = '';
                    if(isset($upload_data['file_name'])){
                        $image = $upload_data['file_name'];
                    }
                    $this->load->model('hunress_model');
                    $data = array(
                        'name'             
                        => $name,
                        'sort_order'       => $sort_card,
                        'image'            => $image,
                        'type_change'      => 1,
                        'status_change'    => $this->input->post('status'),
                        'featured_change'  => $this->input->post('featured'),
                        'min_code'         => $this->input->post('mincode'),
                        'max_code'         => $this->input->post('maxcode'),
                        'min_seri'         => $this->input->post('minseri'),
                        'max_seri'         => $this->input->post('maxseri'),
                    );


                    if($this->typecard_model->create($data))
                    {
                        $data1 = array(
                            'hunress_change' => $hunress,
                            'cate_card' =>$this->db->insert_id(),
                        );
                    }
                    if($this->hunress_model->create($data1)){
                        $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công !');
                    
                    }else{
                        $this->session->set_flashdata('message', 'Không thêm được !');
                    }
                    redirect(admin_url('typecardchange'));
                }
            }
            //load view
            $this->data['temp'] = 'admin/typecardchange/add';
            $this->load->view('admin/main',$this->data);
        }

        // sua loai the
        function edit(){
            $id = $this->uri->rsegment('3');
            $typecardchange = $this->typecard_model->get_info($id);
            if(!$typecardchange){
                $this->session->set_flashdata('message', 'Không tồn tại loại thẻ có mã này !');
                redirect(admin_url('typecardchange'));
            }
            $this->data['typecardchange'] = $typecardchange;
            
            //lay danh muc loai the
            $input = array();
            $input['where'] = array("status_change"=>"1");
            $input['order'] = array("id","ASC");

            $this->load->model('hunress_model');
            $input = array('cate_card'=>$typecardchange->id);
            $hunress = $this->hunress_model->get_info_rule($input);
            $this->data['sub'] = $hunress;
            

            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $this->form_validation->set_rules('name', 'Tên thẻ', 'required');
                $this->form_validation->set_rules('hunress', 'Chiếc khấu', 'required');
                $this->form_validation->set_rules('mincode', 'Số lượng kí tự mã thẻ min', 'required');
                $this->form_validation->set_rules('maxcode', 'Số lượng kí tự mã thẻ max', 'required');
                $this->form_validation->set_rules('minseri', 'Số lượng kí tự mã seri min', 'required');
                $this->form_validation->set_rules('maxseri', 'Số lượng kí tự mã seri max', 'required');

                if($this->form_validation->run()){
                    $name = $this->input->post('name');
                    $hunress = $this->input->post('hunress');
                    $sort_order = $this->input->post('sort_card');
                    //lay ten file anh minh hoa duoc update len
                    $this->load->library('upload_library');
                    $upload_path = './upload/typecard';
                    $upload_data = $this->upload_library->upload($upload_path, 'image');

                    $image = '';
                    if(isset($upload_data['file_name'])){
                        $image = $upload_data['file_name'];
                    }

                    $data = array(
                        'name'     => $name,
                        'sort_order'     => $sort_order,
                        'status_change'  => $this->input->post('status'),
                        'featured_change'  => $this->input->post('featured'),
                        'min_code'         => $this->input->post('mincode'),
                        'max_code'         => $this->input->post('maxcode'),
                        'min_seri'         => $this->input->post('minseri'),
                        'max_seri'         => $this->input->post('maxseri'),
                    );
                    $data1 = array(
                        'hunress_change'     => $this->input->post('hunress'),
                    );

                    if($image != ""){
                        $data['image']     = $image;
                    }

                    $where = array('cate_card'=>$typecardchange->id);
                    if($this->typecard_model->update($typecardchange->id, $data)){
                        if($this->hunress_model->update_rule($where, $data1)){
                            $this->session->set_flashdata('message', 'Chỉnh sửa thành công !');
                        }
                        
                    }else{
                        $this->session->set_flashdata('message', 'Không sửa được !');
                    }
                    redirect(admin_url('typecardchange'));
                }
            }
            //load view
            $this->data['temp'] = 'admin/typecardchange/edit';
            $this->load->view('admin/main',$this->data);
        }
        function delete(){
            $id = $this->uri->rsegment(3);
            $this->_del_id($id);
            $this->session->set_flashdata('message', 'Xóa thành công !');
            redirect(admin_url('typecardchange'));
        }
        //xoa nhieu  loai the
        function del_all(){
            $ids = $this->input->post('ids');
            foreach($ids as $id){
                $this->_del_id($id);
            }
        }
        private function _del_id($id){
            $typecardchange = $this->typecard_model->get_info($id);
            if(!$typecardchange){
                $this->session->set_flashdata('message', 'Không tồn tại card này !');
                redirect(admin_url('typecardchange'));
            }
            //thuc hien xoa loai the
            $this->typecard_model->delete($id);
            //xoa cac anh cua loai the.
            $image_link = './upload/typecard/'.$typecardchange->image; 
            if(file_exists($image_link)){
                unlink($image_link);
            }
            //xoa cac anh kem theo cua loai the
            $hunresschange = $this->hunress_model->get_info($id);
            if(!$hunresschange){
                $where = array('cate_card'=>$id);
                $this->hunress_model->del_rule($where);
            }
        }
	}