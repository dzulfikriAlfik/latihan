<?php 

class Zero
{
    private array $properties = [];

    // Mengambil data berdasarkan property
    public function __get($name)
    {
        return $this->properties[$name];
    }

    // Mengubah data berdasarkan property
    public function __set($name, $value)
    {
        return $this->properties[$name] = $value;
    }

    // Mengecek apakah sudah diset berdasarkan property
    public function __isset($name): bool
    {
        return isset($this->properties[$name]);
    }

    // Mengunset berdasarkan property
    public function __unset($name)
    {
        unset($this->properties[$name]);
    }

    public function __call($name, $arguments)
    {
        $join = join(",", $arguments);
        echo "Call function $name with arguments $join" . PHP_EOL;
    }

    public static function __callStatic($name, $arguments)
    {
        $join = join(",", $arguments);
        echo "Call static function $name with arguments $join" . PHP_EOL;
    }
}

$zero = new Zero();
$zero->firstName = "Eko";
$zero->middleName = "Kurniawan";
$zero->lastName = "Khannedy";

echo "First Name : $zero->firstName" . PHP_EOL;
echo "Middle Name : $zero->middleName" . PHP_EOL;
echo "Last Name : $zero->lastName" . PHP_EOL;

$zero->sayHello("Eko", "Khannedy");
Zero::sayHello("Eko", "Khannedy");