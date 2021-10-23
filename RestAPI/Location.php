<?php
require CONTROL."Province.php";
require CONTROL."District.php";
require CONTROL."Ward.php";
class Location extends Page{
    public function GetProvinces() {
        $ctlProvince = new \Lib\Province($this->api);
        return json_encode($ctlProvince->getGetList());
    }
    public function GetDistricts() {
        $provinceid = $this->request->get('provinceid');
        $ctlDistrict = new \Lib\District($this->api);
        return json_encode($ctlDistrict->getGetList('&core_district_provinceid=equal_'.$provinceid));
    }
    public function GetWards() {
        $districtid = $this->request->get('districtid');
        $ctlWard = new \Lib\Ward($this->api);
        return json_encode($ctlWard->getGetList('&core_ward_districtid=equal_'.$districtid));
    }
    public function GetWard() {
        $wardid = $this->request->get('wardid');
        $ctlWard = new \Lib\Ward($this->api);
        return json_encode($ctlWard->getItem($wardid));
    }
}