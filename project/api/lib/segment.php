<?php

	/**
	 =============================================================
	 * 
	 * SEGMENT CLASS
	 * 
	 * Segment class breaks down urls into segments for
	 * action and value routing
	 * 
	 =============================================================
	 */
	class segment {
		
		//Url to be broken to segments
		public $url = null;
		
		//Start point in the uri path
		public $path = null;
		
		/**
		 * @param $url = The url to be broken down
		 * @return void
		 * 
		 */
		public function __construct($url, $path){
			$this->url = $url;
			$this->path = $path;
		}
		
		/**
		 * @param $uri = Contains the ending uri of the url
		 * @param $path = start point for the api
		 * @return void
		 * 
		 * Parses out the uri while searching for the start point of /api
		 * 
		 */
		public function parseURI($uri, $path){
			$uri = parse_url($uri);
			$pieces = explode('/', strstr($uri['path'], '/'));
			
			//first piece always empty from first slash
			array_shift($pieces);
			
			//Keep removing the first array piece until you hit the designated path
			foreach($pieces as $piece => $value){
				if($value == $path){
					return $pieces;
				} else {
					array_shift($pieces);
				}
			}
		}
		
		/**
		 * @return segment array
		 * Begin the url structure splitting
		 * 
		 */
		 public function start(){
		 	$pieces = $this->parseURI($this->url, $this->path);
			$segments = array(
				'action' => $pieces[1],
				'data' => array(
					'value'  => urldecode($pieces[2]),
					'offset' => $pieces[3],
					'parameters' => $_REQUEST
				)
			);
			
			//Offset always defaults to 0
			(!$segments['offset'] ? $segments['offset'] = 0: $segments['offset']);
			
			return $segments;
		 }
	}

	