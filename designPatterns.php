<?php
/**
 * Created by PhpStorm.
 * User: ericzheng
 * Date: 14/12/10
 * Time: 下午1:44
 */
<?php
//创建类
//抽象工厂
//工厂
//建造者
//多例
//池子
//原型
//简单工厂
//单例
//静态工厂
//
//结构类
//适配器
//桥接
//组合
//数据映射
//装饰者
//DI
//外观
//代理
//注册
//


//策略模式
interface FlyBehavior{
public functioin fly();
}

interface QuackBehavior{
    public function quack();
}

class FlyWithWings implements FlyBehavior{
    public function fly(){
        echo 'I am flying......';
    }
}

class FlyNoWay implements FlyBehavior{
    public function fly(){
        echo 'i can not fly....';
    }
}


class FlyRocketPowered implements FlyBehavior{
    public function fly(){
        echo 'i can fly with a rocket....';
    }
}

//如果我们像上面这样，代码会很乱，来，我们用一下策略模式
abstract class Duck{
    protected $quack_obj;
    protected $fly_obj;
    public abstract function display();
    public function performQuack(){
        $this->quack_obj->quack();
    }
    public function performFly(){
        $this->fly_obj->fly();
    }
    public function swim(){
        echo "All ducks float,even decoys!/n";
    }
    public function setFlyBehavior(FlyBehavior $fb){
        $this->fly_obj = $fb;
    }
    public function setQuackBehavior(QuackBehavior $qb){
        $this->quack_obj = $qb;
    }
}

class ModelDuck extends Duck{
    public function __construct(){
        $this->fly_obj = new FlyNoWay();
        $this->quack_obj = new MuteQuack();
    }
    public function display(){
        echo "i am a model duck";
    }
}

//我们创造出第一种鸭子
$first_duck = new ModelDuck();
$first_duck->performFly();
$first_duck->performQuack();

//我们创造出第二种鸭子
$second_duck = new ModelDuck();
$second_duck->setFlyBehavior(new FlyRocketPowered());
$second_duck->setQuackBehavior(new Squeak());
$second_duck->performFly();
$second_duck->performQuack();

// todo 其实上面还可以改写成 $duck = new ModelDuck(array('firstBehavior'=>$behavior1,'secondBehavior'=>$behavior2));



//单例模式
class MyClass{
    private static $uniqueInstance;
    private function __construct(){

    }
    public static function getInstance(){
        if(self::$uniqueInstance == null){
            self::$uniqueInstance = new MyClass();
        }
        return self::$uniqueInstance;
    }
}

$myClass = MyClass::getInstance();
var_dump($myClass);
//再用一下，还是原来那个对象
$mm = MyClass::getInstance();





//工厂模式这是一个抽象工厂

//定义一个抽象类
abstract class Pizza{
    public $name;
    public $dough;
    public $sauce;
    public $toppings = array();
    public function prepare(){
        echo "preparing ".$this->name."/n";
        echo "Yossing dough.../n";
    }
    public function bake(){

    }
    public function cut(){
    }
    public function box(){

    }
    public function getName(){


    }
}

class myPizza extends Pizza{
}

class otherPizza extends Pizza{

}



//观察者模式

//命令模式
class Light{
    public function __construct(){
    }
    public function on(){
        echo "Light on";
    }
    public function off(){
        echo "Light off";
    }
}

interface Command{
    public function execute();
}

class LightOnCommand implements Command{
    public $light;
    public function __construct(Light $light){
        $this->light = $light;
    }
    public function execute(){
        $this->light->on();
    }
}

class LightOffCommand implements Command{
    public $light;
    public function __construct(Light $light){
        $this->light = $light;
    }
    public function execute(){
        $this->light->off();
    }
}

class SimpleRemoteControl{
    public $slot;
    public function __construct(){

    }
    public function setCommand(Command $command){
        $this->slot = $command;
    }
    public function buttonWasPressed(){
        $this->slot->execute();
    }
}

class RemoteControlTest{
    public static function light($str){
        $remote = new SimpleRemoteControl();
        $light = new Light();
        if($str === 'on'){
            $lightOn = new LightOnCommand($light);
            $remote->setCommand($lightOn);
        }else{
            $lightOff = new LightOffCommand($light);
            $remote->setCommand($lightOff);
        }
        remote->buttonWasPressed();
  }

}
RemoteControlTest::light('on');
RemoteControlTest::light('off');

//状态模式
class GumballMachine{
    const SOLD_OUT = 0;
    const NO_QUARTER = 1;
    const HAS_QUARTER = 2;
    const SOLD = 3;
    public $state = self::SOLD_OUT;
    public $count = 0;
    public function __construct($count){
        $this->count = $count;
        if($count > 0){
            $this->state = self::NO_QUARTER;
        }

    }
}

//适配器
//迭代器
//中介者
//责任链
//链式调用
//原型模式
//代理模式



//访问者模式
abstract class Customer{
    public function accept(ServiceRequestVisitor $visitor){
        $visitor->visitEnterpriseCustomer($this);
    }
}

interface Visitor{
    public function visitEnerpriseCustomer(EnterpriseCustomer $ec);
    public function visitPersonCustomer(PersonalCustomer $pc);
}

class ServiceRequestVisitor implements Visitor{
    public function visitEnerpriseCustomer(EnterpriseCustomer $ec){
        echo $ec->name;
    }
    public function visitPersonalCustomer(PersonalCustomer $pc){
        echo
  }
}
