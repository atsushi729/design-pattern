# What is Template Method

Template Method is a behavioral design pattern that defines the skeleton of an algorithm in the superclass but lets subclasses override specific steps of the algorithm without changing its structure.

## Example
If we have some specific tasks like make curry, we need to implement following step. 
1. Cut ingredients(vegitable, meat, etc..).
2. Boil ingredients.
3. Dish up the food on a plate.

However, there are many curry exists like pork curry, chicken curry and vegitable curry. 
To make these curry, we can divide process into two parts, common step and different step.

 - Common step means that above procedure like cut ingredient, boil and server. 
 - Different step means that different ingredients, different strength of fire etc.

According to above example, we could say that many process has common step and different step.
Template method pattern implement same things.

## How "Template Method" work
The template method is used to define the basic steps of an algorithm, and it allows subclasses to override certain steps of the algorithm without changing its overall structure. This allows subclasses to provide their own implementation for some steps of the algorithm, while still using the same overall structure.

```
abstract class AbstractClass
{
    final public function templateMethod()
    {
        $this->stepOne();
        $this->stepTwo();
        $this->stepThree();
    }

    abstract protected function stepOne();
    abstract protected function stepTwo();
    abstract protected function stepThree();
}

class ConcreteClass extends AbstractClass
{
    protected function stepOne()
    {
        echo "Executing step one\n";
    }

    protected function stepTwo()
    {
        echo "Executing step two\n";
    }

    protected function stepThree()
    {
        echo "Executing step three\n";
    }
}

$concreteClass = new ConcreteClass();
$concreteClass->templateMethod();

```

In this example, the `AbstractClass` defines the template method `templateMethod()`, which consists of three steps: `stepOne()`, `stepTwo()`, and `stepThree()`. The `ConcreteClass` subclass provides its own implementation for each of these steps, and when `templateMethod()` is called on an instance of `ConcreteClass`, it will execute the steps in the order specified in the template method.