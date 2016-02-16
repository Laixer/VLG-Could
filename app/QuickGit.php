<?php

namespace App;

class QuickGit {

    public static function version_short() {
        exec('git describe --always', $version_mini_hash);

        return "v" . $version_mini_hash[0];
    }

    public static function version_full() {
        exec('git describe --always', $version_mini_hash);
        exec('git rev-list HEAD | wc -l', $version_number);
        exec('git log -1', $line);

        $version = "v1.".trim($version_number[0]).".$version_mini_hash[0] (".str_replace('commit ','',$line[0]).")";

        return $version;
    }

}
