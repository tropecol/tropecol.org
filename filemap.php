<?php
/**
 * Scans a directory recursively
 * Can filter the directory to show only desired file extensions
 *
 * @author Jeremy Simkins <SoN9ne>
 */

/**
 * Prepare filters
 * - Do not edit unless you know what you are doing!
 * - Look below (Look for BEGIN) to edit the filters
 */
# Define search Filters
$searchFilter = array();
$searchFilter['file'] = array();
$searchFilter['extension'] = array();
$searchFilter['directory'] = array();

# Define ignore Filters
$ignore = array();
$ignore['file'] = array();
$ignore['extension'] = array();
$ignore['directory'] = array();
//--> End Prepare filters


//-----[ BEGIN - Edit this data as you see fit ]-----------------------------------\\
/**
 * Directory to scan
 * @var string 
 */
$directory = "."; // up one directory to get all the files of the system


/**
 * Set the maximum depth for the scan
 * 
 * @var mixed - NULL|int - NULL will have no depth limitation, int is the number of levels deep to step into
 */
define('MAX_SCAN_DEPTH', NULL);

/**
 * Custom search filters
 * 	- You can add any type of filter to limit the search.
 * 
 * Notes:
 * - Extension and directory filters should be all lowercase
 * - File filters should include the extension and are case-sensitive
 */
# Define search extension filters
//$searchFilter['extension'][] = 'php';


# Define search file filters
//$searchFilter['file'][] = '';


# Define search directory filters
//$searchFilter['directory'][] = '';
//--> End search filters


/**
 * Edit the ignore filters
 */
# Define ignore extension filters
$ignore['extension'][] = 'buildpath'; // ZDE file
$ignore['extension'][] = 'ds_store'; // Desktop Services Store file
$ignore['extension'][] = 'project'; // ZDE file


# Define ignore file filters
//$ignore['file'][] = '';


# Define ignore directory filters
$ignore['directory'][] = '.svn'; // Do not scan svn directories
$ignore['directory'][] = '.settings'; // Do not scan ZDE .setting folder
$ignore['directory'][] = '__sessions'; // Do not scan custom sessions storage folder
//--> End ignore filters
//-----[ STOP - Edit this data as you see fit ]-----------------------------------\\


/**
 * Do Not edit below unless you know what you are doing
 */
# Set timezone
date_default_timezone_set('America/New_York');

# Total files flag
$totalFiles = 0;
$totalDirectories = 0;

# Define direcoty tree array
$directory_tree = array();

# Scan the directory
$directory_tree = customScanDir($directory, $searchFilter, $ignore);

# Sort the array
array_sort($directory_tree, 'name');

//echo '<pre>';
//print_r($directory_tree);
//echo '</pre>';
//die();


# Start output buffering
ob_start();

# Display the content
displayDirRecursively($directory_tree, $totalFiles, $totalDirectories);

# Save output to a var
$tmp = ob_get_contents();

# Delete the output buffer
ob_end_clean();

# Output the page
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Tropecol File Scanner</title>
<style>
body {
	margin: 0;
	padding: 0;
	font: normal 14px Arial;
	color: #666;
	background: #efefef;
}
ul, ol {
	background: #fff;
	border: 4px solid #fff;
}
.dirList {
	margin: 5px auto;
	width: 60%;
	overflow: hidden;
	-moz-box-shadow: 0 0 20px #b5b5b5;
}
#detail-container {
	margin: 5px auto;
	width: 60%;
}
#details, #legend {
	margin: 5px auto;
	-moz-box-shadow: 0 0 20px #b5b5b5;
}
#details {
	float: left;
	width: 70%;
	list-style: none;
}
#legend {
	display: inline-block;
	float: right;
	width: 20%;
}
.clear {
	clear: both;
}
li {
	line-height: 1.8em;
	margin: 0 5px;
	padding-left: 2em;
	text-indent: -2em;
	width: 100%;
}
ol.legend:first-child {
	background: maroon;
}
.dirList li:nth-child(even) {
	background: #fff;
}
.dirList li:nth-child(odd) {
	background: #ecf3fe;
}
.dirList li:hover {
	background: yellow;
}
.dirList ul {
	margin-left: -30px;
}
#details .title, #legend .title {
	list-style: none;
	font-weight: bold;
	border-bottom: 1px solid #ccc;
	margin: 0 0 0 -38px;
}
.folder {
	list-style: circle;
}
.file {
	list-style: square;
}
h3, h4 {
	padding: 10px;
	margin: 0px;
	font: normal 20px 'Trebuchet MS';
	text-align: center;
}
h4 {
	font: normal 15px 'Trebuchet MS';
}
a {
	color: #0079e0;
}
a:visited {
	color: purple;
}
</style>
<!--<script type="text/javascript" src="/gs_sortable.js"></script>-->
<!--<script type="text/javascript">-->
<!---->
<!--var TSort_Data = new Array ('scanner', 's', 'd');-->
<!--tsRegister();-->
<!--// -->
<!--</script>-->
</head>
<body>
<div id="detail-container">
  <ol id="details">
    <li class="title">Details:</li>
    <li>Total Directories Scanned: <strong>
      <?php
echo $totalDirectories;
?>
      </strong></li>
    <li>Total Files Located: <strong>
      <?php
