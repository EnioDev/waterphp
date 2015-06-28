<?php namespace core\base;

// TODO: A classe não está em uso. Testar o uso da classe para exibir os erros.
final class Redirect
{
    public static function to($view, $data = [])
    {
        $url = BASE_URL;

        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        $ch = curl_init();

        if (isset($_COOKIE['PHPSESSID']))
        {
            $strCookie = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=' . session_save_path();

            session_write_close();

            curl_setopt($ch, CURLOPT_COOKIE, $strCookie );
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

        if (count($data) > 0)
        {
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_exec($ch);

        // echo curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        curl_close($ch);
    }
}