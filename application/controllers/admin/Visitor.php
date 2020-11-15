<?php

 /**
 * Author: Amirul Momenin
 * Desc:Visitor Controller
 *
 */
class Visitor extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Visitor_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of visitor table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['visitor'] = $this->Visitor_model->get_limit_visitor($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/visitor/index');
		$config['total_rows'] = $this->Visitor_model->get_count_visitor();
		$config['per_page'] = 10;
		//Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';		
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
        $data['_view'] = 'admin/visitor/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save visitor
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		$file_picture = "";
 
		
		
		$params = array(
					 'visitor_name' => html_escape($this->input->post('visitor_name')),
'visitor_email' => html_escape($this->input->post('visitor_email')),
'visitor_mobile_no' => html_escape($this->input->post('visitor_mobile_no')),
'file_picture' => $file_picture,
'visitor_address' => html_escape($this->input->post('visitor_address')),
'meet_person_name' => html_escape($this->input->post('meet_person_name')),
'department_id' => html_escape($this->input->post('department_id')),
'reason_to_meet' => html_escape($this->input->post('reason_to_meet')),
'visitor_enter_time' => html_escape($this->input->post('visitor_enter_time')),
'visitor_outing_remark' => html_escape($this->input->post('visitor_outing_remark')),
'out_time' => html_escape($this->input->post('out_time')),
'visitor_status' => html_escape($this->input->post('visitor_status')),

				);
		
						$config['upload_path']          = "./public/uploads/images/visitor";
						$config['allowed_types']        = "gif|jpg|png";
						$config['max_size']             = 100;
						$config['max_width']            = 1024;
						$config['max_height']           = 768;
						$this->load->library('upload', $config);
						
						if(isset($_POST) && count($_POST) > 0)     
							{  
							  if(strlen($_FILES['file_picture']['name'])>0 && $_FILES['file_picture']['size']>0)
								{
									if ( ! $this->upload->do_upload('file_picture'))
									{
										$error = array('error' => $this->upload->display_errors());
									}
									else
									{
										$file_picture = "uploads/images/visitor/".$_FILES['file_picture']['name'];
									    $params['file_picture'] = $file_picture;
									}
								}
								else
								{
									unset($params['file_picture']);
								}
							}
							
						    
		 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['visitor'] = $this->Visitor_model->get_visitor($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Visitor_model->update_visitor($id,$params);
				$this->session->set_flashdata('msg','Visitor has been updated successfully');
                redirect('admin/visitor/index');
            }else{
                $data['_view'] = 'admin/visitor/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $visitor_id = $this->Visitor_model->add_visitor($params);
				$this->session->set_flashdata('msg','Visitor has been saved successfully');
                redirect('admin/visitor/index');
            }else{  
			    $data['visitor'] = $this->Visitor_model->get_visitor(0);
                $data['_view'] = 'admin/visitor/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details visitor
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['visitor'] = $this->Visitor_model->get_visitor($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/visitor/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting visitor
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $visitor = $this->Visitor_model->get_visitor($id);

        // check if the visitor exists before trying to delete it
        if(isset($visitor['id'])){
            $this->Visitor_model->delete_visitor($id);
			$this->session->set_flashdata('msg','Visitor has been deleted successfully');
            redirect('admin/visitor/index');
        }
        else
            show_error('The visitor you are trying to delete does not exist.');
    }
	
	/**
     * Search visitor
	 * @param $start - Starting of visitor table's index to get query
     */
	function search($start=0){
		if(!empty($this->input->post('key'))){
			$key =$this->input->post('key');
			$_SESSION['key'] = $key;
		}else{
			$key = $_SESSION['key'];
		}
		
		$limit = 10;		
		$this->db->like('id', $key, 'both');
$this->db->or_like('visitor_name', $key, 'both');
$this->db->or_like('visitor_email', $key, 'both');
$this->db->or_like('visitor_mobile_no', $key, 'both');
$this->db->or_like('file_picture', $key, 'both');
$this->db->or_like('visitor_address', $key, 'both');
$this->db->or_like('meet_person_name', $key, 'both');
$this->db->or_like('department_id', $key, 'both');
$this->db->or_like('reason_to_meet', $key, 'both');
$this->db->or_like('visitor_enter_time', $key, 'both');
$this->db->or_like('visitor_outing_remark', $key, 'both');
$this->db->or_like('out_time', $key, 'both');
$this->db->or_like('visitor_status', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['visitor'] = $this->db->get('visitor')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/visitor/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('visitor_name', $key, 'both');
$this->db->or_like('visitor_email', $key, 'both');
$this->db->or_like('visitor_mobile_no', $key, 'both');
$this->db->or_like('file_picture', $key, 'both');
$this->db->or_like('visitor_address', $key, 'both');
$this->db->or_like('meet_person_name', $key, 'both');
$this->db->or_like('department_id', $key, 'both');
$this->db->or_like('reason_to_meet', $key, 'both');
$this->db->or_like('visitor_enter_time', $key, 'both');
$this->db->or_like('visitor_outing_remark', $key, 'both');
$this->db->or_like('out_time', $key, 'both');
$this->db->or_like('visitor_status', $key, 'both');

		$config['total_rows'] = $this->db->from("visitor")->count_all_results();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		$config['per_page'] = 10;
		// Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
		$data['key'] = $key;
		$data['_view'] = 'admin/visitor/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export visitor
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'visitor_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $visitorData = $this->Visitor_model->get_all_visitor();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Visitor Name","Visitor Email","Visitor Mobile No","File Picture","Visitor Address","Meet Person Name","Department Id","Reason To Meet","Visitor Enter Time","Visitor Outing Remark","Out Time","Visitor Status"); 
		   fputcsv($file, $header);
		   foreach ($visitorData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $visitor = $this->db->get('visitor')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/visitor/print_template.php');
			$html = ob_get_clean();
			include(APPPATH."third_party/mpdf60/mpdf.php");					
			$mpdf=new mPDF('','A4'); 
			//$mpdf=new mPDF('c','A4','','',32,25,27,25,16,13); 
			//$mpdf->mirrorMargins = true;
		    $mpdf->SetDisplayMode('fullpage');
			//==============================================================
			$mpdf->autoScriptToLang = true;
			$mpdf->baseScript = 1;	// Use values in classes/ucdn.php  1 = LATIN
			$mpdf->autoVietnamese = true;
			$mpdf->autoArabic = true;
			$mpdf->autoLangToFont = true;
			$mpdf->setAutoBottomMargin = 'stretch';
			$stylesheet = file_get_contents(APPPATH."third_party/mpdf60/lang2fonts.css");
			$mpdf->WriteHTML($stylesheet,1);
			$mpdf->WriteHTML($html);
			//$mpdf->AddPage();
			$mpdf->Output($filePath);
			$mpdf->Output();
			//$mpdf->Output( $filePath,'S');
			exit;	
	  }
	   
	}
}
//End of Visitor controller