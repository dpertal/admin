<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
	private $_id;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
		$username = strtolower ( $this->username );
		$user = User::model ()->find ( 'LOWER(username)=?', array ($username ) );
		
		if ($user === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if ($user->password != $this->password ) {
			
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
			
		} else if ($user->active != 1 ) {
					
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_id = $user->id;
			$this->username = $user->username;
			$this->setState( 'user_name', $user->first_name .' '.$user->last_name);
			$this->setState( 'last_login', $user->last_login );
                        $this->setState( 'user_email', $user->username );
                        
			$this->setState( 'role_id', $user->role_id );
			//$role = RoleType::model()->findByPk($user->role_id);
			
			$this->setState( 'role_name', 'todo');
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode == self::ERROR_NONE;
	
	}
	
	public function getId() {
		return $this->_id;
	}
}