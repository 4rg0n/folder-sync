<?php
/**
 * Abstrakte Collection
 *
 * @package OST\Collection
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Collection;

abstract class AbstractCollection implements \Iterator, CollectionInterface
{
    /**
     * Contains an array of all elements of the collection
     *
     * @var array $items
     */
    protected $items = array();


    /**
     * Contains an array of all keys of the collection
     *
     * @var array $keys
     */
    protected $keys = array();


    /**
     * Contains the relationship from index to element
     *
     * @var array $indexMap
     */
    protected $indexMap = array();


    /**
     * Contains the amount of elements in the collection
     *
     * @var int $length
     */
    protected $length = 0;


    /**
     * Pointer value, which is used by the Iterator class
     *
     * @var int $pointer;
     */
    protected $pointer = 0;


    /**
     * Constructor
     *
     * @param array $array (optional) - elements, which will be added to the collection
     */
    public function __construct(Array $array = array())
    {
        $this->addAll($array);
    }


    /**
     * Returns the current element for Iterator
     *
     * @see \Iterator::current()
     *
     * @return mixed
     */
    public function current()
    {
        return $this->items[$this->pointer];
    }


    /**
     * Returns the current key of the element for Iterator.
     *
     * @see \Iterator::key()
     *
     * @return string|int
     */
    public function key()
    {
        return $this->keys[$this->pointer];
    }


    /**
     * Sets pointer +1.
     *
     * @see \Iterator::next()
     */
    public function next()
    {
        ++$this->pointer;
    }


    /**
     * Resets the pointer
     *
     * @see \Iterator::rewind()
     */
    public function rewind()
    {
        $this->pointer = 0;
    }


    /**
     * Checks wether a key exists at pointer position
     *
     * @see \Iterator::valid()
     *
     * @return boolean
     */
    public function valid()
    {
        return isset($this->keys[$this->pointer]);
    }


    /**
     * Adds an element to the collection.
     *
     * @todo Bessere Variante finden Elemente ohne Schlüssel hinzuzufügen (SplStack Klasse?)
     *
     * @param string|int|mixed $key - the key of the element or the element itself
     * @param mixed $item (optional) - das Element
     * @throws \Exception
     * @return mixed - added element
     */
    public function add($key, $item = null)
    {
        if (null === $item) {
            $item = $key;
            $key = uniqid(); //Drity...
        }

        //Key already exists in collection?
        if ($this->hasKey($key)) {
            throw new \Exception(sprintf('Es existiert bereits ein Element mit dem Schlüssel "%s".', $key));
        }

        $index = $this->length;

        $this->keys[] = $key;
        $this->items[] = $item;
        $this->indexMap[$key] = $index;

        $this->length++;

        return $item;
    }


    /**
     * Replaces an element with the given key.
     * If no element exists with the given key, it will be added.
     *
     * @param string|int $key - key of the element
     * @param mixed $item - new element
     * @return  \OST\Collection\AbstractCollection
     */
    public function replace($key, $item)
    {
        //Key already exists in collection?
        if (false === $this->hasKey($key)) {

            //Hinzufügen
            $this->add($key, $item);
        }

        $index = $this->indexOfKey($key);
        $this->items[$index] = $item;

        return $this;
    }


    /**
     * Replaces an element with the given key.
     *
     * Returns true if the element was successfully replaced.
     * Returns false if there is no element to replace with the given key.
     *
     * @param string|int $key - key of the element
     * @param mixed $item - new element
     * @return  boolean
     */
    public function set($key, $item)
    {
        if (true === $this->hasKey($key)) {
            $index = $this->indexOfKey($key);
            $this->items[$index] = $item;

            return true;
        }

        return false;
    }


    /**
     * Returns the element with the given key
     *
     * @param string|int $key - der Schlüssel des Elements
     * @return mixed|void
     */
    public function get($key)
    {
        $index = $this->indexOfKey($key);

        $item = null;

        if (null !== $index) {
            $item = $this->items[$index];
        }

        return $item;
    }


    /**
     * Returns an element at the given position.
     *
     * @param int $index - position in collection
     * @return mixed|void
     */
    public function getAt($index)
    {
        $item = null;

        if (array_key_exists($index, $this->items)) {
            $item = $this->items[$index];
        }

        return $item;
    }


    /**
     * Returns true if the given key already exists
     *
     * @param string|int $key - the key
     * @return Boolean
     */
    public function hasKey($key)
    {
        return array_key_exists($key, $this->indexMap);
    }


    /**
     * Adds all given elements to the collection
     *
     * @param array $array
     * @return  \OST\Collection\AbstractCollection
     */
    public function addAll(Array $array)
    {
        foreach($array as $key => $item) {
            $this->add($key, $item);
        }

        return $this;
    }


    /**
     * Returns the amount of elements in the collection.
     *
     * @return int - amount of elements in the collection
     */
    public function count()
    {
        return $this->length;
    }


    /**
     * Removes the element with given key.
     * If no element was found, false will be returned.
      *
     * @param string|int $key - key of the element
     * @return \OST\Collection\AbstractCollection|boolean
     */
    public function remove($key)
    {
        //Existiert der Schlüssel in der Collection?
        if (false === $this->hasKey($key)) {
            return false;
        }

        $index = $this->indexOfKey($key);

        unset($this->indexMap[$key]);

        /*
        unset($this->items[$index]);
        unset($this->keys[$index]);

        $this->items = array_values($this->items);
        $this->keys = array_values($this->keys);
        */

        array_splice($this->items, $index, $index);
        array_splice($this->keys, $index, $index);

        $this->length--;

        return $this;
    }


    /**
     * Clears the whole collection
     *
     * @return \OST\Collection\AbstractCollection
     */
    public function clear()
    {
        $this->items = array();
        $this->keys = array();
        $this->indexMap = array();
        $this->length = 0;

        return $this;
    }


    /**
     * Transforms the collection into an array
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();

        foreach($this->indexMap as $key => $index) {
            $array[$key] = $this->items[$index];
        }

        return $array;
    }


    /**
     * Returns the first element of the collection
     *
     * @return mixed - erstes Element der Collection
     */
    public function first()
    {
        return $this->items[0];
    }


    /**
     * Returns the last element of the collection
     *
     * @return mixed - letzte Element der Collection
     */
    public function last()
    {
        return $this->items[$this->count() - 1];
    }


    /**
     * Returns an array with all elements of the collection.
     *
     * @return array - Array mit allen Elementen der Collection
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * Returns an array with all keys of the collection.
     *
     * @return array - Array mit allen Keys (Schlüsseln) aus der Collection
     */
    public function getKeys()
    {
        return $this->keys;
    }


    /**
     * Returns the index of the given key
     *
     * @param string|int $key - the key
     * @return int|void - position of the key in the collection
     */
    public function indexOfKey($key)
    {
        $index = null;

        if ($this->hasKey($key)) {
            $index = $this->indexMap[$key];
        }

        return $index;
    }



    /**
     * Checks whether the collection is empty
     *
     * @return boolean - true when empty
     */
    public function isEmpty()
    {
        $empty = true;

        if ($this->count() > 0) {
            $empty = false;
        }

        return $empty;
    }
}


