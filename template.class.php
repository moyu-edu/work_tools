<?php
class BaseController{
  public function __construct(){
  
  }	
  private $array = [];
  public function assign(array $arr){
	  $this->array = $arr;
	  return $this;
  }
  public function render($tpl){
	  $arr = $this->array;
	  $tpl = require($tpl);
	  $patterns = [];
	  $patterns[0] = '#{{(.*)}}#';
	  $patterns[1] = '#{if (.*)}#';
	  $patterns[2] = '#{/if}#';
	  $replacement = [];
          $replacement[0] = '<?php echo $1;?>';
          $replacement[1] = '<?php if($1){?>';
	  $replacement[2] = '<?php } ?>';	  
	  $tpl.preg_replace($patterns,$replacement,$tpl);

	  ob_start();
	  eval($tpl);
	  $out = ob_get_contents();
	  ob_end_clean();
          
	  header('Content-type:text/html');
	  echo $out;
          
  }
}

?>


//模板样本
<html>
  <body>
    <h1>{{data1.name}}</h1>
  {if $a > 1}
  <h2>{{data2.value}}</h2>
  {/if}
  </body>
</html>
