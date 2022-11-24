<?
#################################################
#   Company developer: ALTASIB                  #
#   Developer: Toporikov Sergey                 #
#   Site: http://www.altasib.ru                 #
#   E-mail: scorpx@altasib.ru                   #
#   Copyright (c) 2006-2011 ALTASIB             #
#################################################
IncludeModuleLangFile(__FILE__);
class CAltasibDiscountReauth
{
        Function Add($USER_ID)
        {
                if(!$USER_ID) return;
                if(CAltasibDiscountReauth::Get($USER_ID)) return;

                $table_name = 'altasib_discounts_reauth';
                $arFields = array("USER_ID" => intval($USER_ID));
                global $DB;
                $res = $DB->Add($table_name, $arFields);
                return $res;
        }
        Function Delete($USER_ID)
        {
                if(!$USER_ID) return;

                $table_name = 'altasib_discounts_reauth';
                $strSql = "DELETE FROM ".$table_name." WHERE USER_ID = ".intval($USER_ID);
                global $DB;
                $DB->Query($strSql);
                return true;
        }
        Function Get($USER_ID)
        {
                if(!$USER_ID) return;

                $table_name = 'altasib_discounts_reauth';
                $strSql = "SELECT 1 FROM ".$table_name." WHERE USER_ID = ".intval($USER_ID);
                global $DB;
                $res = $DB->Query($strSql)->Fetch();
                //var_dump($res);
                return $res;
        }
}
?>
