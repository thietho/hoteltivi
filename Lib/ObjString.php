<?php
namespace Lib;
final class ObjString
{
    public $imgext = array('jpg','png','gif','jpeg');
    public function getTextLength($str, $from, $len)
    {
        $str = strip_tags($str);
        $words = explode(' ', $str);
        $result = implode(' ', array_slice($words, $from, $len));
        if(count($words) > $len) {
            $result .= "...";
        }
        return $result;
    }
    public function formateJson($strjson){
        $strjson = str_replace('\\"','"',$strjson);
        $strjson = str_replace('"[','[',$strjson);
        $strjson = str_replace(']"',']',$strjson);
        return $strjson;
    }
    public function numberFormate($num,$n=0)
    {
        $dec_point = '.';
        $thousands_sep = ',';
        return number_format($num, $n, $dec_point, $thousands_sep);
    }
    public function arrayToString($arr){
        if(empty($arr)){
            return '';
        }
        foreach ($arr as &$val)
        {
            $val = "[$val]";
        }
        return implode(',',$arr);
    }
    public function stringToArray($str){
        $str = str_replace('[','',$str);
        $str = str_replace(']','',$str);
        return explode(',',$str);
    }
    public function toNumber($str)
    {
        if($str == ''){
            return 0;
        }
        return str_replace(",", "", $str);
    }

    public function numberToString($num, $leng)
    {
        $str = "" . $num;
        $arr = array();
        for ($i = strlen($str) - 1; $i >= 0; $i--) {
            array_push($arr, $str[$i]);
        }

        while (count($arr) < $leng) {
            array_push($arr, 0);
        }
        $s = "";
        while (count($arr)) {
            $s .= array_pop($arr);
        }
        return $s;
    }
    public function toUrlPara($data)
    {
        $str = '';
        foreach($data as $key => $val)
        {
            $str.="&$key=$val";
        }
        return $str;
    }
    public function matrixToArray($data,$col)
    {
        $arr = array();
        if(count($data))
            foreach($data as $item)
                $arr[]=$item[$col];
        return $arr;
    }

    public function array_Filter($data,$col,$value)
    {
        $arr = array();
        if(!empty($data)){
            foreach($data as $item)
            {
                if($item[$col] == $value)
                    $arr[]=$item;
            }
        }
        return $arr;
    }

    function generateRandStr($length)
    {
        $randstr = "";
        for ($i = 0; $i < $length; $i++) {
            $randnum = mt_rand(0, 61);
            if ($randnum < 10) {
                $randstr .= chr($randnum + 48);
            } else {
                if ($randnum < 36) {
                    $randstr .= chr($randnum + 55);
                } else {
                    $randstr .= chr($randnum + 61);
                }
            }
        }
        return $randstr;
    }
    public function encryptionPassword($password){
        return hash('sha512',md5($password));
    }
    function setLoopStr($str,$numlop)
    {
        $strresult = "";
        for($i=0;$i<$numlop;$i++)
        {
            $strresult .= $str;
        }
        return $strresult;
    }
    public function printDataTable($data)
    {
        $header = "<tr>";
        foreach ($data[0] as $key => $val)
            $header .= "<th>$key</th>";
        $header.="</tr>";
        $body = "";
        foreach ($data as $item)
        {
            $body .= "<tr>";
            foreach ($item as $val)
            {
                if(!is_array($val))
                    $body .= "<td>$val</td>";
                else
                {
                    $body .= "<td>".print_r($val,true)."</td>";
                }
            }

            $body .= "</tr>";
        }
        $table = "<table>$header$body</table>";
        return $table;
    }
    public function groupCol($data,$col)
    {
        $datacol = array();
        foreach ($data as $item)
        {
            $datacol[$item[$col]][] = $item;
        }
        return $datacol;
    }
    function convert_number_to_words($number) {
        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = '??m ';
        $decimal     = ' ph???y ';
        $dictionary  = array(
            0                   => 'kh??ng',
            1                   => 'm???t',
            2                   => 'hai',
            3                   => 'ba',
            4                   => 'b???n',
            5                   => 'n??m',
            6                   => 's??u',
            7                   => 'b???y',
            8                   => 't??m',
            9                   => 'ch??n',
            10                  => 'm?????i',
            11                  => 'm?????i m???t',
            12                  => 'm?????i hai',
            13                  => 'm?????i ba',
            14                  => 'm?????i b???n',
            15                  => 'm?????i n??m',
            16                  => 'm?????i s??u',
            17                  => 'm?????i b???y',
            18                  => 'm?????i t??m',
            19                  => 'm?????i ch??n',
            20                  => 'hai m????i',
            30                  => 'ba m????i',
            40                  => 'b???n m????i',
            50                  => 'n??m m????i',
            60                  => 's??u m????i',
            70                  => 'b???y m????i',
            80                  => 't??m m????i',
            90                  => 'ch??n m????i',
            100                 => 'tr??m',
            1000                => 'ngh??n',
            1000000             => 'tri???u',
            1000000000          => 't???',
            1000000000000       => 'ngh??n t???',
            1000000000000000    => 'ngh??n tri????u tri????u',
            1000000000000000000 => 't??? t???'
        );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }
        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        return $string;
    }
    public function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }
    function utf8convert($str) {
        if(!$str) return false;
        $utf8 = array(
            'a'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???|??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
            'd'=>'??|??',
            'e'=>'??|??|???|???|???|??|???|???|???|???|???|??|??|???|???|???|??|???|???|???|???|???',
            'i'=>'??|??|???|??|???|??|??|???|??|???',
            'o'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???|??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
            'u'=>'??|??|???|??|???|??|???|???|???|???|???|??|??|???|??|???|??|???|???|???|???|???',
            'y'=>'??|???|???|???|???|??|???|???|???|???',
        );

        foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);

        return $str;

    }
    public function viewPlanText($str){
        return str_replace("\n","<br>",$str);
    }
}
?>
