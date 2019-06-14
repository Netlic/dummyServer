<?php

namespace Dummy\Server;

/**
 * Class DummyServer
 * @package Dummy\Server
 * @property string $documentRoot
 * @property float $requestTimeFloat
 * @property integer $requestTime
 * @property string $scriptFilename
 * @property string $scriptName
 * @property array $arguments
 */
class DummyServer
{
    /** @var array */
    private $server = [];

    public function __construct()
    {
        $this->server = $_SERVER;
    }

    public function __get($name)
    {
        $method = sprintf('get%s', ucfirst($name));
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        $property = strtoupper(preg_replace('/(?<!\ )[A-Z]/', '_$0', $name));

        return $this->server[$property] ?? null;
    }

    /**
     * Returns array of arguments passed to cli
     * @return array
     */
    public function getArguments(): array
    {
        $arguments = $this->server['argv'];
        array_shift($arguments);

        return $arguments;
    }

    /**
     * @return DummyServer
     */
    public static function instantiate(): DummyServer
    {
        return new static();
    }
}