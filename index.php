<?php
mb_internal_encoding("UTF-8");
error_reporting(E_ALL ^ E_NOTICE);
define('ROOTDIR', __DIR__.'/../');
require ROOTDIR.'config.php';
require ROOTDIR.'overnullch-config.php';
$tc_db->SetFetchMode(ADODB_FETCH_ASSOC);
$tc_db->Execute('SET NAMES utf8');
$db = 'over_chans';
$old_base_URL = 'http://old.0chan.one';

if (isset($_GET['click'])) {
  $tc_db->Execute("UPDATE $db SET clicks = clicks+1 WHERE url=?", [$_GET['click']]);
  header("HTTP/1.1 303 See Other");
  header("Location: " . $_GET['click']);
  exit();
}

$search = (isset($_GET['q']));
$q = (@$_GET['q']);

$shuffle = (@$_GET['shuffle']);

$offline = (@$_GET['offline']);

$search_q = '';
if ($search) {
  $q_e = $tc_db->qStr("%$q%");
  $search_q = "WHERE (name LIKE $q_e OR url LIKE $q_e)";
}

$chans = $tc_db->GetAll("SELECT * FROM $db $search_q ORDER BY " . ($shuffle ? "RAND()" : "`clicks` DESC, `order` DESC"));

function makeIcon($id) {
  return '<svg class="cell-icon"><use xlink:href="i.svg#i-'.$id.'"></use></svg>';
}

function chanHTML($chan) {
  global $old_base_URL;

  $img_src = "$old_base_URL/chans/balls/" 
  . ($chan['offline'] ? 'offline' : (
    $chan['default'] ? 'default' : 'custom' ) )
  . "/" . $chan['id'] . ".png"
  . ($chan['ballv'] ? "?uid=" . $chan['ballv'] : "");

  $a_href = "./?click=" . $chan['url'];

  $search = mb_strtolower($chan['name'] . ' ' . preg_replace('/^https?\:\/\//', '', $chan['url']));

  return '<a target="_blank" href="'.$a_href.'" class="cell chan-cell" id="cc-'.$chan['id'].'" title="'.$chan['name'].'" data-search="'.$search.'" data-offline="'.$chan['offline'].'">
    <div class="cell-bg"></div>
    <img class="chan-pic" src="'.$img_src.'" alt="'.$chan['id'].'">
    <div class="chan-name">'.$chan['name'].'</div>
  </a>';
}

$chans_online = ''; $chans_offline = '';

foreach($chans as $chan) {
  $html = chanHTML($chan);
  if ($chan['offline']) {
    $chans_offline .= $html;
  }
  else {
    $chans_online .= $html;
  }
}

$seven_divs = str_repeat('<div></div>', 7); // elegant AF

require 'content.php';
