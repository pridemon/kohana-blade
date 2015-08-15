# Kohana Blade
[Laravel](http://laravel.com/) [Blade Templating engine](http://laravel.com/docs/5.0/templates) for [Kohana 3.* Framework](http://kohanaframework.org/) based on [Philo Laravel-Blade](https://github.com/PhiloNL/Laravel-Blade) standalone component

#Installation

add to your project by

```
composer require pridemon/kohana-blade
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
