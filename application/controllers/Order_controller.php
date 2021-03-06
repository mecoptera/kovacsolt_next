<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_controller extends MY_Controller {
  private $shippingMethods = [
    // ['key' => 'personal', 'value' => 'Személyes átvétel', 'price' => 0],
    // ['key' => 'post', 'value' => 'Postai átvétel', 'price' => 800],
    ['key' => 'delivery', 'value' => 'Házhozszállítás', 'price' => 1200],
    // ['key' => 'post_point', 'value' => 'Átvétel csomagponton', 'price' => 800]
  ];

  private $paymentMethods = [
    ['key' => 'cash', 'value' => 'Készpénzzel', 'available_for' => ['personal']],
    ['key' => 'card', 'value' => 'Bankkártyás fizetés', 'available_for' => ['personal', 'delivery', 'post', 'post_point']],
    ['key' => 'delivery', 'value' => 'Utánvétellel futárnak', 'available_for' => ['delivery']]
  ];

  public function __construct() {
    parent::__construct();

    $this->load->model('base_product_model', 'baseProductModel');
    $this->load->model('base_product_variant_model', 'baseProductVariantModel');
    $this->load->model('base_product_view_model', 'baseProductViewModel');
    $this->load->model('base_product_color_model', 'baseProductColorModel');

    $this->load->library('cart', ['singleton' => true]);
  }

  public function index() {
    if ($this->userModel->isLoggedIn()) {
      return redirect('order/billing');
    } else {
      $this->session->set_flashdata('errors', $this->session->flashdata('errors'));
      $this->session->set_flashdata('old', $this->session->flashdata('old'));
      return redirect('order/login');
    }
  }

  public function login() {
    if ($this->userModel->isLoggedIn()) {
      return redirect('order/billing');
    }

    $this->session->set_userdata('login_error_redirect', 'order');
    $this->session->set_userdata('login_success_redirect', 'order');

    $this->load->helper('MY_form_helper');
    $this->slice->view('page.order.profile', ['step' => 0, 'errors' => $this->session->flashdata('errors')]);
  }

  public function registration() {
    $this->session->set_userdata('login_error_redirect', 'order');
    $this->session->set_userdata('login_success_redirect', 'order');

    return redirect('registration');
  }

  public function billing() {
    $this->slice->view('page.order.billing', [
      'step' => 1,
      'billingData' => $this->session->userdata('order.billingData'),
      'errors' => $this->session->flashdata('validationErrors'),
    ]);
  }

  public function billingPost() {
    $this->load->library('form_validation');

    $this->session->set_userdata('order.billingData', $this->input->post());

    $this->form_validation->set_error_delimiters('', '');

    $this->form_validation->set_rules('name', null, 'required', [ 'required' => 'Kötelező kitölteni' ]);
    $this->form_validation->set_rules('zip', null, 'required|is_natural|max_length[4]', [
      'required' => 'Kötelező kitölteni',
      'is_natural' => 'Csak számokat tartalmazhat',
      'max_length' => 'Maximum 4 számjegy',
    ]);
    $this->form_validation->set_rules('city', null, 'required', [ 'required' => 'Kötelező kitölteni' ]);
    $this->form_validation->set_rules('address', null, 'required', [ 'required' => 'Kötelező kitölteni' ]);
    $this->form_validation->set_rules('email', null, 'required|valid_email', [
      'required' => 'Kötelező kitölteni',
      'valid_email' => 'Nem megfelelő e-mail formátum',
    ]);

    if ($this->form_validation->run() === false) {
      $this->session->set_flashdata('validationErrors', $this->form_validation->error_array());

      return redirect(current_url());
    }

    return redirect('order/shipping');
  }

  public function shipping() {
    $this->slice->view('page/order/shipping', [
      'step' => 2,
      'shippingData' => $this->session->userdata('order.shippingData'),
      'shippingMethods' => $this->shippingMethods,
      'errors' => $this->session->flashdata('validationErrors')
    ]);
  }

  public function shippingPost() {
    $this->load->library('form_validation');

    if ($this->input->post('same_as_billing')) {
      $billingData = $this->session->userdata('order.billingData');
      $this->session->set_userdata('order.shippingData', [
        'same_as_billing' => true,
        'shipping_method' => $this->input->post('shipping_method'),
        'name' => $billingData['name'],
        'zip' => $billingData['zip'],
        'city' => $billingData['city'],
        'address' => $billingData['address'],
        'email' => $billingData['email'],
        'phone' => $billingData['phone']
      ]);
    } else {
      $postData = array_merge($this->input->post(), ['same_as_billing' => false]);
      $this->session->set_userdata('order.shippingData', $postData);

      $this->form_validation->set_error_delimiters('', '');

      $this->form_validation->set_rules('name', null, 'required', ['required' => 'Kötelező kitölteni']);
      $this->form_validation->set_rules('zip', null, 'required|is_natural|max_length[4]', [
        'required' => 'Kötelező kitölteni',
        'is_natural' => 'Csak számokat tartalmazhat',
        'max_length' => 'Maximum 4 számjegy',
      ]);
      $this->form_validation->set_rules('city', null, 'required', ['required' => 'Kötelező kitölteni']);
      $this->form_validation->set_rules('address', null, 'required', ['required' => 'Kötelező kitölteni']);
      $this->form_validation->set_rules('email', null, 'required|valid_email', [
        'required' => 'Kötelező kitölteni',
        'valid_email' => 'Nem megfelelő e-mail formátum',
      ]);

      if ($this->form_validation->run() === false) {
        $this->session->set_flashdata('validationErrors', $this->form_validation->error_array());
        return redirect(current_url());
      }
    }

    $this->session->set_userdata('order.paymentData', ['payment_method' => 'card']);

    return redirect('order/finalize');
  }

  public function payment() {
    $shippingMethod = $this->session->userdata('order.shippingData')['shipping_method'];
    $availablePaymentMethods = array_filter($this->paymentMethods, function($method) use ($shippingMethod) {
      return in_array($shippingMethod, $method['available_for']);
    });

    $this->slice->view('page/order/payment', [
      'step' => 3,
      'paymentData' => $this->session->userdata('order.paymentData'),
      'availablePaymentMethods' => $availablePaymentMethods,
      'errors' => $this->session->flashdata('validationErrors')
    ]);
  }

  public function paymentPost() {
    $this->session->set_userdata('order.paymentData', $this->input->post());

    return redirect('order/finalize');
  }

  public function finalize() {
    $shippingMethodKey = $this->session->userdata('order.shippingData')['shipping_method'];
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

    $paymentMethodKey = $this->session->userdata('order.paymentData')['payment_method'];
    $paymentMethod = array_reduce($this->paymentMethods, function($carry, $method) use ($paymentMethodKey) {
      if ($paymentMethodKey === $method['key']) {
        $carry = $method;
      }

      return $carry;
    }, []);

    $cartItems = array_map(function($cartItem) {
      $cartItem['product']->base_product_variant_image = media('variant', $cartItem['product']->base_product_variant_id);
      $cartItem['product']->product_variant_design_image = media('design', $cartItem['product']->product_variant_design_id);
      return $cartItem;
    }, $this->cart->get());

    $cartPrice = $this->cart->price();

    $this->slice->view('page/order/finalize', [
      'step' => 4,
      'billingData' => $this->session->userdata('order.billingData'),
      'shippingData' => $this->session->userdata('order.shippingData'),
      'shippingMethodText' => $shippingMethod['value'],
      'paymentData' => $this->session->userdata('order.paymentData'),
      'paymentMethodText' => $paymentMethod['value'],
      'finalizeData' => $this->session->userdata('order.finalizeData'),
      'cartItems' => $cartItems,
      'price' => $cartPrice,
      'shippingPrice' => $shippingPrice,
      'priceTotal' => $cartPrice + $shippingPrice
    ]);
  }

  public function finalizePost() {
    $this->session->set_userdata('order.finalizeData', $this->input->post());

    require_once APPPATH . '/third_party/simple-pay/SimplePay.php';

    $visibleOrderId = number_format(mt_rand(100000, 999999), 0, ',', '-');
    $this->session->set_userdata('order.id', $visibleOrderId);
    $this->session->set_userdata('order.inProgress', true);

    $order = [
      'visibleOrderId' => $visibleOrderId,
      'billingData' => $this->session->userdata('order.billingData'),
      'shippingData' => $this->session->userdata('order.shippingData'),
    ];

    $cartItems = $this->cart->get();

    $url = SimplePay::pay($order, $cartItems, $this->cart->price());

    return redirect($url);
  }

  public function result() {
    require_once APPPATH . '/third_party/simple-pay/SimplePay.php';

    $result = SimplePay::result();

    if ($result['e'] === 'SUCCESS' && $this->session->userdata('order.inProgress')) {
      $this->session->set_userdata('order.inProgress', false);
      return $this->handleSuccess();
    } else if ($result['e'] === 'SUCCESS') {
      return $this->slice->view('page/order/success', ['orderId' => $this->session->userdata('order.id')]);
    } else {
      return $this->handleError();
    }
  }

  private function handleSuccess() {
    $visibleOrderId = $this->session->userdata('order.id');

    $shippingMethodKey = $this->session->userdata('order.shippingData')['shipping_method'];
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

    $paymentMethodKey = $this->session->userdata('order.paymentData')['payment_method'];
    $paymentMethod = array_reduce($this->paymentMethods, function($carry, $method) use ($paymentMethodKey) {
      if ($paymentMethodKey === $method['key']) {
        $carry = $method;
      }

      return $carry;
    }, []);

    $cartItems = array_map(function($cartItem) {
      $cartItem['product']->base_product_variant_image = media('variant', $cartItem['product']->base_product_variant_id);
      $cartItem['product']->product_variant_design_image = media('design', $cartItem['product']->product_variant_design_id);
      return $cartItem;
    }, $this->cart->get());

    $cartPrice = $this->cart->price();

    $this->db->query('
      INSERT INTO `orders` (`order_id`, `visible_order_id`, `user_id`, `billing_data`, `shipping_data`, `payment_data`, `finalize_data`, `status`, `created_at`, `updated_at`)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
        md5(uniqid()),
        $visibleOrderId,
        $this->userModel->isLoggedIn() ? $this->session->userdata('user')->id : null,
        json_encode($this->session->userdata('order.billingData')),
        json_encode($this->session->userdata('order.shippingData')),
        json_encode($this->session->userdata('order.paymentData')),
        json_encode($this->session->userdata('order.finalizeData')),
        'new',
        date('Y-m-d H:i:s'),
        date('Y-m-d H:i:s')
      ]
    );

    $orderId = $this->db->insert_id();

    foreach($cartItems as $item) {
      $this->db->query('
        INSERT INTO `order_products` (`order_id`, `product_id`, `extra_data`, `price`, `quantity`, `status`, `created_at`, `updated_at`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [
          $orderId,
          $item['product']->id,
          json_encode($item['extraData']),
          $item['product']->price * (1 - $item['product']->discount / 100) * $item['quantity'],
          $item['quantity'],
          'in_progress',
          date('Y-m-d H:i:s'),
          date('Y-m-d H:i:s')
        ]
      );
    }

    $this->load->library('email');

    $this->email->from('admin@kovacsoltpolo.hu', 'Kovácsolt Póló');
    $this->email->to(ENVIRONMENT === 'development' ? 'krazyqwed@gmail.com' : $this->input->post('email'));
    $this->email->subject('Fiók aktiválása');
    $this->email->message($this->slice->view('mail.activate-user', [
      'orderId' => $this->session->userdata('order.id'),
      'billingData' => $this->session->userdata('order.billingData'),
      'shippingData' => $this->session->userdata('order.shippingData'),
      'shippingMethodText' => $shippingMethod['value'],
      'paymentData' => $this->session->userdata('order.paymentData'),
      'paymentMethodText' => $paymentMethod['value'],
      'finalizeData' => $this->session->userdata('order.finalizeData'),
      'cartItems' => $cartItems,
      'price' => $cartPrice,
      'shippingPrice' => $shippingPrice,
      'priceTotal' => $cartPrice + $shippingPrice
    ]));
    $this->email->send();

    $this->cart->empty();

    return $this->slice->view('page/order/success', ['orderId' => $this->session->userdata('order.id')]);
  }

  private function handleError() {
    return $this->slice->view('page/order/error');
  }
}
