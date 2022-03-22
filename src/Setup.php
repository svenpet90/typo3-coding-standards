<?php

declare(strict_types=1);

namespace SvenPetersen\CodingStandards;

class Setup
{
    private string $rootPath;

    private string $templatesPath;

    private string $typo3CodingStandardTemplatePath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
        $this->templatesPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates';
        $this->typo3CodingStandardTemplatePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'typo3' . DIRECTORY_SEPARATOR . 'coding-standards' . DIRECTORY_SEPARATOR . 'templates';
    }

    public function forProject(bool $force): int
    {
        echo "TYPO3 Coding Standards: Initialising configuration for PROJECT.\n";

        $errors = $this->copyEditorConfig($force);
        $errors = $this->copyPhpCsFixerConfig($force, 'project') || $errors;
        $errors = $this->copyTyposcriptLintConfig($force, 'project') || $errors;
        $errors = $this->copyPhpStanConfig($force, 'project') || $errors;
        $errors = $this->copyPhpCopyPasteDetector($force) || $errors;
        $errors = $this->copyDebugOutputCheck($force, 'project') || $errors;

        return $errors ? 1 : 0;
    }

    public function forExtension(bool $force): int
    {
        echo "TYPO3 Coding Standards: Initialising configuration for EXTENSION.\n";

        $errors = $this->copyEditorConfig($force);
        $errors = $this->copyPhpCsFixerConfig($force, 'extension') || $errors;
        $errors = $this->copyTyposcriptLintConfig($force, 'extension') || $errors;
        $errors = $this->copyPhpStanConfig($force, 'extension') || $errors;
        $errors = $this->copyPhpCopyPasteDetector($force) || $errors;
        $errors = $this->copyDebugOutputCheck($force, 'extension') || $errors;

        return $errors ? 1 : 0;
    }

    private function copyTyposcriptLintConfig(bool $force, string $typePrefix): bool
    {
        $errors = false;

        if (!$force && file_exists($this->rootPath . DIRECTORY_SEPARATOR . 'typoscript-lint.yml')) {
            echo "A typoscrint-lint.yml file already exists in your main folder, but the \"force\" option was not set. Nothing copied.\n";
            $errors = true;
        } else {
            copy($this->templatesPath . DIRECTORY_SEPARATOR . $typePrefix . '_typoscript-lint.dist.yml', $this->rootPath . DIRECTORY_SEPARATOR . 'typoscript-lint.yml');
        }

        return $errors;
    }

    private function copyPhpStanConfig(bool $force, string $typePrefix): bool
    {
        $errors = false;

        if (!$force && file_exists($this->rootPath . DIRECTORY_SEPARATOR . 'phpstan.neon')) {
            echo "A phpstan.neon file already exists in your main folder, but the \"force\" option was not set. Nothing copied.\n";
            $errors = true;
        } else {
            copy($this->templatesPath . DIRECTORY_SEPARATOR . $typePrefix . '_phpstan.dist.neon', $this->rootPath . DIRECTORY_SEPARATOR . 'phpstan.neon');
        }

        return $errors;
    }

    private function copyPhpCopyPasteDetector(bool $force): bool
    {
        $errors = false;

        if (!$force && file_exists($this->rootPath . DIRECTORY_SEPARATOR . 'phpcpd.phar')) {
            echo "A phpstan.neon file already exists in your main folder, but the \"force\" option was not set. Nothing copied.\n";
            $errors = true;
        } else {
            copy($this->templatesPath . DIRECTORY_SEPARATOR . 'phpcpd.dist.phar', $this->rootPath . DIRECTORY_SEPARATOR . 'phpcpd.phar');
        }

        return $errors;
    }

    private function copyDebugOutputCheck(bool $force, string $typePrefix): bool
    {
        $errors = false;

        if (!$force && file_exists($this->rootPath . DIRECTORY_SEPARATOR . 'debugoutputCheck.sh')) {
            echo "A debugoutputCheck.sh file already exists in your main folder, but the \"force\" option was not set. Nothing copied.\n";
            $errors = true;
        } else {
            copy($this->templatesPath . DIRECTORY_SEPARATOR . $typePrefix . '_debugoutputCheck.dist.sh', $this->rootPath . DIRECTORY_SEPARATOR . 'debugoutputCheck.sh');
        }

        return $errors;
    }

    private function copyPhpCsFixerConfig(bool $force, string $typePrefix): bool
    {
        $errors = false;

        if (!$force && file_exists($this->rootPath . DIRECTORY_SEPARATOR. '.php_cs') && !file_exists($this->rootPath . DIRECTORY_SEPARATOR . '.php-cs-fixer.php')) {
            rename($this->rootPath . DIRECTORY_SEPARATOR . '.php_cs', $this->rootPath . DIRECTORY_SEPARATOR . '.php-cs-fixer.php');
            echo "Found deprecated .php_cs file and renamed it to .php-cs-fixer.php.\n";
        }

        if (
            !$force
            && (file_exists($this->rootPath . DIRECTORY_SEPARATOR . '.php_cs') || file_exists($this->rootPath . DIRECTORY_SEPARATOR . '.php-cs-fixer.php'))
        ) {
            echo "A .php-cs-fixer.php file already exists in your main folder, but the \"force\" option was not set. Nothing copied.\n";
            $errors = true;
        } else {
            copy($this->templatesPath . DIRECTORY_SEPARATOR . $typePrefix . '_php-cs-fixer.dist.php', $this->rootPath . DIRECTORY_SEPARATOR . '.php-cs-fixer.php');

            if (file_exists($this->rootPath . DIRECTORY_SEPARATOR . '.php_cs')) {
                unlink($this->rootPath . DIRECTORY_SEPARATOR . '.php_cs');
            }
        }

        return $errors;
    }

    private function copyEditorConfig(bool $force): bool
    {
        $errors = false;

        if (!$force && file_exists($this->rootPath . DIRECTORY_SEPARATOR . '.editorconfig')) {
            echo "A .editorconfig file already exists in your main folder, but the \"force\" option was not set. Nothing copied.\n";
            $errors = true;
        } else {
            copy($this->typo3CodingStandardTemplatePath . DIRECTORY_SEPARATOR . 'editorconfig.dist', $this->rootPath . DIRECTORY_SEPARATOR . '.editorconfig');
        }

        return $errors;
    }
}
