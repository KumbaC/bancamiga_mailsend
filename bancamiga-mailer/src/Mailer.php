<?php

namespace Bancamiga\Mailer;
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use Exception;


class Mailer
{
    private $client;
    private $URL_reserva;

    public function __construct(string $URL_reserva)
    {
        $this->client = new Client();
        $this->URL_reserva = $URL_reserva;
    }

    public function sendMail(
        string $correoOrigen, 
        string $correoDestino,
        string $asunto,
        string $contenido,
        string $rutaPdf,
        array $datosExtra = []
    ) {
        try {
            if (!file_exists($rutaPdf)) {
                return [
                    'success' => false,
                    'message' => 'El archivo PDF no se generó correctamente.'
                ];
            }

            $datos = array_merge([
                [
                    'name'     => 'from_email',
                    'contents' => $correoOrigen,
                ],
                [
                    'name'     => 'to',
                    'contents' => $correoDestino,
                ],
                [
                    'name'     => 'subject',
                    'contents' => $asunto,
                ],
                [
                    'name'     => 'content',
                    'contents' => $contenido,
                ],
                [
                    'name'     => 'files',
                    'contents' => fopen($rutaPdf, 'r'),
                    'filename' => basename($rutaPdf),
                ],
            ], $datosExtra);

            $this->client->request('POST', $this->URL_reserva, [
                'headers' => [
                    'accept' => 'application/json',
                ],
                'multipart' => $datos,
                'verify' => false,
            ]);

            return [
                'success' => true,
                'message' => 'Correo enviado exitosamente.'
            ];
        } catch (Exception $excepcion) {
            return [
                'success' => false,
                'message' => 'Error al enviar el correo: ' . $excepcion->getMessage(),
            ];
        }
    }
}