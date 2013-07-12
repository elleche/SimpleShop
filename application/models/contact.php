<?php
class Contact extends CI_Model
{
	private $contactId;
	private $contactEmail;
	private $isSubscribed;
	
	public function getId()
	{
		return $this->contactId;
	}
	public function getEmail()
	{
		return $this->contactEmail;
	}
	public function isSubscribed()
	{
		return $this->isSubscribed;
	}
	public function isSubscribedToDB()
	{
		return ($this->isSubscribed) ? 't' : 'f';
	}
	public function setEmail($email)
	{
		$this->contactEmail = $email;
	}
	public function setSubscribed($isSubscribed)
	{
		$this->isSubscribed = $isSubscribed;
	}
	
	public function __construct($dataRow = FALSE)
	{		
		$this->load->database();
		$this->contactId = 0;
		$this->contactEmail = '';
		$this->isSubscribed = true;
		if (!empty($dataRow))
		{
			if(isset($dataRow['contact_id'])) $this->contactId = $dataRow['contact_id'];
			if(isset($dataRow['contact_email'])) $this->contactEmail = $dataRow['contact_email'];
			if(isset($dataRow['is_subscribed'])) $this->isSubscribed = $dataRow['is_subscribed'];
		}
	}
	
	public function save($data = false)
	{		
		if (empty($data))
		{
			$data = array(
				'contact_email' => $this->getEmail(),
				'is_subscribed' => $this->isSubscribedToDB()
			);
		}
		if($this->getId() > 0) return $this->db->update('contacts', $data, array('contact_id' => $this->getId()));
		else return $this->db->insert('contacts', $data);
	}
	public static function getContactByEmail($email)
	{
		$CI =& get_instance();		
		$query = $CI->db->get_where('contacts', array('contact_email' => $email));
		$row = $query->row_array();
		return new Contact($row);		
	}
	public static function getContacts()
	{		
		$CI =& get_instance();	
		$CI->db->order_by('contact_email', 'asc');
		$query = $CI->db->get('contacts');
		$dataRows = $query->result_array();
		$contacts  = array();
		foreach($dataRows as $row)
		{
			$contacts[] = new Contact($row);
		}
		return $contacts;	
	}
}