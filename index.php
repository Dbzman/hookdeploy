<?php

$currentDeployKey = $_GET['key'];
if (is_string($currentDeployKey) && strlen($currentDeployKey) > 0) {
    $config = json_decode(file_get_contents("config.json"));
    $apps = $config->apps;
    
    foreach ($apps as $app) {
        $name = $app->name;
        $workingDir = $app->workingDir;
        $deployKey = $app->deployKey;
        $deployScript = $app->deployScript;

        if ($deployKey == $currentDeployKey) {
            $commandReturn = 0;
            $output = system("cd $workingDir && ./$deployScript 2>&1", $commandReturn);
            if ($commandReturn === 0) {
                echo "[deployment of '$name' succeeded]";
            } else {
                echo "[deployment of '$name' failed]";
            }
        }
    }
}

