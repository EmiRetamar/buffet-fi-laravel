<?php

namespace App\Http\Controllers;

use App\Configuracion;
use App\Menu;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use DateInterval;

class BotTelegram_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function init($m = null)
    {
        define('BOT_TOKEN', '270810209:AAEe8VV5BleJoTvgLFgZA6TMjdb83JBHr2s');
        define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
        $config = Configuracion::all()->first();
        // Read incoming info and grab the chatID
        $content = file_get_contents("php://input");
        $update = json_decode($content, true);
        if(!empty($m))
            $message = $m;
        else
            $message = $update["message"]["text"];
        $chatID = $update["message"]["chat"]["id"];
        // Compose reply
        switch($message) {
            case '/start':
                $reply = 'Hola ' . $update['message']['from']['first_name'] . "\n" . '¿Como puedo ayudarte? Puedes utilizar el comando /help';
                break;
            case '/hoy':
                $menu = self::menuHoy();
                $reply = self::respuesta($menu, $config['titulo']);
                break;
            case '/mañana':
                $menu = self::menuManiana();
                $reply = self::respuesta($menu, $config['titulo']);
                break;
            case '/help':
                $reply = "Indique /hoy o /mañana para obtener el menú.\n Además puede suscribirse al menu diario con /suscribirse .\n En caso de darse de baja use /desuscribirse . \n /help para mostrar el mismo mensaje. \n" . $config['titulo'];
                break;
            case '/suscribirse':
                $res = self::suscribe($update);
                $reply = 'Hola ' . $update['message']['from']['first_name'] . "\n" . $res;
                break;
            case '/desuscribirse':
                $res = self::delSuscribe($update);
                $reply = 'Hola ' . $update['message']['from']['first_name'] . "\n" . $res;
                break;
            case '/enviarMenu':
                $msg = self::enviarMenu();
                $reply = 'Hola ' . $update['message']['from']['first_name'] . "\n" . $msg;
                break;
            default:
                $reply = 'Hola ' . $update['message']['from']['first_name'] . "\n" . "Disulpe no entiendo el mensaje: \n         ".$message." \nPruebe con /help . \n " . $config['titulo'];
                break;
        }
        // Send reply
        $sendto = API_URL."sendmessage?chat_id=".$chatID."&text=". urlencode($reply);
        file_get_contents($sendto);
        return ($sendto);
    }

    public function menuHoy()
    {
        $hoy = (new DateTime())->format('Y-m-d');
        $menus = Menu::obtenerMenu($hoy); // Recibe false si no hay menu
        if($menus != false) {
            return ($menus);
        }
        else {
            return (false);
        }
    }

    public function menuManiana()
    {
        $hoy = (new DateTime());
        $hoy->add(new DateInterval('P1D'));
        $tomorrow = date_format($hoy, 'Y-m-d');
        $menus = Menu::obtenerMenu($tomorrow); // Recibe false si no hay menu
        if($menus != false) {
            return ($menus);
        }
        else {
            return (false);
        }
    }

    public function respuesta($value, $titulo)
    {
        if($value != false) {
            $texto = "El menú del dia es:\n";
            foreach($value as $key => $value) {
                $texto .= $value['nombre'] . "\n";
            }
            return ($texto .= "\n" . $titulo);
        }
        return ($texto = "Aún no hay menú\nVuelva a intentarlo más tarde.\n" . $titulo);
    }

    public function enviarMenu()
    {
        define('BOT_TOKEN', '270810209:AAEe8VV5BleJoTvgLFgZA6TMjdb83JBHr2s');
        define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
        $config = Configuracion::all()->first();
        $suscriptos = Suscripcion::all();
        if(!empty($suscriptos)) {
            $menu = self::menuHoy();
            $reply = self::respuesta($menu, $config['titulo']);
            if($menu != false) {
                foreach($suscriptos as $key => $value) {
                    $sendto = API_URL."sendmessage?chat_id=".$value->chat_id."&text=". urlencode($reply);
                    file_get_contents($sendto);
                }
                return ("Menú enviado con exito");
            }
            else
                return ("No hay menu para enviar");
        }
        else
            return ("No se pudo enviar, no hay suscritos");
    }

    public function suscribe($value)
    {
        $valor = Suscripcion::crearSuscripcion($value);
        if($valor)
            return ("Suscripto exitosamente!");
        else
            return ("Usted ya se encuentra inscripto");
    }

    public function delSuscribe($value)
    {
        $valor = Suscripcion::eliminarSuscripcion($value);
        if($valor > 0)
            return ("Desuscripto exitosamente!");
        else
            return ("Usted no está inscripto");
    }

    public function verificacion()
    {
        $content = file_get_contents("php://input");
        $update = json_decode($content, true);
        if(!$update) {
            // Receive wrong update, must not happen
            return (false);
        }
        return (true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
