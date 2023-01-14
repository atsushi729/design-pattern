<?php

namespace Flyweight;

class Flyweight
{
    private $sharedState;

    public function __construct($sharedState)
    {
        $this->sharedState = $sharedState;
    }

    public function operation($uniqueState): void
    {
        $s = json_encode($this->sharedState);
        $u = json_encode($uniqueState);
        echo "Flyweight: Displaying shared ($s) and unique ($u) state.\n";
    }
}

class FlyweightFactory
{
    private $flyweight = [];

    public function __construct(array $initialFlyweights)
    {
        foreach ($initialFlyweights as $state) {
            $this->flyweight[$this->getKey($state)] = new Flyweight($state);
        }
    }

    private function getKey(array $state): string
    {
        ksort($state);

        return implode("_", $state);
    }

    public function getFlyweight(array $sharedState): Flyweight
    {
        $key = $this->getKey($sharedState);

        if (!isset($this->flyweight[$key])) {
            echo "FlyweightFactory: Can't find a flyweight, creating new one.\n";
            $this->flyweight[$key] = new Flyweight($sharedState);
        } else {
            echo "FlyweightFactory: Reusing existing flyweight.\n";
        }

        return $this->flyweight[$key];
    }

    public function listFlyweights(): void
    {
        $count = count($this->flyweight);
        echo "\nFlyweightFactory: I have $count flyweights:\n";
        foreach ($this->flyweight as $key => $flyweight) {
            echo $key . "\n";
        }
    }
}

$factory = new FlyweightFactory([
    ["Chevrolet", "Camaro2018", "pink"],
    ["Mercedes Benz", "C300", "black"],
    ["Mercedes Benz", "C500", "red"],
    ["BMW", "M5", "red"],
    ["BMW", "X6", "white"],
]);
$factory->listFlyweights();

function addCarToPoliceDatabase(
    FlyweightFactory $ff, $plates, $owner,
                     $brand, $model, $color
) {
    echo "\nClient: Adding a car to database.\n";
    $flyweight = $ff->getFlyweight([$brand, $model, $color]);
    $flyweight->operation([$plates, $owner]);
}

addCarToPoliceDatabase($factory,
    "CL234IR",
    "James Doe",
    "BMW",
    "M5",
    "red",
);

addCarToPoliceDatabase($factory,
    "CL234IR",
    "James Doe",
    "BMW",
    "X1",
    "red",
);

$factory->listFlyweights();
