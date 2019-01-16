<?php

namespace App\Http\Controllers\Index;

use App\Hospital;
use App\Http\Controllers\Controller;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getUserInfo()
    {
        return view('index.index');
    }
    public function userDetail()
    {

        $data          = Users::where('hospital_id', '=', Session::get('hospital_info.id'))->paginate(10);
        $hospital_info = Hospital::find(Session::get('hospital_info.id'));
        return view('index.detail', ['hospital_info' => $hospital_info, 'data' => $data]);
    }
    public function login(Request $request)
    {

        if ($request->ajax()) {
            $post_data = $request->input();
            if (!$post_data['name']) {
                return $this->returnMsg(1, '请填写完整');
            }
            if (!$post_data['password']) {
                return $this->returnMsg(2, '密码为空');
            }
            // 极验
            // $result = $this->validate($request, [
            //   'geetest_challenge' => 'geetest',
            // ], [
            //   'geetest' => config('geetest.server_fail_alert')
            // ]);
            $hospital_info = DB::table('hospital')->where('name', $post_data['name'])->first();
            if ($hospital_info) {
                $salt     = env('PASSWORD_PRE');
                $password = md5(md5($post_data['password']) . $salt);
                if ($hospital_info->password == $password) {
                    Session::put('hospital_info.nickname', $hospital_info->nickname);
                    Session::put('hospital_info.descrip', $hospital_info->descrip);
                    Session::put('hospital_info.id', $hospital_info->id);
                    return $this->returnMsg(0, '验证成功');
                }
            }
        }
        return $this->returnMsg(400, '验证失败');
    }
    public function logout(Request $request)
    {
        Session::remove('hospital_info');
        return $this->returnMsg(0, '退出成功');
    }
    public function hospitalEdit(Request $request)
    {
        $validatedData = $request->validate([
            'nickname' => 'required|max:50',
            'descrip' => 'required',
        ]);
        if (!empty($request['nickname']) && !empty($request['descrip'])) {
            $data = Hospital::find(Session::get('hospital_info.id'));
            $data->nickname = $request['nickname'];
            $data->descrip = $request['descrip'];
            $res = $data->save();
            if ($res) {
                return response()->json(['status' => '200', 'info' => '修改成功']);
            }else{
                return response()->json(['status' => '401', 'info' => '修改失败']);
            }
        }else{
            return response()->json(['status' => '400', 'info' => '数据不能为空']);
        }
    }
}
