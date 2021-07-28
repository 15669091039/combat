<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/24
 * Time: 14:30
 * When you read this code, good luck for you.
 */
require __DIR__.'/../Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__.'/../..');
use Application\Form\Generic;
$wrappers=[
    Generic::INPUT=>['type'=>'td','class'=>'content'],
    Generic::LABEL=>['type'=>'td','class'=>'label'],
    Generic::ERRORS=>['type'=>'td','class'=>'error'],
];
$email=new Generic('email',Generic::TYPE_EMAIL,'Email',$wrappers,['id'=>'email','maxLength'=>128,'title'=>'Enter address','required'=>'']);
$password=new Generic('password',$email);
$password->setType(Generic::TYPE_PASSWORD);
$password->setLabel('password');
$password->setAttributes(['id'=>'password','title'=>'enter your password','required'=>'']);
$submit=new Generic('submit',Generic::TYPR_SUBMIT,'Login',$wrappers,['id'=>'submit','title'=>'click to login','value'=>'click here']);



?>
<div class="container">
    <h1>Login</h1>
    <form name="login" method="post">
        <table id="login" class="display" cellpadding="0" width="100%">

            <tr>  <?= $email->getInputOnly();?></tr>
            <tr> <?= $password->getInputOnly();?></tr>
            <tr> <?= $submit->getInputOnly();?></tr>
            <tr>
                <td colspan="2">
                    <br>
                    <?php var_dump($_POST) ; ?>
                </td>
            </tr>

        </table>
    </form>
</div>
