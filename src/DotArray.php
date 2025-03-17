<?php
namespace DotAccess\DotArray;

class DotArray implements DotArrayInterface
{
    /**
     * The data array storage.
     * 
     * @var array
     */
    private array $data = [];

    /**
     * {@inheritDoc}
     */
    public function &reference(): array
    {
        $data =& $this->data;

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function &array(): array
    {
        return $this->reference();
    }

    /**
     * {@inheritDoc}
     */
    public function copy(): array
    {
        return $this->data;
    }

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * ArrayAccess
     * 
     * @param  mixed  $offset  The offset
     * 
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return DotApi::has($this->data, $offset);
    }

    /**
     * ArrayAccess
     * 
     * @param  mixed  $offset  The offset
     * 
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return DotApi::get($this->data, $offset);
    }

    /**
     * ArrayAccess
     * 
     * @param  mixed  $offset  The offset
     * @param  mixed  $value   The value
     * 
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        DotApi::set($this->data, $offset, $value);
    }

    /**
     * ArrayAccess
     * 
     * @param  mixed  $offset  The offset
     * 
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        DotApi::unset($this->data, $offset, null);
    }

}