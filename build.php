#!/usr/bin/env php
<?php
require 'vendor/autoload.php';

$phpcsCLI = new PHP_CodeSniffer_CLI();
$phpcsViolations = $phpcsCLI->process(array('standard' => array('PSR1'), 'files' => array('src', 'build.php')));
if ($phpcsViolations > 0) {
    exit(1);
}

$phpunitConfiguration = PHPUnit_Util_Configuration::getInstance(__DIR__ . '/phpunit.xml');
$phpunitArguments = array('coverageHtml' => __DIR__ . '/coverage', 'configuration' => $phpunitConfiguration);
$testRunner = new PHPUnit_TextUI_TestRunner();
$result = $testRunner->doRun($phpunitConfiguration->getTestSuiteConfiguration(), $phpunitArguments);
if (!$result->wasSuccessful()) {
    exit(1);
}

$coverageFactory = new PHP_CodeCoverage_Report_Factory();
$coverageReport = $coverageFactory->create($result->getCodeCoverage());
if ($coverageReport->getNumExecutedLines() !== $coverageReport->getNumExecutableLines()) {
    file_put_contents('php://stderr', "Code coverage was NOT 100%\n");
    exit(1);
}

file_put_contents('php://stderr', "Code coverage was 100%\n");
