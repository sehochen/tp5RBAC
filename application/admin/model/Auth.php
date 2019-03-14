<?php

namespace app\admin\model;

use think\Model;

class Auth extends Model
{
    public function addAuth($data){

        $newid=$this->save($data);
        // 使用查询构造器查询满足条件的数据
        $user = $this->where([
            'auth_name'	=>	$data['auth_name'],
            'auth_c'=>	$data['auth_c'],
            'auth_a'=>	$data['auth_a'],
        ])->find();

        $auth_id=$user['auth_id'];
         if($user['auth_pid']==0){
             $data['auth_path'] = (string)$auth_id;
             $data['auth_level'] = 0;
         }else{
             $data['auth_path'] = $user['auth_pid'].'-'.$auth_id;
             $data['auth_level'] = 1;
         }
        //④更新数据库
        $auth = Auth::where('auth_id',$auth_id)->find();
        $auth->auth_path     =  $data['auth_path'];
        $auth->auth_level    =  $data['auth_level'];
        return $auth->save($data);

    }
}
