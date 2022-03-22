#!/usr/bin/env bash

if grep -r --include '*.html' 'f:debug' ./packages/*/Resources/Private/; then exit 1; fi
if grep -r --include '*.php' 'var_dump' ./packages/*/Classes/; then exit 1; fi
if grep -r --include '*.php' 'dump(' ./packages/*/Classes/; then exit 1; fi
if grep -r --include '*.php' ' dd(' ./packages/*/Classes/; then exit 1; fi
if grep -r --include '*.php' ' print_r(' ./packages/*/Classes/; then exit 1; fi
if grep -r --include '*.php' 'die(' ./packages/*/Classes/; then exit 1; fi
if grep -r --include '*.js' 'console.log' ./assets/javascript/; then exit 1; fi
if grep -r --include '*.js' 'console.table' ./assets/javascript/; then exit 1; fi
if grep -r --include '*.js' 'alert(' ./assets/javascript/; then exit 1; fi
