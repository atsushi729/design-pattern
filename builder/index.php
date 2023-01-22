<?php


interface Builder
{
    public function producePartA();
    public function producePartB();
    public function producePartC();
}

class ConcreteBuilder1 implements Builder
{
    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->product = new Product1();
    }

    public function producePartA()
    {
        $this->product->parts[] = "PartA1";
    }

    public function producePartB()
    {
        $this->product->parts[] = "PartB1";
    }
    public function producePartC()
    {
        $this->product->parts[] = "PartC1";
    }

    public function getProduct(): Product1
    {
        $result = $this->product;
        $this->reset();

        return $result;
    }
}

class Product1
{
    public $parts = [];

    public function listParts(): void
    {
        echo "Product parts: " . implode(', ', $this->parts) . "\n\n";
    }
}

class Director
{
    private $builder;

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function buildMinimalViableProduct(): void
    {
        $this->builder->producePartA();
    }

    public function buildFullFeaturedProduct(): void
    {
        $this->builder->producePartA();
        $this->builder->producePartB();
        $this->builder->producePartC();
    }
}

function clientCode(Director $director)
{
    $builder = new ConcreteBuilder1();
    $director->setBuilder($builder);

    echo "Standard basic product:\n";
    $director->buildMinimalViableProduct();
    $builder->getProduct()->listParts();

    echo "Standard full featured product:\n";
    $director->buildFullFeaturedProduct();
    $builder->getProduct()->listParts();

    echo "Custom product:\n";
    $builder->producePartA();
    $builder->producePartC();
    $builder->getProduct()->listParts();
}

$director = new Director();
clientCode($director);