<?php

/* -------------------------------------------------------------------------- */
/*                              Class Programmer                              */
/* -------------------------------------------------------------------------- */
class Programmer
{
    public string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

/* -------------------------------------------------------------------------- */
/*                           Class BackEndProgrammer                          */
/* -------------------------------------------------------------------------- */
class BackendProgrammer extends Programmer
{
}

/* -------------------------------------------------------------------------- */
/*                          class FrontEndProgrammer                          */
/* -------------------------------------------------------------------------- */
class FrontendProgrammer extends Programmer
{
}

/* -------------------------------------------------------------------------- */
/*                                Class Company                               */
/* -------------------------------------------------------------------------- */
class Company
{
    public Programmer $programmer;
}

function sayHelloProgrammer(Programmer $programmer)
{
    if ($programmer instanceof BackendProgrammer) {
        echo "Hello Backend Programmer $programmer->name" . PHP_EOL;
    } else if ($programmer instanceof FrontendProgrammer) {
        echo "Hello Frontend Programmer $programmer->name" . PHP_EOL;
    } elseif ($programmer instanceof Programmer) {
        echo "Hello Programmer $programmer->name" . PHP_EOL;
    }
}
