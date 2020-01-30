<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart {
  protected $CI;
  private static $instance = null;

  private $items = [];
  private $userId = null;
  private $cartId = null;

  private function __construct() {
    $this->CI = &get_instance();
    $this->CI->load->model('cart_model', 'cartModel');
    $this->CI->load->model('cart_product_model', 'cartProductModel');

    if ($this->CI->userModel->isLoggedIn()) {
      $this->userId = $this->CI->session->userdata('user')->id;
      $userCart = $this->CI->cartModel->getByUserId($this->userId);

      if ($userCart !== null) {
        $this->cartId = $userCart->id;
      }

      if ($this->userId !== null && $userCart === null) {
        $this->cartId = $this->CI->cartModel->create($this->userId);
      }

      if ($this->CI->session->userdata('cart') !== null) {
        $this->items = $this->CI->session->userdata('cart');
      } elseif ($this->userId !== null) {
        $cartItems = $this->CI->cartProductModel->getAllByCartId($this->cartId);

        foreach ($cartItems as $cartItem) {
          $this->items[$cartItem->unique_id] = [
            'uniqueId' => $cartItem->unique_id,
            'product' => $cartItem->product,
            'extraData' => json_decode($cartItem->extra_data, true),
            'quantity' => $cartItem->quantity,
          ];
        }

        $this->CI->session->set_userdata('cart', $this->items);
      }
    }
  }

  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new Cart();
    }

    return self::$instance;
  }

  public function get() {
    return $this->items;
  }

  public function add($productId, $extraData) {
    $this->CI->load->model('product_model', 'productModel');

    $product = $this->CI->productModel->get($productId);
    $uniqueId = md5(uniqid());

    $this->items[] = [
      'uniqueId' => $uniqueId,
      'product' => $product,
      'extraData' => $extraData,
      'quantity' => 1
    ];

    $this->updateDatabase($uniqueId);
    $this->CI->session->set_userdata('cart', $this->items);
  }

  private function updateDatabase($uniqueId) {
    if (!$this->userId) { return; }

    $key = array_search($uniqueId, array_column($this->items, 'uniqueId'));

    if (isset($this->items[$key])) {
      $this->CI->cartProductModel->updateOrCreate($this->cartId, $this->items[$key]);
    } else {
      $this->CI->cartProductModel->deleteByUniqueId($this->cartId, $uniqueId);
    }
  }
}
