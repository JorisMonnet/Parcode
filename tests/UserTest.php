<?php 
use PHPUnit\Framework\TestCase;

//to test : ./vendor/bin/phpunit --testdox tests
//in bash in the folder Awb-g4-Parcode

final class UserTest extends TestCase
{
    public function testParamUser(){
        $this->assertEquals(User::getParam(),[
			"name" => PDO::PARAM_STR,
			"pass" => PDO::PARAM_STR,
			"id" => PDO::PARAM_INT
		]);
    }
    
    public function testNewUser(){
        $user = new User;
        $user->setName("User");
        $user->setPass(password_hash("user",PASSWORD_DEFAULT));
        $this->assertEquals("User",$user->getName());
        $this->assertTrue(password_verify("user",$user->getPass()));   
        $this->assertTrue($user->getAttributes()!==null);
        return $user;
    }

    /**
     * @depends testNewUser
     */
    public function testExtend($user){
        $user->setId(5);
        $this->assertEquals(5,$user->getId());
    }
}