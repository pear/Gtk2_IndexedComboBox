<?php
/**
*   Simple Gtk2_IndexedComboBox example
*
*   @author Christian Weiske <cweiske@php.net>
*/
require_once 'Gtk2/IndexedComboBox.php';

$arData = array('key' => 'constructor', 2 => 'c02', 3 => 'c03');
$arPrepend = array('prepend' => 'prepend', 10 => 'p10', 11 => 'p11', 12 => 'p12');
$arInsert  = array('insert'  => 'insert' , 20 => 'i20', 21 => 'i21', 22 => 'i22');
$arAppend  = array('append'  => 'append' , 30 => 'a30', 31 => 'a31', 32 => 'a32');

$cmb = array();

$cmb['empty'] = new Gtk2_IndexedComboBox();

$cmb['constructor'] = new Gtk2_IndexedComboBox($arData);

$cmb['append'] = new Gtk2_IndexedComboBox();
$cmb['append']->append_array($arAppend);

$cmb['append+c'] = new Gtk2_IndexedComboBox($arData);
$cmb['append+c']->append_array($arAppend);

$cmb['prepend'] = new Gtk2_IndexedComboBox();
$cmb['prepend']->prepend_array($arPrepend);

$cmb['prepend+c'] = new Gtk2_IndexedComboBox($arData);
$cmb['prepend+c']->prepend_array($arPrepend);

$cmb['insert'] = new Gtk2_IndexedComboBox();
$cmb['insert']->insert_array(2, $arInsert);

$cmb['insert+c'] = new Gtk2_IndexedComboBox($arData);
$cmb['insert+c']->insert_array(2, $arInsert);

$cmb['normal'] = new Gtk2_IndexedComboBox();
$cmb['normal']->append('append', 'append');
$cmb['normal']->prepend('prepend', 'prepend');
$cmb['normal']->insert(1, 'insert', 'insert on #1');
$cmb['normal']->append('append2', 'append#2');

$cmb['normal']->set_active_key('append');


$lbl = new GtkLabel("Status\r\n\r\n");

$tbl = new GtkTable(2, count($cmb));
$nPos = 0;
foreach ($cmb as $id => $combo) {
    $tbl->attach(new GtkLabel($id), 0, 1, $nPos, $nPos + 1);
    $tbl->attach($combo, 1, 2, $nPos, $nPos + 1);
    $combo->connect('changed', 'comboChanged', $id, $lbl);
    ++$nPos;
}


function comboChanged($combo, $comboId, $lbl)
{
    $lbl->set_text(
        'Combo "'    . $comboId . "\" changed:\r\n"
        . 'Key: '   . $combo->get_active_key() . "\r\n"
        . 'Value: ' . $combo->get_active_text()
    );
}


$vbox = new GtkVBox();
$vbox->pack_start($tbl);
$vbox->pack_start($lbl);

$wnd = new GtkWindow();
$wnd->connect_simple('destroy', array('Gtk', 'main_quit'));
$wnd->add($vbox);
$wnd->show_all();
Gtk::main();
?>
