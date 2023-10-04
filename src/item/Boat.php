<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
 */

declare(strict_types=1);

namespace pocketmine\item;

use pocketmine\entity\Entity;
usepocketmine\entity\EntityId;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\network\mcpe\protocol\RemoveEntityPacket;
use pocketmine\Player;

class Boat {
    public static function spawnBoat(Player $player, string $boatType) {
        $boat = null;
        $boatId = null;

        switch ($boatType) {
            case "oak":
                $boat = Entity::createEntity("Boat", $player->getLevel(), Entity::createBaseNBT($player->getPosition()));
                $boatId = EntityIds::BOAT;
                break;
            case "spruce":
                $boat = Entity::createEntity("SpruceBoat", $player->getLevel(), Entity::createBaseNBT($player->getPosition()));
                $boatId = EntityIds::SPRUCE_BOAT;
                break;
            case "birch":
                $boat = Entity::createEntity("BirchBoat", $player->getLevel(), Entity::createBaseNBT($player->getPosition()));
                $boatId = EntityIds::BIRCH_BOAT;
                break;
            case "jungle":
                $boat = Entity::createEntity("JungleBoat", $player->getLevel(), Entity::createBaseNBT($player->getPosition()));
                $boatId = EntityIds::JUNGLE_BOAT;
                break;
            case "acacia":
                $boat = Entity::createEntity("AcaciaBoat", $player->getLevel(), Entity::createBaseNBT($player->getPosition()));
                $boatId = EntityIds::ACACIA_BOAT;
                break;
            case "darkoak":
                $boat = Entity::createEntity("DarkOakBoat", $player->getLevel(), Entity::createBaseNBT($player->getPosition()));
                $boatId = EntityIds::DARK_OAK_BOAT;
                break;
            default:
                $player->sendMessage("Invalid boat type. Available types: oak, spruce, birch, jungle, acacia, darkoak");
                return;
        }

        if ($boat !== null) {
            $boat->spawnToAll();
            $player->getInventory()->removeItem(Item::get(Item::BOAT, $boatId));
            $player->sendMessage("Boat spawned!");
        } else {
            $player->sendMessage("Failed to spawn boat.");
        }
    }
}
