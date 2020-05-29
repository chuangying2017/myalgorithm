<?php
/**
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */


function create($class,$attributes = [])
{
    return factory($class)->create($attributes);
}

function make($class,$attributes = [])
{
    return factory($class)->make($attributes);
}

function raw($class,$attributes = [])
{
    return factory($class)->raw($attributes);
}
