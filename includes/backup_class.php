<?php
/*
Backup and Restore Mysql database


inline example
<code>
$obj=new Backup_Restore();
##for backup
###$obj->backup_database($dbhost,$dbuser,$dbpass,$dbname,$table_names,$path);
##for restore
##$obj->restore_database($dbhost,$dbuser,$dbpass,$dbname,$file);
</code>

@name	Backup_Restore
@author	Md.Abdullah Bin Salam - ab_duetcse@yahoo.com,blog:absalam.wordpress.com
	
*/
class Backup_Restore{
/**
	* @access private
	database name
	*/
	//added by Daser solomon
	public $filepath = "../churchdump";
	public $file  = null;
var $dbname=null;
/**
	* @access private
	file path where backup file will be store
	*/
var $path=null;
/**
	* @access private
	database host
	*/
var $dbhost=null;
/**
	* @access private
	database user
	*/
var $dbuser=null;
/**
	* @access private
	database password
	*/
var $dbpass=null;

/**
	* @access private
	default all tables of the selected database
	*/
var $table_names="*";

/**
	* Class constructor
*/

##get table defination

function get_def($dbname, $table,$conn) {
   // global $conn;
    $def = "";
    $def .= "DROP TABLE IF EXISTS $table;#$$\n";
    $def .= "CREATE TABLE $table (\n";
    $result = mysql_db_query($dbname, "SHOW FIELDS FROM $table",$conn) or die("Table does not exists");
    while($row = mysql_fetch_array($result)) {
        $def .= "    $row[Field] $row[Type]";
        if ($row["Default"] != "") $def .= " DEFAULT '$row[Default]'";
        if ($row["Null"] != "YES") $def .= " NOT NULL";
       	if ($row[Extra] != "") $def .= " $row[Extra]";
        	$def .= ",\n";
     }
     $def = ereg_replace(",\n$","", $def);
     $result = mysql_db_query($dbname, "SHOW KEYS FROM $table",$conn);
     while($row = mysql_fetch_array($result)) {
          $kname=$row[Key_name];
          if(($kname != "PRIMARY") && ($row[Non_unique] == 0)) $kname="UNIQUE|$kname";
          if(!isset($index[$kname])) $index[$kname] = array();
          $index[$kname][] = $row[Column_name];
     }
     while(list($x, $columns) = @each($index)) {
          $def .= ",\n";
          if($x == "PRIMARY") $def .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
          else if (substr($x,0,6) == "UNIQUE") $def .= "   UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
          else $def .= "   KEY $x (" . implode($columns, ", ") . ")";
     }

     $def .= "\n);#$$";
     return (stripslashes($def));
}


######################################

##get table contents
function get_content($dbname, $table,$conn) {
     //global $conn;
     $content="";
     $result = mysql_db_query($dbname, "SELECT * FROM $table",$conn);
     while($row = mysql_fetch_row($result)) {
         $insert = "INSERT INTO $table VALUES (";
         for($j=0; $j<mysql_num_fields($result);$j++) {
            if(!isset($row[$j])) $insert .= "NULL,";
            else if($row[$j] != "") $insert .= "'".addslashes($row[$j])."',";
            else $insert .= "'',";
         }
         $insert = ereg_replace(",$","",$insert);
         $insert .= ");#$$\n";
         $content .= $insert;
     }
     return $content;
}

################################

function start_backup($dbname,$table_names,$path,$conn)
	{
	$filetype = "sql";

//if (!eregi("/restore\.",$PHP_SELF)) {

	$cur_time=date("Y-m-d H:i");
	if ($table_names == "*" ) {
	   $tables = mysql_list_tables($dbname,$conn);
	   $num_tables = @mysql_num_rows($tables);
	   $i = 0;
	   while($i < $num_tables) { 
	      $table = mysql_tablename($tables, $i);
	      $newfile .= $this->get_def($dbname,$table,$conn);
	      $newfile .= "\n\n";
	      $newfile .= $this->get_content($dbname,$table,$conn);
	      $newfile .= "\n\n";
	      $i++;
	   }	
	} else {
	   $i=0;
	   $tables=explode(";",$table_names);
	   if (count($tables) != 0) {
	      while($i < count($tables)) {
	         $newfile .= $this->get_def($dbname,$tables[$i],$conn);
	         $newfile .= "\n\n";
	         $newfile .= $this->get_content($dbname,$tables[$i],$conn);
	         $newfile .= "\n\n";
	         $i++;
	      }
	   }      
	}
	$this->file = $dbname.".".$filetype;
	
	$this->filepath = $path.$dbname.".".$filetype;
	$fp = fopen ($this->filepath,"w");
	fwrite ($fp,$newfile);
	fclose ($fp);
}


####call this function to backup your database
function backup_database($dbhost,$dbuser,$dbpass,$dbname,$table_names,$path)
	{
	 flush();
   $conn = @mysql_connect($dbhost,$dbuser,$dbpass);
   if ($conn==false)  die("password/user or database name wrong");
   $path = $path . "dump/";
   if (!is_dir($path)){
    mkdir($path, 0766);
    }
   //chmod($path, 777);

   if(!file_exists($path .$dbname.".sql"))
   {
	$fp2 = fopen ($path.$dbname.".sql","w");
	fwrite ($fp2,"");
	fclose ($fp2);
//        chmod($path.$dbname.".sql", 0777);
   }
   
 $this->start_backup($dbname,$table_names,$path,$conn);
     
	}
######################
####call this function to restore your database
function restore_database($dbhost,$dbuser,$dbpass,$dbname,$file)
	{
	if ($file!=""){  
         
      flush();
      $conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
	$filename = $file;
	set_time_limit(1000);
	$file=fread(fopen($path.$file, "r"), filesize($path.$file));
	$query=explode(";#$$\n",$file);
	for ($i=0;$i < count($query)-1;$i++) {
		mysql_db_query($dbname,$query[$i],$conn) or die(mysql_error());
	}
	}
	}


}


?>
