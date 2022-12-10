<html>
<head><title>ql - Joomla Copy</title></head>
<body>
<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

$strPrefix = 'copy2_';
$str = $strReplacement = '';
$strFolder = $_POST['folder'] ?? '';
$strSearch = $_POST['strSearch'] ?? '';
$strReplacement = $_POST['strReplacement'] ?? '';
$strFolderNew = $strPrefix . $strReplacement;


if (isset($strFolder)) {
    if (is_dir($strFolder)) {
        $objFiles = new Files;
        $objFiles->readFolder($strFolder);
        $arrFiles = $objFiles->arrFiles;
        $objFiles->copyFoldersnFiles($arrFiles, $strPrefix, $strSearch, $strReplacement);
        $message = $strFolder . ' wurde kopiert und heisst jetzt ' . $strFolderNew;
        $foldernameNew = $strPrefix . str_replace($strSearch, $strReplacement, $strFolder);
        $objFiles->zip($foldernameNew, $foldernameNew . '.zip');
    } else $message = $strFolder . ' does not exist.';


//	if (is_dir($strFolderNew)) $message="Der Ordner '".$strFolderNew."' existiert bereits. <br />Daher kann nicht erzeugt werden. <br />L&ouml;schen Sie diesen Ordner oder benennen Sie ihn um.";
//	else rename("copy_".$strReplacement,$strFolderNew);
}

if (isset($message)) echo $message;

?>
<form method="post" action="#">
    <table>
        <tr>
            <td>Ordnername:</td>
            <td><input name="folder" type="text" value="<?php if (isset($folder)) echo $folder; ?>"/></td>
        </tr>
        <tr>
            <td>Zu ersetzender String:</td>
            <td><input name="strSearch"
                       value="<?php if (isset($strSearch)) echo $strSearch; ?>" type="text"/></td>
        </tr>
        <tr>
            <td>Stringersetzung:</td>
            <td><input name="strReplacement" value="<?php if (isset($strReplacement)) echo $strReplacement; ?>"
                       type="text"/></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit"/></td>
        </tr>
    </table>
</form>

<?php

class Files
{
    public $arrFiles = [];
    public $strMessage = '';

    public function readFolder($strFilename)
    {
        $strFilename = trim($strFilename);
        if (!is_dir($strFilename)) {
            $this->strMessage = sprintf('Folder %s not found.', $strFilename);
        }
        $rscHandle = opendir($strFilename);
        while ($strFile = readdir($rscHandle)) {
            $strPath = $strFilename . '/' . $strFile;
            if (!is_dir($strPath) && is_file($strPath)) {
                $this->arrFiles[] = $strPath;
            }
            if (is_dir($strPath) && '..' != $strFile && '.' != $strFile) {
                $this->readFolder($strPath);
            }
        }
        closedir($rscHandle);
    }

    public function copyFoldersnFiles($arrFiles, $strPrefix, $strSearch, $strReplacement)
    {
        if (isset($strSearch) & isset($strReplacement)) {
            $this->strSearch = $strSearch;
            $this->strReplacement = $strReplacement;
        }
        if (is_array($arrFiles)) {
            foreach ($arrFiles as $k => $v) {
                $this->copyFolder($v, $strPrefix);
                $this->copyFile($v, $strPrefix);
                $arrFiles_copy[$k] = $this->replacer($strPrefix . $v);
            }
        }
        $this->arrFiles_copy = $arrFiles_copy;
    }

    public function copyFolder($strPath, $strPrefix)
    {
        $arrFolder = preg_split("?/?", $strPath);
        if (!is_array($arrFolder)) {
            return;
        }
        $strPath = $strPrefix;
        for ($i = 0; $i < count($arrFolder) - 1; $i++) {
            $strPath .= $arrFolder[$i] . '/';
            $strPath = $this->replacer($strPath);
            if (is_dir(substr($strPath, 0, -1))) {
                continue;
            }
            mkdir($strPath);
        }
    }

    public function copyFile($strPath, $strPrefix)
    {
        $strPathNew = $strPrefix . $this->replacer($strPath);
        copy($strPath, $strPathNew);
        $str = file_get_contents($strPathNew);
        $str = $this->replacer($str);
        file_put_contents($strPathNew, $str);
    }

    public function replacer($str)
    {
        if (!empty($this->strSearch) & !empty($this->strReplacement)) {
            $str = preg_replace('/' . strtoupper($this->strSearch) . '/', strtoupper($this->strReplacement), $str);
            $str = preg_replace('/' . ucwords($this->strSearch) . '/', ucwords($this->strReplacement), $str);
            $str = preg_replace('/' . $this->strSearch . '/i', $this->strReplacement, $str);
        }
        return $str;
    }

    public function zip($src, $destination)
    {
        return;
        $zip = new ZipArchive();

        if ($zip->open($src, ZipArchive::CREATE) !== TRUE) {
            echo('cannot open ' . $src);
            return false;
        }
        $zip->addFile($destination, $src);
        echo "numfiles: " . $zip->numFiles . "\n";
        echo "status:" . $zip->status . "\n";
        $zip->close();
    }

}

?>
</body>
</html>
