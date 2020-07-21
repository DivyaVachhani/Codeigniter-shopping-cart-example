<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('product');
	}

	public function index()
	{
		$data['product_data'] = $this->product->getAllProduct();
		
		$this->load->view('welcome_message',$data);
	}
	public function add_to_cart($id)
	{
		$product_data = $this->product->addToCart($id);
		$data = array(
			'id' => $product_data['id'],
			'qty' => 1,
			'price' => $product_data['product_price'],
			'name' => $product_data['product_name'],
			'image' => $product_data['product_image'],
		);
		$this->cart->insert($data);
		return redirect('welcome/cart');
	}

	public function cart()
	{
		$data = array();
		$data['cartItems'] = $this->cart->contents();
		$this->load->view('cart',$data);
	}

	public function updateCartItem()
	{
		$update = 0;
		$rowid = $this->input->get('rowid');
		$qty = $this->input->get('qty');

		$data = array(
			'rowid' => $rowid,
			'qty' => $qty
		);

		$update = $this->cart->update($data);

		echo $update?'ok':'error';
	}

	public function remove_from_cart($rowid)
	{
		$this->cart->remove($rowid);

		return redirect('welcome/cart');
	}

	public function checkout()
	{
		$data['cartItems'] = $this->cart->contents();

		$this->load->view('checkout',$data);
	}

	public function order()
	{
		$data = $this->input->post();
		$customer_id = $this->product->add_customer($data);
		$order_id = $this->product->add_order($data,$customer_id);
		$order_data = $this->cart->contents();
		$this->product->add_order_detail($order_data,$order_id);
	}
	


}








