# Kohana Blade
Laravel Blade Templating engine for Kohana 3.* Framework based on https://github.com/PhiloNL/Laravel-Blade standalone component

#Installation

Add this into your `composer.json` repositories section

```json
  "repositories" :[
      {
          "type":"git",
          "url":"https://github.com/pridemon/kohana-blade.git"
      },
  ],
```
and require section

```json
  "require":{
        "pridemon/kohana-blade"		: "dev-master"
  }
```
then run `composer install`

Include Kohana blade integration into your kohana `bootstrap.php` file
```php
Kohana::modules(array(
  
     'blade'        => MODPATH.'kohana-blade',

	));
```
# Usage

For a example, place `Hello.blade.php` into `application\views` directory

```blade
@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar. {{ $value2 }}</p>
@endsection

@section('content')
    <p>This is my body content. {{ $value }}</p>
@endsection
```

Now, you can write something like this in controllers actions: 

```php         
$value2 = 'foo';

$view = BladeView::factory('Hello');

$view->bind('value', $value);
$view->set('value2', $value2);
$value = 'bar';

$this->response->body($view->render());
```
