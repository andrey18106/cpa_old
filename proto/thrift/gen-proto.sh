#!/bin/sh

# Build core proto files for PHP and Python

thrift -r --gen php:server --gen py test.thrift

