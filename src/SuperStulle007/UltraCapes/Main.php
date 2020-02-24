<?php

/**
 * Copyright (c) 2019 SuperStulle007
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

declare(strict_types=1);

namespace SuperStulle007\UltraCapes;

use pocketmine\command\{Command, CommandSender};
use pocketmine\entity\Skin;
use pocketmine\event\Listener;
use pocketmine\event\player\{PlayerChangeSkinEvent, PlayerJoinEvent};
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use SuperStulle007\UltraCapes\libs\jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener
{

    public $skins;
    protected $skin = [];

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("capes.yml");
        $this->saveResource("config.yml");
        $this->capes = new Config($this->getDataFolder() . "capes.yml", Config::YAML);
        foreach ($this->capes->get("capes") as $cape) {
            $this->saveResource("$cape.png");
        }
    }

    public function onJoin(PlayerJoinEvent $eve)
    {
        $player = $eve->getPlayer();
        $this->skin[$player->getName()] = $player->getSkin();
        $playercape = new Config($this->getDataFolder() . "data.yml", Config::YAML);
        if ($playercape->get($player->getName()) == "b") {
            $oldSkin = $player->getSkin();
            $capeData = $this->createCape("Blue_Creeper");
            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
            $player->setSkin($setCape);
            $player->sendSkin();
        } else {
            if ($playercape->get($player->getName()) == "c") {
                $oldSkin = $player->getSkin();
                $capeData = $this->createCape("Enderman");
                $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                $player->setSkin($setCape);
                $player->sendSkin();
            } else {
                if ($playercape->get($player->getName()) == "d") {
                    $oldSkin = $player->getSkin();
                    $capeData = $this->createCape("Energy");
                    $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                    $player->setSkin($setCape);
                    $player->sendSkin();
                } else {
                    if ($playercape->get($player->getName()) == "e") {
                        $oldSkin = $player->getSkin();
                        $capeData = $this->createCape("Fire");
                        $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                        $player->setSkin($setCape);
                        $player->sendSkin();
                    } else {
                        if ($playercape->get($player->getName()) == "f") {
                            $oldSkin = $player->getSkin();
                            $capeData = $this->createCape("Red_Creeper");
                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                            $player->setSkin($setCape);
                            $player->sendSkin();
                        } else {
                            if ($playercape->get($player->getName()) == "g") {
                                $oldSkin = $player->getSkin();
                                $capeData = $this->createCape("Turtle");
                                $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                $player->setSkin($setCape);
                                $player->sendSkin();
                            } else {
                                if ($playercape->get($player->getName()) == "h") {
                                    $oldSkin = $player->getSkin();
                                    $capeData = $this->createCape("Pickaxe");
                                    $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                    $player->setSkin($setCape);
                                    $player->sendSkin();
                                } else {
                                    if ($playercape->get($player->getName()) == "i") {
                                        $oldSkin = $player->getSkin();
                                        $capeData = $this->createCape("Firework");
                                        $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                        $player->setSkin($setCape);
                                        $player->sendSkin();
                                    } else {
                                        if ($playercape->get($player->getName()) == "j") {
                                            $oldSkin = $player->getSkin();
                                            $capeData = $this->createCape("Iron_Golem");
                                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                            $player->setSkin($setCape);
                                            $player->sendSkin();
                                        } else {
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function createCape($capeName)
    {
        $path = $this->getDataFolder() . "{$capeName}.png";

        $img = @imagecreatefrompng($path);

        $bytes = '';

        $l = (int)@getimagesize($path)[1];

        for ($y = 0; $y < $l; $y++) {

            for ($x = 0; $x < 64; $x++) {

                $rgba = @imagecolorat($img, $x, $y);

                $a = ((~((int)($rgba >> 24))) << 1) & 0xff;

                $r = ($rgba >> 16) & 0xff;

                $g = ($rgba >> 8) & 0xff;

                $b = $rgba & 0xff;

                $bytes .= chr($r) . chr($g) . chr($b) . chr($a);

            }

        }

        @imagedestroy($img);
        return $bytes;
    }

    public function onChangeSkin(PlayerChangeSkinEvent $eve)
    {
        $player = $eve->getPlayer();
        $this->skin[$player->getName()] = $player->getSkin();
    }

    public function onCommand(CommandSender $player, Command $command, string $label, array $args): bool
    {
        $this->capes = new Config($this->getDataFolder() . "capes.yml", Config::YAML);
        $cape = $this->capes->get("capes");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $noperms = $this->cfg->get("no-permissions");
        switch (strtolower($command->getName())) {
            case "cape":
                if ($player instanceof Player) {
                    if (!isset($args[0])) {
                        if (!$player->hasPermission("cape.cmd")) {
                            $player->sendMessage($noperms);
                            return true;
                        } else {
                            $form = new SimpleForm(function (Player $player, $data) {
                                $result = $data;
                                if ($result == null) {
                                }
                                switch ($result) {
                                    case 0:
                                        break;
                                    case 1:
                                        $pdata = new Config($this->getDataFolder() . "data.yml", Config::YAML);
                                        $oldSkin = $player->getSkin();
                                        $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), "", $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                        $player->setSkin($setCape);
                                        $player->sendSkin();
                                        $player->sendMessage($this->cfg->get("skin-resetted"));
                                        $data->set($player->getName(), "a");
                                        $data->save();

                                        return true;
                                    case 2:
                                        $pdata = new Config($this->getDataFolder() . "data.yml", Config::YAML);
                                        if (!$player->hasPermission("blue_creeper.cape")) {
                                            $player->sendMessage($noperms);
                                            return true;
                                        } else {
                                            $oldSkin = $player->getSkin();
                                            $capeData = $this->createCape("Blue_Creeper");
                                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                            $player->setSkin($setCape);
                                            $player->sendSkin();
                                            $player->sendMessage("§f[§bServer§f] §aBlue Creeper Cape activated!");
                                            $pdata->set($player->getName(), "b");
                                            $pdata->save();
                                        }
                                        return true;
                                    case 3:
                                        $pdata = new Config($this->getDataFolder() . "data.yml", Config::YAML);
                                        if (!$player->hasPermission("enderman.cape")) {
                                            $player->sendMessage($noperms);
                                            return true;
                                        } else {
                                            $oldSkin = $player->getSkin();
                                            $capeData = $this->createCape("Enderman");
                                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                            $player->setSkin($setCape);
                                            $player->sendSkin();
                                            $player->sendMessage("§f[§bServer§f] §aEnderman Cape activated!");
                                            $pdata->set($player->getName(), "c");
                                            $pdata->save();
                                            return true;
                                        }
                                        break;
                                    case 4:
                                        $pdata = new Config($this->getDataFolder() . "data.yml", Config::YAML);
                                        if (!$player->hasPermission("energy.cape")) {
                                            $player->sendMessage($noperms);
                                            return true;
                                        } else {
                                            $oldSkin = $player->getSkin();
                                            $capeData = $this->createCape("Energy");
                                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                            $player->setSkin($setCape);
                                            $player->sendSkin();
                                            $player->sendMessage("§f[§bServer§f] §aEnergy Cape activated!");
                                            $pdata->set($player->getName(), "d");
                                            $pdata->save();
                                            return true;
                                        }
                                        break;
                                    case 5:
                                        $pdata = new Config($this->getDataFolder() . "data.yml", Config::YAML);
                                        if (!$player->hasPermission("fire.cape")) {
                                            $player->sendMessage($noperms);
                                            return true;
                                        } else {
                                            $oldSkin = $player->getSkin();
                                            $capeData = $this->createCape("Fire");
                                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                            $player->setSkin($setCape);
                                            $player->sendSkin();
                                            $player->sendMessage("§f[§bServer§f] §aFire Cape activated!");
                                            $pdata->set($player->getName(), "e");
                                            $pdata->save();
                                            return true;
                                        }
                                        break;
                                    case 6:
                                        $pdata = new Config($this->getDataFolder() . "data.yml", Config::YAML);
                                        if (!$player->hasPermission("red_creeper.cape")) {
                                            $player->sendMessage($noperms);
                                            return true;
                                        } else {
                                            $oldSkin = $player->getSkin();
                                            $capeData = $this->createCape("Red_Creeper");
                                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                            $player->setSkin($setCape);
                                            $player->sendSkin();
                                            $player->sendMessage("§f[§bServer§f] §aRed Creeper Cape activated!");
                                            $pdata->set($player->getName(), "f");
                                            $pdata->save();
                                            return true;
                                        }
                                        break;
                                    case 7:
                                        $pdata = new Config($this->getDataFolder() . "data.yml", Config::YAML);
                                        if (!$player->hasPermission("turtle.cape")) {
                                            $player->sendMessage($noperms);
                                            return true;
                                        } else {
                                            $oldSkin = $player->getSkin();
                                            $capeData = $this->createCape("Turtle");
                                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                            $player->setSkin($setCape);
                                            $player->sendSkin();
                                            $player->sendMessage("§f[§bServer§f] §aTurtle Cape activated!");
                                            $pdata->set($player->getName(), "g");
                                            $pdata->save();
                                            return true;
                                        }
                                        break;
                                    case 8:
                                        $pdata = new Config($this->getDataFolder() . "data.yml", Config::YAML);
                                        if (!$player->hasPermission("pickaxe.cape")) {
                                            $player->sendMessage($noperms);
                                            return true;
                                        } else {
                                            $oldSkin = $player->getSkin();
                                            $capeData = $this->createCape("Pickaxe");
                                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                            $player->setSkin($setCape);
                                            $player->sendSkin();
                                            $player->sendMessage("§f[§bServer§f] §aPickaxe Cape activated!");
                                            $pdata->set($player->getName(), "h");
                                            $pdata->save();
                                            return true;
                                        }
                                        break;
                                    case 9:
                                        $pdata = new Config($this->getDataFolder() . "data.yml", Config::YAML);
                                        if (!$player->hasPermission("firework.cape")) {
                                            $player->sendMessage($noperms);
                                            return true;
                                        } else {
                                            $oldSkin = $player->getSkin();
                                            $capeData = $this->createCape("Firework");
                                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                            $player->setSkin($setCape);
                                            $player->sendSkin();
                                            $player->sendMessage("§f[§bServer§f] §aFirework Cape activated!");
                                            $pdata->set($player->getName(), "i");
                                            $pdata->save();
                                            return true;
                                        }
                                        break;
                                    case 10:
                                        $pdata = new Config($this->getDataFolder() . "data.yml", Config::YAML);
                                        if (!$player->hasPermission("iron_golem.cape")) {
                                            $player->sendMessage($noperms);
                                            return true;
                                        } else {
                                            $oldSkin = $player->getSkin();
                                            $capeData = $this->createCape("Iron_Golem");
                                            $setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
                                            $player->setSkin($setCape);
                                            $player->sendSkin();
                                            $player->sendMessage("§f[§bServer§f] §aIron-Golem Cape activated!");
                                            $pdata->set($player->getName(), "j");
                                            $pdata->save();
                                            return true;
                                        }
                                        break;
                                }
                            });
                            $form->setTitle($this->cfg->get("UI-Title"));
                            $form->setContent($this->cfg->get("UI-Content"));
                            $form->addButton("§4Abort", 0);
                            $form->addButton("§0Remove your Cape", 1);
                            $form->addButton("§eBlue-Creeper-Cape", 2);
                            $form->addButton("§eEndermancape", 3);
                            $form->addButton("§eEnergycape", 4);
                            $form->addButton("§eFirecape", 5);
                            $form->addButton("§eRed-Creeper-Cape", 6);
                            $form->addButton("§eTurtlecape", 7);
                            $form->addButton("§ePickaxecape", 8);
                            $form->addButton("§eFireworkcape", 9);
                            $form->addButton("§eIron-Golem-Cape", 10);
                            $form->sendToPlayer($player);
                        }
                        return true;
                    }
                }
        }
        return true;
    }
}
