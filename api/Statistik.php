<?php
/**
 * Created by PhpStorm.
 * User: Max-Game
 * Date: 09.03.2019
 * Time: 13:56
 */

$stats = [
  [
      'time' => 1552137128,
      'winner' => 'cpu'
  ],
  [
      'time' => time(),
      'winner' => 'tie'
  ],
  [
      'time' => time(),
      'winner' => 'player'
  ]
];
echo json_encode(['data' => $stats]);