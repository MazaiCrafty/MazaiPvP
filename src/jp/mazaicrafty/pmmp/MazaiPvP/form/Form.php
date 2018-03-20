<?php

/*
 * ___  ___               _ _____            __ _         
 * |  \/  |              (_)  __ \          / _| |        
 * | .  . | __ _ ______ _ _| /  \/_ __ __ _| |_| |_ _   _ 
 * | |\/| |/ _` |_  / _` | | |   | '__/ _` |  _| __| | | |
 * | |  | | (_| |/ / (_| | | \__/\ | | (_| | | | |_| |_| |
 * \_|  |_/\__,_/___\__,_|_|\____/_|  \__,_|_|  \__|\__, |
 *                                                   __/ |
 *                                                  |___/
 * Copyright (C) 2017-2018 @MazaiCrafty (https://twitter.com/MazaiCrafty)
 *
 * This program is free plugin.
 */

 declare(strict_types = 1);
 namespace jp\mazaicrafty\pmmp\MazaiPvP\form;

 # Player
 use pocketmine\Player;

 # Network
 use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;

 # Interface
 use jp\mazaicrafty\pmmp\MazaiPvP\form\Interface\FormInterface;

 abstract class Form implements FormInterface{

     public $id;

     private $callable;

     public function __construct(int $id, ?callable $callable){
         $this->id = $id;
         $this->callable = $callable;
     }

     public function getId(): int{
         return $this->id;
     }

     public $name;
     private $data = [];

     public function sendToPlayer(Player $player): void{
         $pk = new ModalFormRequestPacket();
         $pk->formId = $this->id;
         $pk->formId = json_encode($this->data);
         $player->dataPacket($pk);
         $this->name = $player->getName();
     }

     public function isRecipient(Player $player): bool{
         $result = $player->getName() === $this->name;
         return $result;
     }

     public function getCallable(): ?callable{
         return $this->callable;
     }
 }
