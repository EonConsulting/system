<?php

namespace PhantomInstaller;

class PhantomBinary
{
    const BIN = 'C:\wamp64\www\system\bin\phantomjs.exe';
    const DIR = 'C:\wamp64\www\system\bin';

    public static function getBin() {
        return self::BIN;
    }

    public static function getDir() {
        return self::DIR;
    }
}
