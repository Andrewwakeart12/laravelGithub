<?php
function rmDir_rf($directory){
    try {
        foreach (glob($directory . '/*') as $file_folder) {
            if(is_dir($file_folder)){
                rmDir_rf($file_folder);
            } else{
                unlink($file_folder);
            }

        }
    } catch (\Throwable $th) {
        print($th);
    }
    try {
        rmdir($directory);
    } catch (\Throwable $th) {
        print($th);
    }

}
?>
