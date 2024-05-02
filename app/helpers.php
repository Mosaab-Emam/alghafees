<?php


function can($permission) {
    return true;
    // if (in_array('super-admin', auth()->user()->getRoleNames()->toArray())) {
    //     return true;
    // }
    // // dd(auth()->user()->getPermissionsViaRoles()->pluck('name')->toArray());
    // return in_array($permission, auth()->user()->getPermissionsViaRoles()->pluck('name')->toArray());
}
