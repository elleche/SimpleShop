<?php
class Newsletter extends CI_Model 
{
	private $id;
	private $autorEmail;
	private $autorName;
	private $subject;
	private $body;
	private $campaingType;
	
	public function __construct($dataRow = FALSE)
	{
		$this->load->library('email');
		$this->load->database();
		
		$this->id = 0;
		$this->autorEmail = '';
		$this->autorName = '';
		$this->subject = '';
		$this->body = '';
		$this->campaingType = 'purchase';
		if (!empty($dataRow))
		{
/*			if(isset($dataRow['product_id'])) $this->productId = $dataRow['product_id'];
			if(isset($dataRow['product_title'])) $this->productTitle = $dataRow['product_title'];
			if(isset($dataRow['product_slug'])) $this->productSlug = $dataRow['product_slug'];
			if(isset($dataRow['product_price'])) $this->productPrice = $dataRow['product_price'];
			if(isset($dataRow['product_availability'])) $this->productAvailability = $dataRow['product_availability'];
*/		}
	}
	
	public function sendMailToContact($contact)
	{
		if($contact->isSubscribed())
		{
			$this->email->from($this->autorEmail, $this->autorName);
			$this->email->to($contact->getEmail());
			if ($this->campaignType == 'purchase')	$this->email->cc($this->autorEmail);

			$this->email->subject($this->subject);
			$this->email->message($this->body);

			$this->email->send();
		}
	}
	
}
	