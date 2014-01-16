<?php
	/*
	 * @author Rex Finn <rexcfinn@gmail.com>
	 * @version 1.0
	 * @link http://github.com/OctodexAPI/octodex.php
	 * @package octodex.php
	 */

	class Octodex {
		// the URL to the API - strings will be appended for specification
		public $baseURL = 'https://octodexapi.herokuapp.com/';
		
		/**
		 * Creates a new Octodex instance
		 */
		
		public function __construct () {
			// If you don't have cURL, this clas is unuseable, so check if you have cURL
			if (!extension_loaded('cURL')) {
				// if you don't, stop and tell the developer
				throw new Exception('This Octodex PHP Class requires cURL to work...');
			}
		}

		/**
		 * Fetches the complete octodex
		 * @return the complete octodex as an array
		 */

		public function completeOctodex () {
			// do a cURL (in our cURL method) with just $baseURL
			return $this->cURL($this->baseURL);
		}

		/**
		 * Fetches a random octocat
		 * @return the single octocat as an array
		 */
		
		public function randomOctocat () {
			// do a cURL (in our cURL method) with $baseURL and append '?random'
			return $this->cURL($this->baseURL.'?random');
		}

		/**
		 * Fetches an octocat by its number
		 * @param int $number the number of the octocat
		 * @return the single octocat as an array
		 */
		
		public function numberedOctocat ($number) {
			// do a cURL (in our cURL method) with $baseURL and append '?number={@param $number}'
			return $this->cURL($this->baseURL.'?number='.$number);
		}
        
        /**
         * Performs all cURLs that are initated in each function, protected function
         * @param string $endpoint is the URL of the cURL
		 * @return the JSON as a decoded array
         */

		protected function cURL ($endpoint) {
			// initiate the cURL
			$curl = curl_init();
			
			// create an array with our cURL options
			$curlArray = array(
				CURLOPT_RETURNTRANSFER => true, 
				CURLOPT_HEADER => false,
				CURLOPT_URL => $endpoint);
		
			// set our cURL options ($curlArray) to the cURL ($curl)
			curl_setopt_array($curl, $curlArray);
			
			// our JSON response (the API returns JSON) from executing the cURL
			$response = curl_exec($curl);
			// the status code for our response - not relevant now, but may be soon used
			$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			
			// close our cURL
			curl_close($curl);
			
			// serve up our decoded JSON from $response as an array
			return json_decode($response, true);
		}
	}
?>