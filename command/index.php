<?php

namespace Command;

interface Command
{
    public function execute();
}

class SimpleCommand implements Command
{
    private $payload;

    public function __construct(string $payload)
    {
        $this->payload = $payload;
    }

    public function execute()
    {
        echo "SimpleCommand: See, I can do simple things like printing (" . $this->payload . ")\n";
    }
}

class ComplexCommand implements Command
{
    private $receiver;

    private $a;
    private $b;

    public function __construct(Receiver $receiver, string $a, string $b)
    {
        $this->receiver = $receiver;
        $this->a = $a;
        $this->b = $b;
    }

    public function execute()
    {
        echo "ComplexCommand: Complex stuff should be done by a receiver object.\n";
        $this->receiver->doSomething($this->a);
        $this->receiver->doSomethingElse($this->b);
    }
}

class Receiver
{
    public function doSomething(string $a)
    {
        echo "Receiver: Working on (" . $a . ".)\n";
    }

    public function doSomethingElse(string $b)
    {
        echo "Receiver: Also working on (" . $b . ".)\n";
    }
}

class Invoker
{
    private $onStart;
    private $onFinish;

    public function setOnStart(Command $command)
    {
        $this->onStart = $command;
    }

    public function setOnFinish(Command $command)
    {
        $this->onFinish = $command;
    }

    public function doSomethingImportant()
    {
        echo "Invoker: Does anybody want something done before I begin?\n";
        if ($this->onStart instanceof Command) {
            $this->onStart->execute();
        }

        echo "Invoker: ...doing something really important...\n";

        echo "Invoker: Does anybody want something done after I finish?\n";
        if ($this->onFinish instanceof Command) {
            $this->onFinish->execute();
        }
    }
}

$invoker = new Invoker();
$invoker->setOnStart(new SimpleCommand("say hi!"));
$receiver = new Receiver();
$invoker->setOnFinish(new ComplexCommand($receiver, 'send email', 'save report'));
$invoker->doSomethingImportant();
