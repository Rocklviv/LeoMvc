<?php

namespace system\core;
use \system\exceptions\ErrorHandler;
use \system\exceptions\HttpException;

/**
 * Class Router
 * @package system\core
 * @author Denis Chekirda
 */
class Router {

  /**
   * Stores requested URI.
   * @var null
   */
  private $uri = null;
  /**
   * Stores list of available routes.
   * @var array
   */
  private $listRoutes = array();
  /**
   * Stores additional params.
   * @var null
   */
  private $additionalParams = null;
  /**
   * Stores additional param.
   * @var null
   */
  private $param = null;

  /**
   * Starts routing.
   * @param array $routes List of routes.
   */
  function start($routes = array()) {
    if ($routes) {
      $this->listRoutes = $routes;
    }
    self::_processRequest();
  }

  /**
   * Creates new instance as requested.
   * @param array $request
   */
  function createInstance($request) {
    $controller_path = APP .'/'. $request['controller'] .'/'. $request['controller'] . '.php';
    $controller = $request['controller'];
    $method = $request['method'];

    if ($controller_path) {
      $class = '\\application\\' . $controller . '\\' . $controller;
      $ctr = new $class;
      if (method_exists($ctr, $method)) {
        if ($this->param){
          $ctr->$method($this->param);
        } else {
          $ctr->$method();
        }
      }
    }
  }

  /**
   * Checks controller on exist.
   * @param $controller_path
   * @deprecated Will be reimplemented.
   * @return bool
   */
  private function _checkControllerExists($controller_path) {
    try {
      if (file_exists($controller_path)) {
        require_once ($controller_path);
      } else {
        throw new HttpException(404, 'Requested page <b> ' . $_SERVER['REQUEST_URI'] . '</b> not found.');
      }
    } catch (HttpException $e) {
      $err = new ErrorHandler();
      $err->get404($e);
    }
  }

  /**
   * Prepares initialize of instance as requested.
   * @throws HttpException
   */
  private function _processRequest() {
    $additionalParams = explode('?', $_SERVER['REQUEST_URI']);
    // Additional params after ?
    $this->additionalParams = $additionalParams;
    self::_checkParams();

    $uri = $_SERVER['REQUEST_URI'] ?: '';
    $rUri = explode('/', $uri);

    $this->uri = self::_removeEmptyUriPart($rUri);
    $r = self::_checkRoutes();

    try {
      if ($r) {
        $this->createInstance($r);
      } else {
        throw new HttpException(404, 'Requested page <b> ' . $uri . '</b> not found.');
      }
    } catch (HttpException $e) {
      $err = new ErrorHandler();
      $err->get404($e);
    }
  }

  /**
   * Removes empty values from URI array.
   * @method _removeEmptyUriPart
   * @param array $uri Requested URI.
   * @return array $modifiedUri Returns clean URI.
   */
  private function _removeEmptyUriPart($uri) {
    $modifiedUri = array();
    if (sizeof($uri) >= 3) {
      $this->param = $uri[sizeof($uri) - 1];
      unset($uri[sizeof($uri) - 1]);
    }
    foreach ($uri as $key => $value) {
      if ($value !== '') $modifiedUri[] = $value;
    }
    return $modifiedUri;
  }

  /**
   * Checks $_SERVER['REQUEST_URI'] for additional params.
   * @method _checkParams
   */
  private function _checkParams() {
    if (preg_match("/\?\w+\=\d+/", $_SERVER['REQUEST_URI'])) {
      $_SERVER['REQUEST_URI'] = preg_replace("/\?\w+\=\d+/", "", $_SERVER['REQUEST_URI']);
    }
  }

  /**
   * Checks route in the list of allowed routes.
   * If request is valid returns controller name and method.
   * @method _checkRoutes
   * @return bool|array
   */
  private function _checkRoutes() {
    $r = array();
    $route = '';
    $max = sizeof($this->uri);

    if ($max >= 1) {
      for ($i = 0; $i < $max; $i++) {
        $route .= $this->uri[$i] . '/';
      }
    } else {
      $route = '/';
    }
    foreach($this->listRoutes as $key => $val) {
      $r[] = $key;
    }

    if (in_array($route, $r)) {
      return $this->listRoutes[$route];
    } else {
      return false;
    }
  }

}