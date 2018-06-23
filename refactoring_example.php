<?php
class Film

{
public function __construct($title, $priceCode)
{
$this->_title = $title;
$this->_priceCode = $priceCode;
}
public function getPriceCode()
{
return $this->_priceCode;
}
public function setPriceCode($value)
{
$this->_priceCode = $value;
}
public function getTitle()
{
return $this->_title;
}
private $_title;
private $_priceCode;
const CHILDRENS = 2;
const REGULAR = 0;
const NEW_RELEASE = 1;
}
class Rental
{
public function __construct($film, $daysRented)
{
$this->_film = $film;
$this->_daysRented = $daysRented;
}
public function getDaysRented()
{
return $this->_daysRented;
}
/**
* @return Film
*/
public function getFilm()
{
return $this->_film;
}

private $_film;
private $_daysRented;
}
class Customer
{
public function __construct($name)
{
$this->_name = $name;
$this->_rentals = array();
}
public function addRental($rental)
{
array_push($this->_rentals, $rental);
}
public function getName()
{
return $this->_name;
}
public function getStatement()
{
$totalAmount = 0;
$frequentRenterPoints = 0;
$result = "Rental Record for " . $this->getName() . "\n";
foreach ($this->_rentals as $rental)
{
/* @var $rental Rental */
$thisAmount = 0;
//determine amounts for each line
switch ($rental->getFilm()->getPriceCode())
{
case Film::REGULAR:
$thisAmount += 2;
if ($rental->getDaysRented() > 2)
$thisAmount += ($rental->getDaysRented() - 2) * 1.5;
break;
case Film::NEW_RELEASE:
$thisAmount += $rental->getDaysRented() * 3;
break;
case Film::CHILDRENS:
$thisAmount += 1.5;
if ($rental->getDaysRented() > 3)
$thisAmount += ($rental->getDaysRented() - 3) * 1.5;
break;
}

// add frequent renter points
$frequentRenterPoints++;
// add bonus for a two day new release rental
if ($rental->getFilm()->getPriceCode() == Film::NEW_RELEASE &&

$rental->getDaysRented() > 1)

$frequentRenterPoints++;
//show figures for this rental
$result .= "\t" . $rental->getFilm()->getTitle() . "\t" .

$thisAmount . "\n";

$totalAmount += $thisAmount;
}
return $result;
}
private $_name;
private $_rentals;
}