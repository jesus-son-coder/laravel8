<?php

class Service
{
    //
}

Route::get('/', function (Service $service) {
    die(get_class($service));
});
