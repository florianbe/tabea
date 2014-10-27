<?php

/**
 *	displayAlertMessage() is used to display different kinds of flashmessages
 *  - error
 *  - message
 *  - success
 *  
 *  @return string
 */
function displayAlertMessage()
{
      if (Session::has('message'))
      {
         list($type, $message) = explode('|', Session::get('message'));

         if ($type == 'error') 
         {
         	$type = 'danger';
         }
         elseif ($type == 'message') {
         	$type = 'info';
         }
         
         
         return ('<div class="alert alert-' . $type . '">' . $message . '</div>');
      }

      return '';
}