<?php

namespace Jasny;

/**
 * Helper methods
 */
trait TestHelper
{
    /**
     * Call a private or protected method
     * 
     * @param object $object
     * @param string $method
     * @param array  $args
     * @return mixed
     */
    protected function callPrivateMethod($object, $method, array $args = [])
    {
        $refl = new \ReflectionMethod(get_class($object), $method);
        $refl->setAccessible(true);
        
        return $refl->invokeArgs($object, $args);
    }
    
    /**
     * Set a private or protected property
     * 
     * @param object $object
     * @param string $property
     * @param mixed  $value
     * @return mixed
     */
    protected function setPrivateProperty($object, $property, $value)
    {
        $refl = new \ReflectionProperty(get_class($object), $property);
        $refl->setAccessible(true);
        
        return $refl->setValue($object, $value);
    }
    
    
    /**
     * Assert the last error
     * 
     * @param int    $type     Expected error type, E_* constant
     * @param string $message  Expected error message
     */
    protected function assertLastError($type, $message = null)
    {
        $expected = compact('type') + (isset($message) ? compact('message') : []);
        $this->assertArraySubset($expected, error_get_last());
    }
}
