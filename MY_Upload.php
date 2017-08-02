<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * File: (Codeigniterapp)/libraries/MY_Upload.php
 * 
 * A simple library extending CI native upload library.
 * This library will allow multiple file upload using native CI upload library
 * 
 * @author Oussama MKADMINI 
 */

Class MY_Upload Extends CI_Upload {

    public function __construct($config = array())
    {
		parent::__construct($config);
    }
	
	/**
	 * Do the upload and return file data or errors
	 *
	 * @param string $field
	 *
	 * @return array
	 */
	public function do_multi_upload($field) {

		for ($i = 0; $i < count($_FILES[$field]['name']); $i++):
			$_FILES['userFile']['name'] = $_FILES[$field]['name'][$i]; 
			$_FILES['userFile']['type'] = $_FILES[$field]['type'][$i]; 
			$_FILES['userFile']['tmp_name'] = $_FILES[$field]['tmp_name'][$i]; 
			$_FILES['userFile']['error'] = $_FILES[$field]['error'][$i]; 
			$_FILES['userFile']['size'] = $_FILES[$field]['size'][$i]; 

			if ( !$this->do_upload('userFile') )
				$ret[$_FILES['userFile']['name']]['error'] = $this->display_errors();
			else
				$ret[$_FILES['userFile']['name']]['success'] = $this->data();

		endfor;
		return $ret;

	}
}