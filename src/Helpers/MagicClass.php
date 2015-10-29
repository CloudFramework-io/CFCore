<?php
namespace CloudFramework\Helpers;

/**
 * Class MagicClass
 * @package CloudFramework\Helpers
 */
Trait MagicClass {
    /**
     * Magic setter
     * @param string $variable
     * @param mixed $value
     */
    public function __set($variable, $value)
    {
        $this->$variable = $value;
    }

    /**
     * Magic getter
     * @param string $variable
     * @return mixed
     */
    public function __get($variable)
    {
        return $this->$variable;
    }

    /**
     * Prevent the instance from being cloned
     * @return void
     */
    private function __clone() {}

    public function __toString()
    {
        $size = round(strlen(print_r($this, true)) / 1024, 4);
        return get_class($this) . " " . $size . " Kbytes";
    }
}