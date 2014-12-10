<?php
namespace business;
use \lib\Component;
use \lib\Singleton;
class FileDb extends Component {
    use Singleton;
    private $_filePath;
    private $_fp;
    protected function init() {
        $this->_filePath = DB_FILE;
        try{
            $this->_fp = fopen($this->_filePath, 'a+');
        }catch (\Exception $e){
            echo '错误代码是'.$e->getCode().'错误行数是'.$e->getLine();
        }

    }

    public function __destruct() {
        fclose($this->_fp);
    }

    public function getFilePointer() {
        return $this->_fp;
    }

    public function insert(array $row) {
        fputcsv($this->_fp, $row);

        if($this->hasEventHandlers('afterInsert')) {
            $this->trigger('afterInsert', $row);
        }

    }

}