<?php

/**
 * Bedwars - SignCommand.php
 * @author Fludixx
 * @license MIT
 */

declare(strict_types=1);

namespace Fludixx\Bedwars\command;

use Fludixx\Bedwars\Bedwars;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class SignCommand extends Command
{

    public function __construct()
    {
        parent::__construct(
            "sign",
            "/sign [ARENANAME]",
            "/sign [ARENANAME]",
            ['addsign']
        );
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender->hasPermission("bw.admin") && $sender instanceof Player) {
            if (!isset($args[0]) || $args[0] == "help") {
                $sender->sendMessage(Bedwars::PREFIX."/sign [ARENANAME]");
                return true;
            } else {
                $arenas = Bedwars::$provider->getArenas();
                if (!isset($arenas[$args[0]])) {
                    $sender->sendMessage(Bedwars::PREFIX."Arena not found! Be sure to register it");
                    return false;
                } else {
                    $sender->sendMessage(Bedwars::PREFIX."Break a Sign");
                    Bedwars::$players[$sender->getName()]->setPos(-11);
                    Bedwars::$players[$sender->getName()]->setKnocker($args[0]);
                    return true;
                }
            }
        }
        return false;
    }

}
