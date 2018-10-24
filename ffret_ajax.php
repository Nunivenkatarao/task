<?php 
$errorMSG = array();

if (empty($_POST["fullpath"])) {
    $errorMSG = array('pathErr' => "Path is required");
} else {
    $errorMSG = array();
    $fullpath = $_POST["fullpath"];
    if(!file_exists($fullpath) && !is_dir($fullpath)) {
    	$errorMSG = array('pathErr' => "File not exists");
    }
}

if(!empty($errorMSG)) {
	echo json_encode(['status'=>false, 'msg'=>$errorMSG]);
}

if(empty($errorMSG)) {
	if(is_dir($fullpath)) {
		$fileInfo = pathinfo( $fullpath );
		$baseName = $fileInfo['basename'];
		$r = '0001';
		copyFilesFrmSrcToDst($baseName, $r, $fileInfo);
	}else if(file_exists($fullpath)) {
		$fileInfo = pathinfo( $fullpath );
		$fileName = $fileInfo['filename'];
		$r = '0001';
		renameFileName($fileName,$r,$fileInfo);
	} else {
		
	}
	echo json_encode(['status'=>true, 'msg'=>"Successfully completed"]);
}

function copyFilesFrmSrcToDst($bName, $n, $fileInfo) {
	$fileArr = explode("_", $bName);
	$n = str_pad($n, 4, '0', STR_PAD_LEFT);
	if(is_dir($fileArr[0]."_".$n)) {
		$n=$n+1;
		copyFilesFrmSrcToDst($bName, $n, $fileInfo);
	} else{
		$folderName  = $fileInfo['basename'];
		$newFolderName = $folderName."_".$n;
		$existingPath = $fileInfo['dirname']."/".$fileInfo['basename']."/";
		mkdir($newFolderName);
		copyr($existingPath,$newFolderName);
		return true;
	}
}

function copyr($source, $dest)
{
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }
    
    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        copyr("$source/$entry", "$dest/$entry");
    }

    // Clean up
    $dir->close();
    return true;
}

function renameFileName($fname, $n, $fileInfo) {
	$fileArr = explode("_", $fname);
	
	$n = str_pad($n, 4, '0', STR_PAD_LEFT);
	$fileName  = $fileInfo['filename'];
	if(file_exists($fileName."_".$n.".".$fileInfo['extension'])) {
		$n = $n+1;
		renameFileName($fname, $n, $fileInfo);
	} else{
		$fileName  = $fileInfo['filename'];
		$extistingFileName = $fileName.".".$fileInfo['extension'];
		$newFileName = $fileName."_".$n.".".strtolower($fileInfo['extension']);
		copy($extistingFileName, $newFileName);
		return true;
	}
}
exit;
?>