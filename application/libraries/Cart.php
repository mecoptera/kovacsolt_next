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

    $userCart = null;

    if ($this->CI->userModel->isLoggedIn()) {
      $this->userId = $this->CI->session->userdata('user')->id;
      $userCart = $this->CI->cartModel->getByUserId($this->userId);
    }

    if ($userCart !== null) {
      $this->cartId = $userCart->id;
    } elseif ($this->userId !== null) {
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

  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new Cart();
    }

    return self::$instance;
  }

  public function get() {
    return $this->items;
  }

  public function getQuantity() {
    $count = 0;

    foreach ($this->items as $item) {
      $count += $item['quantity'];
    }

    return $count;
  }

  public function add($productId, $extraData) {
    $this->CI->load->model('product_model', 'productModel');

    $product = $this->CI->productModel->get($productId);
    $existingCartItem = $this->getCartItemByIdAndData($productId, $extraData);
    $uniqueId = $existingCartItem ? $existingCartItem['uniqueId'] : md5(uniqid());

    if ($existingCartItem) {
      $this->setQuantity($existingCartItem['uniqueId'], $existingCartItem['quantity'] + 1);
    } else {
      $this->items[] = [
        'uniqueId' => $uniqueId,
        'product' => $product,
        'extraData' => $extraData,
        'quantity' => 1
      ];

      $this->updateDatabase($uniqueId);
      $this->CI->session->set_userdata('cart', $this->items);
    }
  }

  public function remove($uniqueId) {
    $key = array_search($uniqueId, array_column($this->items, 'uniqueId'));
    unset($this->items[$key]);

    $this->updateDatabase($uniqueId);
    $this->CI->session->set_userdata('cart', $this->items);
  }

  public function setQuantity($uniqueId, $quantity) {
    $key = array_search($uniqueId, array_column($this->items, 'uniqueId'));

    if (intval($quantity) === 0) {
      $this->remove($uniqueId);
    } else {
      $this->items[$key]['quantity'] = $quantity;

      $this->updateDatabase($uniqueId);
      $this->CI->session->set_userdata('cart', $this->items);
    }
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

  private function getCartItemByIdAndData($productId, $extraData) {
    return array_filter($this->items, function($value, $key) use ($productId, $extraData) {
      return $value['product']->id === $productId && $value['extraData'] == $extraData;
    }, ARRAY_FILTER_USE_BOTH)[0];
  }
}
