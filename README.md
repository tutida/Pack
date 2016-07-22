# Pack plugin is for CakePHP3

You can easy to pass CakePHP3 variables to JS in View.

## Requirements ##

* PHP >=5.4
* CakePHP >= ~3.2

## Installation

In bootstrap.php.

```php
<?php
    Plugin::load('Search');
```

In controller.

```php
<?php
    class AppController extends Controller
    {

        public function initialize()
        {
            $this->loadComponent('Pack.Pack');
        }
        ...
    }
```

In layout ctp or template ctp.

```php
    <?= $this->Pack->render();?>
```

## Usage

Just set variables in your controller.
```
<?php

    $entity = $this->Hoge->get($id);
    $array  = [...];

    $this->Pack->set('entity', $entity);
    $this->Pack->set('array', $array);

    ## OR ##
    $this->Pack->set(compact('entity', 'array'));

```

Just get the variables in your JS in view.
```js
    Pack.entity;
    Pack.array;
```


## Methods

1. set($varName, $variable) … Set variable in Pack.
2. remove($varNamee) … Remove variable in Pack.
3. show() … Show all variable in Pack.
4. rename($namespace) … Change Pack's namespace in JS.

example

In controller
```php
    $this->Pack->rename('Hoge');
    $this->Pack->set('array', $array);
```

In js
```js
    Hoge.array;
```

