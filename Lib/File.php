<?php
namespace Lib;
class File
{
    public function getFileInfor($file){
        $file_info = array();
        $pathinfo = pathinfo($file);
        $stat = stat($file);
        $file_info['realpath'] = realpath($file);
        $file_info['dirname'] = $pathinfo['dirname'];
        $file_info['basename'] = $pathinfo['basename'];
        $file_info['filename'] = $pathinfo['filename'];
        $file_info['extension'] = $pathinfo['extension'];
        $file_info['mime'] = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file);
        $file_info['encoding'] = finfo_file(finfo_open(FILEINFO_MIME_ENCODING), $file);
        $file_info['size'] = $stat[7];
        $file_info['size_string'] = $this->format_bytes($stat[7]);
        $file_info['atime'] = $stat[8];
        $file_info['mtime'] = $stat[9];
        $file_info['permission'] = substr(sprintf('%o', fileperms($file)), -4);
        $file_info['fileowner'] = getenv('USERNAME');
        return $file_info;
    }
    private function format_bytes(int $size){
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base-floor($base)), 2).''.$suffixes[floor($base)];
    }
}