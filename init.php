<?php defined('SYSPATH') or die('No direct script access.');

// Check if the blade directory exists in cache,
// if not then create 
if (!file_exists(APPPATH.'cache/blade')) {
   mkdir(APPPATH.'cache/blade', 0755);
}
