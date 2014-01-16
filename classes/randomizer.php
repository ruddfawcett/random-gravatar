<?php
	include('GravatarRPC.class.php');
	include('octodex.php');
	
	class Randomizer {
		public function randomizeGravatar() {
			// Let's keep our API classes here...
			$gravatarAPI = new GravatarRPC(YOUR_AKISMET_API_KEY, YOUR_GRAVATAR_EMAIL);
			$octodexAPI = new Octodex();
			
			foreach ($this->convertToArray($gravatarAPI->userimages()) as $gravatar) {
				// WARNING: this deletes every Gravatar on your account!
				$gravatarAPI->deleteUserimage(str_replace('.jpg', '', end(explode('/', $gravatar['url']))));
			}
			
			$gravatarURL = $octodexAPI->randomOctocat();
			$gravatarURL = $gravatarURL['image'];
			
			$newGravatar = $gravatarAPI->saveUrl($gravatarURL, 0);
			$gravatarAPI->useUserimage($newGravatar, YOUR_GRAVATAR_EMAIL);
		}
		
		protected function convertToArray($object) {
			if(!is_object($object) && !is_array($object)) {
				return $object;
			}
						
			return array_map(array($this, __FUNCTION__), (array)$object);
		}
	}
?>