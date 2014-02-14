<?php
/**
 * Collection Interface
 *
 * @package OST\Collection
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Collection;

interface CollectionInterface
{
    /**
     * Returns the element with the given key
     *
     * @param string|int $key - der Schlüssel des Elements
     * @return mixed|void
     */
    public function get($key);


    /**
     * Adds an element to the collection.
     *
     * @param string|int|mixed $key - the key of the element or the element itself
     * @param mixed $item (optional) - das Element
     * @throws \Exception
     * @return mixed - added element
     */
    public function add($key, $item = null);


    /**
     * Removes the element with given key.
     * If no element was found, false will be returned.
     *
     * @param string|int $key - key of the element
     * @return $this
     */
    public function remove($key);


    /**
     * Replaces an element with the given key.
     * If no element exists with the given key, it will be added.
     *
     * @param string|int $key - key of the element
     * @param mixed $item - new element
     * @return $this
     */
    public function replace($key, $item);


    /**
     * Returns the amount of elements in the collection.
     *
     * @return int - amount of elements in the collection
     */
    public function count();


    /**
     * Clears the whole collection
     *
     * @return $this
     */
    public function clear();


    /**
     * Transforms the collection into an array
     *
     * @return array
     */
    public function toArray();
}


