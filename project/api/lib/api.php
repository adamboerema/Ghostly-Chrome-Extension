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
		    //var_dump($data);
		    $image = $this->addImage($data);
			var_dump($image);
			if($image){
				try{
					$q = $this->db->prepare('INSERT INTO entries (image_path, thumb_path)
											 VALUES(:image_path, :thumb_path)');
					//$q->bindParam(':plus_votes', 1, PDO::PARAM_INT);
					$q->bindParam(':image_path', $image['image']['path']);
					$q->bindParam(':thumb_path', $image['thumbnail']['path']);
					$q->execute();
					$insertId = $this->db->lastInsertId();
					
					if($insertId){
						$q = $this->db->prepare('INSERT INTO submissions (entry_id, url) 
											 VALUES(:entry_id, :url)');
						$q->bindParam(':entry_id', $insertId, PDO::PARAM_INT);
						//$q->bindParam(':url', $data['parameters']['url']);
						$q->bindParam(':url', $data);
						$q->execute();
					}
				} 
				catch (PDOException $e){
					echo $e->getMessage();
				}
			} else{
				return false;
			}
			
			if($data['parameters']){
				try{
					$q = $this->db->prepare('INSERT INTO submissions (url) 
											 VALUES(:url)');
					$q->bindParam(':url', $data['parameters']['url']);
					$q->execute();
				} 
				catch (PDOException $e){
					echo $e->getMessage();
				}
			} else {
				return false;
			}
		}
        /**
         * @param string $url = Img to be locally stored
         * @return array
         * 
         * Make curl request to store image locally
         * returns array to add image
         * 
         */
        private function addImage($url){
            $img = $this->imagePath($url);
            $ch = curl_init($url);
            $fp = fopen($img['path'], 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            
            //Check if curl successful
            if(curl_exec($ch)){
                curl_close($ch);
                fclose($fp);
                $thumbnail = $this->imageResize($img['path'], $img['name'], $img['directory']);
              
                if($thumbnail){
                  $image = array(
                    'image' => array(
                        'path' => $img['path'],
                        'name' => $img['name']
                    ),
                    'thumbnail' => array(
                        'path' => $thumbnail['path'],
                        'name' => $thumbnail['name']
                    )
                  );
				  
                  return $image;
                }
            } else {
                return false;
            }
        } 

        /**
         * @param string $url = Img to be broken down
         * @return array
         * 
         * Break down the url into image path and name 
         * 
         */
        private function imagePath($url){
            $path = pathinfo($url);
            $time = time();
            
            $image = array(
                'directory' => ABSPATH. "/uploads/",
                'path' => ABSPATH. "/uploads/{$time}_{$path['basename']}",
                'name' => "{$time}_{$path['basename']}"
            );
            return $image;
        }
        
        /**
         * 
         * @param string $name = Original img name
         * @param string $url = Img to be broken down
         * @return array
         * 
         * Break down the url into image path and name 
         * 
         */
        private function imageResize($image, $name, $directory){
            $thumbName = "thumb_{$name}";
            $thumbPath = "{$directory}{$thumbName}";
			
           /* $thumb = new Imagick($image);
            $thumb->cropThumbnailImage(300,300);
            $thumb->writeImage($thumbPath);
            $thumb->destroy();
            */
            $thumb = array(
                'path' => $thumbPath,
                'name' => $thumbName
            );
            return $thumb;
        }   	
	}