echo $totalFiles;
?>
      </strong></li>
  </ol>
  <ol id="legend">
    <li class="title">Legend</li>
    <li class="folder">Folder</li>
    <li class="file">File</li>
  </ol>
  <div class="clear"></div>
</div>
<hr />
<?php
# Output the buffer
echo $tmp;
?>
</body>
</html>
<?php

/**
 * Recursively scans the directory
 *
 * @param string $directory - Directory to scan
 * @param array $searchFilter - Array of serch data
 * @param array $ignore - Array of data to ignore
 * @param int $depth - Flag for knowing the depth of the scan
 * @throws Exception
 */
function customScanDir($directory = '.', $searchFilter = NULL, $ignore = NULL, $depth = 0) {
    
    if ( MAX_SCAN_DEPTH && $depth > MAX_SCAN_DEPTH ) return array();
    
    if ( substr($directory, -1) == '/' ) {
        $directory = substr($directory, 0, -1);
    }
    
    try {
        try {
            $directory_tree = array(); // Define output array
            foreach (new DirectoryIterator($directory) as $fileInfo) {
                if ( $fileInfo->isDot() ) continue;
                
                $subdirectories = explode('/', $fileInfo->getPathname());
                $tmpName = end($subdirectories);
                
                if ( $fileInfo->isDir() && !empty($ignore['directory']) && !in_array($tmpName, $ignore['directory']) ) {
                    $directory_tree['directory'][] = array('path'=>$fileInfo->getPathname(), 'name'=>$tmpName, 'kind'=>'directory', 'content'=>array_sort(customScanDir($fileInfo->getPathname(), $searchFilter, $ignore, $depth + 1), 'name'));
                } else if ( $fileInfo->isFile() ) {
                    $tmpExtension = strtolower(end(explode('.', $tmpName)));
                    
                    # Ignored files and extensions
                    if ( !empty($ignore['extension']) && in_array($tmpExtension, $ignore['extension']) || !empty($ignore['file']) && in_array(strtolower($tmpName), $ignore['file']) || !empty($searchFilter['extension']) && !in_array($tmpExtension, $searchFilter['extension']) ) {
                        continue;
                    }
                    
                    # Add the file to the tree if it is searched or we are displaying the entire directory
                    if ( empty($searchFilter['file']) || !empty($searchFilter['file']) && in_array(strtolower($tmpName), $searchFilter['file']) ) {
                        $directory_tree['file'][] = array('name'=>$tmpName, 'extension'=>$tmpExtension, 'path'=>$fileInfo->getPathname(), 'lastModified'=>date('M d Y h:i:s a', $fileInfo->getMTime()), 'kind'=>'file');
                    }
                }
            }
            
            unset($tmpName, $tmpExtension); // Free tmp vars
            return $directory_tree;
        } catch ( UnexpectedValueException $e ) {
            throw new Exception(sprintf("Directory [%s/] contained a directory that cannot be stepped into", $directory), E_USER_WARNING);
            return array(); // Return an empty array
        }
    } catch ( Exception $e ) {
        die($e->getMessage()); // Show the error
    }
}

/**
 * Steps throught the directory array and displays
 *
 * @param array $fileSystem - Array of file system
 * @param int $totalFiles - Flag to count the total files found
 * @param int $totalDirectories - Flag to count the total directories scanned
 * @param int $depth - Flag to know the depth of the display
 */
function displayDirRecursively($fileSystem = array(), & $totalFiles = 0, & $totalDirectories = 0, $depth = 0) {
    echo '<ul class="' . (($depth) ? "sub-depth-{$depth}" : 'dirList') . '">';
    foreach ($fileSystem as $fsType=>$fsData) {
        foreach ($fsData as $item) {
            if ( $fsType === 'directory' ) {
                ++$totalDirectories;
                
                echo '<li class="folder">';
                echo $item['name'];
                
                if ( isset($item['content']) && is_array($item['content']) && !empty($item['content']) ) {
                    displayDirRecursively($item['content'], $totalFiles, $totalDirectories, $depth + 1);
                }
                $deep = 0;
                echo '</li>';
            } else if ( $fsType === 'file' ) {
                ++$totalFiles;
                
                echo '<li class="file">';
                echo sprintf('<a href="%s" target="_blank" title="%s">%s</a>', $item['path'], $item['path'], $item['name']);
                echo '</li>';
            }
        }
    }
    echo '</ul>';
}

/**
 * Sorts an array by key
 *
 * @param array $array
 * @param mixed $on - string||int
 * @param bool $sortASC - TRUE sort ASC, FALSE sort DESC
 * @return array
 */
function array_sort($array, $on, $sortASC = TRUE) {
    $new_array = array();
    $sortable_array = array();
    
    if ( count($array) > 0 ) {
        foreach ($array as $k=>$v) {
            if ( is_array($v) ) {
                foreach ($v as $k2=>$v2) {
                    if ( $k2 == $on ) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }
        
        if ( $sortASC ) {
            asort($sortable_array);
        } else {
            arsort($sortable_array);
        }
        
        foreach ($sortable_array as $k=>$v) {
            $new_array[$k] = $array[$k];
        }
    }
    
    return $new_array;
}