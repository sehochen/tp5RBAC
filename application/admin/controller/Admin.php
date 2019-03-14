<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Admin extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = db('admin')->alias('a')
            ->join('t_role w','a.role_id = w.role_id')->order('id asc')->paginate(10);
       // dump($list);
       $this->assign('list',$list);
        return view();
    }



    /**
     * 添加管理员
     */
    public function add_admin()
    {
        if(\request()->isPost() && !\request()->isAjax()){
            $data = input('param.');
            $data['create_time'] = time();
            $data['password'] = md5($data['password']);
            $res = db('admin')->insert($data);
            if($res){
                $this->redirect('admin/admin/index');
            }else{
                $this->error('添加失败','admin/admin/index',1,1);
            }
        }
        $list = db('role')->select();
        $this->assign('list',$list);
        return view();
    }
    /**
     * 编辑用户
     */
    public function edit($id)
    {
        if(\request()->isPost() && !\request()->isAjax()){
            $data = input('param.');
//            if($id == 1){$this->error('该用户不可删除','admin/admin/index',1,1);}
            $data['password'] = md5($data['password']);
            $res = db('admin')->where('id', $id)
                ->update($data);
           if($res){$this->redirect('admin/admin/index');}else{$this->error('修改失败','admin/admin/index',1,1);}
        }
        $list = db('role')->select();
        $listA = db('admin')->where('id',$id)->find();
        $this->assign([
            'list'=>$list,
            'listA'=>$listA
        ]);
        return view();
    }


    /**
     * 修改密码
     */
    public function setup(){
        if(\request()->isPost() && !\request()->isAjax()){
            $data = input('param.');
            $info['password'] = md5($data['password']);
            $res = db('admin')->where('id', $data['id'])
                ->update($info);
            if($res){$this->redirect('admin/index/index');}else{$this->error('修改失败','admin/index/index',1,1);}
        }
        return view();
        //$this->redirect('admin/login/index');
    }
    /**
     * 删除指定资源
     *
     */
    public function del()
    {
       $data=input('id');
       if($data != 1){
           // 条件删除
          $res = db('admin')->where('id',$data)->delete();
          if($res){return 1;}else{return -1;}
       }
    }
}

