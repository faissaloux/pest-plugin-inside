# PEST PLUGIN INSIDE

This plugin checks what's inside the files.


[![Tests](https://github.com/faissaloux/pest-plugin-inside/actions/workflows/tests.yml/badge.svg)](https://github.com/faissaloux/pest-plugin-inside/actions/workflows/tests.yml) ![Codecov](https://img.shields.io/codecov/c/github/faissaloux/pest-plugin-inside) ![Packagist Version](https://img.shields.io/packagist/v/faissaloux/pest-plugin-inside) ![Packagist License](https://img.shields.io/packagist/l/faissaloux/pest-plugin-inside)

## Available Expectations
### toReturnLowercase
Make sure a file or directory files returns an array with all lowercase values.
```php
expect('file.php')->toReturnLowercase();
```

### toReturnUnique
Make sure a file or directory files returns an array with unique values.
```php
expect('file.php')->toReturnUnique();
```

### toReturnSingleWords
Make sure a file or directory files returns an array with single words.
```php
expect('file.php')->toReturnSingleWords();
```

### toBeOrdered
Make sure a file or directory files returns an array with words that are ordered.
```php
expect('file.php')->toBeOrdered();
```

----

### Success

```php
<?php

// lowercase.php

return [
    'lower',
    'case',
    'lowercase',
    'array' => [
        'lower',
        'case',
    ],
];

```

```php
expect('lowercase.php')->toReturnLowercase();
```

### Failure

```php
<?php

// notlowercase.php

return [
    'lower',
    'caSe',
    'lowercase',
];

```

```php
expect('notlowercase.php')->toReturnLowercase();
```

### Scan directory

```bash
directory
├── file.js
├── file.php
├── subdirectory
    ├── file.json
    ├── file1.php
    ├── file2.php
```

- To scan all the php files in `directory` and all its subdirectories (`file.php`, `file1.php` and `file2.php`), we can use:
```php
expect('directory')->toReturnLowercase();
```

- We can also specify the scan depth using `depth`.
```php
expect('directory')->toReturnLowercase(depth:0);
```
In this case it will only scan direct php file which is `file.php`.
