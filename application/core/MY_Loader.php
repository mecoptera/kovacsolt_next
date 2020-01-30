<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
  protected function _ci_init_library($class, $prefix, $config = FALSE, $object_name = NULL)
  {
    // Is there an associated config file for this class? Note: these should always be lowercase
    if ($config === NULL)
    {
      // Fetch the config paths containing any package paths
      $config_component = $this->_ci_get_component('config');

      if (is_array($config_component->_config_paths))
      {
        $found = FALSE;
        foreach ($config_component->_config_paths as $path)
        {
          // We test for both uppercase and lowercase, for servers that
          // are case-sensitive with regard to file names. Load global first,
          // override with environment next
          if (file_exists($path.'config/'.strtolower($class).'.php'))
          {
            include($path.'config/'.strtolower($class).'.php');
            $found = TRUE;
          }
          elseif (file_exists($path.'config/'.ucfirst(strtolower($class)).'.php'))
          {
            include($path.'config/'.ucfirst(strtolower($class)).'.php');
            $found = TRUE;
          }

          if (file_exists($path.'config/'.ENVIRONMENT.'/'.strtolower($class).'.php'))
          {
            include($path.'config/'.ENVIRONMENT.'/'.strtolower($class).'.php');
            $found = TRUE;
          }
          elseif (file_exists($path.'config/'.ENVIRONMENT.'/'.ucfirst(strtolower($class)).'.php'))
          {
            include($path.'config/'.ENVIRONMENT.'/'.ucfirst(strtolower($class)).'.php');
            $found = TRUE;
          }

          // Break on the first found configuration, thus package
          // files are not overridden by default paths
          if ($found === TRUE)
          {
            break;
          }
        }
      }
    }

    $class_name = $prefix.$class;

    // Is the class name valid?
    if ( ! class_exists($class_name, FALSE))
    {
      log_message('error', 'Non-existent class: '.$class_name);
      show_error('Non-existent class: '.$class_name);
    }

    // Set the variable name we will assign the class to
    // Was a custom class name supplied? If so we'll use it
    if (empty($object_name))
    {
      $object_name = strtolower($class);
      if (isset($this->_ci_varmap[$object_name]))
      {
        $object_name = $this->_ci_varmap[$object_name];
      }
    }

    // Don't overwrite existing properties
    $CI =& get_instance();
    if (isset($CI->$object_name))
    {
      if ($CI->$object_name instanceof $class_name)
      {
        log_message('debug', $class_name." has already been instantiated as '".$object_name."'. Second attempt aborted.");
        return;
      }

      show_error("Resource '".$object_name."' already exists and is not a ".$class_name." instance.");
    }

    // Save the class name and object name
    $this->_ci_classes[$object_name] = $class;

    // Instantiate the class

    if ($config !== null) {
      if (isset($config['singleton']) && $config['singleton']) {
        $CI->$object_name = $object_name::getInstance($config);
      } else {
        $CI->$object_name = new $class_name($config);
      }
    } else {
      $CI->$object_name = new $class_name();
    }
  }
}
