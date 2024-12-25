<?php

namespace App\Controllers\Notification;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NotificationModel;
use App\Models\RoleModel;
use App\Models\PermissionModel;

class NotificationController extends BaseController
{
    protected $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }


    public function create($title)
    {
        // dd($requestData);
        $session = session();
        $role = new RoleModel();
        $permission = new PermissionModel();
        $user = $session->get('name');
        $url = uri_string();
        $position = strrpos($url,'/');
        if ($position !== false) {
            $result = substr($url, $position + 1);
            if ($result == 'create' || $result == 'update' || $result == 'updateI'){
                if( $result == 'update' || $result == 'updateI'){
                    $action = 'cập nhật';
                }
                if( $result == 'create' ){
                    $action = 'thêm mới';
                }
            }
            $url = substr_replace($url,'',$position);
        }
        $roleid = $role->select('role_id,type')->where('url',$url)->first();
        $group_ids = $permission->select('group_id')->where('role_id',$roleid['role_id'])->findAll();
        foreach($group_ids as $group_id):
            $data = [
                'user_group_id' => $group_id,
                'title' => $title,
                'message' => $user.' đã '.$action .' '.$roleid['type'] .' vào hệ thống',
            ];
            $this->notificationModel->save($data);
        endforeach;
    }

    public function fetchUnread($userGroupId)
    {
        $notifications = $this->notificationModel
            ->where('user_group_id', $userGroupId)
            ->orderBy('id','DESC')
            // ->where('is_read', 0)
            // ->where('notify_time <=', date('Y-m-d H:i:s'))
            ->findAll();

        return $this->response->setJSON($notifications);
    }

    public function markAsRead($notificationId)
    {
        $this->notificationModel->update($notificationId, ['is_read' => 1]);
        return redirect()->back()->with('success', 'Notification marked as read.');
    }
}
