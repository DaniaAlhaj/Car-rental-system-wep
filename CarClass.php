<?php
require_once "dbconfig.php";

class Car {
    private $carid;
    private $model;
    private $make;
    private $type;
    private $registration_year;
    private $description;
    private $price_per_day;
    private $capacity_people;
    private $capacity_suitcases;
    private $colors;
    private $fuel_type;
    private $avg_consumption;
    private $horsepower;
    private $length;
    private $width;
    private $plate_number;
    private $conditions;


    public function __construct($carid, $model, $make, $type, $registration_year, $description, $price_per_day, $capacity_people, $capacity_suitcases, $colors, $fuel_type, $avg_consumption, $horsepower, $length, $width, $plate_number, $conditions, $pdo) {
        $this->carid = $carid;
        $this->model = $model;
        $this->make = $make;
        $this->type = $type;
        $this->registration_year = $registration_year;
        $this->description = $description;
        $this->price_per_day = $price_per_day;
        $this->capacity_people = $capacity_people;
        $this->capacity_suitcases = $capacity_suitcases;
        $this->colors = $colors;
        $this->fuel_type = $fuel_type;
        $this->avg_consumption = $avg_consumption;
        $this->horsepower = $horsepower;
        $this->length = $length;
        $this->width = $width;
        $this->plate_number = $plate_number;
        $this->conditions = $conditions;
        $this->pdo = $pdo; 
    }
    public function getPhoto() {
        $sql = "SELECT imgname FROM car_images WHERE carid = :carid";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':carid', $this->carid);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['imgname'])) {
            $path = "images/" . $result['imgname'];
            return $path;
        }

        return "images/car1127507853img1.jpg"; 
    }



public function getCarid() { return $this->carid; }
public function getModel() { return $this->model; }
public function getMake() { return $this->make; }
public function getType() { return $this->type; }
public function getRegistrationYear() { return $this->registration_year; }
public function getDescription() { return $this->description; }
public function getPricePerDay() { return $this->price_per_day; }
public function getCapacityPeople() { return $this->capacity_people; }
public function getCapacitySuitcases() { return $this->capacity_suitcases; }
public function getColors() { return $this->colors; }
public function getFuelType() { return $this->fuel_type; }
public function getAvgConsumption() { return $this->avg_consumption; }
public function getHorsepower() { return $this->horsepower; }
public function getLength() { return $this->length; }
public function getWidth() { return $this->width; }
public function getPlateNumber() { return $this->plate_number; }
public function getConditions() { return $this->conditions; }
public function setCarid($carid) { $this->carid = $carid; }
public function setModel($model) { $this->model = $model; }
public function setMake($make) { $this->make = $make; }
public function setType($type) { $this->type = $type; }
public function setRegistrationYear($registration_year) { $this->registration_year = $registration_year; }
public function setDescription($description) { $this->description = $description; }
public function setPricePerDay($price_per_day) { $this->price_per_day = $price_per_day; }
public function setCapacityPeople($capacity_people) { $this->capacity_people = $capacity_people; }
public function setCapacitySuitcases($capacity_suitcases) { $this->capacity_suitcases = $capacity_suitcases; }
public function setColors($colors) { $this->colors = $colors; }
public function setFuelType($fuel_type) { $this->fuel_type = $fuel_type; }
public function setAvgConsumption($avg_consumption) { $this->avg_consumption = $avg_consumption; }
public function setHorsepower($horsepower) { $this->horsepower = $horsepower; }
public function setLength($length) { $this->length = $length; }
public function setWidth($width) { $this->width = $width; }
public function setPlateNumber($plate_number) { $this->plate_number = $plate_number; }
public function setConditions($conditions) { $this->conditions = $conditions; }
}
?>
