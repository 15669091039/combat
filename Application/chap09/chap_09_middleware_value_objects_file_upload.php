<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/7
 * Time: 12:18
 * When you read this code, good luck for you.
 */
include '../Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__ . '/../..');

use Application\Middleware\UploadedFile;

try {
    $message='';
    $uploadedFiles=array();
    if (isset($_FILES)){
        foreach ($_FILES as $key=>$info){
            if ($info['tmp_name']){
                $uploadedFiles[$key]=new UploadedFile($key,$info,true);
                $uploadedFiles[$key]->moveTo('./uploads');
            }
        }
    }
}catch (Throwable $e){
    $message=$e->getMessage();
}
?>
<form name="search" method="post" enctype="<?= \Application\Middleware\Constants::CONTENT_TYPE_MULTI_FORM?>">
    <table class="display" cellspacing="0" width="100%">
        <tr>
            <th>
                upload1
            </th>
            <td>
                <input type="file" name="upload_1">
            </td>
        </tr>
        <tr>
            <th>
                upload2
            </th>
            <td>
                <input type="file" name="upload_2">
            </td>
        </tr>
        <tr>
            <th>
                upload3
            </th>
            <td>
                <input type="file" name="upload_3">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit">
            </td>
        </tr>

    </table>

</form>
<?= ($message)? '<h1>'.$message.'</h1>':' ';?>



<?php if ($uploadedFiles): ?>
<table class="diaplay" cellspacing="0" width="100%">
    <tr>
        <th>
            FIileName
        </th>
        <th>
            SIZE
        </th>
        <th>
            Moved Filename
        </th>
        <th>
            Text
        </th>

    </tr>
    <?php foreach ($uploadedFiles as $obj) : ?>
    <?php if ($obj->getMovedName()) :?>
    <tr>
        <td>
            <?=htmlspecialchars($obj->getClientFilename())?>
        </td>
        <td>
            <?=$obj->getSize() ?>
        </td>
        <td>
            <?=$obj->getMovedName() ?>
        </td>
        <td>
            <?=$obj->getStream()->getContents() ?>
        </td>

    </tr>
        <?php endif;?>
    <?php endforeach;?>
</table>
<?php endif;?>
<?php phpinfo(INFO_VARIABLES);?>
