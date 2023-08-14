#!/usr/bin/env bash

cd `dirname $0` || exit
/usr/bin/env php -S localhost:8080 -t public
