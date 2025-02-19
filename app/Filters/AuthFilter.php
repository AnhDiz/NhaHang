<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\UserModel;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function check_permission($url, $id)
    {
        $rolemodel = new RoleModel();
        $pmmodel = new PermissionModel();
        $user = new UserModel();
        $groupid = $user->select('group_id')->where('id',$id)->first();
        while(is_numeric(substr($url,-1))){
            $url = substr($url,0,-1);
        }
        if(substr($url,-1) == '/'){
            $url = substr($url,0,-1);
        }
        $position = strrpos($url,'/');
        if ($position !== false) {
            // Cắt chuỗi từ vị trí của ký tự đó đến hết
            $result = substr($url, $position + 1);
            if ($result == 'create' || $result == 'update' || $result == 'updateI' || $result == 'extract'){
                if( $result == 'update' || $result == 'updateI'){
                    $url = substr_replace($url,'edit',$position + 1);
                }
                if( $result == 'create' ){
                    $url = substr_replace($url,'add',$position + 1);
                }
                if($result == 'extract'){
                    $url = substr_replace($url,'edit',$position + 1);
                }
            }
        }
        $role = $rolemodel->select('role_id')->where('url',$url)->first();
        $permission = $pmmodel->select('role_id')->where('group_id',$groupid)->findAll();
        if(!in_array($role,$permission)){
            return false;
        }
        return true;
    }
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if(!$session->get('logged_in')){
            if(current_url() === base_url().'/dang_nhap'){
                return view('/dang_nhap');
            }
            return redirect('dang_nhap');
        }
        if($session->get('is_admin')){
            $data = [
                'dashboard/group' => true,
                'dashboard/role' => true,
                'dashboard/user' => true,
                'dashboard/material' => true,
                'dashboard/dish' => true,
                'dashboard/materialtype' => true,
                'dashboard/table' => true,
                'dashboard/dishtype' => true,
                'dashboard/booking' => true,
            ];
            $session->set($data);
            return;
        }
        if(session()->get('is_inside')){
            $id = session()->get('id');
            if($this->check_permission('dashboard/group',$id)){
                session()->set(['dashboard/group' => true]);
            }else{
                session()->set(['dashboard/group' => false]);
            }
            if($this->check_permission('dashboard/role',$id)){
                session()->set(['dashboard/role' => true]);
            }else{
                session()->set(['dashboard/role' => false]);
            }
            if($this->check_permission('dashboard/user',$id)){
                session()->set(['dashboard/user' => true]);
            }else{
                session()->set(['dashboard/user' => false]);
            }
            if($this->check_permission('dashboard/material',$id)){
                session()->set(['dashboard/material' => true]);
            }else{
                session()->set(['dashboard/material' => false]);
            }
            if($this->check_permission('dashboard/dish',$id)){
                session()->set(['dashboard/dish' => true]);
            }else{
                session()->set(['dashboard/dish' => false]);
            }
            if($this->check_permission('dashboard/table',$id)){
                session()->set(['dashboard/table' => true]);
            }else{
                session()->set(['dashboard/table' => false]);
            }
            if($this->check_permission('dashboard/dishtype',$id)){
                session()->set(['dashboard/dishtype' => true]);
            }else{
                session()->set(['dashboard/dishtype' => false]);
            }
            if($this->check_permission('dashboard/booking',$id)){
                session()->set(['dashboard/booking' => true]);
            }else{
                session()->set(['dashboard/booking' => false]);
            }
            $url = uri_string();
            if(!$this->check_permission($url,$id)){
                return redirect('error');
            }
        }else{
            return redirect('/');
        }
    }
    
    

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
