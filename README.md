# SvenPetersen TYPO3 Coding Standards Package

## Installation
As this is a composer package, execute `composer req --dev svenpetersen/typo3-coding-standards`
in your composer project.

### Setting up the TYPO3 rulesets as boilerplate
Our coding standards files can set this up for you. Run

```bash
composer exec svenpet-typo3-coding-standards project
```
or
```bash
composer exec svenpet-typo3-coding-standards extension
```

or if you want to update the rules, add `force` option to the end.

Have a look at the newly created files in your root folder:

* .editorconfig
* .php-cs-fixer.php
* .eslintrc.json
* .eslintignore
* .stylelintrc.json
* .stylelintignore
* phpcpd.phar
* phpstan.neon
* typoscript-lint.yml
* debutoutputCheck.sh
* .gitlab-ci.yml

## composer.scripts
Kopiere diesen Code in die scripts Sektion der composer.json.
Danach kannst du alle codechecks ganz einfach mit `composer ci:test` ausführen.

### PROJECT
<pre>
"ci:test": [
    "@ci:test:php",
    "@ci:lint:typoscript",
    "@ci:test:debugoutput",
    "@ci:test:phpunit"
],
"ci:test:php": [
    "@ci:php:cs-fixer",
    "@ci:php:stan",
    "@ci:php:phpmd",
    "@ci:php:copypastedetector"
],
"ci:test:phpunit": [
    "@ci:test:functional",
    "@ci:test:unit"
],
"ci:php:cs-fixer": [
    "php-cs-fixer fix packages -v --dry-run --using-cache no --diff",
],
"ci:php:stan": [
    "phpstan analyse --no-progress"
],
"ci:php:phpmd": [
    "phpmd ./packages html codesize --ignore-violations-on-exit --reportfile ./phpmd-codesize.html",
    "phpmd ./packages html cleancode --ignore-violations-on-exit --reportfile ./phpmd-codesize.html",
    "phpmd ./packages html naming --ignore-violations-on-exit --reportfile ./phpmd-naming.html",
    "phpmd ./packages html design --ignore-violations-on-exit --reportfile ./phpmd-design.html",
    "phpmd ./packages html unusedcode --ignore-violations-on-exit --reportfile ./phpmd-unusedcode.html",
    "phpmd ./packages html controversial --ignore-violations-on-exit --reportfile ./phpmd-controversial.html"
],
"ci:php:copypastedetector": [
    "php phpcpd.phar --fuzzy ./packages/*"
],
"ci:test:debugoutput": [
    "chmod +x ./debugoutputCheck.sh && sh ./debugoutputCheck.sh"
],
"ci:test:functional": [
    "phpunit -c Tests/Functional/phpunit.xml"
],
"ci:test:unit": [
    "phpunit -c Tests/Unit/phpunit.xml"
],
"ci:lint:typoscript": [
    "typoscript-lint --ansi -n --fail-on-warnings -vvv"
],
"fix:php:cs-fixer": [
    "php-cs-fixer fix -v --using-cache no"
]
</pre>

### EXTENSION
<pre>
"ci:test": [
    "@ci:test:php",
    "@ci:lint:typoscript",
    "@ci:test:debugoutput",
    "@ci:test:phpunit"
],
"ci:test:php": [
    "@ci:php:cs-fixer",
    "@ci:php:stan",
    "@ci:php:phpmd",
    "@ci:php:copypastedetector"
],
"ci:test:phpunit": [
    "@ci:test:functional",
    "@ci:test:unit"
],
"ci:php:cs-fixer": [
    "php-cs-fixer fix Classes -v --dry-run --using-cache no --diff",
    "php-cs-fixer fix Tests -v --dry-run --using-cache no --diff"
],
"ci:php:stan": [
    "phpstan analyse --no-progress"
],
"ci:php:phpmd": [
    "phpmd ./Classes html codesize --ignore-violations-on-exit --reportfile ./phpmd-codesize.html",
    "phpmd ./Classes html cleancode --ignore-violations-on-exit --reportfile ./phpmd-codesize.html",
    "phpmd ./Classes html naming --ignore-violations-on-exit --reportfile ./phpmd-naming.html",
    "phpmd ./Classes html design --ignore-violations-on-exit --reportfile ./phpmd-design.html",
    "phpmd ./Classes html unusedcode --ignore-violations-on-exit --reportfile ./phpmd-unusedcode.html",
    "phpmd ./Classes html controversial --ignore-violations-on-exit --reportfile ./phpmd-controversial.html"
],
"ci:php:copypastedetector": [
    "php phpcpd.phar --fuzzy ./Classes/*"
],
"ci:test:debugoutput": [
    "chmod +x ./debugoutputCheck.sh && sh ./debugoutputCheck.sh"
],
"ci:test:functional": [
    "phpunit -c Tests/Functional/phpunit.xml"
],
"ci:test:unit": [
    "phpunit -c Tests/Unit/phpunit.xml"
],
"ci:lint:typoscript": [
    "typoscript-lint --ansi -n --fail-on-warnings -vvv"
],
"fix:php:cs-fixer": [
    "php-cs-fixer fix -v --using-cache no"
]
</pre>


## package.json scripts
Kopiere diesen Code in die scripts Sektion der package.json.
Danach kannst du die Codechecks ganz einfach mit `yarn ci:lint:stylelint` bzw. `yarn ci:lint:eslint` ausführen.

### Project
<pre>
  "ci:lint:stylelint": "stylelint ./assets/scss/*",
  "ci:lint:eslint": "eslint ./assets/javascript/*"
</pre>

### Extension
<pre>
  "ci:lint:stylelint": "stylelint ./Resources/*",
  "ci:lint:eslint": "eslint ./Resources/*"
</pre>

---

### PHP-CS-Fixer rules
Making sure your PHP files apply to the same rules.

### .editorconfig
The offical .editorconfig of the typo3/coding-standards package.
Used by the TYPO3 core.

### phpstan config
Config for the PHP Static Analyser "PHPStan"

### php copy-paste-detector
The executable PHAR file of the Copy & Paste Detector

### typoscript-lint config
Config file for the TypoScipt linter "typoscript-lint" by Martin Helmich.

### stylelint config
Config file to the SCSS linting tool "stylelint".

### eslint config
Config file to the JavaScript tool "eslint".

### debugoutputCheck.sh
Checks the source code for usages of debugging output like die(), var_dump(), DebuggerUtility::var_dump(), console.log() etc.
Calls to debugging functions should not be commited or deployed.
