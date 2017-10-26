<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drug extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model("drug_model");
		$this->load->model("drugcategory_model");
		$this->load->model("drugimage_model");
	} 

	public function index()
	{

		$viewData = new stdClass();
		$viewData->rows = $this->drug_model->get_all(array(),"id ASC");

		$this->load->view('drug', $viewData);
	}

	public function newPage(){

		$this->load->view("new_drug");
	}

	public function editPage($id){

		$viewData = new stdClass();

		$viewData->row = $this->drug_model->get(array("id" => $id));

		$this->load->view("edit_drug", $viewData);


	}

	public function add(){

		$data = array(
			"title" 			=> $this->input->post("title"),
			"category_id" 		=> $this->input->post("category"),
			"price" 			=> $this->input->post("price"),
			"isActive"				=> 0
		);

		$insert = $this->drug_model->add($data);

		if($insert){

			redirect(base_url("drug"));
		}else{
			redirect(base_url("drug/newPage"));
		}
	}

	public function edit($id){

		$data = array(
			"title" => $this->input->post("title")
		);

		$update = $this->drug_model->update(
			array("id"	=> $id),
			$data
		);

		if($update){
			redirect(base_url("drug"));
		}else{
			redirect(base_url("drug/editPage/$id"));
		}
	}

	public function isActiveSetter(){

		$id 	  = $this->input->post("id");
		$isActive = ($this->input->post("isActive") == "true") ? 1 : 0;

		$update = $this->drug_model->update(
			array("id" => $id),
			array("isActive" => $isActive)
		);

	}

	public function isCover(){

		$id 	  = $this->input->post("id");
		$isCover = ($this->input->post("isCover") == "true") ? 1 : 0;

		$update = $this->drugimage_model->update(
			array("id" => $id),
			array("isCover" => $isCover)
		);

	}


	public function isActiveSetterForImage(){

		$id 	  = $this->input->post("id");
		$isActive = ($this->input->post("isActive") == "true") ? 1 : 0;

		$update = $this->drugimage_model->update(
			array("id" => $id),
			array("isActive" => $isActive)
		);

	}

	public function delete($id){

		$delete = $this->drug_model->delete(array("id" => $id));

		redirect(base_url("drug"));

	}


	public function imageUploadPage($drug_id){

		$this->session->set_userdata("drug", $drug_id);

		$viewData = new stdClass();
		$viewData->rows = $this->drugimage_model->get_all(
			array(
				"drug"	=> $drug_id,
			),
			"id ASC"
		);

		$this->load->view("drug_image", $viewData);

	}

	public function upload_image(){

		$config['upload_path']          = 'uploads/';
		$config['allowed_types']        = '*';
		$config['encrypt_name']			= true;

		$this->load->library('upload', $config);

//		if(!file_exists(FCPATH)){}

		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());

			print_r($error);

		}
		else
		{

			// Upload Basarili ise DB ye aktar..
			$data = array('upload_data' => $this->upload->data());
			$img_id = $data["upload_data"]['file_name'];

			$this->drugimage_model->add(array(
					"image"	=> $img_id,
					"drug"	=> $this->session->userdata("drug"),
					"isActive"	=> 1
				)

			);


		}

	}

	public function deleteImage($id){

		$image = $this->drugimage_model->get(array("id" => $id));

		$file_name = FCPATH ."uploads/$image->image";

		if(unlink($file_name)){

			$delete = $this->drugimage_model->delete(array("id"	=> $id));

			if($delete){

				redirect("drug/imageUploadPage/$image->drug");

			}
		}


	}

	/*
	 * Availability Metodlari
	 */

	public function newAvailabilityPage($drug_id){



		$viewData =  new stdClass();
		$viewData->drug_id = $drug_id;

		$viewData->availabilities = $this->drugavailability_model->get_all(
			array(
				"drug_id"	    => $drug_id,
				"daily_date >=" => date("Y-m-d")
			),"daily_date ASC"
		);


		$this->load->view("new_drugavailability", $viewData);

	}


	public function addNewAvailability($drug_id){

		//08/10/2016 - 08/25/2016

		// 2016-08-10

		$availability_date = explode("-", $this->input->post("availability_date"));
		$startDateArr  = explode("/", $availability_date[0]);
		$finishDateArr = explode("/",$availability_date[1]);

		$startDateStr  = trim($startDateArr[2]) . "-" . trim($startDateArr[0]) . "-" . trim($startDateArr[1]);
		$finishDateStr = trim($finishDateArr[2]) . "-" . trim($finishDateArr[0]) . "-" . trim($finishDateArr[1]);

		$startDate  = new DateTime($startDateStr);
		$finishDate = new DateTime(date("Y-m-d", strtotime("1 day" ,strtotime($finishDateStr))));

		$interval = DateInterval::createFromDateString("1 day");

		$period = new DatePeriod($startDate, $interval, $finishDate);

		foreach ($period as $date){


			$record_test = $this->drugavailability_model->get(
				array(
					"drug_id"	    => $drug_id,
					"daily_date"	=> $date->format("Y-m-d")
				)
			);

			if(empty($record_test)) {

				$this->drugavailability_model->add(
					array(
						"daily_date" => $date->format("Y-m-d"),
						"drug_id" => $drug_id,
						"status" => 1
					)
				);
			}

		}

		redirect(base_url("drug/newAvailabilityPage/$drug_id"));



	}

	/*
	 * drug Pricing Metodlari
	 */
    public function newPricingPage($drug_id){


        $viewData =  new stdClass();
        $viewData->drug_id = $drug_id;

        $viewData->prices = $this->drugpricing_model->get_all(
            array(
                "drug_id"	    => $drug_id,
                "date >=" => date("Y-m-d")
            ),"date ASC"
        );


        $this->load->view("new_drugpricing", $viewData);

    }

    public function addNewPricing($drug_id){

        //08/10/2016 - 08/25/2016

        // 2016-08-10
        $price = $this->input->post("price");
        if($price == " "){
            redirect(base_url("drug/newPricingPage/$drug_id"));
        }

        $pricing_date = explode("-", $this->input->post("pricing_date"));
        $startDateArr  = explode("/", $pricing_date[0]);
        $finishDateArr = explode("/",$pricing_date[1]);

        $startDateStr  = trim($startDateArr[2]) . "-" . trim($startDateArr[0]) . "-" . trim($startDateArr[1]);
        $finishDateStr = trim($finishDateArr[2]) . "-" . trim($finishDateArr[0]) . "-" . trim($finishDateArr[1]);

        if($startDateStr < date("Y-m-d")){
            redirect(base_url("drug/newPricingPage/$drug_id"));
        }
        $startDate  = new DateTime($startDateStr);
        $finishDate = new DateTime(date("Y-m-d", strtotime("1 day" ,strtotime($finishDateStr))));

        $interval = DateInterval::createFromDateString("1 day");

        $period = new DatePeriod($startDate, $interval, $finishDate);
            foreach ($period as $date) {

            $record_test = $this->drugpricing_model->get(
                array(
                    "drug_id"	    => $drug_id,
                    "date"	        => $date->format("Y-m-d"),
                )
            );


            if(empty($record_test)) {

                $this->drugpricing_model->add(
                    array(
                        "date"          => $date->format("Y-m-d"),
                        "drug_id"       => $drug_id,
                        "price"         => $price,
                        )
                    );
                }else{
                    $this->drugpricing_model->update(
                        array(
                            "date"      => $date->format("Y-m-d"),
                            "drug_id"   => $drug_id
                        ),
                        array(
                            "price"     => $price
                        )

                    );

            }
            }

        redirect(base_url("drug/newPricingPage/$drug_id"));



    }

    public function drugPricingDelete($id){

        $drug_id = $this->drugpricing_model->get(array("id" => $id));
        $drug_id = $drug_id->drug_id;

        $delete = $this->drugpricing_model->delete(array("id" => $id));

        redirect(base_url("drug/newPricingPage/$drug_id"));

    }

    public function getPrices($drug_id){
        //08/10/2016 - 08/25/2016

        // 2016-08-10

        $pricing_date = explode("-", $this->input->post("pricing_date"));
        $startDateArr  = explode("/", $pricing_date[0]);
        $finishDateArr = explode("/",$pricing_date[1]);

        $startDateStr  = trim($startDateArr[2]) . "-" . trim($startDateArr[0]) . "-" . trim($startDateArr[1]);
        $finishDateStr = trim($finishDateArr[2]) . "-" . trim($finishDateArr[0]) . "-" . trim($finishDateArr[1]);


        $startDate  = new DateTime($startDateStr);
        $finishDate = new DateTime(date("Y-m-d", strtotime("1 day" ,strtotime($finishDateStr))));

        $interval = DateInterval::createFromDateString("1 day");

        $period = new DatePeriod($startDate, $interval, $finishDate);

        $day_price = array();

        $default_price = $this->drug_model->get(
            array(
                "id" => $drug_id
            )
        );
        foreach ($period as $date){
        $record_test = $this->drugpricing_model->get(
            array(
                "drug_id"	    => $drug_id,
                "date"          => $date->format("Y-m-d")
//                "date >="	    => $startDateStr,
//                "date <="	    => $finishDateStr,
            )
        );
            if($record_test){
                array_push($day_price,$date->format("d-m-Y"),$record_test->price);
            }else{
                array_push($day_price,$date->format("d-m-Y"),$default_price->default_price);
            }

        }
        $viewData = new stdClass();
        $viewData->prices = $day_price;
        $viewData->row_count = count($day_price);
        $this->load->view("pricepage",$viewData);

    }

    public function getPricePage($drug_id){

        $viewData = new stdClass();
        $viewData->drug_id = $drug_id;


        $this->load->view("price",$viewData);


    }

}

