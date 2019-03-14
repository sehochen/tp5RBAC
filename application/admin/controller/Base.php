<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{

    protected $current_action;
    /**
     * 判断session是否存在
     * @return \think\Response
     */
  protected function initialize()
    {
        // 判断（当前作用域）是否赋值
       // dump(session('admin'));
        if(session('?admin')){
            $id=session('id');
            //session的id获取管理员的信息
            $staff=db('admin')->find($id);

            $role_id=$staff['role_id'];
            //$role_id获取本身的信息
            $role=db('role')->find($role_id);
            $auth_ids=$role['role_auth_ids'];
            //$auth_ids获取对应权限
            if($id==1){
                //获取超级管理员对应权限
                $listA=db('auth')->where('auth_level',0)
                    ->select();//父级
                $listB=db('auth')->where('auth_level',1)
                    ->select();//子级、和父级的查询结果是一样的
            }else{
                //③根据$auth_ids获取对应权限
                $listA=db('auth')->where('auth_level',0)->where('auth_id','in',$auth_ids)
                    ->select();//父级
                $listB=db('auth')->where("auth_level=1 and auth_id in($auth_ids)")
                    ->select();//子级、和父级的查询结果是一样的
            }

/*            $listA=db('auth')->where('auth_level',0)->where('auth_id','in',$auth_ids)
                ->select();//父级
            $listB=db('auth')->where("auth_level=1 and auth_id in($auth_ids)")
                ->select();//子级、和父级的查询结果是一样的*/
//            dump($listA);die();
            //结果输出到模板
            $this->assign([
                'listA'=>$listA,
                'listB'=>$listB
            ]);
           /* return view();*/
        }else{
            $this->redirect('admin/login/index');
        }

    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
