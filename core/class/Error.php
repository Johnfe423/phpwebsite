<?php

class PHPWS_Error {

  function &get($value, $module, $funcName=NULL, $extraInfo=NULL){
    $errorFile = PHPWS_Core::getConfigFile($module, "error.php");

    if (PEAR::isError($errorFile))
      exit($errorFile->getMessage());

    include $errorFile;
    if (!isset($errors))
      return FALSE;

    if (PEAR::isError($value))
      $value = $value->getCode();

    if ($module != "core")
      $fullError[] = $module;
    else
      $fullError[] = "Core";

    if (isset($funcName))
      $fullError[] = "::$funcName()";

    if (isset($errors[$value]))
      $message = $errors[$value] . ".";
    else
      $message = $errors[PHPWS_UNKNOWN] . ".";

    $fullError[] = " - " . $message;

    if (isset($extraInfo)){
      if (is_array($extraInfo))
	_print($message, $extraInfo);
      else
	$fullError[] = " [" . $extraInfo . "]";
    }

    $error = &PEAR::raiseError($message, $value, NULL, NULL, implode("", $fullError));
    return $error;
  }

  function log($value, $module=NULL, $funcName=NULL, $extraInfo=NULL){
    if (!PEAR::isError($value)) 
      $error = &PHPWS_Error::get($value, $module, $funcName, $extraInfo);
    else
      $error = $value;

    if (!is_writable(PHPWS_LOG_DIRECTORY))
      exit("Unable to write to log directory");

    if ((bool)PHPWS_LOG_ERRORS == FALSE)
      return;

    $final = PHPWS_Error::printError($error);

    $conf = array('mode' => 0600, 'timeFormat' => '%X %x');
    $log  = &Log::singleton('file', PHPWS_LOG_DIRECTORY . 'error.log', 'Error', $conf, PEAR_LOG_NOTICE);

    $log->log("$final", PEAR_LOG_NOTICE);

    $log->close();
  }


  function printError($error){
    $code  = $error->getcode();
    $message = $error->getuserinfo();
    
    if (!isset($message))
      $message = $error->getmessage();
    
    $final = "[" . $code . "] $message"; 

    return $final;
  }

}

?>