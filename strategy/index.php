<?php

namespace Strategy;

class Context
{
    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function doSomeBusinessLogic()
    {
        echo "Context: Sorting data using the strategy (not sure how it'll do it)\n";
        $result = $this->strategy->doAlgorithm(['a', 'b', 'c', 'd', 'e']);
        echo implode(',', $result) . "\n";
    }
}

interface Strategy
{
    public function doAlgorithm(array $data);
}


class ConcreteStrategyA implements Strategy
{
    public function doAlgorithm(array $data)
    {
        sort($data);

        return $data;
    }
}

class ConcreteStrategyB implements Strategy
{
    public function doAlgorithm(array $data)
    {
        rsort($data);

        return $data;
    }
}

$context = new Context(new ConcreteStrategyA());
echo "Client: Strategy is set to normal sorting.\n";
$context->doSomeBusinessLogic();

echo "\n";

echo "Client: Strategy is set to reverse sorting.\n";
$context->setStrategy(new ConcreteStrategyB());
$context->doSomeBusinessLogic();
