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
//	private $db;

	public function __construct($dataRow = FALSE)
	{
//		$CI =& get_instance();
//		$this->db = $CI->db;
		$this->load->database();
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
			if(isset($dataRow['product_availability'])) $this->productAvailability = $dataRow['product_availability'];
		}
	}
	
	public function placeOrder($orderDetails)
	{
//		$purchaseSuccess = false;

		//TODO lock table products here (for this specific product by id
		$this->db->trans_start();
		
		$product = Product::getProducts($orderDetails['product_id']);
		$productQuantity = $orderDetails['product_quantity'];
		
		if (!$product->isEmpty() && $product->getAvailability() >= $productQuantity)
		{	
			$orderDetails['order_amount'] = $product->getPrice() * $productQuantity;
			
//			$orderPlaced = $this->db->insert('orders', $orderDetails);	
//			if ($orderPlaced)			
//			{
//				$purchaseSuccess = $product->updateProduct(
//					array('product_availability' => $product->getAvailability() - $productQuantity));				
//			}			
			
			$this->db->insert('orders', $orderDetails);
			$product->updateProduct(					
					array('product_availability' => $product->getAvailability() - $productQuantity));
		}
		
		//TODO unlock table products (by product_id)
		$this->db->trans_complete();
		
//		return 	$purchaseSuccess;
		return 	$this->db->trans_status();
	}
}