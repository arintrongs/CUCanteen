#!/bin/bash
#
# You can run this bash script with a cron job
# or just run the command below.
#
# I had to use php-cli for both the cron job and the
# call to queue:listen in "EnsureQueueListenerIsRunning.php"
# to avoid getting the exception:
# 'ErrorException' with message 'Invalid argument supplied for foreach()'
# in /path/to/vendor/symfony/console/Input/ArgvInput.php:283
#

php-cli /home/ratemyca/public_html/CUCanteen/artisan schedule:run >/dev/null 2>&1