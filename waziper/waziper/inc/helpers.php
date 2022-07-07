<?php
if(!function_exists('waziper_e')){
    function waziper_e($text = '', $strip_tags = true){
        if($strip_tags){
            echo strip_tags($text);
        }else{
            echo $text;
        }
    }
}

if(!function_exists('waziper_datetime_show')){
    function waziper_datetime_show($data){
        if($data != ""){
            if(!is_numeric($data)){
                $data = strtotime($data);
            }

            return date( 'd/m/Y g:i A' , $data);
        }else{
            return false;
        }
    }
}

if (!function_exists('waziper_get_data')) {
    function waziper_get_data($data, $field, $type = '', $value = '', $class = 'active'){
        if( is_array($data) ){
            if(!empty($data) && isset($data[$field]) ){
                switch ($type) {
                    case 'checkbox':
                        if($data[$field] == $value){
                            return 'checked';
                        }
                        break;

                    case 'radio':
                        if($data[$field] == $value){
                            return 'checked';
                        }
                        break;

                    case 'select':
                        if($data[$field] == $value){
                            return 'selected';
                        }
                        break;

                    case 'class':
                        if($data[$field] == $value){
                            return $class;
                        }
                        break;

                    default:
                        return $data[$field];
                        break;
                }
            }
        }else{
            if(!empty($data) && isset($data->$field) ){
                switch ($type) {
                    case 'checkbox':
                        if($data->$field == $value){
                            return 'checked';
                        }
                        break;

                    case 'radio':
                        if($data->$field == $value){
                            return 'checked';
                        }
                        break;

                    case 'select':
                        if($data->$field == $value){
                            return 'selected';
                        }
                        break;

                    case 'class':
                        if($data->$field == $value){
                            return $class;
                        }
                        break;

                    default:
                        return $data->$field;
                        break;
                }
            }
        }

        return false;
    };
}

if(!function_exists("waziper_get_avatar")){
    function waziper_get_avatar($text){
        return "https://ui-avatars.com/api/?name=".urldecode($text)."&background=25d366&color=fff&font-size=0.5&rounded=true";
    }

}

if (!function_exists('waziper_time_elapsed_string')) {
    function waziper_time_elapsed_string($datetime, $full = false) {
        if(!is_numeric($datetime)){
            $datetime = strtotime($datetime);
        }
        
        $datetime =  date( 'Y-m-d g:i A' , $datetime);

        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => __('%s year%s ago'),
            'm' => __('%s month%s  ago'),
            'w' => __('%s week%s  ago'),
            'd' => __('%s day%s  ago'),
            'h' => __('%s hour%s  ago'),
            'i' => __('%s minute%s  ago'),
            's' => __('%s second%s  ago'),
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = sprintf( $v , $diff->$k, ($diff->$k > 1 ? 's' : '') );
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) : __('Just now');
    }
}

if(!function_exists('waziper_output')){
    function waziper_output($view_path, $data =  false){
    	ob_start();
    	
    	if( !empty( $data) ){
    		foreach( $data as $key => $var ){
    			$$key = $var;
    		}
    	}

    	include($view_path);
    	$buffer = ob_get_contents();
    	@ob_end_clean();
    	return $buffer;
    }
}

if(!function_exists('waziper_get_phone')){
	function waziper_get_phone( $jid = "" )
	{
		return $jid = "+".explode("@", $jid)[0];
	}
}

if(!function_exists("waziper_get")){
    function waziper_get($name){
        if (!isset( $_GET[ $name ] )) {
            return "";
        }

        return $_GET[ $name ];
    }
}

if(!function_exists("waziper_post")){
    function waziper_post($name){
        if (!isset( $_POST[ $name ] )) {
            return "";
        }

        return $_POST[ $name ];
    }
}

if(!function_exists("waziper_create_folder")){
    function waziper_create_folder($path){
        if (!file_exists($path)) {
            $uold     = umask(0);
            mkdir($path, 0777);
            umask($uold);

            file_put_contents($path."index.html", "<h1>404 Not Found</h1>");
        }
    }
}

