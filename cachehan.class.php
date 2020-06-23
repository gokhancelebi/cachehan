<?php


class Cachehan
{

    public $cache_dir, $address, $exceptioons;

    function __construct($cache_dir, $address, $exceptioons)
    {
        $this->cache_dir = $cache_dir;
        $this->address = $address;
        $this->exceptioons = $exceptioons;
    }

    function cacheStart($hour = 24)
    {
        if (!file_exists($this->cache_dir)) {
            mkdir(CACHE_DIR, 0777, true);
        }

        if ($_SERVER["REQUEST_URI"] == "/")
            $address = "index";
        else
            $address = ($_SERVER["REQUEST_URI"]);

        $address = md5($address);

        $cache_address = CACHE_DIR . "/" . $address . ".txt";

        if (!file_exists($cache_address) || time() > (filemtime($cache_address) + ($hour * 60 * 60))) {
            ob_start("ob_html_compress");
        } else {
            include $cache_address;
            echo "<!-- CACHEHAN SUNAR $address -->";
            exit;
        }
    }

    function ob_html_compress($buf)
    {

        if ($_SERVER["REQUEST_URI"] == "/")
            $address = "index";
        else
            $address = ($_SERVER["REQUEST_URI"]);

        $address = md5($address);

        $cache_address = CACHE_DIR . "/" . $address . ".txt";

        if (!strstr($buf, "'pageCategory':"))
            return $buf;


        file_put_contents($cache_address, $buf);

        return $buf;
    }

    function cacheEnd()
    {
        ob_end_flush();
    }
}

?>
