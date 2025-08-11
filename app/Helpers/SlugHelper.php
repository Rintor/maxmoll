<?php

namespace App\Helpers;

class SlugHelper
{
    public static function translit($str)
    {
        $map = [
            'а' => 'a',  'б' => 'b',  'в' => 'v',  'г' => 'g',  'д' => 'd',
            'е' => 'e',  'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',  'и' => 'i',
            'й' => 'y',  'к' => 'k',  'л' => 'l',  'м' => 'm',  'н' => 'n',
            'о' => 'o',  'п' => 'p',  'р' => 'r',  'с' => 's',  'т' => 't',
            'у' => 'u',  'ф' => 'f',  'х' => 'h',  'ц' => 'ts', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'sch','ъ' => '',   'ы' => 'y',  'ь' => '',
            'э' => 'e',  'ю' => 'yu', 'я' => 'ya'
        ];

        $str = mb_strtolower($str, 'UTF-8');
        $result = '';
        $len = mb_strlen($str, 'UTF-8');

        for ($i = 0; $i < $len; $i++) {
            $char = mb_substr($str, $i, 1, 'UTF-8');
            $result .= isset($map[$char]) ? $map[$char] : $char;
        }

        return $result;
    }

    public static function generateSlug($value)
    {
        $value = self::translit($value);
        $value = preg_replace('/\s+/', '-', $value);
        $value = preg_replace('/[^a-z0-9\-]/', '', $value);
        $value = preg_replace('/-+/', '-', $value);
        $value = trim($value, '-');
        
        return $value;
    }
}
