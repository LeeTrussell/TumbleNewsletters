<?php
      class database
      {
          protected $link, $database;
          
          function database_connect( $mysql_host, $mysql_database, $mysql_user, $mysql_password)
          {
                $this->link = mysql_connect($mysql_host, $mysql_user, $mysql_password);
                if (!$this->link) {
                    die('Could not connect: ' . mysql_error());
                }
                mysql_select_db($mysql_database, $this->link);
                
               
          }
          
          function database_query($sql)
          {
              
              $GLOBALS['debug']->addToDebug($sql);
              $recordset = mysql_query($sql, $this->link);
              
              if (!$recordset) {
                  $message  = 'Invalid query: ' . mysql_error() . "\n";
                  $message .= 'Whole query: ' . $sql;
                  die($message);
                }
                
                
              return $recordset;
          }
          
          function database_hasrows($recordset)
          {
            $numberofrows = mysql_num_rows($recordset);      
          
            return $numberofrows;
          }
          
          function database_fetch($recordset)
          {
              $row = mysql_fetch_assoc($recordset);
                        
              return $row;
          }
          
          function  database_update($table, $data, $id_field, $id_value)
          {
              	
                foreach ($data as $field=>$value) {
              		$fields[] = sprintf("`%s` = '%s'", $field, $value);
              	}
              	$field_list = join(',', $fields);
              	
              	$query = sprintf("UPDATE `%s` SET %s WHERE `%s` = %s", $table, $field_list, $id_field, intval($id_value));
              	
              	$result = $this->database_query($query);
            }
            
            function database_delete($tablename,$clause)
            {
              $query = "DELETE FROM " . $tablename . " WHERE ".$clause;
              $this->database_query($query);            
            }     
            
            function database_insert($table, $data)
            {
                foreach ($data as $field=>$value) 
                {
		              
                  $fields[] = '`' . $field . '`';
		              //$values[] = "'" . htmlspecialchars($value, ENT_QUOTES) . "'";
		              $values[] = "'".$value."'";
	              }
            	   $field_list = join(',', $fields);
            	   $value_list = join(', ', $values);
	
	             $query = "INSERT INTO `" . $table . "` (" . $field_list . ") VALUES (" . $value_list . ")";
	
	             $rstResult = $this->database_query($query);
            
                return mysql_insert_id();
            }
            
  }
          
          

      
      
?>
