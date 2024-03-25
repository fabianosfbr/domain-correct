<p align="center">
	<h2 align="center">Domain Correct API</h2>
</p>
<h4 align="center"> 
	🚧  Projeto 🚀 em construção...  🚧
</h4>
<p align="center">
	<img src="https://img.shields.io/badge/version project-1.0-brightgreen" alt="version project">
    <img src="https://img.shields.io/badge/Php-8.3.3-informational" alt="stack php">
    <img src="https://img.shields.io/badge/Laravel-11.00-informational&color=brightgreen" alt="stack laravel">
	<a href="https://opensource.org/licenses/GPL-3.0">
		<img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="GPLv3 License">
	</a>
</p>

---
### :package: dependências do projeto
 - Docker + docker-compose
 - curl
 - Make 4.x

---
### :books: Configurando o projeto em um novo ambiente
Simplesmente execute o comando `make` no seu terminal:
```bash
make
```

Agora, basta acessar a URL `http://localhost`
## :information_source: Como Utilizar a API
A api verifica a estrutura do email verificando se as informações do email são válidas.

O envio do parâmetro email no corpo da requisição é obrigatório.
### :elephant: Enviando Requisição em PHP
  Enviando requisição via Guzzle
 ```
<?php

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'http://localhost:8001/v1/email/validate', [
  'body' => '{
  "email": "teste@example.com"
}',
  'headers' => [
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
  ],
]);

echo $response->getBody();
 ```
 Enviando a Requisição via Curl
 ```
<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_PORT => "80",
  CURLOPT_URL => "http://localhost/v1/email/validate",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'email' => 'teste@example.com'
  ]),
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
 ```
### Enviando Requisição em Node.js
Enviando requisição via Fetch
 ```
 const fetch = require('node-fetch');

const url = 'http://localhost/v1/email/validate';
const options = {
  method: 'POST',
  headers: {'Content-Type': 'application/json', Accept: 'application/json'},
  body: '{"email":"teste@example.com"}'
};

try {
  const response = await fetch(url, options);
  const data = await response.json();
  console.log(data);
} catch (error) {
  console.error(error);
}
 ```
 #### Para verificar como enviar a requisição em outras linguagens consulte a documentação no link abaixo.

### :inbox_tray: Exemplo de Retorno
```
{
	"data": [
    {
      "email": "user@example.com",
      "is_valid": true,
      "user": "user",
      "domain": "example.com",
      "sugestion": "validexample.com"
    }
  ]
}
```

### Documentação da API
  - Basta acessar a URL `http://localhost/docs/api`

---
### :recycle: Orientações
 - Caso tenha algum problema com a instalação, execute o comando `make rebuild`
 - Para fazer uma nova instalação execute o comando `make`
 - Inicializar os container do projeto execute o comando `make up`
 - Encerrar os container do projeto execute o comando `make down`
 - Maiores informações, vide o arquivo Makefile
 - Correr pro abraço!
