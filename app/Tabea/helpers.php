<?php

/**
 *	displayAlertMessage() is used to display different kinds of flashmessages
 *  - error
 *  - message
 *  - success
 *  
 *  @return string
 */
function display_alert_message()
{
      if (Session::has('message'))
      {
         list($dam, $type, $message) = explode('|', Session::get('message'));

         if ($dam != 'dam')
         {
         	return '';
         }

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


function show_errors_for($attribute, $errors)
{
   return $errors->first($attribute, '<div class="alert alert-danger">:message</div>');
}