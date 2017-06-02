<?php
class Token extends AppModel
{
	public function getToken()
	{
		$util = new Utility();
	        // $util->editMenu();
	        
	    $token = $this->find('first', [
	    ]);

	    if (!$token || ($token['Token']['updated'] < date(time() - $token['Token']['expire_seconds']))) {
	        $token = $util->getToken();
	        $accessToken = $token['access_token'];
	        $expires = $token['expires_in'];
	        $this->save(['token' => $accessToken, 'expire_seconds' => $expires]);
	    } else{
	        $accessToken = $token['Token']['token'];
	    }

	    return $accessToken;
	}

}