if( !function_exists('waziper_save_img') ){
    function waziper_save_img($img, $path, $url){
        waziper_create_folder($path);

        $stream_opts = [
            "ssl" => [
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]; 

        $headers = get_headers(urldecode($img), 1, stream_context_create($stream_opts));
        $img_types = ['image/jpeg', 'image/png', 'image/gif'];

        if( is_array($headers['Content-Type']) ){
            $file_type = "png";
            $filename = uniqid().".".$file_type;
            $path = $path.$filename;
            $data = file_get_contents($img, false, stream_context_create($stream_opts));
            file_put_contents($path, $data);
            return $url.$filename;
        }else{
            $file_type = waziper_mime2ext( $headers['Content-Type'] );
            $filename = uniqid().".".$file_type;
            $path = $path.$filename;
            if(in_array( $headers['Content-Type'] , $img_types, true)){
                $data = file_get_contents($img, false, stream_context_create($stream_opts));
                file_put_contents($path, $data);
                return $url.$filename;
            }
        }

        return "";
    }
}

if( !function_exists('waziper_mime2ext') ){
    function waziper_mime2ext($mime) {
        $mime_map = [
            'video/3gpp2' => '3g2',
            'video/3gp' => '3gp',
            'video/3gpp' => '3gp',
            'application/x-compressed' => '7zip',
            'audio/x-acc' => 'aac',
            'audio/ac3' => 'ac3',
            'application/postscript' => 'ai',
            'audio/x-aiff' => 'aif',
            'audio/aiff' => 'aif',
            'audio/x-au' => 'au',
            'video/x-msvideo' => 'avi',
            'video/msvideo' => 'avi',
            'video/avi' => 'avi',
            'application/x-troff-msvideo' => 'avi',
            'application/macbinary' => 'bin',
            'application/mac-binary' => 'bin',
            'application/x-binary' => 'bin',
            'application/x-macbinary' => 'bin',
            'image/bmp' => 'bmp',
            'image/x-bmp' => 'bmp',
            'image/x-bitmap' => 'bmp',
            'image/x-xbitmap' => 'bmp',
            'image/x-win-bitmap' => 'bmp',
            'image/x-windows-bmp' => 'bmp',
            'image/ms-bmp' => 'bmp',
            'image/x-ms-bmp' => 'bmp',
            'application/bmp' => 'bmp',
            'application/x-bmp' => 'bmp',
            'application/x-win-bitmap' => 'bmp',
            'application/cdr' => 'cdr',
            'application/coreldraw' => 'cdr',
            'application/x-cdr' => 'cdr',
            'application/x-coreldraw' => 'cdr',
            'image/cdr' => 'cdr',
            'image/x-cdr' => 'cdr',
            'zz-application/zz-winassoc-cdr' => 'cdr',
            'application/mac-compactpro' => 'cpt',
            'application/pkix-crl' => 'crl',
            'application/pkcs-crl' => 'crl',
            'application/x-x509-ca-cert' => 'crt',
            'application/pkix-cert' => 'crt',
            'text/css' => 'css',
            'text/x-comma-separated-values' => 'csv',
            'text/comma-separated-values' => 'csv',
            'application/vnd.msexcel' => 'csv',
            'application/x-director' => 'dcr',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/x-dvi' => 'dvi',
            'message/rfc822' => 'eml',
            'application/x-msdownload' => 'exe',
            'video/x-f4v' => 'f4v',
            'audio/x-flac' => 'flac',
            'video/x-flv' => 'flv',
            'image/gif' => 'gif',
            'application/gpg-keys' => 'gpg',
            'application/x-gtar' => 'gtar',
            'application/x-gzip' => 'gzip',
            'application/mac-binhex40' => 'hqx',
            'application/mac-binhex' => 'hqx',
            'application/x-binhex40' => 'hqx',
            'application/x-mac-binhex40' => 'hqx',
            'text/html' => 'html',
            'image/x-icon' => 'ico',
            'image/x-ico' => 'ico',
            'image/vnd.microsoft.icon' => 'ico',
            'text/calendar' => 'ics',
            'application/java-archive' => 'jar',
            'application/x-java-application' => 'jar',
            'application/x-jar' => 'jar',
            'image/jp2' => 'jp2',
            'video/mj2' => 'jp2',
            'image/jpx' => 'jp2',
            'image/jpm' => 'jp2',
            'image/jpeg' => 'jpg',
            'image/pjpeg' => 'jpeg',
            'application/x-javascript' => 'js',
            'application/json' => 'json',
            'text/json' => 'json',
            'application/vnd.google-earth.kml+xml' => 'kml',
            'application/vnd.google-earth.kmz' => 'kmz',
            'text/x-log' => 'log',
            'audio/x-m4a' => 'm4a',
            'application/vnd.mpegurl' => 'm4u',
            'audio/midi' => 'mid',
            'application/vnd.mif' => 'mif',
            'video/quicktime' => 'mov',
            'video/x-sgi-movie' => 'movie',
            'audio/mpeg' => 'mp3',
            'audio/mpg' => 'mp3',
            'audio/mpeg3' => 'mp3',
            'audio/mp3' => 'mp3',
            'video/mp4' => 'mp4',
            'video/mpeg' => 'mpeg',
            'application/oda' => 'oda',
            'audio/ogg' => 'ogg',
            'video/ogg' => 'ogg',
            'application/ogg' => 'ogg',
            'application/x-pkcs10' => 'p10',
            'application/pkcs10' => 'p10',
            'application/x-pkcs12' => 'p12',
            'application/x-pkcs7-signature' => 'p7a',
            'application/pkcs7-mime' => 'p7c',
            'application/x-pkcs7-mime' => 'p7c',
            'application/x-pkcs7-certreqresp' => 'p7r',
            'application/pkcs7-signature' => 'p7s',
            'application/pdf' => 'pdf',
            'application/octet-stream' => 'pdf',
            'application/x-x509-user-cert' => 'pem',
            'application/x-pem-file' => 'pem',
            'application/pgp' => 'pgp',
            'application/x-httpd-php' => 'php',
            'application/php' => 'php',
            'application/x-php' => 'php',
            'text/php' => 'php',
            'text/x-php' => 'php',
            'application/x-httpd-php-source' => 'php',
            'image/png' => 'png',
            'image/x-png' => 'png',
            'application/powerpoint' => 'ppt',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/vnd.ms-office' => 'ppt',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            'application/x-photoshop' => 'psd',
            'image/vnd.adobe.photoshop' => 'psd',
            'audio/x-realaudio' => 'ra',
            'audio/x-pn-realaudio' => 'ram',
            'application/x-rar' => 'rar',
            'application/rar' => 'rar',
            'application/x-rar-compressed' => 'rar',
            'audio/x-pn-realaudio-plugin' => 'rpm',
            'application/x-pkcs7' => 'rsa',
            'text/rtf' => 'rtf',
            'text/richtext' => 'rtx',
            'video/vnd.rn-realvideo' => 'rv',
            'application/x-stuffit' => 'sit',
            'application/smil' => 'smil',
            'text/srt' => 'srt',
            'image/svg+xml' => 'svg',
            'application/x-shockwave-flash' => 'swf',
            'application/x-tar' => 'tar',
            'application/x-gzip-compressed' => 'tgz',
            'image/tiff' => 'tiff',
            'text/plain' => 'txt',
            'text/x-vcard' => 'vcf',
            'application/videolan' => 'vlc',
            'text/vtt' => 'vtt',
            'audio/x-wav' => 'wav',
            'audio/wave' => 'wav',
            'audio/wav' => 'wav',
            'application/wbxml' => 'wbxml',
            'video/webm' => 'webm',
            'audio/x-ms-wma' => 'wma',
            'application/wmlc' => 'wmlc',
            'video/x-ms-wmv' => 'wmv',
            'video/x-ms-asf' => 'wmv',
            'application/xhtml+xml' => 'xhtml',
            'application/excel' => 'xl',
            'application/msexcel' => 'xls',
            'application/x-msexcel' => 'xls',
            'application/x-ms-excel' => 'xls',
            'application/x-excel' => 'xls',
            'application/x-dos_ms_excel' => 'xls',
            'application/xls' => 'xls',
            'application/x-xls' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.ms-excel' => 'xlsx',
            'application/xml' => 'xml',
            'text/xml' => 'xml',
            'text/xsl' => 'xsl',
            'application/xspf+xml' => 'xspf',
            'application/x-compress' => 'z',
            'application/x-zip' => 'zip',
            'application/zip' => 'zip',
            'application/x-zip-compressed' => 'zip',
            'application/s-compressed' => 'zip',
            'multipart/x-zip' => 'zip',
            'text/x-scriptzsh' => 'zsh'
        ];

        return isset($mime_map[$mime]) === true ? $mime_map[$mime] : false;
    }
}

if(!function_exists("waziper_get_curl")){
    function waziper_get_curl($url){
        $user_agent='Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3B48b Safari/419.3';

        $headers = array
        (
            'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language: en-US,fr;q=0.8;q=0.6,en;q=0.4,ar;q=0.2',
            'Accept-Encoding: gzip,deflate',
            'Accept-Charset: utf-8;q=0.7,*;q=0.7',
            'cookie:datr=; locale=en_US; sb=; pl=n; lu=gA; c_user=; xs=; act=; presence='
        ); 

        $ch = curl_init( $url );

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , "GET");
        curl_setopt($ch, CURLOPT_POST, false);     
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec( $ch );
       
        curl_close( $ch );

        return $result;
    }
}


