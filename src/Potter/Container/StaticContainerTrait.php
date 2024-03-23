<?php

namespace Potter\Container;

trait StaticContainerTrait
{
    private static int $_count = -1;
    private static array $_entries = [];
    
    final protected static function _destruct(int $index): void
    {
        if (!self::_hasContainer($index)) {
            return;
        }
        unset(self::$_entries[$index]);
    }
    
    final public static function _get(int $index, string $id): mixed
    {
        if (!self::_has($index, $id)) {
            throw new NotFoundException;
        }
        return self::$_entries[$index][$id];
    }
    
    final protected static function _getIndex(): int
    {
        return ++self::$_count;
    }
    
    final public static function _has(int $index, string $id): bool
    {
        return self::_hasContainer($index) && array_key_exists($id, self::$_entries[$index]);
    }
    
    final protected static function _hasContainer(int $index): bool
    {
        return array_key_exists($index, self::$_entries);
    }
    
    final protected static function _set(int $index, string $id, mixed $entry): void
    {
        if (!self::_hasContainer($index)) {
            self::$_entries[$index] = [$id => $entry];
            return;
        }
        self::$_entries[$index][$id] = $entry;
    }

    final protected static function _unset(int $index, string $id): void
    {
        if (!self::_has($index, $id)) {
            return;
        }
        unset(self::$_entries[$index][$id]);
    }
}