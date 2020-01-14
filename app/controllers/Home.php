<?php



class Home extends Controller
{



public function index()

	{


	$data['model'] = $this->model('Contoh_model')->dataDariModel();

	$this->view('templates/header');
	$this->view('home/index', $data);
	$this->view('templates/footer');

	}

}