<?php

declare(strict_types=1);

namespace Potter\Container;

trait ContainerTrait
{
    private int $index;
    
    public function __clone(): void
    {
        $this->index = self::_getIndex();
    }
    
    public function __destruct()
    {
        self::_destruct($this->getIndex());
    }
    
    final public function get(string $id): mixed
    {
        return self::_get($this->getIndex(), $id);
    }
    
    final protected function getIndex(): int
    {
        return isset($this->index) ? $this->index : $this->index = self::_getIndex();
    }

    final public function has(string $id): bool
    {
        return self::_has($this->getIndex(), $id);
    }

    final protected function set(string $id, mixed $entry): void
    {
        self::_set($this->getIndex(), $id, $entry);
    }
    
    final protected function unset(string $id): void
    {
        self::_unset($this->getIndex(), $id);
    }

    abstract protected static function _destruct(int $index): void;
    abstract protected static function _get(int $index, string $id): mixed;
    abstract protected static function _getIndex(): int;
    abstract protected static function _has(int $index, string $id): bool;
    abstract protected static function _hasContainer(int $index): bool;
    abstract protected static function _set(int $index, string $id, mixed $entry): void;
    abstract protected static function _unset(int $index, string $id): void;
}