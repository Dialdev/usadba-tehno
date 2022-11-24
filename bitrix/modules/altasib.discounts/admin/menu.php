<?
#################################################
#   Company developer: ALTASIB                  #
#   Developer: Toporikov Sergey                 #
#   Site: http://www.altasib.ru                 #
#   E-mail: scorpx@altasib.ru                   #
#   Copyright (c) 2006-2011 ALTASIB             #
#################################################

IncludeModuleLangFile(__FILE__);

$GROUP_RIGHT = $APPLICATION->GetGroupRight("altasib.discounts");

if($GROUP_RIGHT>"D")
{
        $aMenu = array(
                "parent_menu" => "global_menu_store",
                "section" => "altasib_discounts",
                "sort" => 1000,
                "text" => GetMessage("ALTASIB_DISCOUNTS_ADMIN_MENU_SECT"),
                "title" => GetMessage("ALTASIB_DISCOUNTS_ADMIN_MENU_SECT_TITLE"),
                "url" => "altasib_discounts_list.php?lang=".LANGUAGE_ID,
                "icon" => "altasib_discounts_menu_icon",
                "page_icon" => "altasib_discounts_page_icon",
                "items_id" => "menu_altasib_discounts",
                "items" => array()
        );
        return $aMenu;
}
return false;
?>
