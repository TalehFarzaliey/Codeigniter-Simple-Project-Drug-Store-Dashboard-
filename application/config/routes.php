<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = "dashboard";
$route['404_override'] = '';

$route["dashboard"]         = "dashboard/index";
$route["dashboard/(.*)"]    = "dashboard/$1";

$route["drugcategory"]      = "drugcategory/index";
$route["drugcategory/(.*)"] = "drugcategory/$1";

$route["drug"]      = "drug/index";
$route["drug/(.*)"] = "drug/$1";

$route["^(.*)"] = "index/$1";
