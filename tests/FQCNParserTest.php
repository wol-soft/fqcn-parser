<?php

declare(strict_types=1);

namespace tests;

use Exception;
use FQCNParser\FQCNParser;
use GlobalClass;
use MyApp\Classes\NamespacedClass;
use PHPUnit\Framework\TestCase;

class FQCNParserTest extends TestCase
{
    public function testNonExistingFileThrowsAnException(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("File doesn't exist");

        FQCNParser::getFQCNFromFile(__DIR__ . '/files/NonExistingFile.php');
    }

    public function testFileWithoutClassThrowsAnException(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("No valid class found");

        FQCNParser::getFQCNFromFile(__DIR__ . '/files/NoClass.php');
    }

    public function testGlobalClass(): void
    {
        $this->assertSame(GlobalClass::class, FQCNParser::getFQCNFromFile(__DIR__ . '/files/GlobalClass.php'));
    }

    public function testNamespacedClass(): void
    {
        $this->assertSame(NamespacedClass::class, FQCNParser::getFQCNFromFile(__DIR__ . '/files/NamespacedClass.php'));
    }
}