if(!function_exists('waziper_post_curl')){
	function waziper_post_curl($url, $data=array() )
	{
	    //open connection
	    $ch = curl_init();

	    //set the url, number of POST vars, POST data
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch,CURLOPT_URL, $url);
	    curl_setopt($ch,CURLOPT_POST, count($data));
	    curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

	    //execute post
	    $result = curl_exec($ch);

	    //close connection
	    curl_close($ch);

	    return $result;
	}
}

if(!function_exists('waziper_keyword_trim')){
	function waziper_keyword_trim( $data = "" )
	{
		if($data == "") return $data;

		$data = explode(",", $data);

		$tmp = [];
		foreach ($data as $value) {
			$tmp[] = trim($value);
		}

		return implode(",", $tmp);
	}
}

if(!function_exists('waziper_utf8ize')){
	function waziper_utf8ize($d) {
	    if (is_array($d)) {
	        foreach ($d as $k => $v) {
	            $d[$k] = waziper_utf8ize($v);
	        }
	    } else if (is_string ($d)) {
	        return mb_convert_encoding($d, "UTF-8");
	    }
	    return $d;
	}
}

if(!function_exists('waziper_ms')){
    function waziper_ms($array){
        print_r(json_encode( waziper_utf8ize($array) ));
        exit(0);
    }
}

