<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/24
 * Time: 10:16
 * When you read this code, good luck for you.
 */

namespace Application\Entity;

use Application\Database\Connection;
use Application\Database\Finder;

/**
 * Class Customer
 *
 * Custom表对应实体模型。
 * @package Application\Entity
 */
class Customer  extends Base
{
    const TABLE_NAME='customer';
    protected $name=' ';
    protected $balance=0.0;
    protected $email='';
    protected $password='';
    protected $status=0;
    protected $securityQuestion='';
    protected $confirmCode='';
    protected $profileId=0;
    protected $level='';
    protected $mapping=[
        'id'=>'id',
        'name'=>'name',
        'balance'=>'balance',
        'email'=>'email',
        'password'=>'password',
        'status'=>'status',
        'security_question'=>'securityQuestion',
        'confirm_code'=>'confirmCode',
        'profile_id'=>'profileId',
        'level'=>'level'
    ];





    public function getName():string
    {
        return (string)$this->name;
    }
    public function setName($name)
    {
        $this->name=(string)$name;
    }
    public function getBalance():float
    {
        return  (float)$this->balance;
    }
    public function setBalance($balance)
    {
        $this->balance=(float)$balance;
    }

    public function getEmail():string
    {
        return  (string)$this->email;
    }
    public function setEmail($email)
    {
        $this->email=(string)$email;
    }


    public function getPassword():string
    {
        return  (string)$this->password;
    }
    public function setPassword($password)
    {
        $this->password=$password;
    }

    public function getStatus():int
    {
        return  (int)$this->status;
    }
    public function setStatus($status)
    {
        $this->status=(int)$status;
    }
    public function getSecurityQuestion():string
    {
        return  (string)$this->securityQuestion;
    }
    public function setSecurityQuestion($securityQuestion)
    {
        $this->securityQuestion=(string)$securityQuestion;
    }
    public function getConfirmCode():string
    {
        return  (string)$this->confirmCode;
    }
    public function setConfirmCode($confirmCode)
    {
        $this->confirmCode=(int)$confirmCode;
    }

    public function getProfileId():int
    {
        return  (int)$this->profileId;
    }
    public function setProfileId($profileId)
    {
        $this->status=(int)$profileId;
    }
    public function getLevel():string
    {
        return  (string)$this->level;
    }
    public function setLevel($level)
    {
        $this->status=(int)$level;
    }









}
