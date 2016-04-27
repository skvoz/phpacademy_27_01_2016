<?php


namespace testnamespace;


interface IAR
{
    function delete();
    function update();
    function save();
    function find($array);
    function load($array);
}