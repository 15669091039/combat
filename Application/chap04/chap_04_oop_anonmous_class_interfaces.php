<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/22
 * Time: 16:52
 * When you read this code, good luck for you.
 */
define('MAX_COLORS',256**3);
$d=new class()implements Countable{
    public $current =0;
    public $maxRows=16;
    public $maxCols=64;
    public function cycle(){
        $row='';
        $max=$this->maxRows*$this->maxCols;
        for ($x=0;$x<$this->maxRows;$x++){
            $row.='<tr>';
            for ($y=0;$y<$this->maxCols;$y++){
                $row.=sprintf('<td style="background-color:#%06x;"',$this->current);
                $row.=sprintf('title="#%06x">&nbsp;</td>',$this->current);
                $this->current++;
                $this->current=($this->current>MAX_COLORS)?0:$this->current;
            }
            $row.='</tr>';
        }
        return $row;
    }
    public function count()
    {
        return MAX_COLORS;
        // TODO: Implement count() method.
    }

};
$d->current=$_GET['currrnt']??0;
$d->current=hexdec($d->current);
$factor=($d->maxRows*$d->maxCols);
$next=$d->current+$factor;
$prev=$d->current-$factor;
$next=($next<MAX_COLORS)?$next:MAX_COLORS-$factor;
$prev=($prev>=0)?$prev:0;
$next=sprintf('%06x',$next);
$prev=sprintf('%06x',$prev);
?>
<h1>
    Total Possible Color Combinations:<?= count($d);?>
</h1>
<hr>
<table>
    <?= $d->cycle()?>
</table>
<a href="?current=<?= $prev ?>"> <<PREV  </a>
<a href="?current=<?= $next ?>">NEXT>> </a>
