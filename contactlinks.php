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

require_once 'contactlinks.civix.php';
use CRM_Contactlinks_ExtensionUtil as E;

function contactlinks_civicrm_custom( $op, $groupID, $entityID, &$params ) {
  if ($op == 'create') {
    // set creator ID and create data
    // fixme: is there a way to get the civicrm_value_contact_link.id?
    $creator_id = (int) CRM_Core_Session::getLoggedInContactID();
    if ($creator_id) {
      CRM_Core_DAO::executeQuery("
        UPDATE civicrm_value_contact_link
        SET create_contact_id = %1
        WHERE create_contact_id IS NULL
          AND entity_id = %2;", [1 => [$creator_id, 'Integer'], 2 => [$entityID, 'Integer']]);
    }

    CRM_Core_DAO::executeQuery("
        UPDATE civicrm_value_contact_link
        SET create_date = NOW()
        WHERE create_date IS NULL
          AND entity_id = %1;", [1 => [$entityID, 'Integer']]);
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function contactlinks_civicrm_config(&$config) {
  _contactlinks_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function contactlinks_civicrm_install() {
  _contactlinks_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function contactlinks_civicrm_enable() {
  _contactlinks_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *

 // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function contactlinks_civicrm_navigationMenu(&$menu) {
  _contactlinks_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _contactlinks_civix_navigationMenu($menu);
} // */
