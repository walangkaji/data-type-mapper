<?php

namespace walangkaji\Mapper;

/**
 * Array Type Mapper
 *
 * Digunakan untuk merubah format array / json menjadi php syntax
 * valuenya akan dirubah jadi type, jadi intinya tinggal
 * copy paste trus bisa buat validasi type data.
 * Pokoknya gitu deh.
 *
 * @author walangkaji (https://github.com/walangkaji)
 */
class DataTypeMapper
{
    protected $indent = 4;

    /**
     * Get result formatted data
     *
     * @param array|json $data data yang akan di format
     *
     * @return string
     */
    public function getResult($data)
    {
        return $this->arraySyntax($this->inputData($data));
    }

    /**
     * Format data
     *
     * @param array|json $data data yang akan di format
     *
     * @return string
     */
    protected function inputData($data)
    {
        if ($this->isArray($data)) {
            return $this->buildType($data);
        } elseif ($this->isObject($data)) {
            return $this->buildType(json_decode(json_encode($data), true));
        } elseif ($this->isJson($data)) {
            return $this->buildType(json_decode($data, true));
        } else {
            return 'Invalid data, gunakan array atau json';
        }
    }

    /**
     * Proses build type
     *
     * @param array $array
     *
     * @return string
     */
    protected function buildType($array)
    {
        $string = '';

        foreach ($array as $key => $value) {
            if (is_string($key)) {
                $string .= $this->getIndent() . var_export($key, true) . ' => ';
            }

            if (is_array($value)) {
                $string .= $this->indentArray($this->buildType($value)) . ',' . PHP_EOL;
                continue;
            }

            $string .= var_export(gettype($value), true) . ',' . PHP_EOL;
        }

        return $string;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    protected function indentArray($string)
    {
        $lines = array_filter(explode(PHP_EOL, $string));
        $str   = '';

        if (!empty($lines)) {
            foreach ($lines as $key) {
                if ($this->isNumericArrayKey($key)) {
                    $str .= $this->getIndent($this->indent * 2) . $key . PHP_EOL;
                } else {
                    $str .= $this->getIndent() . $key . PHP_EOL;
                }
            }
        } else {
            return $this->emptyArraySyntax();
        }

        return $this->arraySyntax($str . $this->getIndent());
    }

    /**
     * Array syntax
     *
     * @param string $string string formatted array
     *
     * @return string
     */
    protected function arraySyntax($string)
    {
        return '[' . PHP_EOL . $string . ']';
    }

    /**
     * Empty Array syntax
     *
     * @return string
     */
    protected function emptyArraySyntax()
    {
        return '[]';
    }

    /**
     * Get indent space
     *
     * @param int $count count additional indent
     *
     * @return string space
     */
    protected function getIndent($count = null)
    {
        if (!is_null($count)) {
            return str_repeat(' ', $count);
        }

        return str_repeat(' ', $this->indent);
    }

    /**
     * Cek jika key array merupakan numeric maka harus di tambahi indent
     * biar masuk pak eko spasinya
     *
     * @param string $value value pokoknya
     *
     * @return bool
     */
    protected function isNumericArrayKey($value)
    {
        if ($value == "'string',") {
            return true;
        }

        return false;
    }

    /**
     * Array cek
     *
     * @param mixed $data
     *
     * @return bool
     */
    protected function isArray($data)
    {
        return is_array($data) && (empty($data) || array_keys($data) === range(0, count($data) - 1));
    }

    /**
     * Object cek
     *
     * @param mixed $data
     *
     * @return bool
     */
    protected function isObject($data)
    {
        return is_object($data) || (is_array($data) && !empty($data) && array_keys($data) !== range(0, count($data) - 1));
    }

    /**
     * Json cek
     *
     * @param mixed $string
     *
     * @return bool
     */
    protected function isJson($string)
    {
        if ($string === false) {
            return false;
        }

        json_decode($string);

        return (json_last_error() == JSON_ERROR_NONE);
    }
}
