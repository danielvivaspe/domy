<?php

namespace App\Http\Connections;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PhilipsHue
{
    const EXCLUDED_SERVICES = [
        'zigbee_connectivity',
        'entertainment'
    ];

    const SERVICE_NAME = 'Philips Hue';

    function __construct($home)
    {
        $this->home = $home;
        $this->ip = $this->home->param("connections.philipshue.bridgeip");
        $this->user = $this->home->param("connections.philipshue.bridgeuser");
    }

    public function get_all_devices()
    {
        $ip = $this->ip;
        $url = "https://${ip}/clip/v2/resource/device";
        $response = Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'hue-application-key' => $this->user
        ])->get($url)->json('data');

        return $response;
    }

    public function get_all_rooms()
    {
        $url = "https://$this->ip/clip/v2/resource/room";
        $response = Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'hue-application-key' => $this->user
        ])->get($url)->json('data');

        return $response;
    }

    public function get_service_device_info($rid, $rtype) {
        $data = null;
        $case = null;

        switch ($rtype) {
            case "light":
                $case = "light";
                $url = "https://$this->ip/clip/v2/resource/light/$rid";
                $response = Http::withOptions([
                    'verify' => false
                ])->withHeaders([
                    'hue-application-key' => $this->user
                ])->get($url)->json('data')[0];

                $data['on'] = $response['on']['on'];

                if ($response['metadata']['archetype'] !== "plug") {
                    $data['brightness'] = $response['dimming']['brightness'];
                    $data['color'] = $response['color'];
                }

                break;

            case "motion":
                $case = "motion";
                $url = "https://$this->ip/clip/v2/resource/motion/$rid";
                $response = Http::withOptions([
                    'verify' => false
                ])->withHeaders([
                    'hue-application-key' => $this->user
                ])->get($url)->json('data')[0];

                $data['enabled'] = $response['enabled'];
                $data['motion_detected'] = $response['motion']['motion'];
                break;

            case "device_power":
                $case = "device_power";
                $url = "https://$this->ip/clip/v2/resource/device_power/$rid";
                $response = Http::withOptions([
                    'verify' => false
                ])->withHeaders([
                    'hue-application-key' => $this->user
                ])->get($url)->json('data')[0];

                $data['battery_state'] = $response['power_state']['battery_state'];
                $data['battery_level'] = $response['power_state']['battery_level'];
                break;

            case "light_level":
                $case = "light_level";
                $url = "https://$this->ip/clip/v2/resource/light_level/$rid";
                $response = Http::withOptions([
                    'verify' => false
                ])->withHeaders([
                    'hue-application-key' => $this->user
                ])->get($url)->json('data')[0];

                $data['enabled'] = $response['enabled'];
                $data['light_level'] = $response['light']['light_level'];
                break;

            case "temperature":
                $case = "temperature";
                $url = "https://$this->ip/clip/v2/resource/temperature/$rid";
                $response = Http::withOptions([
                    'verify' => false
                ])->withHeaders([
                    'hue-application-key' => $this->user
                ])->get($url)->json('data')[0];

                $data['enabled'] = $response['enabled'];
                $data['temperature'] = $response['temperature']['temperature'];
                break;
        }

        return [
            "name" => $case,
            "data" => $data
        ];
    }

    public function get_device_info($rid) {
        $data = [];

        $url = "https://$this->ip/clip/v2/resource/device/$rid";
        $deviceData = Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'hue-application-key' => $this->user
        ])->get($url)->json('data')[0];
        foreach ($deviceData['services'] as $service) {

            if(!in_array($service['rtype'], self::EXCLUDED_SERVICES)) {
                $serviceData = $this->get_service_device_info($service['rid'], $service['rtype']);
                $data[$serviceData["name"]] = $serviceData["data"];
            }
        }

        return $data;
    }
}
