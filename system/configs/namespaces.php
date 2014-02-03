<?php
	
	/**
	 * List of core namespaces.
	 * The list should be looks like, e.g.
	 *	<code>
	 *		array( '\\core\\controller' => 'Controller')
	 *	</code>
	 * The key in the list is a namespace and a real path
	 * that would be used to include all necessary classes.
	 * The value is a class name.
	 */
	$namespaces = array(
		array('\\core\\router' => 'Router'),
    array('\\core\\errorhandler' => 'ErrorHandler')
  );