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

private function getRegularPrice($daysRented)
{
	if ($daysRented>2) {
		return 2+($daysRented-2)*1.5;
	}
	return 2;
}
private function getNewReleasePrice($daysRented)
{
	return 3*$daysRented;
}
private function getChildrensPrice($daysRented)
{
	if ($daysRented>3) {
		return 1.5+($daysRented-3)*1.5;
	}
	return 1.5;
}
function getLoyaltyPoints($daysRented)
{
	if ($daysRented>1 && $this->_priceCode==self::NEW_RELEASE) {
		return 2;
	}
	return 1;
}
function getCharge($daysRented)
{
	switch ($this->_priceCode) {
		case self::REGULAR: return $this->getRegularPrice($daysRented); break;
		case self::CHILDRENS: return $this->getChildrensPrice($daysRented); break;
		case self::NEW_RELEASE:	return $this->getNewReleasePrice($daysRented); break;	
		default: die('getCharge:It must be a valid price code'); // error handler please
	}
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

function getCharge() {
	return $this->getFilm()->getCharge($this->_daysRented);
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
$result = "Rental Record for " . $this->getName() . "\n";
foreach ($this->_rentals as $rental)
{
//show figures for this rental
$result .= "\t" . $rental->getFilm()->getTitle() . "\t" .

$rental->getCharge() . "\n";

}
return $result;
}
private $_name;
private $_rentals;
}
