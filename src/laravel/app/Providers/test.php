<?php

interface GetMessageInterface
{
    public function getMessage(): string;
}

class A
{
    private readonly GetMessageInterface $b;
    public function __construct(GetMessageInterface $b)
    {
        $this->b = $b;
    }

    public function displayMessage()
    {
        var_dump($this->b->getMessage());
    }
}

class B implements GetMessageInterface
{
    public function getMessage(): string
    {
        return 'hellow world';
    }
}

class C implements GetMessageInterface
{
    public function getMessage(): string
    {
        return substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 16);
    }
}

$a1 = new A(new B);
$a1->displayMessage();

$a2 = new A(new C);
$a2->displayMessage();
