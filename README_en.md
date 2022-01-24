# PHP On Rails framework

![CodeSniffer-PSR-12](https://github.com/IlyaMur/php_on_rails_mvc/workflows/CodeSniffer-PSR-12/badge.svg)
![PHPUnit-Tests](https://github.com/IlyaMur/php_on_rails_mvc/workflows/PHPUnit-Tests/badge.svg)
[![Maintainability](https://api.codeclimate.com/v1/badges/673249eff3f090fe3f06/maintainability)](https://codeclimate.com/github/IlyaMur/php_on_rails_mvc/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/673249eff3f090fe3f06/test_coverage)](https://codeclimate.com/github/IlyaMur/php_on_rails_mvc/test_coverage)

**[🇷🇺 Russian readme](https://github.com/IlyaMur/php_on_rails_mvc/blob/master/README.md)**

**Table of contents**
  - [Overview](#overview)
  - [Install](#install)
    - [Used libraries](#used-libraries)
  - [How To Use](#how-to-use)
    - [Configuration](#configuration)
    - [Routing system](#routing)
    - [Controllers](#controllers)
      - [Actions](#actions)
      - [Route parameters](#route-parameters)
      - [Action filters](#action-filters)
    - [Views](#views)
    - [Models](#models)
    - [Errors](#errors)

  - [How It Works](#how-it-works)

## Overview
PHP On Rails is a simple MVC framework for building web applications in PHP.   
The framework was written for educational purposes but has advanced routing options.

The main goal was to write a framework entirely based on the Model-View-Controller design pattern from scratch.  
Despite the fact that this is a training project, PHP On Rails is fully functional and you can build projects on it.

The blog application was written in Php On Rails - [myPosts](https://github.com/IlyaMur/myposts_app).

## Install
- PHP version >= 8.0 (framework is using named arguments and other modern php features).
- `$ git clone` the repo.
- `$ make install` to install dependencies.
- Configure your web server to have the public folder as the web root.
- Open config/config.php and enter your database configuration data.

Pretty URLs are enabled using web server rewrite rules. An [.htaccess](public/.htaccess) file is included in the `public` folder.

### Used libraries
I tried to avoid using existing libraries and do everything myself.  
PHP On Rails has only one dependency:
-  Twig Template Engine.

## How To Use

### Configuration
Configuration settings are stored in the `config/config.php` file.  
Default settings include database connection data, error loggin and a setting to show or hide error detail.  
You can access the settings in your code by using constants defined in the configuration file.

### Routing System

The [Router](src/Service/Router.php) translates URLs into controllers and actions. Routes are added in the [front controller](public/index.php). A sample home route is included that routes to the `index` action in the [Home controller](src/Controllers/Home.php).

Routes are added with the `add` method. You can add fixed URL routes, and specify the controller and action, like this:

```php
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts/index', ['controller' => 'Posts', 'action' => 'index']);
```

Or you can add route **variables**, like this:

```php
$router->add('{controller}/{action}');
```

In addition to the **controller** and **action**, you can specify any parameter you like within curly braces, and also specify a custom regular expression for that parameter:

```php
$router->add('{controller}/{id:\d+}/{action}');
```

Example. For routing to the specific post's defined in the request URL:

```php
$router->add(route: 'posts/{action}/{id:\d+}', params: ['controller' => 'posts']);
```

You can also specify a namespace for the controller:

```php
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
```

### Controllers

Controllers respond to user actions (clicking on a link, submitting a form etc.). Controllers are classes that extend the [src\Controllers\BaseController.php](src/Controllers/BaseController.php) class.

Controllers are stored in the `src/Controllers` folder. A sample [Home controller](src/Controllers/Home.php) included. Controller classes need to be in the `Ilyamur\PhpOnRails\Controllers` namespace. You can add subdirectories to organise your controllers, so when adding a route for these controllers you need to specify the namespace (see the routing section above).

#### Actions

Controller classes contain methods that are the actions. To create an action, add the **`Action`** suffix to the method name. The sample controller in [src/Controllers/Home.php](src/Controllers/Home.php) has a sample `index` action.

#### Route parameters

You can access route parameters (for example the **id** parameter shown in the route examples above) in actions via the `$this->route_params` property
.
#### Action filters

Controllers can have **before** and **after** filter methods. These are methods that are called before and after **every** action method call in a controller.  
It is very useful for authentication for example, making sure that a user is logged in before letting them execute an action. 
Optionally add a **before filter** to a controller like this:

```php
/**
 * Before filter. Return false to stop the action from executing.
 *
 * @return void
 */
protected function before()
{
}
```

To stop the originally called action from executing, return `false` from the before filter method. An **after filter** is added like this:

```php
/**
 * After filter.
 *
 * @return void
 */
protected function after()
{
}
```

### Views

Views are used to display information (normally HTML). View files go in the `src/Views` folder. Main format for Views is the [Twig](https://twig.symfony.com/) templating engine.  
Twig is very comfortable and flexible template engine. Using Twig allows you to have simpler, safer templates that can take advantage of things like template inheritance. You can render a Twig template like this:

```php
BaseView::renderTemplate('Home/index', [
    'name' => 'John Doe',
    'colors' => ['red', 'green', 'blue'],
]);
```

A sample Twig template is included in [src/Views/Home/index.html.twig](src/Views/Home/index.html.twig) that inherits from the base template in [src/Views/base.html.twig](src/Views/base.html.twig).

### Models

Models are used to get and store data in your application. They know nothing about how this data is to be presented in the views. Models extend the `src\Model` class and use [PDO](http://php.net/manual/en/book.pdo.php) to access the database. They're stored in the `src/Models` folder. A sample user model class is included in [src/Models/User.php](src/Models/User.php). You can get the PDO database connection instance like this:

```php
$db = static::getDB();
```

### Errors

If the `SHOW_ERRORS` (configuring in `config/config.php`) configuration setting is set to `true`, full error detail will be shown in the browser if an error or exception occurs. If it's set to `false`, a generic message will be shown using the [src/Views/404.html.twig](src/Views/404.html.twig) or [src/Views/500.html.twig](src/Views/500.html.twig) views, depending on the error.
