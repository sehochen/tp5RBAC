<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Role extends Base
{
    /**
     * 显示权限
     */
    public function index()
    {
        $list = db('role')->select();
        $this->assign('list',$list);
        return view();
    }

    /**
     * 分配权限
     */
    public function allot()
    {
        //获得"被分配权限"的角色信息
        $list=db('role')->where('role_id',input('id'))->find();
        //获取超级管理员对应权限
        $listA=db('auth')->where('auth_level',0)
            ->select();//父级
        $listB=db('auth')->where('auth_level',1)
            ->select();//子级、和父级的查询结果是一样的
        //dump($list);
        //结果输出到模板
        $this->assign([
            'list'=>$list,
            'listA'=>$listA,
            'listB'=>$listB
        ]);
        return view();
    }


    //权限分配添加
    public function fenadd()
    {
        $data=input('param.');
        if(request()->Post()){
            //两个逻辑：展示、收集
            $role = new \app\admin\model\Role();
            $res = $role -> roleAuth($data['role_id'],$data['role_auth_ids']);
            if($res){
                $this->redirect('admin/role/index');
            }else {
                $this->error('分配权限失败','admin/role/index',1,1);
            }
        }
    }

    //添加角色名
    public function add_user()
    {
        if(\request()->isPost() && !\request()->isAjax()){
            $data=input('param.');
            $res = db('role')->insert($data);
            if($res){$this->redirect('admin/role/index');}else{$this->error('添加失败','admin/role/index',1,1);}
        }
        return view();
    }

    //删除角色名
    public function del_user()
    {
        $data = input('id');
        $res = db('role')->where('role_id',$data)->delete();
        if($res){return 1;}else{return -1;}
    }








}

