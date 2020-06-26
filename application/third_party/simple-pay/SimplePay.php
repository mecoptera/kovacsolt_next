<?php

require_once 'SimplePayV21.php';

class SimplePay {
  protected static $CI;

  public static function pay($order, $cartItems, $price) {
    self::$CI = &get_instance();
    $config = require_once APPPATH . 'config/simple-pay.php';

    $trx = new SimplePayStart;
    $trx->addConfig($config);

    $billingData = $order['billingData'];
    $shippingData = $order['shippingData'];
    $timeoutInSec = 600;

    foreach ($cartItems as $cartItem) {
      $trx->addItems(array(
        'ref' => $cartItem['product']->base_product_name,
        'title' => $cartItem['product']->name,
        'description' => '#' . $cartItem['product']->id,
        'amount' => $cartItem['quantity'],
        'price' => $cartItem['product']->price * (1 - $cartItem['product']->discount / 100),
        'tax' => 0
      ));
    }

    $trx->addData('shippingCost', 1200);

    //add transaction data
    $trx->addData('currency', 'HUF');
    $trx->addData('total', $price);
    $trx->addData('orderRef', $order['visibleOrderId']);
    $trx->addData('customer', $billingData['name']);
    $trx->addData('customerEmail', $billingData['email']);
    $trx->addData('language', 'HU');
    $trx->addData('timeout ', date("c", time() + $timeoutInSec));
    $trx->addData('methods', array('CARD'));
    $trx->addData('url', $config['URL']);

    // invoice
    $trx->addGroupData('invoice', 'name', $billingData['name']);
    $trx->addGroupData('invoice', 'country', 'HU');
    $trx->addGroupData('invoice', 'city', $billingData['city']);
    $trx->addGroupData('invoice', 'zip', $billingData['zip']);
    $trx->addGroupData('invoice', 'address', $billingData['address']);
    $trx->addGroupData('invoice', 'address2', '');
    $trx->addGroupData('invoice', 'phone', $billingData['phone']);

    // delivery
    $trx->addGroupData('delivery', 'name', $shippingData['name']);
    $trx->addGroupData('delivery', 'country', 'HU');
    $trx->addGroupData('delivery', 'city', $shippingData['city']);
    $trx->addGroupData('delivery', 'zip', $shippingData['zip']);
    $trx->addGroupData('delivery', 'address', $shippingData['address']);
    $trx->addGroupData('delivery', 'address2', '');
    $trx->addGroupData('delivery', 'phone', $shippingData['phone']);

    $trx->formDetails['element'] = 'button';
    //create transaction in SimplePay system
    $trx->runStart();

    return $trx->returnData['paymentUrl'];
  }

  public static function result() {
    self::$CI = &get_instance();
    $config = require_once APPPATH . 'config/simple-pay.php';

    $trx = new SimplePayBack;
    $trx->addConfig($config);

    $result = [];
    if (isset($_REQUEST['r']) && isset($_REQUEST['s'])) {
      if ($trx->isBackSignatureCheck($_REQUEST['r'], $_REQUEST['s'])) {
        $result = $trx->getRawNotification();
      }
    }

    return $result;
  }
}
