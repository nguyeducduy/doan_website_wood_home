<?php defined('BASEPATH') OR exit('No direct script access allowed');

  function sendMail($to,$message)
  {
    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'youremail', // change it to yours
      'smtp_pass' => 'yourpass', // change it to yours
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n",
      'wordwrap' => TRUE
    );
    $ci = &get_instance();
    $ci->load->library('email', $config);
    $ci->email->set_newline("\r\n");
    $ci->email->from('youremail'); // change it to yours
    $ci->email->to($to);// change it to yours
    $ci->email->subject('Active Your Account !');
    $ci->email->message($message);
    if($ci->email->send())
    {
      return TRUE;
    }
    return FALSE;
  }

  /* ham xoa dau tieng viet*/
    function vn2latin($cs, $tolower = false){
        /*Mảng chứa tất cả ký tự có dấu trong Tiếng Việt*/
        $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
                "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
                "ế","ệ","ể","ễ",
                "ì","í","ị","ỉ","ĩ",
                "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
                "ờ","ớ","ợ","ở","ỡ",
                "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
                "ỳ","ý","ỵ","ỷ","ỹ",
                "đ",
                "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
                "Ằ","Ắ","Ặ","Ẳ","Ẵ",
                "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
                "Ì","Í","Ị","Ỉ","Ĩ",
                "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
                "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
                "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
                "Đ"," ",",",":",'"',",","'","&","%","*","@","!","#","$","^","(",")");
        /*Mảng chứa tất cả ký tự không dấu tương ứng với mảng $marTViet bên trên*/
        $marKoDau=array("a","a","a","a","a","a","a","a","a","a","a",
                "a","a","a","a","a","a",
                "e","e","e","e","e","e","e","e","e","e","e",
                "i","i","i","i","i",
                "o","o","o","o","o","o","o","o","o","o","o","o",
                "o","o","o","o","o",
                "u","u","u","u","u","u","u","u","u","u","u",
                "y","y","y","y","y",
                "d",
                "A","A","A","A","A","A","A","A","A","A","A","A",
                "A","A","A","A","A",
                "E","E","E","E","E","E","E","E","E","E","E",
                "I","I","I","I","I",
                "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
                "U","U","U","U","U","U","U","U","U","U","U",
                "Y","Y","Y","Y","Y",
                "D","-");
        if ($tolower) {
            return strtolower(str_replace($marTViet,$marKoDau,$cs));
        }
        return str_replace($marTViet,$marKoDau,$cs);
    }

 ?>