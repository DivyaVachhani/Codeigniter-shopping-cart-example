<?php

class Product extends CI_Model{

	public function getAllProduct()
	{
		$query = $this->db->get('products');
		return $query->result_array();
	}
	public function addToCart($id)
	{
		$query = $this->db->where('id',$id)->get('products');
		return $query->row_array();
	}
	public function add_customer($data)
	{
		$data = array(
			'name' => $data['name'],
			'email' => $data['email'],
			'mobile_number' => $data['mobile_number'],
			'address' => $data['address']
		);
		$this->db->insert('customers',$data);
		return $this->db->insert_id();
	}

	public function add_order($data,$customer_id)
	{
		$data = array(
			'order_id' => $data['orderid'],
			'total' => $data['total'],
			'customer_id' => $customer_id
		);
		$this->db->insert('orders',$data);
		return $this->db->insert_id();
	}

	public function add_order_detail($order_data,$order_id)
	{
		foreach ($order_data as $order_detail) {
			$data = array(
			'order_id' => $order_id,
			'product_id' => $order_detail['id'],
			'quantity' => $order_detail['qty'],
			'price' => $order_detail['price']
			);
			$this->db->insert('order_detail',$data);
		}
		
	}

	
}







