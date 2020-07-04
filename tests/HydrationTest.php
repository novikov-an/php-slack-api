<?php

use ANovikov\Helpers\Hydration;
use ANovikov\Response\Type\Group;

use ANovikovTest\BaseAnTest;
use ANovikovTest\WithFaker;

/**
 * Class HydrationTest
 */
class HydrationTest extends BaseAnTest
{
    use WithFaker;

    /**
     * @var
     */
    private $hydration;

    /**
     * HydrationTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->hydration = new Hydration();
    }

    /**
     * @test
     */
    public function has_necessary_methods(): void
    {
        $this->assertTrue(method_exists($this->hydration, 'toObject'));
        $this->assertTrue(method_exists($this->hydration, 'toArray'));
    }

    /**
     * @test
     */
    public function can_convert_to_object(): void
    {
        $array = [
            'id' => $this->faker->word,
            'name' => $this->faker->name,
            'is_group' => $this->faker->boolean,
            'created' => time(),
            'creator' => $this->faker->word,
            'is_archived' => $this->faker->boolean
        ];

        $object = $this->hydration->toObject($array, new Group());
        $this->assertEquals(Group::class, get_class($object));

        foreach ($array as $key => $value) {
            $getterName = Hydration::camel('get_' . $key);
            $this->assertEquals($object->{$getterName}(), $array[$key]);
        }
    }

    // to object should implement first array
    // $this->toArray($obj);
}
