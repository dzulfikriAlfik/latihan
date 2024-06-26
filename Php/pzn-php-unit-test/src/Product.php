<?php

namespace ProgrammerZamanNow\Test;

class Product
{

  private string $id, $name, $descriptioin;
  private int $price, $quantity;

  /**
   * @return string
   */
  public function getId(): string
  {
    return $this->id;
  }

  /**
   * @param string $id
   */
  public function setId(string $id): void
  {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName(string $name): void
  {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getDescriptioin(): string
  {
    return $this->descriptioin;
  }

  /**
   * @param string $descriptioin
   */
  public function setDescriptioin(string $descriptioin): void
  {
    $this->descriptioin = $descriptioin;
  }

  /**
   * @return int
   */
  public function getPrice(): int
  {
    return $this->price;
  }

  /**
   * @param int $price
   */
  public function setPrice(int $price): void
  {
    $this->price = $price;
  }

  /**
   * @return int
   */
  public function getQuantity(): int
  {
    return $this->quantity;
  }

  /**
   * @param int $quantity
   */
  public function setQuantity(int $quantity): void
  {
    $this->quantity = $quantity;
  }

}