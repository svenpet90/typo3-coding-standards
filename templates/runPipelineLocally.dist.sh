#!/usr/bin/env bash

RED='\033[0;31m'
NC='\033[0m'

printf "${RED}##################### DEPRECATED #####################${NC}\n"
printf "${RED}Please use \"composer ci:test\" and \"yarn ci:lint:stylelint\" / \"ci:lint:javascript\" instead. \n"
printf "${RED}##################### DEPRECATED #####################${NC}\n"

composer ci:test
yarn ci:lint:stylelint
yarn ci:lint:eslint

printf "${RED}##################### DEPRECATED #####################${NC}\n"
printf "${RED}Please use \"composer ci:test\" and \"yarn ci:lint:stylelint\" / \"ci:lint:javascript\" instead. \n"
printf "${RED}##################### DEPRECATED #####################${NC}\n"
