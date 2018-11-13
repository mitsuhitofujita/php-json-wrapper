<?php

namespace mitsuhitofujita;

class Json
{

    /**
     * Encode to json string.
     *
     * @param mixed $value
     * @param int $options
     * @param int $depth
     * @return string
     * @throws JsonException
     */
    public function encode($value, int $options = 0, int $depth = 512): string
    {
        $json = json_encode($value, $options, $depth);
        if ($json === false) {
            throw new JsonException(json_last_error_msg());
        }
        return $json;
    }

    /**
     *  Decode from json string.
     *
     * @param string $json
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     * @return mixed
     * @throws JsonException
     */
    public function decode(string $json, bool $assoc = false, int $depth = 512, int $options = 0)
    {
        $obj = json_decode($json, $assoc, $depth, $options);
        if (is_null($obj)) {
            throw new JsonException(json_last_error_msg());
        }
        return $obj;
    }
}
