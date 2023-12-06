<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rastreado</title>
</head>
<body>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            text-align: center;
        }
    </style>
<?php
// Substitua {query} pelo endereço IP que você deseja pesquisar
// Use uma API de terceiros para obter o endereço IP
$api_url_ipify = 'https://api64.ipify.org?format=json';

// Inicia uma solicitação HTTP usando cURL
$ch_ipify = curl_init($api_url_ipify);

// Configura as opções do cURL
curl_setopt($ch_ipify, CURLOPT_RETURNTRANSFER, true);

// Executa a solicitação e obtém a resposta
$response_ipify = curl_exec($ch_ipify);

// Verifica se houve erros durante a solicitação
if (curl_errno($ch_ipify)) {
    echo 'Erro ao obter o endereço IP: ' . curl_error($ch_ipify);
} else {
    // Decodifica a resposta JSON
    $data_ipify = json_decode($response_ipify, true);

    // Exibe o endereço IP
    echo '<strong>IP: </strong>' . $data_ipify['ip'] . "<br>";

    $ip = $data_ipify['ip'];

    // Fecha a sessão cURL
    curl_close($ch_ipify);

    // Agora, faça a solicitação para a segunda API usando o IP obtido
    $api_url_ipapi = "http://ip-api.com/json/{$ip}";

    // Faz a requisição HTTP para a API
    $response_ipapi = file_get_contents($api_url_ipapi);

    // Converte a resposta JSON para um array associativo
    $ip_data = json_decode($response_ipapi, true);

    // Verifica se a requisição foi bem-sucedida
    if ($ip_data['status'] == 'success') {
        // Exibe os dados de localização
        echo "<strong>country: </strong>" . $ip_data['country'] . "<br>";
        echo "<strong>countryCode: </strong>" . $ip_data['countryCode'] . "<br>";
        echo "<strong>region: </strong>" . $ip_data['region'] . "<br>";
        echo "<strong>regionName: </strong>" . $ip_data['regionName'] . "<br>";
        echo "<strong>city: </strong>" . $ip_data['city'] . "<br>";
        echo "<strong>zipcode: </strong>" . $ip_data['zip'] . "<br>";
        echo "<strong>latitude: </strong>" . $ip_data['lat'] . "<br>";
        echo "<strong>longitude: </strong>" . $ip_data['lon'] . "<br>";
        echo "<strong>timezone: </strong>" . $ip_data['timezone'] . "<br>";
        echo "<strong>isp: </strong>" . $ip_data['isp'] . "<br>";
        echo "<strong>org: </strong>" . $ip_data['org'] . "<br>";
        echo "<strong>as: </strong>" . $ip_data['as'] . "<br>";
    } else {
        // Exibe uma mensagem de erro
        echo "Erro ao obter informações de localização.";
    }
}
?>
</body>
</html>
