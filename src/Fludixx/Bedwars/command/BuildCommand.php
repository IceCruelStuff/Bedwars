<?php

declare(strict_types=1);

/**
 * Bedwars - BuildCommand.php
 * @author Fludixx
 * @license MIT
 */

namespace Fludixx\Bedwars\command;

use Fludixx\Bedwars\Bedwars;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class BuildCommand extends Command
{


    public function __construct()
    {
        parent::__construct("bwbuild", "Change mode to: Build Mode", "/build", []);
        $this->setPermission("bw.build");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender->hasPermission("bw.build")) {
            $mplayer = Bedwars::$players[$sender->getName()];
            $mplayer->setCanBuild(!$mplayer->canBuild());
            if ($mplayer->canBuild()) {
                $mplayer->sendMsg("You can now place & break blocks!");
            } else {
                $mplayer->sendMsg("You can't build now!");
            }
            return true;
        } else {
            $sender->sendMessage("§cYou don't have the Permissions for this command");
        }
    }

}
