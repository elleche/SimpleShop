<?php
class Admin extends CI_Model 
{
	private $adminId;
	private $adminUsername;
	private $adminPassword;
	private $adminEmail;

	public function __construct($dataRow = FALSE)
	{
		$this->load->database();
		$this->load->library('passwordhash.php', array(8, false));
		
		$this->adminId = 0;
		$this->adminUsername = '';
		$this->adminPassword = '';
		$this->adminEmail = '';
		if (!empty($dataRow))
		{
			if(isset($dataRow['admin_id'])) $this->adminId = $dataRow['admin_id'];
			if(isset($dataRow['admin_username'])) $this->adminUsername = $dataRow['admin_username'];
			if(isset($dataRow['admin_password'])) $this->adminPassword = $dataRow['admin_password'];
			if(isset($dataRow['admin_email'])) $this->adminEmail = $dataRow['admin_email'];
		}
	}
	public function getId()
	{
		return $this->adminId;
	}	
	public function getUsername()
	{
		return $this->adminUsername;
	}	
	public function getPassword()
	{
		return $this->adminPassword;
	}	
	public function getEmail()
	{
		return $this->adminEmail;
	}	
	public function setUsername($username)
	{
		$this->adminUsername = $username;
	}	
	public function setPassword($password)
	{
		$hash = $this->passwordhash->HashPassword($password);
		if (strlen($hash) >= 20) 
		{
			$this->adminPassword = $hash;
			return true;
		}
		else
		{
			return false;
		}
	}	
	public function setEmail($email)
	{
		$this->adminEmail = $email;
	}
	public static function getAdmins($adminId = FALSE)
	{
		//get an instance of CodeIgniter to access the database
		$CI =& get_instance();
		
		if ($adminId === FALSE)
		{
			$CI->db->order_by('admin_username', 'asc');
			$query = $CI->db->get('admin');
			$dataRows = $query->result_array();
			$admins  = array();
			foreach($dataRows as $row)
			{
				$admins[] = new Admin($row);
			}
			return $admins;
		}
		
		$query = $CI->db->get_where('admin', array('admin_id' => $adminId));
		$row = $query->row_array();
		return new Admin($row);
	}
	public static function getAdminByUsername($username)
	{
		$CI =& get_instance();
		$query = $CI->db->get_where('admin', array('admin_username' => $username));
		$row = $query->row_array();
		return new Admin($row);
	}
	public static function userExist($username, $password)
	{
		$CI =& get_instance();
		$query = $CI->db->get_where('admin', array('admin_username' => $username));
		$row = $query->row_array();
		if(empty($row)) return false;
		$admin = new Admin($row);
		$isMatch = $admin->passwordhash->CheckPassword($password, $admin->getPassword());
		return $isMatch;
	}
	public static function usernameUnique($username)
	{
		$CI =& get_instance();
		$query = $CI->db->get_where('admin', array('admin_username' => $username));
		$row = $query->row_array();
		return empty($row);		
	}
/*	public static function createAdmin($adminDetails)
	{
		$CI =& get_instance();
		return $CI->db->insert('admin', $adminDetails);
	}
	public function updateAdmin()
	{
		$data = array (
			'admin_username' => $this->getUsername(), 
			'admin_password' => $this->getPassword(),
			'admin_email' => $this->getEmail());
	
		return $this->db->update('admin', $data, array('admin_id' => $this->getId()));
	}	*/
	public function save($adminDetails = false)
	{			
		if (empty($adminDetails))
		{
			$adminDetails = array(
				'admin_username' => $this->getUsername(),
				'admin_email' => $this->getEmail(),
				'admin_password' => $this->getPassword()
			);
		}
		if($this->getId() > 0) return $this->db->update('admin', $adminDetails, array('admin_id' => $this->getId()));
		else return $this->db->insert('admin', $adminDetails);
	}	
	public function delete()
	{
		return $this->db->delete('admin', array('admin_id' => $this->getId()));
	}
}