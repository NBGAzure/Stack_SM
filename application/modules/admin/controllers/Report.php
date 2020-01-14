<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Pagination');
	}
	
	public function index()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->load->view('admin/report/report_list');
		//$this->load->view('admin/footer');
	}

	public function report_list()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$_SESSION['search'] = "";
		$this->load->model('Report_model');

		$search_text = "";
    	if($this->input->post('submit') != NULL ){
	      	$search_text = $this->input->post('search');
			$this->session->set_userdata(array("search"=>$search_text));
			}else{
	      	if($this->session->userdata('search') != NULL){
	        	$search_text = $this->session->userdata('search');
        	}
        }
		$params = array();
        $limit_per_page = 10;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$total_records = $this->Report_model->record_reportcount($search_text);
		
		if ($total_records > 0) 
        {
		
            $params["report_data"] = $this->Report_model->getreport($limit_per_page, $start_index, $search_text);
            
            $config['base_url'] = base_url() . 'admin/Report/report_list';
			
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
             
            $this->pagination->initialize($config);
            $params["links"] = $this->pagination->create_links();
			$params['search'] = $search_text;
        }
        
		$this->load->view('admin/report/report_list',$params);
	 	//$this->load->view('admin/footer');  
	}

	public function addtillreport()
	{
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	 	$this->load->model('Report_model');
	 	//$data["report_data"] = $this->Report_model->getreportstock();
	 	$this->load->view('report/add_report');
	 	$this->load->view('admin/footer');
	}

	public function insert_report()
	{
	    $this->load->model('Report_model');

	   	$id =$this->input->post('id');
	   	$data['item'] =$this->input->post('item');
  		
	    $this->Report_model->insert_report($data);

	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Till Report Has Been Inserted Successfully');
		redirect('admin/Report/report_list' ,'refresh');
		$this->load->view('admin/footer');
	}
	
	public function editreport()
	{
	    $this->load->model('Report_model');
	    $id=$this->uri->segment('4');
	    
	    $data["report_data"] = $this->Report_model->geteditreport($id);
	 	
	 	$this->load->view('admin/header');
		$this->load->view('admin/nav');
	    $this->load->view('admin/report/edit_report',$data);
	    $this->load->view('admin/footer');
	}
	
	public function update_report()
	{
		$this->load->model('Report_model');
		$id =$this->input->post('id');
	   	$data['item'] =$this->input->post('item');
        $this->Report_model->update_report($data,$id);
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Till Report Has Been Updated Successfully');
		redirect('admin/Report/report_list' ,'refresh');
	    $this->load->view('admin/footer');
	}

	public function delete_report()
	{	
		$id = $_POST['list_id'];
	    $this->db->where('id', $id);
        $this->db->delete('tillreport');
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Till Report Item Has Been Deleted Successfully');
        redirect('admin/Report/report_list', 'refresh');
        $this->load->view('admin/footer');
	}

	public function getproduct()
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->order_by("product_id","asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getdepartment()
    {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->order_by("dept_id","asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function tillreportitem()
    {	
    	$this->load->model('Report_model');
	    $id=$this->uri->segment('4');
	    
	    $data['till_report'] = $this->Report_model->geteditreportitem($id);
	    
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
	    $this->load->view('admin/report/edit_reportstock',$data);
	    $this->load->view('admin/footer');
	}

	public function submittillreportitem()
    {	
    	$this->load->model('Report_model');
	    $id=$this->uri->segment('4');
	    
	    $data['till_report'] = $this->Report_model->geteditreportitem($id);
	    
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
	    $this->load->view('admin/report/submit_reportstock',$data);
	    $this->load->view('admin/footer');
	}

	public function save_tillreportstock()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->load->model('Report_model');
		$id = $this->input->post('id');
	   	$data['item_id'] = $this->input->post('item_id');
  		$data['quantity']=$this->input->post('quantity');
	    $data['previous_qun']=$this->input->post('previous_qun');
	    $data['total'] = $this->input->post('total');
	    $data['created_date']=date('Y-m-d H:i:s');
	    //print_r($data);
	    // exit;
	   
	    $save = $this->Report_model->save_reportstock($data,$id);
	    
	    $this->Report_model->submit_reportstock($id);
	    //exit;
	    $param['tillpdf_data']=$this->Report_model->pdfgenerate($data,$id);
	   
	    $htmlContent = $this->load->view('admin/report/pdftillreport', $param, TRUE);
	    $uid =$this->session->userdata['uid'];

        $createPDFFile = $uid.'uid_'.time().'.pdf';
        
        $this->createPDF(FCPATH.'pdf/till_report/'.$createPDFFile, $htmlContent);
        $saved_pdf = base_url().'pdf/till_report/'.$createPDFFile;
        
        //$this->Report_model->sendemailpdf($uid,$saved_pdf);
        
		$this->session->set_flashdata('success', 'Till Report Has Been Updated Successfully');
		redirect('admin/Report/tillreportitem/'.$uid ,'refresh');
		$this->load->view('admin/footer');
	 	//    $param['pdf_data']=$this->Report_model->pdfgenerate($data,$id);
	   
	 	//    $htmlContent = $this->load->view('admin/report/pdftillreport', $param, TRUE);
	 	//$uid =$this->session->userdata['uid'];

  		//       $createPDFFile = $uid.'uid_'.time().'.pdf';
        
  		//       $this->createPDF(FCPATH.'pdf/till_report/'.$createPDFFile, $htmlContent);
  		//       $saved_pdf = base_url().'pdf/till_report/'.$createPDFFile;
        
		//       //$this->Report_model->sendemailpdf($uid,$saved_pdf);
        
		// $this->session->set_flashdata('success', 'Till Report Has Been Updated Successfully');
		// redirect('admin/Report/submittillreportitem/'.$uid ,'refresh');
		// $this->load->view('admin/footer');
	}


	public function submit_tillreportstock()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->load->model('Report_model');
		$id = $this->input->post('id');
	   
	    $this->Report_model->submit_reportstock($id);
	    //exit;
	    $param['tillpdf_data']=$this->Report_model->pdfgenerate($data,$id);
	   
	    $htmlContent = $this->load->view('admin/report/pdftillreport', $param, TRUE);
	    $uid =$this->session->userdata['uid'];

        $createPDFFile = $uid.'uid_'.time().'.pdf';
        
        $this->createPDF(FCPATH.'pdf/till_report/'.$createPDFFile, $htmlContent);
        $saved_pdf = base_url().'pdf/till_report/'.$createPDFFile;
        
        //$this->Report_model->sendemailpdf($uid,$saved_pdf);
        
		$this->session->set_flashdata('success', 'Till Report Has Been Updated Successfully');
		redirect('admin/Report/tillreportitem/'.$uid ,'refresh');
		$this->load->view('admin/footer');
	}


	public function createPDF($fileName,$html)
    {
        ob_start(); 
        // Include the main TCPDF library (search for installation path).
        $this->load->library('Pdf');
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TechArise');
        $pdf->SetTitle('TechArise');
        $pdf->SetSubject('TechArise');
        $pdf->SetKeywords('TechArise');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // set auto page breaks
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 0);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }       

        // set font
        $pdf->SetFont('dejavusans', '', 10);

        // add a page
        $pdf->AddPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();       
        ob_end_clean();
        //Close and output PDF document
        $pdf->Output($fileName, 'F');   
        //Download PDF document
        //$pdf->Output($fileName, 'I'); 
        //$pdf->Output($fileName, 'D');       
    }
}