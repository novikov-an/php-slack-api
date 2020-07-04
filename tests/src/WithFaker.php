<?php

namespace  ANovikovTest;

use Faker\Generator;

/**
 * Trait WithFaker
 */
trait WithFaker
{
    /**
     * @var Generator
     */
    private $faker;

    /**
     * @return Generator
     */
    public function getFaker(): Generator
    {
        return $this->faker;
    }

    /**
     * @param Generator $faker
     */
    public function setFaker(Generator $faker): void
    {
        $this->faker = $faker;
    }
}
