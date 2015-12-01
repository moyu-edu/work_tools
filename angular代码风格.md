### 翻译自https://github.com/johnpapa/angular-styleguide
## 一个文件只定义一个模块
- 避免如下写代码:
```
/* 避免 */
    angular
        .module('app', ['ngRoute'])
        .controller('SomeController', SomeController)
        .factory('someFactory', someFactory);

    function SomeController() { }

    function someFactory() { }
```
- 可以把上面的拆分成几个文件
```
    /* recommended */

    // app.module.js
    angular
        .module('app', ['ngRoute']);
```

```
/* recommended */

// some.controller.js
angular
    .module('app')
    .controller('SomeController', SomeController);

function SomeController() { }
```

```
/* recommended */

// someFactory.js
angular
    .module('app')
    .factory('someFactory', someFactory);

function someFactory() { }
```

## 用IIFE
## 由于我们第一条规则说了，一个文件一般是一个模块，所以我们一般定义一个模块只用getter，不需要考虑使用setter
```
/* avoid */
var app = angular.module('app', [
    'ngAnimate',
    'ngRoute',
    'app.shared',
    'app.dashboard'
]);
```

```
/* recommended */
angular
    .module('app', [
        'ngAnimate',
        'ngRoute',
        'app.shared',
        'app.dashboard'
    ]);
```

## 文件命名规划
```
    /**
     * recommended
     */

    // controllers
    avengers.controller.js
    avengers.controller.spec.js

    // services/factories
    logger.service.js
    logger.service.spec.js

    // constants
    constants.js

    // module definition
    avengers.module.js

    // routes
    avengers.routes.js
    avengers.routes.spec.js

    // configuration
    avengers.config.js

    // directives
    avenger-profile.directive.js
    avenger-profile.directive.spec.js
```

## Configuration 可以通过Configuration来定制我们的ng-app
```
angular
    .module('app')
    .config(configure);

configure.$inject =
    ['routerHelperProvider', 'exceptionHandlerProvider', 'toastr'];

function configure (routerHelperProvider, exceptionHandlerProvider, toastr) {
    exceptionHandlerProvider.configure(config.appErrorPrefix);
    configureStateHelper();

    toastr.options.timeOut = 4000;
    toastr.options.positionClass = 'toast-bottom-right';

    ////////////////

    function configureStateHelper() {
        routerHelperProvider.configure({
            docTitle: 'NG-Modular: '
        });
    }
}
```

## Run模块，这里的代码是在配置完成后所有的控制器运行之前运行的代码
```
angular
    .module('app')
    .run(runBlock);

runBlock.$inject = ['authenticator', 'translator'];

function runBlock(authenticator, translator) {
    authenticator.initialize();
    translator.initialize();
}
```

## 尽量多使用$开头的服务
```
  $timeout $http $interval
```

## 使用constant来设置全局变量
```
// constants.js

/* global toastr:false, moment:false */
(function() {
    'use strict';

    angular
        .module('app.core')
        .constant('toastr', toastr)
        .constant('moment', moment);
})();
```
