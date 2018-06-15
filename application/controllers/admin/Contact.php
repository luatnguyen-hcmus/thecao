<?php 
	Class Contact extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('contact_model');
			$this->lang->load('admin/contact');
		}
		function index(){
			redirect(base_url());
			// lay tong so luong tat ca cac lien he
			$total_rows = $this->contact_model->get_total();
			$this->data['total_rows'] = $total_rows;
			//load thu vien phan trang
			$this->load->library('pagination');
			$config = array();
			$config['total_rows'] = $total_rows;//tong tat ca cac lien he
			$config['base_url'] = base_url('admin/cat/index');
			$config['per_page'] = 5;//so luong hien thi tren 1 trang
			$config['uri_segment'] = 4;// pha doan hien thi ra so trang tren url
			$config['next_link'] = 'Trang kế tiếp';
			$config['prev_link'] = 'Trang trước';
			//khoi tao phan trang
			$this->pagination->initialize($config);

			$segment = $this->uri->segment(3);
			$segment = intval($segment);

			$input = array();
			$input['limit'] = array($config['per_page'], $segment);

			//lay danh sach lien he
			$list = array();
			$list = $this->contact_model->get_list($input);
			$this->data['list'] = $list;
			$this->data['total_rows'] = $total_rows;

			//lay noi dung cua biên message
			$message = $this->session->flashdata('flash_message');
			if($message){
				$this->data['message'] = $message;
			}
			

			//load view
			$this->data['temp'] = 'admin/contact/index';
			$this->load->view('admin/main',$this->data);
		}
        function del(){
        	redirect(base_url());
            $id = $this->uri->rsegment(3);
            $this->_del_id($id);
            $this->session->set_flashdata('message', 'Không tồn tại liên hệ này !');
            redirect(admin_url('contact'));
        }
        //xoa nhieu  lien he
        function del_all(){redirect(base_url());
            $ids = $this->input->post('ids');
            foreach($ids as $id){
                $this->_del_id($id);
            }
        }
        private function _del_id($id){
            $product = $this->product_model->get_info($id);
            if(!$product){
                $this->session->set_flashdata('message', 'Không tồn tại sản phẩm này !');
                redirect(admin_url('product'));
            }
            //thuc hien xoa lien he
            $this->product_model->delete($id);
            //xoa cac anh cua lien he.
            $image_link = './upload/product/'.$product->image_link; 
            if(file_exists($image_link)){
                unlink($image_link);
            }
            //xoa cac anh kem theo cua lien he
            $image_list = json_decode($product->image_list);
            if(is_array($image_list)){
                foreach ($image_list as $img) {
                    $image_link = './upload/product/'.$img; 
                    if(file_exists($image_link)){
                        unlink($image_link);
                    }
                }
            }


        }
	}