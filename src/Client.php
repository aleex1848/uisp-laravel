<?php

namespace Aleex1848\UispLaravel;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Client {

    private string $url, $token;

    public function __construct()
    {
        $this->url = config('uisp-laravel.url_base').config('uisp-laravel.url_path');
        $this->token = config('uisp-laravel.token');
    }

    public function test()
    {
        return $this->url.' : '.$this->token;
    }

    public function sendRequest($verb,$endpoint)
    {
        return Http::withHeader('x-auth-token',$this->token)
        ->$verb($this->url.$endpoint);
    }

    public function getAllDevices()
    {
        return $this->sendRequest('get','devices')->json();
    }

    public function getDeviceById($id)
    {
        return $this->sendRequest('get','devices/'.$id)->json();
    }

    public function makeDeviceBackupById($id)
    {
        return $this->sendRequest('post','devices/'.$id.'/backups')->json();
    }

    public function getDeviceBackupsById($id)
    {
        return $this->sendRequest('get','devices/'.$id.'/backups')->json();
    }

    public function getDeviceBackupById($id, $backupId, $name)
    {
        $result = $this->sendRequest('get','devices/'.$id.'/backups/'.$backupId)->body();
        return Storage::disk('edgerouter')->put($name.'.tar.gz',$result);
    }

}
