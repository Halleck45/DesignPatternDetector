<?php
namespace Test\Hal\BusinessRule;

use Hal\Component\BusinessRule\Collection;

class CollectionFilterTest extends \PHPUnit_Framework_TestCase {
    public function testCollectionIsFiltered() {
        $collection = new Collection(array(
            new CollectionTestUser('jean-françois',27)
        , new CollectionTestUser('bénédicte',28)
        , new CollectionTestUser('bob',5) // is not adult
        , new CollectionTestUser('alice',40) // is too old
        ));
        $request = $collection->where('user => user.age > 18 and user.age < 40');
        $result = array();
        foreach($request as $item) {
            $result[] = $item->name;
        }
        $this->assertEquals(array('jean-françois', 'bénédicte'), $result);
    }
    public function testCollectionAcceptsArgumentAfterFiltering() {
        $collection = new Collection(array(
            new CollectionTestUser('jean-françois',27, 500)
        , new CollectionTestUser('bénédicte',28, 500)
        , new CollectionTestUser('bob',5, 0) // is not adult
        , new CollectionTestUser('alice',40, 0) // is too old
        ));
        $request = $collection->where('user => user.age > 18 and user.age < 40');
        $collection->push(new CollectionTestUser('isAddedAfter',30, 500));
        $this->assertEquals(3, sizeof($request));
    }
}
class CollectionTestUser {
    public $name;
    public $age;
    public function __construct($name, $age)
    {
        $this->age = $age;
        $this->name = $name;
    }
}