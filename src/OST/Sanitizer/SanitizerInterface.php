<?php
/**
 * Sanitizer Interface
 * 
 * @package OST\Sanitizer
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Sanitizer;

interface SanitizerInterface
{
    /**
     * Cuts some words from the string
     *
     * @param $string
     * @return string
     */
    public function sanitize($string);
}


