<?php

if (!function_exists('delete_loaded_images')) {
    /**
     * Удаление картинок загруенных факером в прошлых итерациях
     *
     * @param string $path Путь до папки с картинками
     */
    function delete_loaded_images($path)
    {
        foreach (glob(storage_path($path) . '/*.*') as $image) {
            if (is_file($image)) {
                unlink($image);
            }
        }
    }
}