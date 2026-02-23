<?php

class ApiModel {

    private $baseUrl = "http://localhost:3000";

    public function login($email, $senha) {

        $dados = [
            "email" => $email,
            "senha" => $senha
        ];

        $ch = curl_init($this->baseUrl . "/login");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
