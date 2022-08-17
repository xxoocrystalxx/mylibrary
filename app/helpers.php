<?php

if (!function_exists('img_setup')) {
  function img_setup($image, $width, $height, $path)
  {
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    Image::make($image)->resize($width, $height)->save($path . $name_gen);
    $save_url = $path . $name_gen;
    return $save_url;
  }
}
