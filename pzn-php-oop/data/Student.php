<?php 

class Student
{
    public string $id;
    public string $name;
    public int $value;
    private string $sampel;

    public function setSample(string $sampel): void
    {
        $this->sampel = $sampel;
    }

    public function __clone()
    {
        unset($this->sampel);
    }

    public function __toString(): string
    {
        return "Student id:$this->id, name:$this->name, value:$this->value";
    }

    public function __invoke(...$arguments): void
    {
        $join = join(",", $arguments);
        echo "Invoke student with arguments $join" . PHP_EOL;
    }

    public function __debugInfo()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "value" => $this->value,
            "sampel" => $this->sampel,
            "author" => "Eko",
            "version" => "1.0.0"
        ];
    }
}