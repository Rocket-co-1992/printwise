<?php

namespace Auth;

class Authorization
{
    private $permissions;

    public function __construct()
    {
        $this->permissions = include __DIR__ . '/../../config/permissions.php';
    }

    public function hasPermission($userRole, $permission)
    {
        if (!isset($this->permissions[$userRole])) {
            return false;
        }

        return in_array($permission, $this->permissions[$userRole]);
    }

    public function isAdmin($userRole)
    {
        return $userRole === 'admin';
    }

    public function isOperator($userRole)
    {
        return $userRole === 'operator';
    }
}