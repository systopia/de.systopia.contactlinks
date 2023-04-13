<?php
/*-------------------------------------------------------+
| SYSTOPIA ContactLinks Extension                        |
| Copyright (C) 2019 SYSTOPIA                            |
| Author: B. Endres (endres@systopia.de)                 |
| http://www.systopia.de/                                |
+--------------------------------------------------------+
| This program is released as free software under the    |
| Affero GPL license. You can redistribute it and/or     |
| modify it under the terms of this license which you    |
| can read by viewing the included agpl.txt or online    |
| at www.gnu.org/licenses/agpl.html. Removal of this     |
| copyright header is strictly prohibited without        |
| written permission from the original author(s).        |
+--------------------------------------------------------*/

use CRM_Contactlinks_ExtensionUtil as E;

/**
 * Collection of upgrade steps.
 */
class CRM_Contactlinks_Upgrader extends CRM_Extension_Upgrader_Base {

  /**
   * Installer
   */
  public function install() {
    // run the custom group sync
    require_once 'CRM/Contactlinks/CustomData.php';
    $customData = new CRM_Contactlinks_CustomData('de.systopia.contactlinks');
    $customData->syncOptionGroup(__DIR__ . '/../../resources/contact_link_category_option_group.json');
    $customData->syncCustomGroup(__DIR__ . '/../../resources/contactlinks_custom_group.json');

    return TRUE;
  }
}
