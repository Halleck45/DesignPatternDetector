<?php
class Car {

}

class CarFactory {
    static function factory($value) {
        return new Car;
    }
}