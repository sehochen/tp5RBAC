<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Auth extends Base
{
    /**
     * 规则表显示
     */
    public function index()
    {
        $list=db('auth')->order('auth_path')->paginate(10);

        $this->assign('list',$list);
        return view();
    }

    /**
     * 添加规则
     */
    public function add_auth()
    {
        if(\request()->isPost() && !\request()->isAjax()){
            $data = input('param.');
            $res = new \app\admin\model\Auth();
            if($res->addAuth($data)){
                $this->redirect('admin/auth/index');
            }else{
               $this->error('添加失败','admin/auth/index',66,1);
            }
        }
        //获取超级管理员对应权限
        $listA=db('auth')->where('auth_level',0)
            ->select();//父级
        //dump($list);
        //结果输出到模板
        $this->assign([
            'list'=>$listA,

        ]);
        return view();
    }


    /**
     * 删除规则
     */
    public function del_auth()
    {
        if(\request()->isAjax()){
            $data = input('param.');
            $list = db('auth')->where('auth_id',$data['auth_id'])->find();
            if($list['auth_level'] == '1'){
                $res = db('auth')->where('auth_id',$data['auth_id'])->delete();
                if($res){return 1;}else{return -1;}
            }else{
                // 条件删除
                $res = db('auth')->where('auth_id|auth_pid','eq',$data['auth_id'],$data['auth_id'])->delete();

                if($res){return 1;}else{return -1;}
            }

        }
    }












}