if(!function_exists('waziper_base64')){
	function waziper_base64( $path = "" )
	{
		$path = explode("/assets/", $path);
		$path = FCPATH."/assets/".$path[1];
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		if($type != "mp4"){
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		}else{
			$base64 = 'data:video/' . $type . ';base64,' . base64_encode($data);
		}
		return $base64;
	}
}

if(!function_exists('array2csv')){
	function array2csv(array &$array)
	{
	   if (count($array) == 0) {
	     return null;
	   }
	   ob_start();
	   $df = fopen("php://output", 'w');
	   fputcsv($df, array_keys(reset($array)));
	   foreach ($array as $row) {
	      fputcsv($df, $row);
	   }
	   fclose($df);
	   return ob_get_clean();
	}
}

if(!function_exists('waziper_download_send_headers')){
	function waziper_download_send_headers($filename) {
	    // disable caching
	    $now = gmdate("D, d M Y H:i:s");
	    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
	    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
	    header("Last-Modified: {$now} GMT");

	    // force download  
	    header("Content-Type: application/force-download");
	    header("Content-Type: application/octet-stream");
	    header("Content-Type: application/download");

	    // disposition / encoding on response body
	    header("Content-Disposition: attachment;filename={$filename}");
	    header("Content-Transfer-Encoding: binary");
	}
}