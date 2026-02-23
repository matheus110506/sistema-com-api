<?php

class ApiModel {

    private $baseUrl = "http://localhost:3000";

    private function request($endpoint, $method = "GET", $data = null, $token = null) {

        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = ['Content-Type: application/json'];

        if ($token) {
            $headers[] = "Authorization: Bearer $token";
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method === "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        if ($method === "PUT") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        if ($method === "DELETE") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function listarMaes($token) {
        return $this->request("/maes", "GET", null, $token);
    }

    public function criarMae($dados, $token) {
        return $this->request("/maes", "POST", $dados, $token);
    }

    public function atualizarMae($id, $dados, $token) {
        return $this->request("/maes/$id", "PUT", $dados, $token);
    }

    public function excluirMae($id, $token) {
        return $this->request("/maes/$id", "DELETE", null, $token);
    }
}
