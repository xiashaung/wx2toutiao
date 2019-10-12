<?php


namespace XiaShuang\TouTiao\Common;


class Response  implements \ArrayAccess,\JsonSerializable
{
    private $data = [];

    /**
     * Response constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function offsetExists($offset)
    {
       return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function __set($name, $value)
    {
        $this->offsetGet($name,$value);
    }

    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    public function toArray()
    {
        return $this->data;
    }

    public function jsonSerialize()
    {
        return json_encode($this->data,JSON_UNESCAPED_UNICODE);
    }

}
