<?php
/**
 * Release Sanitizer
 *
 * Bringt die Ordnernamen in eine vergleichbare Form
 *
 * @package OST\Sanitizer
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Sanitizer;


class ReleaseName extends AbstractSanitizer
{
    /**
     * @var \OST\Sanitizer\ReleaseName
     */
    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            // First invocation only.
            $className = __CLASS__;
            self::$instance = new $className();
        }

        return self::$instance;
    }

    /**
     * Cuts some words from the name
     *
     * @param $name
     * @return string
     */
    public function sanitize($name)
    {
        return $name;
    }


    /**
     * Disabled cloning of the class
     *
     * @throws Exception
     */
    public function __clone() {
        throw new Exception('Illegally attempted to clone ' . __CLASS__);
    }
} 