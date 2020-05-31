<?php

require_once 'SimplePayV21.php';

class SimplePay {
  protected static $CI;

  public static function test($order, $cartItems, $price) {
    self::$CI = &get_instance();
    $config = require_once APPPATH . 'config/simple-pay.php';

    // new SimplePayStart instance
    $trx = new SimplePayStart;
    //add config data
    $trx->addConfig($config);

    $billingData = json_decode($order->billing_data, true);
    $shippingData = json_decode($order->shipping_data, true);
    $timeoutInSec = 600;

    foreach ($cartItems as $cartItem) {
      $trx->addItems(array(
        'ref' => $cartItem['product']->id,
        'title' => $cartItem['product']->name,
        'description' => $cartItem['product']->id,
        'amount' => $cartItem['quantity'],
        'price' => $cartItem['product']->price * (1 - $cartItem['product']->discount / 100),
        'tax' => 0
      ));
    }

    $trx->addData('shippingCost', 1200);

    //add transaction data
    $trx->addData('currency', 'HUF');
    $trx->addData('total', $price);
    $trx->addData('orderRef', $order->order_id);
    $trx->addData('customer', 'v2 START Tester');
    $trx->addData('customerEmail', $billingData['email']);
    $trx->addData('language', 'HU');
    $trx->addData('timeout ', date("c", time() + $timeoutInSec));
    $trx->addData('methods', array('CARD'));
    $trx->addGroupData('urls', 'success', $config['URL_SUCCESS']);
    $trx->addGroupData('urls', 'fail', $config['URL_FAIL']);
    $trx->addGroupData('urls', 'cancel', $config['URL_CANCEL']);
    $trx->addGroupData('urls', 'timeout', $config['URL_TIMEOUT']);

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
}
