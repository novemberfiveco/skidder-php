November Five - Logging Bundle
==============================

This bundle provides you with a set of tools to extend logging functionality.

Setup
-----
### Composer

        "november-five/lib_serverside_loggingbundle": "*.*.*"

        "repositories": [
            {
                "type": "vcs",
                "url": "git@bitbucket.org:appstrakt/lib_serverside_loggingbundle.git"
            }
        ],

### AppKernel

      new NovemberFive\LoggingBundle\NovemberFiveLoggingBundle()


Send user id in log
-------------------

If you want to add the user id of the logged user to monolog, please add the following to your monolog config in the config_prod.yml and config_stag.yml file.

This will use a formatter with an extra block at the end. This extra block is used by our custom listener that will append session info to the record.

    monolog:
        handlers:
            main:
                formatter: novemberfive_logging.monolog.formatter
                
Send request id in log
----------------------

If you want to add a request id to the logs, please add the following to your config.yml file
 
    november_five_logging: 
       request_id_header: 'x-Request-ID'
                
NewRelicPass
-------------------
The NewRelicPass will prevent Monolog from throwing fatal errors if the New Relic extension is not installed.

Monolog will no longer throw an exception but just `return`. 


Releases
-------------------
__1.3.0 (2021/06/21)__

* Add filename and linenumber

__1.2.1 (2021/04/30)__

* Merge "data" key on logger "context" with the "data" key getting set in the processors
* Unset "extra" key on record

__1.2.0 (2021/04/13)__

* Added new configuration to format as json according to our new guidelines:  https://appstrakt.atlassian.net/wiki/spaces/DOTECH/pages/2766143566/Standard+logging+conventions

__1.1.0 (2018/08/01)__

* Added configuration for request ID

__1.0.0 (2017/11/24)__

* Added NewRelicPass