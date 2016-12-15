# Nootifier

A console application that's just used to add, commit and push files from a local to remote repository.

This project requires PHP 5.6+ to run. To see all dependencies check the [composer.json](https://github.com/nooticias/nootifier/blob/master/composer.json) file.

## Installation

The source files is [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) compatible.
Autoloading is [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) compatible.

```shell
git clone https://github.com/nooticias/nootifier.git
cd nootifier/
composer install
```

## How to use

```shell
php app/console nootifier --directory="/<your-git-repository-directory>" --limit=<amount-of-files-that-will-be-committed>
```

## Todo

1. Cover all statements with PHPunit tests.

Contributing
------------

1. Give me a star **=)**
2. Fork it
3. Create your feature branch (`git checkout -b my-new-feature`)
4. Make your changes
5. Commit your changes (`git commit -am 'Added some feature'`)
6. Push to the branch (`git push origin my-new-feature`)
7. Create new Pull Request
