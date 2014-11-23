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

function set_class($route, $class = 'active')
{
    return Route::currentRouteName() == $route ? $class : '';
}
function show_errors_for($attribute, $errors)
{
   return $errors->first($attribute, '<div class="alert alert-danger">:message</div>');
}

function format_date_to_display($date)
{
    $phpLocale = Config::get('app.phplocale');
    setlocale(LC_TIME, $phpLocale);
    if (!(is_a($date, 'Carbon\Carbon'))) return '--------';
    if (starts_with($date, '-0001')) return '--------';

    return $date->formatLocalized('%d. %B %Y');
};

function date_for_picker($date)
{
    if (!(is_a($date, 'Carbon\Carbon'))) return '';
    if (starts_with($date, '-0001')) return '';

    return 'value=' . $date->formatLocalized('%d.%m.%Y');

}

function format_time_to_display($date)
{

};