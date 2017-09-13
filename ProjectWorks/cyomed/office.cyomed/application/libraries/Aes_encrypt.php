<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Aes_encrypt
{
    /**
     * Key of size 9 not supported by this algorithm. Only keys of sizes 16, 24 or 32 supported.
     * const LEGACY_KEY = 'IhrArzt24';.
     */
    const LEGACY_KEY = 'c39d768e01ab44c6a3c6b3f7d18578be';

    /**
     * [$CI description].
     * 
     * @var [type]
     */
    private $CI;

    /**
     * [__construct description].
     */
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    /**
     * [en description].
     *
     * @param [type] $text [description]
     * @param string $key  [description]
     *
     * @return [type] [description]
     */
    public function en($text, $key = '')
    {
        return $this->b($text, $key);
    }

    /**
     * [de description].
     *
     * @param [type] $text [description]
     * @param string $key  [description]
     *
     * @return [type] [description]
     */
    public function de($text, $key = '')
    {
        return remove_invisible_characters($this->b($text, $key, 'mcrypt_decrypt'));
    }

    /**
     * [b description].
     *
     * @param [type] $text       [description]
     * @param string $key        [description]
     * @param string $crypt_func [description]
     *
     * @return [type] [description]
     */
    public function b($text, $key = '', $crypt_func = 'mcrypt_encrypt')
    {
        return $crypt_func(MCRYPT_RIJNDAEL_128, $key ? $key : self::LEGACY_KEY, $text, MCRYPT_MODE_ECB);
    }
}

/* End of file Aes_encrypt.php */
/* Location: ./application/libraries/Aes_encrypt.php */
