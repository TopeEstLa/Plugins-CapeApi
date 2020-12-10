<?php

namespace Azuriom\Plugin\CapeApi;

class CapeAPI
{
    public static function getConstraints()
    {
        $width = (int) setting('cape.width', 64);
        $height = (int) setting('cape.height', 32);
        $scale = (int) setting('cape.scale', 1);

        if ($scale === 1) {
            return [
                'width' => $width,
                'height' => $height,
            ];
        }

        return [
            'min_width' => $width,
            'min_height' => $height,
            'max_width' => $width * $scale,
            'max_height' => $height * $scale,
        ];
    }

    public static function getRule()
    {
        $result = '';

        foreach (self::getConstraints() as $key => $value) {
            $result .= "$key=$value,";
        }

        return 'dimensions:'.substr($result, 0, -1);
    }
}