<?php

class ApiModel {

    private $baseUrl = "http://localhost:3000";

    private function request($endpoint, $method = "GET", $data = nill, $token = null) {

        $ch = curl_init($this->baseUrl . $endpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        $headers = ['Content-Type: application/json'];

        if ($token) {
            $headers[] = "Authorization: Bearer $token";
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function login($email, $senha) {
        return $this->request("/login", "POST", [
            "email" => $email,
            "senha" => $senha
        ]);
    }

    public function cadastrar($nome, $email, $senha) {
        return $this->request("/usuarios", "POST", [
            "nome" => $nome,
            "email" => $email,
            "senha" => $senha
        ]);
    }

    public function listarMaes($token) {
        return $this->request("/maes", "GET", null, $token);
    }
}