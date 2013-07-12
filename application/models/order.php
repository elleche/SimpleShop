<?php
//class Order
class Order extends CI_Model
{
	private $orderId;
	private $orderDate;
	private $buyerDetails;
	private $buyerEmail;
	private $productId;
	private $productQuantity;
	private $orderAmount;
//	private $db;
	
	public function getOrderDate()
	{
		return date('Y-m-d H:i:s', strtotime($this->orderDate));
	}
	public function getBuyerDetails()
	{
		return $this->buyerDetails;
	}
	public function getBuyerEmail()
	{
		return $this->buyerEmail;
	}
	public function getProductId()
	{
		return $this->productId;
	}
	public function getProductTitle()
	{
		$product = Product::getProducts($this->productId);
		return $product->getTitle();
	}
	public function getProductQuantity()
	{
		return $this->productQuantity;
	}
	public function getOrderAmount()
	{
		return $this->orderAmount;
	}

	public function __construct($dataRow = FALSE)
	{
//		$CI =& get_instance();
//		$this->db = $CI->db;
		$this->load->database();		
		$this->load->model('product', 'productModel');
		
		$this->orderId = 0;
		$this->orderDate = getdate();
		$this->orderAmount = 0;
		$this->buyerDetails = '';
		$this->buyerEmail = '';
		$this->productId = 0;
		$this->productQuantity = 0;
		if (!empty($dataRow))
		{
			if(isset($dataRow['order_id'])) $this->orderId = $dataRow['order_id'];
			if(isset($dataRow['order_date'])) $this->orderDate = $dataRow['order_date'];
			if(isset($dataRow['order_amount'])) $this->orderAmount = $dataRow['order_amount'];
			if(isset($dataRow['buyer_details'])) $this->buyerDetails = $dataRow['buyer_details'];
			if(isset($dataRow['buyer_email'])) $this->buyerEmail = $dataRow['buyer_email'];
			if(isset($dataRow['product_id'])) $this->productId = $dataRow['product_id'];
			if(isset($dataRow['product_quantity'])) $this->productQuantity = $dataRow['product_quantity'];
		}
	}
	public static function getOrders()
	{
		$CI =& get_instance();	
		$CI->db->order_by('buyer_email', 'asc');
		$query = $CI->db->get('orders');
		$dataRows = $query->result_array();
		$orders  = array();
		foreach($dataRows as $row)
		{
			$orders[] = new Order($row);
		}
		return $orders;	
	}
	public function placeOrder($orderDetails)
	{
		$purchaseSuccess = false;
		$this->db->trans_start();
		
		//locks table products for this specific product by id
		$product = Product::selectProductForUpdate($orderDetails['product_id']);
		$productQuantity = $orderDetails['product_quantity'];
		
		if (!$product->isEmpty() && $product->getAvailability() >= $productQuantity)
		{	
			$orderDetails['order_amount'] = $product->getPrice() * $productQuantity;
			
			$this->db->insert('orders', $orderDetails);
			//update unlocks the table
			$product->updateProduct(					
					array('product_availability' => $product->getAvailability() - $productQuantity));
			$purchaseSuccess = true;
		}
		
		$this->db->trans_complete();
		
		return ($purchaseSuccess && $this->db->trans_status());
	}
}