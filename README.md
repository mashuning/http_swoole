# http_swoole
两个http服务，旨在提高微服务的效率;

两个文件功能相同，也是相互独立，都是http服务，可以任意选择一个;这里推荐使用http.php

本服务是以 msn 自制MVC框架为例编写，有兴趣可以clone学习：https://github.com/mashuning/msn.git 

本服务可以热加载任何框架，配合任何框架做你想要的任何应用;本实例是提供一种解决问题的思想，提高代码效率的方法；配合不同框架需要对不同框架做微调，目的是在启动http服务的时候，就尽可能的加载完所有需要的类库；这也是区别与nginx和apache 在运行时每次都加载编译php代码;

需要注意的是，加载不同的框架都是需要在 workerstart事件中加载框架、在Request 事件中启动框架的;

这里不介绍swoole的基础知识，关于swoole基础知识请移步：https://wiki.swoole.com/wiki/page/1.html

本http服务实例代码中的重要步骤已添加中文备注，请放入您的swoole环境中启动调试; 并且每次调试完代码，需要swoole重启 http.php; 真正在开发中，建议用nginx + php框架开发，开发完之后，再换上swoole的http服务测试并上线;


