<?php
namespace App\Generic;

use FontLib\EOT\File;
use Illuminate\Support\Facades\Storage;

class Load{
    public function read($path){

        $data = Storage::disk()->get($path);

        Storage::delete($path);

       return (array)json_decode($data);
    }
    public function loadDegrees(){

     return array(
            //cas
            16=>12,17=>80,18=>11,19=>9,21=>8,23=>7,
            //chs
            36=>28,37=>30,38=>29,
            // cbea
            26=>13,27=>77,28=>75,29=>76,30=>78,31=>61,32=>15,33=>17,34=>14,35=>60,
            //coe
            64=>24,65=>23,66=>20,67=>25,68=>21,69=>26,70=>22,
            //casat
            24=>27,25=>6,
            //cte
           71=>166, 72=>105,73=>104,74=>103,75=>121,76=>123,77=>124,78=>70,79=>18,80=>66,81=>71,
            82=>67,83=>72,84=>68,85=>70,77=>167,86=>124,87=>69,88=>119,89=>47,90=>47,
            //cit
            39=>64,40=>159,41=>160,42=>161,43=>162,44=>163,45=>164,46=>168,47=>115,48=>87,49=>84,
            50=>117,51=>88,52=>89,53=>116,54=>86,55=>85,56=>106,57=>57,58=>55,59=>55,60=>55,61=>55,
            62=>55,63=>56,
            //cafsd
            3=>54,4=>48,6=>109,7=>108,8=>113,9=>110,10=>4,11=>3,12=>5,14=>49,15=>50,
            //SOMETHINGS
            22=>10,5=>2,13=>63,
            //GS
            91=>130,92=>127,93=>128,94=>139,95=>40,96=>44,97=>132,98=>133,99=>136,100=>137,101=>138,102=>140,103=>141,
            104=>142,105=>143,106=>144,107=>145,108=>146,109=>149,110=>151,111=>157,112=>152,
            113=>153,114=>154,115=>42,116=>37,117=>36,118=>38,119=>43,120=>43,122=>155,123=>156,124=>39,125=>158,121=>165   ,


        );
    }//end of load degrees
    public function loadColleges(){
        return array(
            1=>4,2=>6,3=>5,4=>2,5=>7,6=>9,7=>8,8=>1,9=>3,
        );
    }

}
