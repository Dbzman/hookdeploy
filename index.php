<?php

$currentDeployKey = $_GET['key'];

if (is_string($currentDeployKey) && strlen($currentDeployKey) > 0) {
    $config = json_decode(file_get_contents("config.json"));

    foreach ($config as $configItem) {
        $app = $configItem[0];
        $name = $app->name;
        $workingDir = $app->workingDir;
        $deployKey = $app->deployKey;
        $deployScript = $app->deployScript;

        if ($deployKey == $currentDeployKey) {
            $commandReturn = 0;
            $output = system("cd $workingDir && $deployScript 2>&1", $commandReturn);
            if ($commandReturn === 0) {
                echo "[deployment succeeded]";
            } else {
                echo "[deployment failed]";
            }
        }
    }
}

