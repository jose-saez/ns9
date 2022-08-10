<?php
/*
 * menu1.php
 * 
 * Copyright 2014 jsaez
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Menú 1</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	
<style>
    ul#navWrapper {
      border: 1px black dashed;
    }
    
    ul#navWrapper li {
      border: 1px red dashed;    
      float: left;
      list-style: none;
      margin-right: 0.8em; /* Place some space between the adjacent top nav items. */ 
      background-color: #DDD; /* Add a background color to all nav items. */
    }
    
    ul#navWrapper li li {
      border: 1px blue dashed;    
      float: none;
      margin-left: -44px; /* Account for missing bullet space, etc. */
	  margin-top: 3px; /* Place some space between the vertical dropdown menu items. */ 
    }
    
    ul#navWrapper li li:first-child { 
		margin-top: 4px; /* Add a touch more space between a top nav item and its associated drop-down menu. */
	}
	
    ul#navWrapper ul {
      display: none;
	  position: absolute;
	}
    
    ul#navWrapper li:hover ul {
      display: block;
    }
    
    
    div#principal {
		clear: both;
	}
	
</style>	
</head>

<body>
	<nav><ul>
			<li>Opción 1</li>
			<li>Opción 2</li>
			<li>Opción 3</li>
		</ul>
	</nav>
	
  <ul id="navWrapper"> <!-- Top Nav -->
    <li> <!-- Menu A -->
      <a href="pageA.html">Menu A</a>
      <ul>
        <li><a href="pageA1.html">Menu A, Item 1</a></li>
        <li><a href="pageA2.html">Menu A, Item 2</a></li>
      </ul>
    </li> <!-- Menu A -->
    <li> <!-- Menu B -->
      <a href="pageB.html">Menu B</a>
      <ul>
        <li><a href="pageB1.html">Menu B, Item 1</a></li>
        <li><a href="pageB2.html">Menu B, Item 2</a></li>
        <li><a href="pageB3.html">Menu B, Item 3</a></li>        
      </ul>
    </li> <!-- Menu B -->
  </ul> <!-- Top Nav -->	
	
	<div id='principal'>
Este es el texto principal
	</div>
</body>

</html>
