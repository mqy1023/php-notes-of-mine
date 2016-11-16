<?php
namespace App\Http\Middleware;
use Closure;

// 活动Activity中间件
// --> 对应的是在App\Http下的Kernel.php中注册该中间件
class Activity {

    // 前置判断
    public function handle($request, Closure $next) {
        if(time() < strtotime('2016-11-15')) {
            return redirect('activity0');
        }

        return $next($request);
    }
}
