<?php
/**
 * Reader Interface
 * 
 * @package OST\Reader
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Reader;

interface ReaderInterface
{
    public function read($path);
}


