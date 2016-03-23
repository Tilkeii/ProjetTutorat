<?php

/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 22/03/2016
 * Time: 17:06
 */
require_once 'TestFormValideAnnonce.php';

class Test extends PHPUnit_Framework_TestCase
{
    public function testAnnonceValide(){
        $a = new TestFormValideAnnonce(new PDO('mysql:host=89.234.180.28;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu'),"21401059",1,"Bonjour je test");
        //Action
        $b = $a->formValideAnnonce();
        //Assert
        $this->assertTrue($b,"Test b False");
    }
}
