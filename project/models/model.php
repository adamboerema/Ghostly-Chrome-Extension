<?php	
	/**
	 =============================================================
	 * 
	 * MODEL Class
	 * 
	 * Class for internal application database manipulation
	 * 
	 =============================================================
	 */
	 class Model {
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
		 * 
		 * @access public
		 * @return object
		 * 
		 * Get all entries
		 * 
		 */
		public function getAll($limit=null, $offset=null){
			try{
				if(isset($limit, $offset)){
					$q = $this->db->prepare("SELECT * FROM entries ORDER BY id DESC LIMIT $offset, $limit");
				} else {
					$q = $this->db->prepare("SELECT * FROM entries ORDER BY id DESC");
				}
				$q->execute();
				
				//Only fetch one result
				$results = $q->fetchall(PDO::FETCH_OBJ);
				return $results;
			}
			catch (PDOException $e){
				echo $e->getMessage();
			}			
		}
		
		
		/**
		 * 
		 * @access public
		 * @param int entry id
		 * @return boolean
		 * 
		 * Positive vote on entry
		 * 
		 */
		public function plusVote($id){
			$votes = $this->getVotes($id);
			try{
				if($votes > 3){
					$q = $this->db->prepare("UPDATE entries SET plus_votes = plus_votes + 1, condemned = 1 WHERE id = :id ");
				} else {
					$q = $this->db->prepare("UPDATE entries SET plus_votes = plus_votes + 1 WHERE id = :id ");
				}
				$q->bindParam(':id', $id);
				$q->execute();
				
				return true;
			}
			catch (PDOException $e){
				echo $e->getMessage();
			}			
		}
		
		/**
		 * 
		 * @access public
		 * @param int entry id
		 * @return boolean
		 * 
		 * Positive vote on entry
		 * 
		 */
		public function minusVote($id){
			try{
				$q = $this->db->prepare("UPDATE entries SET plus_vote = plus_vote - 1 WHERE id = :id ");
				$q->bindParam(':id', $id);
				$q->execute();
			}
			catch (PDOException $e){
				echo $e->getMessage();
			}			
		}
		
		/**
		 * 
		 * @access public
		 * @param int entry id
		 * @return int
		 * 
		 * Positive vote on entry
		 * 
		 */
		public function getVotes($id){
			try{
				$q = $this->db->prepare("SELECT plus_votes FROM entries WHERE id = :id ");
				$q->bindParam(':id', $id);
				$q->execute();
				$results = $q->fetch(PDO::FETCH_OBJ);
				return $results->plus_votes;
			}
			catch (PDOException $e){
				echo $e->getMessage();
			}			
		}
	 }
