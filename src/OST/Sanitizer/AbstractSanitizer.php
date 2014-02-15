<?php
/**
 * Abstract Sanitizer
 * 
 * @package OST\Sanitizer
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Sanitizer;

abstract class AbstractSanitizer implements SanitizerInterface
{
    /**
     * Cuts some words from the string
     *
     * @param $string
     * @return string
     */
    public function sanitize($string)
    {
        return $string;
    }
}


