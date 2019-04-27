<?php

namespace Najaram\Zmto\Tests;

/**
 * Class TestCase.
 *
 * @property $className
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    protected function getClassDependencies()
    {
        $dependencies = [];
        $constructor = (new \ReflectionClass($this->className))->getConstructor();

        if (!is_null($constructor)) {
            foreach ($constructor->getParameters() as $paramNames) {
                $dependencies[$paramNames->getClass()->getName()] = $paramNames->getName();
            }
        }

        return $dependencies;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    protected function mockClassDependencies()
    {
        $dependencies = $this->getClassDependencies();

        if (count($dependencies) >= 1) {
            foreach ($dependencies as $class => $name) {
                if (!isset($this->$name)) {
                    $this->$name = \Mockery::mock($class);
                }
                $dependencies[$class] = $this->$name;
            }
        }

        return $dependencies;
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \ReflectionException
     */
    protected function classInject(array $params = [])
    {
        $dependencies = $this->mockClassDependencies();
        $dependencies = array_merge($dependencies, $params);

        return new $this->className(
            ...array_values($dependencies)
        );
    }
}
