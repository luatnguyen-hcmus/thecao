<?php 
	Class Info extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('info_model');
		}
		function index(){
			// lay tong so luong tat ca cac info
			$total_rows = $this->info_model->get_total();
			$this->data['total_rows'] = $total_rows;

			$input = array();
            
			//lay danh sach info
			$list = $this->info_model->get_list($input);
			$this->data['list'] = $list;

			//lay noi dung cua biên message
			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;

			//load view
			$this->data['temp'] = 'admin/info/index';
			$this->load->view('admin/main',$this->data);
		}
        // them info moi
        function add(){

            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
               $this->form_validation->set_rules('name', 'Tên thông báo', 'required');
               $this->form_validation->set_rules('content', 'Nội dung thông báo', 'required');
                if($this->form_validation->run()){
                   $data = array(
                        'title'     => $this->input->post('name'),
                        'content'      => $this->input->post('content'),
                        'status'  => $this->input->post('status'),
                        
                    );
                    if($this->info_model->update($info->id, $data)){
                        $this->session->set_flashdata('message', 'Chỉnh sửa thành công !');
                    }else{
                        $this->session->set_flashdata('message', 'Không sửa được !');
                    }
                    redirect(admin_url('info'));
                }
            }
            //load view
            $this->data['temp'] = 'admin/info/add';
            $this->load->view('admin/main',$this->data);
        }

        // sua info
        function edit(){

            $id = $this->uri->rsegment('3');
            $info = $this->info_model->get_info($id);
            if(!$info){
                $this->session->set_flashdata('message', 'Không tồn tại info có mã này !');
                redirect(admin_url('info'));
            }
            $this->data['info'] = $info;

            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
               $this->form_validation->set_rules('name', 'Tên thông báo', 'required');
               $this->form_validation->set_rules('content', 'Nội dung thông báo', 'required');

                if($this->form_validation->run()){
                    

                   $data = array(
                        'title'     => $this->input->post('name'),
                        'content'      => $this->input->post('content'),
                        'status'  => $this->input->post('status'),
                        
                    );
                    if($this->info_model->update($info->id, $data)){
                        $this->session->set_flashdata('message', 'Chỉnh sửa thành công !');
                    }else{
                        $this->session->set_flashdata('message', 'Không sửa được !');
                    }
                    redirect(admin_url('info'));
                }
            }
            //load view
            $this->data['temp'] = 'admin/info/edit';
            $this->load->view('admin/main',$this->data);
        }
        function delete(){
            $id = $this->uri->rsegment(3);
            $this->_del_id($id);
            $this->session->set_flashdata('message', 'Xóa thành công !');
            redirect(admin_url('info'));
        }
        //xoa nhieu  info
        function del_all(){
            $ids = $this->input->post('ids');
            foreach($ids as $id){
                $this->_del_id($id);
            }
        }
        private function _del_id($id){
            $info = $this->info_model->get_info($id);
            if(!$info){
                $this->session->set_flashdata('message', 'Không tồn tại thông báo này !');
                redirect(admin_url('info'));
            }
            //thuc hien xoa info
            $this->info_model->delete($id);


        }
	}