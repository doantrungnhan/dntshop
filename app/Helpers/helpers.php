<?php
function Slug($string)
{
    // Chuyển đổi các ký tự tiếng Việt có dấu thành không dấu
    $vietnameseChars = array(
        'a'=>'á|à|ả|ạ|ã|â|ấ|ầ|ẩ|ậ|ẫ|ă|ắ|ằ|ẳ|ặ|ẵ',
        'e'=>'é|è|ẻ|ẹ|ẽ|ê|ế|ề|ể|ệ|ễ',
        'i'=>'í|ì|ỉ|ị|ĩ',
        'o'=>'ó|ò|ỏ|ọ|õ|ô|ố|ồ|ổ|ộ|ỗ|ơ|ớ|ờ|ở|ợ|ỡ',
        'u'=>'ú|ù|ủ|ụ|ũ|ư|ứ|ừ|ử|ự|ữ',
        'y'=>'ý|ỳ|ỷ|ỵ|ỹ',
        'd'=>'đ',
        'A'=>'Á|À|Ả|Ạ|Ã|Â|Ấ|Ầ|Ẩ|Ậ|Ẫ|Ă|Ắ|Ằ|Ẳ|Ặ|Ẵ',
        'E'=>'É|È|Ẻ|Ẹ|Ẽ|Ê|Ế|Ề|Ể|Ệ|Ễ',
        'I'=>'Í|Ì|Ỉ|Ị|Ĩ',
        'O'=>'Ó|Ò|Ỏ|Ọ|Õ|Ô|Ố|Ồ|Ổ|Ộ|Ỗ|Ơ|Ớ|Ờ|Ở|Ợ|Ỡ',
        'U'=>'Ú|Ù|Ủ|Ụ|Ũ|Ư|Ứ|Ừ|Ử|Ự|Ữ',
        'Y'=>'Ý|Ỳ|Ỷ|Ỵ|Ỹ',
        'D'=>'Đ'
    );
    foreach ($vietnameseChars as $nonAccent => $accented) {
        $string = preg_replace("/($accented)/i", $nonAccent, $string);
    }

    // Loại bỏ các ký tự không phải là chữ hoặc số và thay khoảng trắng bằng dấu gạch ngang
    $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string); 
    $string = preg_replace('/\s+/', '-', trim($string)); 

    // Chuyển chuỗi về dạng chữ thường
    return strtolower($string);
}
