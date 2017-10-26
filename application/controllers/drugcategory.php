<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drugcategory extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model("drugcategory_model");
	}

	public function index()
	{

		$viewData = new stdClass();
		$viewData->rows = $this->drugcategory_model->get_all(array(),"id ASC");

		$this->load->view('drugcategory', $viewData);
	}

	public function newPage(){

		$this->load->view("new_drugcategory");
	}

	public function editPage($id){

		$viewData = new stdClass();

		$viewData->row = $this->drugcategory_model->get(array("id" => $id));

		$this->load->view("edit_drugcategory", $viewData);


	}

	public function add(){

		$data = array(
			"name" 	=> $this->input->post("name"),
			"isActive"	=> 0
		);

		$insert = $this->drugcategory_model->add($data);

		if($insert){

			redirect(base_url("drugcategory"));
		}else{
			redirect(base_url("drugcategory/newPage"));
		}
	}

	public function edit($id){

		$data = array(
			"name" => $this->input->post("title")
		);

		$update = $this->drugcategory_model->update(
			array("id"	=> $id),
			$data
		);

		if($update){
			redirect(base_url("drugcategory"));
		}else{
			redirect(base_url("drugcategory/editPage/$id"));
		}
	}

	public function isActiveSetter(){

		$id 	  = $this->input->post("id");
		$isActive = ($this->input->post("isActive") == "true") ? 1 : 0;

		$update = $this->drugcategory_model->update(
			array("id" => $id),
			array("isActive" => $isActive)
		);

	}

	public function delete($id){

		$delete = $this->drugcategory_model->delete(array("id" => $id));

		redirect(base_url("drugcategory"));

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */