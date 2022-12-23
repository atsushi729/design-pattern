<?php

namespace TemplateMethod;

abstract class AbstractClass
{
    final public function templateMethod()
    {
        $this->baseOperation1();
        $this->requiredOperations1();
        $this->baseOperation2();
        $this->hook1();
        $this->requiredOperation2();
        $this->baseOperation3();
        $this->hook2();
    }

    protected function baseOperation1()
    {
        echo "AbstractClass says: I am doing the bulk of the work\n";
    }

    protected function baseOperation2()
    {
        echo "AbstractClass says: But I let subclasses override some operations\n";
    }

    protected function baseOperation3()
    {
        echo "AbstractClass says: But I am doing the bulk of the work anyway\n";
    }

    abstract protected function requiredOperations1();
    abstract protected function requiredOperation2();

    protected function hook1() {}
    protected function hook2() {}
}

class ConcreteClass1 extends AbstractClass
{
    protected function requiredOperations1()
    {
        echo "ConcreteClass1 says: Implemented Operation1\n";
    }

    protected function requiredOperation2(): void
    {
        echo "ConcreteClass1 says: Implemented Operation2\n";
    }
}

class ConcreteClass2 extends AbstractClass
{
    protected function requiredOperations1(): void
    {
        echo "ConcreteClass2 says: Implemented Operation1\n";
    }

    protected function requiredOperation2(): void
    {
        echo "ConcreteClass2 says: Implemented Operation2\n";
    }

    protected function hook1(): void
    {
        echo "ConcreteClass2 says: Overridden Hook1\n";
    }
}

function clientCode(AbstractClass $class)
{
    $class->templateMethod();
}

echo "Same client code can work with different subclasses:\n";
clientCode(new ConcreteClass1());

echo "\n";

echo "Same client code can work with different subclasses:\n";
clientCode(new ConcreteClass2());
