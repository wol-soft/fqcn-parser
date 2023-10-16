<?php

declare(strict_types=1);

namespace FQCNParser;

use Exception;

class FQCNParser
{
    public static function getFQCNFromFile(string $filePath): string
    {
        if (!file_exists($filePath)) {
            throw new Exception("File doesn't exist: $filePath");
        }

        $src = file_get_contents($filePath);
        $tokens = token_get_all($src);

        $namespace = self::getNamespaceFromTokenizedFile($tokens);
        $className = self::getClassNameFromTokenizedFile($tokens, $filePath);

        return join('\\', array_filter([$namespace, $className]));
    }

    private static function getNamespaceFromTokenizedFile(array $tokens): string
    {
        $count = count($tokens);
        $i = 0;
        $namespace = '';

        while ($i < $count) {
            $token = $tokens[$i];
            if (is_array($token) && $token[0] === T_NAMESPACE) {
                while (++$i < $count) {
                    if ($tokens[$i] === ';') {
                        $namespace = trim($namespace);
                        break;
                    }
                    $namespace .= is_array($tokens[$i]) ? $tokens[$i][1] : $tokens[$i];
                }
                break;
            }
            $i++;
        }

        return $namespace;
    }

    private static function getClassNameFromTokenizedFile(array $tokens, string $filePath): string
    {
        if (!defined('T_ENUM')) {
            define('T_ENUM', 336);
        }

        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if (in_array($tokens[$i - 2][0], [T_CLASS, T_INTERFACE, T_TRAIT, T_ENUM])
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING
            ) {
                return trim($tokens[$i][1]);
            }
        }

        throw new Exception("No valid class found: $filePath");
    }
}
