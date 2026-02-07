<?php namespace EC\HttpRequest;
defined('_ESPADA') or die(NO_ACCESS);

require(__DIR__ . '/../composer/vendor/autoload.php');

use E, EC;

class CHttpRequest {
    private $client = null;
    private $auth = null;
    private $headers = null;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function delete($url) {
        return $this->request('DELETE', $url, [
            'http_errors' => false,
        ]);
    }

    public function delete_JSON($url, array $json = []) {
        return $this->request('DELETE', $url, [
            'json' => $json,
            'http_errors' => false,
        ]);
    }

    public function get($url, $fields = []) {
        return $this->request('GET', $url);
    }

    public function get_Test($url, $fields = []) {
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "icanhazip.com");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);  

        echo $output;

        // print_r(net_get_interfaces());
        // echo "3";

        // $client = new \GuzzleHttp\Client(['curl' => [ CURLOPT_HTTPHEADER => array("X-Forwarded-For: 77.55.138.172") ]]);
        // return $client->request('GET', $url);
    }

    public function get_JSON($url) {
        return $this->request('GET', $url, [
            'http_errors' => false,
        ]);
    }

    public function post($url, $fields = []) {
        return $this->request('POST', $url, [
            'form_params' => $fields,
        ]);
    }

    public function post_JSON($url, array $json) {
        return $this->request('POST', $url, [
            'json' => $json,
            'http_errors' => false,
        ]);
    }

    public function put_JSON($url, array $json) {
        return $this->request('PUT', $url, [
            'json' => $json,
            'http_errors' => false,
        ]);
    }

    public function request($type, $url, $extra = []) {
        if ($this->auth !== null)
            $extra['auth'] = $this->auth;
        if ($this->headers !== null)
            $extra['headers'] = $this->headers;

        return $this->client->request($type, $url, $extra);
    }

    public function setAuth(string $user, string $password) {
        $this->auth = [ $user, $password ];
    }

    public function setHeaders(array $headers) {
        $this->headers = $headers;
    }
}