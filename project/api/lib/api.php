<?php

	/**
	 =============================================================
	 * 
	 * API CLASS
	 * 
	 * API class is a PDO wrapper that creates helper functions
     * for adding and manipulating public data in the database
	 * 
	 =============================================================
	 */
	class api{
		
		//database connection
		protected $db = null;
		
		//post parameters to be used throughout api
		public $parameters = array(); 
		
		
		/**
		 * @param $user = database user name
		 * @param $pass = database password
		 * @param $host = database host
		 * @param $db   = database name
		 * @return void
		 * 
		 * Initializes PDO object using selected settings
		 * 
		 */
		public function __construct($user, $pass, $host, $db){
			try{
				$this->db = new PDO("mysql:host=$host;dbname=$db;",$user,$pass);
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
			}
			catch (PDOException $e) {
				$this->db = null;
				die($e->getMessage());
			}

			
			
		}
		/**
		 * @param $text = User entered cloud text
		 * @return void
		 * 
		 * Adds cloud text to the database and sets a cookie
		 * associated with the user for future retrieval
		 * 
		 * /api/add/{url_encoded_text}
		 * 
		 */
		public function add($data){
			if($data['parameters']){
				try{
					$q = $this->db->prepare('INSERT INTO submissions (url) 
											 VALUES(:url)');
					$q->bindParam(':url', $data['url']);
					$q->execute();
				} 
				catch (PDOException $e){
					echo $e->getMessage();
				}
			} else {
				return false;
			}
		}	
	}