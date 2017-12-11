<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 11/12/17
 * Time: 14:24
 */

namespace App;


final class AppEvent
{
    const USER_CARD_ADD = 'app.player.add';
    const USER_CARD_EDIT = 'app.player.edit';
    const USER_CARD_DELETE = 'app.player.delete';
}