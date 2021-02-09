<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['dashboard'] = 'backend/dashboard';
// $route['user'] = 'backend/user';
// $route['video'] = 'backend/video';
// $route['footage'] = 'backend/footage';
// $route['audio'] = 'backend/audio';
// $route['report'] = 'backend/report';
$route['api/login.json'] = 'api/Api_login/login';
$route['api/upload-photo-user.json'] = 'api/Api_login/uploadphoto';
$route['api/regist.json'] = 'api/Api_login/register';

$route['api/sound.json'] = 'api/Api_dashboard/sound';
$route['api/upload-dropbox.json'] = 'api/Api_dashboard/uploadphoto';
$route['api/process-rendering.json'] = 'api/Api_dashboard/rendering';
$route['api/fullcalendar.json'] = 'api/Api_dashboard/fullcalendar';
$route['api/event.json'] = 'api/Api_dashboard/eventid';

$route['api/get-myvideo.json'] = 'api/Api_video/myvideo';
$route['api/get-myvideolink-id.json'] = 'api/Api_video/myvideolink';
$route['api/get-myvideo-id.json'] = 'api/Api_video/myvideobyid';
$route['api/get-report-id.json'] = 'api/Api_video/reportingbyid';
$route['api/download-myvideo.json'] = 'api/Api_video/download';
$route['api/input-report.json'] = 'api/Api_video/inputreport';
$route['api/get-template.json'] = 'api/Api_video/template';
$route['api/delete-myvideo.json'] = 'api/Api_video/deletevideo';