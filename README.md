<p align="center"><a href="#" target="_blank"><img src="https://confirmado.com.ve/conf/conf-upload/uploads/2024/11/bancamiga-logo-C4D87941FB-seeklogo.com_.png" width="400" alt="Bancamiga Logo"></a></p>

# Bancamiga Mailer

Bancamiga Mailer es una librería PHP diseñada para integrarse fácilmente en proyectos Laravel. Su propósito principal es enviar correos electrónicos con o sin archivos adjuntos utilizando una API externa.

## Instalación

1. Agrega la librería a tu proyecto utilizando Composer:
   ```bash
   composer require bancamiga/mailer
   ```

2. Asegúrate de que las dependencias necesarias estén instaladas:
   - `guzzlehttp/guzzle`

3. Publica el archivo de configuración si es necesario (opcional).

## Uso

### Configuración

Inicializa la clase `Mailer` con la URL de la API:

```php
use Bancamiga\Mailer\Mailer;

$mailer = new Mailer('https://mails-api-des.redbancamiga.com.ve/attach');
```

### Enviar un correo

Utiliza el método `send` para enviar un correo electrónico. Este método requiere los siguientes parámetros:

- **toEmail**: Dirección de correo del destinatario.
- **subject**: Asunto del correo.
- **content**: Contenido del correo.
- **pdfPath**: Ruta del archivo PDF que se adjuntará.
- **fromEmail** (opcional): Dirección de correo del remitente (por defecto: `mailservice@bancamiga.com`).
- **extraData** (opcional): Datos adicionales para incluir en la solicitud.

#### Ejemplo:

```php
$result = $mailer->send(
'usuario@ejemplo.com',
    'Acta de entrega - Recepción de equipos',
    'Contenido del correo aquí...',
    public_path('ruta/del/archivo.pdf')
);

if ($result['success']) {
    echo $result['message'];
} else {
    echo 'Error: ' . $result['message'];
}
```

### Respuesta

El método `send` devuelve un array con la siguiente estructura:

- **success**: Indica si el correo fue enviado exitosamente (`true` o `false`).
- **message**: Mensaje descriptivo del resultado.

## Métodos

### `__construct(string $urlFallback)`

Constructor de la clase. Recibe la URL de la API como parámetro.

### `send(string $toEmail, string $subject, string $content, string $pdfPath, string $fromEmail = 'mailservice@bancamiga.com', array $extraData = [])`

Envía un correo electrónico con un archivo adjunto. Los parámetros están descritos en la sección anterior.

## Notas

- La librería utiliza la API externa proporcionada por Bancamiga para enviar correos.
- Asegúrate de que la ruta del archivo PDF sea válida y accesible (NO OBLIGATORIO ENVIAR UN DOCUMENTO).
- La librería utiliza `GuzzleHttp` para realizar las solicitudes HTTP.

## Licencia

Este proyecto está licenciado bajo la licencia MIT. Para más información, consulta el archivo LICENSE.
