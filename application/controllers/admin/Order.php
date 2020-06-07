<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {
  private $shippingMethods = [
    ['key' => 'personal', 'value' => 'Személyes átvétel', 'price' => 0],
    ['key' => 'post', 'value' => 'Postai átvétel', 'price' => 800],
    ['key' => 'delivery', 'value' => 'Házhozszállítás, utánvét', 'price' => 1200],
    ['key' => 'post_point', 'value' => 'Átvétel csomagponton', 'price' => 800]
  ];

  private $paymentMethods = [
    ['key' => 'cash', 'value' => 'Készpénzzel', 'available_for' => ['personal']],
    ['key' => 'card', 'value' => 'Bankkártyás fizetés', 'available_for' => ['personal', 'delivery', 'post', 'post_point']],
    ['key' => 'delivery', 'value' => 'Utánvétellel futárnak', 'available_for' => ['delivery']]
  ];

  protected $middlewares = ['Auth.isLoggedInAsAdmin' => ''];

  public function index() {
    $orders = $this->db->query('SELECT * FROM `orders`')->result();

    $this->slice->view('panel/orders', ['orders' => $orders]);
  }

  public function edit($id) {
    $this->load->model('product_model', 'productModel');

    $order = $this->db->query('SELECT * FROM `orders` WHERE `id` = ?', [$id])->row();
    $orderProducts = $this->db->query('SELECT * FROM `order_products` WHERE `order_id` = ?', [$id])->result_array();

    $cartPrice = 0;

    foreach($orderProducts as $key => $orderProduct) {
      $orderProduct['product'] = $this->productModel->get($orderProduct['product_id']);
      $cartPrice += $orderProduct['price'];

      $orderProducts[$key] = (object)$orderProduct;
    }

    $shippingData = json_decode($order->shipping_data, true);
    $shippingMethodKey = $shippingData['shipping_method'];
    $shippingMethod = array_reduce($this->shippingMethods, function($carry, $method) use ($shippingMethodKey) {
      if ($shippingMethodKey === $method['key']) {
        $carry = $method;
      }

      return $carry;
    }, []);

    $shippingPrice = array_reduce($this->shippingMethods, function($carry, $method) use ($shippingMethodKey) {
      if ($shippingMethodKey === $method['key']) {
        $carry = $method['price'];
      }

      return $carry;
    }, 0);

    $paymentData = json_decode($order->payment_data, true);
    $paymentMethodKey = $paymentData['payment_method'];
    $paymentMethod = array_reduce($this->paymentMethods, function($carry, $method) use ($paymentMethodKey) {
      if ($paymentMethodKey === $method['key']) {
        $carry = $method;
      }

      return $carry;
    }, []);

    $orderProducts = array_map(function($orderProduct) {
      $orderProduct->product->base_product_variant_image = media('variant', $orderProduct->product->base_product_variant_id);
      $orderProduct->product->product_variant_design_image = media('design', $orderProduct->product->product_variant_design_id);
      return $orderProduct;
    }, $orderProducts);

    $this->slice->view('panel.order-edit', [
      'order' => $order,
      'billingData' => json_decode($order->billing_data, true),
      'shippingData' => $shippingData,
      'shippingMethodText' => $shippingMethod['value'],
      'shippingPrice' => $shippingPrice,
      'paymentData' => $paymentData,
      'paymentMethodText' => $paymentMethod['value'],
      'finalizeData' => json_decode($order->finalize_data, true),
      'orderProducts' => $orderProducts,
      'cartPrice' => $cartPrice,
      'totalPrice' => $cartPrice + $shippingPrice
    ]);
  }

  public function update($id, Request $request) {

  }

  public function remove($id) {

  }
}
