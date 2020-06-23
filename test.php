<?php

/*
 * it is simple example for how to use this class
 */

include "src/cachehan.class.php";

$testCache = new Cachehan("cache",$_SERVER["REQUEST_URI"],1);

$testCache->cacheStart();


//content that you wanted to cache

$testCache->cacheEnd();