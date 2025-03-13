<?php
namespace DotAccess\DotArray;

use ArrayAccess;

class DotArray implements ArrayAccess
{
    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function offsetExists(mixed $offset): bool
    {
        return DotApi::has($this->data, $offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return DotApi::get($this->data, $offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        DotApi::set($this->data, $offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        DotApi::unset($this->data, $offset, null);
    }

}