<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
  protected $middlewares = [];
  private $middlewareResults = [];

  public function _remap($method, $params = []) {
    $this->_run_middlewares();

    if ($this->input->method(true) === 'POST') {
      return $this->{$method . 'Post'}(...$params);
    } elseif (method_exists($this, $method)) {
      return $this->{$method}(...$params);
    }

    show_404();
  }

  private function _run_middlewares() {
    if (count($this->middlewares) === 0) { return; }

    foreach ($this->middlewares as $middleware => $route) {
      $middlewareParts = explode('.', $middleware);

      if (file_exists(APPPATH . 'middlewares/' . $middlewareParts[0] . '.php')) {
        require APPPATH . 'middlewares/' . $middlewareParts[0] . '.php';
        $ci = &get_instance();
        $middlewareObject = new $middlewareParts[0]($ci);

        if (!method_exists($middlewareObject, $middlewareParts[1])) {
          $this->show_error('Middleware function <b>' . $middlewareParts[1] . '</b> in <b>' . $middlewareParts[0] . '</b> doesn\'t exists.');
        }

        if (strpos($route, 'except::') !== false) {
          $exceptions = explode('|', substr($route, 8));
          $method = $this->router->fetch_method();

          if (array_search($method, $exceptions) === false) {
            $this->middlewareResults[$middleware] = $middlewareObject->{$middlewareParts[1]}();
          }
        } elseif (strlen($route) !== 0) {
          $exceptions = explode('|', $route);
          $method = $this->router->fetch_method();

          if (array_search($method, $exceptions) !== false) {
            $this->middlewareResults[$middleware] = $middlewareObject->{$middlewareParts[1]}();
          }
        } else {
          $this->middlewareResults[$middleware] = $middlewareObject->{$middlewareParts[1]}();
        }
      } else {
        $this->show_error('Middleware file <b>' . $middlewareParts[0] . '</b> doesn\'t exists.');
      }
    }
  }

  protected function middlewareResult($middleware) {
    if (isset($this->middlewareResults[$middleware])) {
      return $this->middlewareResults[$middleware];
    }

    $this->show_error('Middleware result for <b>' . $middleware . '</b> doesn\'t exists.');
  }

  private function show_error($message) {
    if (ENVIRONMENT == 'development') {
      show_error($message);
    } else {
      show_error('Sorry something went wrong.');
    }
  }
}
