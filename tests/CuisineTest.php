<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost:8889;dbname=restaurant_app_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase {

        protected function tearDown() {
            Cuisine::deleteAll();
        }

        function test_save() {

            // ARRANGE
            $id = null;
            $cuisine_type = "Tex-Mex";
            $test_cuisine = new Cuisine($cuisine_type, $id);
            $test_cuisine->save();

            // ACT
            $result = $test_cuisine::getAll();

            // ASSERT
            $this->assertEquals($test_cuisine, $result[0]);

        }

        function test_getAll() {

            // ARRANGE
            $id = null;
            $cuisine_type1 = "Tex-Mex";
            $cuisine_type2 = "Ethiopian";
            $test_cuisine1 = new Cuisine($cuisine_type1, $id);
            $test_cuisine2 = new Cuisine($cuisine_type2, $id);
            $test_cuisine1->save();
            $test_cuisine2->save();

            // ACT
            $result = Cuisine::getAll();

            // ASSERT
            $this->assertEquals([$test_cuisine1, $test_cuisine2], $result);

        }

        function test_deleteAll() {

            // ARRANGE
            $id = null;
            $cuisine_type1 = "Tex-Mex";
            $cuisine_type2 = "Ethiopian";
            $test_cuisine1 = new Cuisine($cuisine_type1, $id);
            $test_cuisine2 = new Cuisine($cuisine_type2, $id);
            $test_cuisine1->save();
            $test_cuisine2->save();

            // ACT
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            // ASSERT
            $this->assertEquals([], $result);

        }

        function test_find() {

            // ARRANGE
            $id = null;
            $cuisine_type = "Tex-Mex";
            $test_cuisine = new Cuisine($cuisine_type, $id);
            $test_cuisine->save();

            // ACT
            $result = Cuisine::find($test_cuisine->getId());

            // ASSERT
            $this->assertEquals($test_cuisine, $result);

        }

        function testUpdate() {
            //ARRANGE
            $id = null;
            $type = "Korean";
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $new_type = "Japanese";

            //ACT
            $test_cuisine->update($new_type);

            //ASSERT
            $this->assertEquals("Japanese", $test_cuisine->getCuisineType());
        }

    }


?>
