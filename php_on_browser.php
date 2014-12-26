<?php
if(count($_POST)){
    $code = $_POST['code'];
    $a = 'function a(){'.$code.'}';
    try{
        eval($a);
    }catch(Exception $e){
        echo $e->getCode().$e->getMessage();
    }
}
?>
<style>
    *{padding:0;margin:0;}
    #cli{background-color: darkslategray;font-size: 14px;font-family: monospace;color:white;}
    #result{background-color: black;color:white;font-family: monospace;font-size:15px;}
    .con{margin:0 auto;width:60%;margin-top:200px;}
    #cli{width:100%;padding-left:20px;background: url(http://js.jrjimg.cn/zqt-red-1000/images/index_05.jpg) repeat-y left center darkslategray;}
    .run{margin-top:20px;}
</style>
<div class="con">
    <form action="index.php" method="post" id="myform">
        <div>
            <textarea name="code"  cols="30" rows="10" id="cli">
                <?php if($a){echo $code;}?>
            </textarea>
        </div>
        <div class="run">
            <input type="submit" value="运行"/>
        </div>
    </form>

    <p>结果是:</p>
    <div id="result">
        <?php a();?>
    </div>
</div>
