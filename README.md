Skidder
==============================

Skidder will drag your logs to where they need to go. A small, uniform and extensible logging library, implemented
across major technologies.

Setup
-----

### Composer

        "november-five/skidder": "*.*.*"

        "repositories": [
            {
                "type": "vcs",
                "url": "git@github.com:novemberfiveco/skidder-php.git"
            }
        ],

### AppKernel

      new NovemberFive\SkidderBundle\NovemberFiveSkidderBundle()

Send user id in log
-------------------

If you want to add the user id of the logged user to monolog, please add the following to your monolog config in the
config_prod.yml and config_stag.yml file.

This will use a formatter with an extra block at the end. This extra block is used by our custom listener that will
append session info to the record.

    monolog:
        handlers:
            main:
                formatter: skidder.monolog.formatter

Send request id in log
----------------------

If you want to add a request id to the logs, please add the following to your config.yml file

    skidder: 
       request_id_header: 'x-Request-ID'

NewRelicPass
-------------------
The NewRelicPass will prevent Monolog from throwing fatal errors if the New Relic extension is not installed.

Monolog will no longer throw an exception but just `return`.


Releases
-------------------
__2.1.1 (2025/01/08)__
* Fixed constructor of SessionRequestProcessor

__2.1.0 (2025/01/08)__

* Fixed deprecations for Symfony 4
* Added support for Symfony 5
* Added support for PHP 8.1
* Bumped PHP min version to 8.1

__2.0.0 (2021/08/17)__

* Renamed bundle to Skidder

__1.0.0 (2021/06/21)__

* Initial version
