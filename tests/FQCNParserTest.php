<?php

declare(strict_types=1);

namespace tests;

use Exception;
use FQCNParser\FQCNParser;
use GlobalClass;
use GlobalEnum;
use GlobalInterface;
use GlobalTrait;
use MyApp\Classes\NamespacedClass;
use MyApp\Classes\NamespacedEnum;
use MyApp\Classes\NamespacedInterface;
use MyApp\Classes\NamespacedTrait;
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

    public function testGlobalInterface(): void
    {
        $this->assertSame(GlobalInterface::class, FQCNParser::getFQCNFromFile(__DIR__ . '/files/GlobalInterface.php'));
    }

    public function testNamespacedInterface(): void
    {
        $this->assertSame(NamespacedInterface::class, FQCNParser::getFQCNFromFile(__DIR__ . '/files/NamespacedInterface.php'));
    }

    public function testGlobalTrait(): void
    {
        $this->assertSame(GlobalTrait::class, FQCNParser::getFQCNFromFile(__DIR__ . '/files/GlobalTrait.php'));
    }

    public function testNamespacedTrait(): void
    {
        $this->assertSame(NamespacedTrait::class, FQCNParser::getFQCNFromFile(__DIR__ . '/files/NamespacedTrait.php'));
    }

    /**
     * @requires PHP >= 8.1
     */
    public function testGlobalEnum(): void
    {
        $this->assertSame(GlobalEnum::class, FQCNParser::getFQCNFromFile(__DIR__ . '/files/GlobalEnum.php'));
    }

    /**
     * @requires PHP >= 8.1
     */
    public function testNamespacedEnum(): void
    {
        $this->assertSame(NamespacedEnum::class, FQCNParser::getFQCNFromFile(__DIR__ . '/files/NamespacedEnum.php'));
    }
}
