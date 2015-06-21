<?php

	namespace system\core;

  /**
   * Class Autoloader
   * @package system\core
   * @author Denis Chekirda
   */
  class Autoloader {
    /**
     * @var array
     */
    private $namespaces = array();
    /**
     * @var string
     */
    private $autoloadRoot;

    /**
     * @param null $root
     * @param array $namespaces
     */
    function __construct($root = null, $namespaces = array()) {
      $this->autoloadRoot = $root ?: '..' . DIRECTORY_SEPARATOR . '..';
      $this->namespaces = $this->_trimPaths($namespaces);

      set_include_path(stream_resolve_include_path($this->autoloadRoot)
        . PATH_SEPARATOR . get_include_path());
    }

    /**
     * Prepares namespaces to start application core.
     * @method prepareNamespace
     * @param Array $namespaces Array list of namespaces.
     * @return Autoloader $this
     */
    public function prepareNamespace($namespaces) {
      $trimedNamespaced = $this->_trimPaths($namespaces);

      foreach ($trimedNamespaced as $namespace) {
        $this->namespaces[] = $namespace;
      }
      return $this;
    }

    /**
     * Gets namespaces.
     * @return array
     */
    public function getNamespaces() {
      return $this->namespaces;
    }

    /**
     * Registering classes in system.
     * @return bool
     */
    public function register() {
      // file extensions to look for
      spl_autoload_extensions('.php');

      // add PHP default autoloader first, to work around
      // LogicException bug in PHP
      spl_autoload_register('spl_autoload', false, true);

      return spl_autoload_register(array($this, 'findFile'), false, false);
    }

    /**
     * Trims paths from namespace list.
     * @param array $namespaces
     * @return array
     */
    private function _trimPaths($namespaces = array()) {
      $trimNamespace = array();
      if ($namespaces) {
        $trimNamespace = array_map(function($includePath) {
          $trimmed = rtrim(reset($includePath), DIRECTORY_SEPARATOR);
          return array(key($includePath) => $trimmed);
        }, $namespaces);
      }

      return $trimNamespace;
    }
  }