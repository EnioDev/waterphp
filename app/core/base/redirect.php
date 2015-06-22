<?php namespace core\base;

final class Redirect
{
    public static function to($view, $data = [])
    {
        $url = BASE_URL . $view;

        // Gets info about user's SO and Browser.
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        $ch = curl_init();

        if (isset($_COOKIE['PHPSESSID']))
        {
            // Stores de session's info.
            $strCookie = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/'; //session_save_path();

            // Close the session with user data.
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

        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        curl_close($ch);
    }
}