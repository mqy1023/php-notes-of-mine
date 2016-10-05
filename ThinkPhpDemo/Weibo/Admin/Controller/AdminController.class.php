<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function index(){
    	echo "Admin Controller Page Index";
    }
    
    // http://localhost:3333/codes/ThinkPhpDemo/Admin/admin/test
    public function test() {
    	show();
    }
}