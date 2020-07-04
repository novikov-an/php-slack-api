<?php

namespace  ANovikovTest;

use ANovikov\Helpers\Hydration;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class BaseAnTest extends TestCase
{
    private const DYNAMIC_PROPERTIES = [
        'faker'
    ];

    /**
     * BaseAnTest constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct();
        $this->checkAndLoadDynamicProperties();
    }

    /**
     * @throws \ReflectionException
     */
    protected function checkAndLoadDynamicProperties(): void
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);
        foreach ($properties as $key => $property) {
            $name = $property->getName();
            $setter = Hydration::camel('set_' . $name);
            if (in_array($name, self::DYNAMIC_PROPERTIES, true) && method_exists($this, $setter)) {
                switch ($name) {
                    case 'faker':
                        $this->setFaker(Factory::create());
                        break;
                }
            }
        }
    }
}
