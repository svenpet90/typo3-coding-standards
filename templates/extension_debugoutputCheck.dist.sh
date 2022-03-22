#!/usr/bin/env bash

if grep -r --include '*.php' 'var_dump' ./Classes/; then exit 1; fi
if grep -r --include '*.php' 'dump(' ./Classes/; then exit 1; fi
if grep -r --include '*.php' ' dd(' ./Classes/; then exit 1; fi
if grep -r --include '*.php' ' print_r(' ./Classes/; then exit 1; fi
if grep -r --include '*.php' 'die(' ./Classes/; then exit 1; fi
if grep -r --include '*.html' 'f:debug' ./Resources/Private/; then exit 1; fi
if grep -r --include '*.js' 'console.log' ./Resources/Private/Assets/javascript/; then exit 1; fi
if grep -r --include '*.js' 'console.table' ./Resources/Private/Assets/javascript/; then exit 1; fi
if grep -r --include '*.js' 'alert(' ./Resources/Private/Assets/javascript/; then exit 1; fi
