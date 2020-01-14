
<?php

// class yang mengatur request url menjadi menjalankan method
Class App {


	protected $controller = "Home"; // url[0] kondisi default
	protected $method = "index"; // url[1] kondisi default
	protected $params = []; // url [2,3,dst...] (parameter)

	public function __construct() {


		$url = $this->parseURL(); // mendeklarikan sebuah fungsi yang otomatis di jalankan
		// var_dump($url);



		//controller - url ke 1
		if( file_exists('../app/controllers/' . $url[0] . '.php')) 

		{
			

			$this->controller = $url[0];
			unset($url[0]);

		}

		require_once '../app/controllers/' . $this->controller . '.php';

		$this->controller = new $this->controller;


		//method - url ke 2
		if(isset($url[1])) 
		{

			if(method_exists($this->controller, $url[1])) 

			{

				$this->method = $url[1];
				unset($url[1]);


			}


		}
		// parameter - url selanjutnya
		if(!empty($url)) 

		{

			$this->params = array_values($url);



		}

		// menjalankan method pada kontroller yang di pilih dari url
		call_user_func_array([$this->controller,$this->method],$this->params);





	}


	public function parseURL() 


	{

		if(isset($_GET['url']) ) 


		{
			$url = rtrim($_GET['url'], '/'); // Memnghilangkan / di akhir url
			$url = filter_var($url, FILTER_SANITIZE_URL); // filter url yang mengancam
			$url = explode('/', $url); // membagi string ke beberapa nilai pada array
			return $url; // mengembalikan nilai url
		}


	}


}