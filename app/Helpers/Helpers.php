<?php
//

//Random Password generator

use App\Models\About\About;
use App\Models\Profession;
use App\Models\Regions\Country;

if (!function_exists('_getProfessions')) {

  function _getProfessions()
  {
    $lang = \App::getLocale();
    $professions = Profession::select('id', 'name_'. $lang.' as name')->where([['status', 'active']])->orderBy('id', 'ASC')->get();
    return $professions;
  }
}

if (!function_exists('_getCountries')) {

  function _getCountries()
  {
    $lang = \App::getLocale();
    $countries = Country::select('id', 'name_'. $lang.' as name')->where([['status', 'active']])->orderBy('id', 'ASC')->get();
    return $countries;
  }
}

if (! function_exists('getSiteInfo')) {

  function getSiteInfo($key)
  {
    $data = About::findOrFail('1');
    return $data->$key;
  }
}