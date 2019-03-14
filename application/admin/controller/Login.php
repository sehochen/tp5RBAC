<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Login extends Controller
{
    /**
     * 显后台登录
     *
     */
    public function index()
    {
        if(request()->isAjax()){
            $data = input('param.');
            $list =  db('admin')->where('username',$data['username'])->find();
            if($list != null){
                if(md5($data['password'])  === $list['password']){
                    if($data['code'] != $data['input_code']){
                        return json([
                            'code' => -1,
                            'msg' => '验证码错误'
                        ]);
                    }else{
                        // 赋值（当前作用域）
                        session('admin', $data['username']);
                        session('id', $list['id']);
                        return json([
                            'code' => 1,
                            'msg' => '登录成功'
                        ]);
                    }
                }else{
                    return json([
                        'code' => 0,
                        'msg' => '用户名或者密码错误'
                    ]);
                }
            }else{
                return json([
                    'code' => 0,
                    'msg' => '用户名或者密码错误'
                ]);
            }
            die();
        }else{
            return view();
        }

    }

    /**
     * 显后台登录
     *
     */
    public function logout(){
        // 清除session（当前作用域）
        session(null);
        //$this->success('退出成功','admin/login/index');
        //重定向到指定的URL地址
        $this->redirect('admin/login/index');
    }


}
