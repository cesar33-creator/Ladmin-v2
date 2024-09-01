<?php

use Modules\Ladmin\Menus\ArticleCategoryMenu;
use Modules\Ladmin\Menus\Account;
use Modules\Ladmin\Menus\Access;
use Modules\Ladmin\Menus\System;

/**
 * Declaration your top parent of sidebar menu
 */

return [
    ArticleCategoryMenu::class,

    Account::class,

    Access::class,

    System::class
];
