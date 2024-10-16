<?php

// Lớp database
class DB
{
    public $conn;
    
    // Hàm kết nối
    function __construct()
    {
    	$this->conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD) or die('Could not connect database');
		mysqli_select_db($this->conn, DATABASE) or die("Could not select database");
		mysqli_query($this->conn, "SET NAMES 'utf8'");
    }
 
    // Hàm ngắt kết nối
    public function close()
    {
        if ($this->conn)
        {
            mysqli_close($this->conn);
        }
    }
 
    // Hàm truy vấn
    public function query($sql = null) 
    {       
        if ($this->conn)
        {
            mysqli_query($this->conn, $sql);
        }
    }
    
    // Hàm chống sql injection
    public function real_escape_string($sql = null) 
    {
        if ($this->conn) return mysqli_real_escape_string($this->conn, $sql);
    }
    
    // Hàm đếm số hàng
    public function num_rows($sql = null) 
    {
        if ($this->conn)
        {
            $query = mysqli_query($this->conn, $sql);
            if ($query)
            {
                $row = mysqli_num_rows($query);
                return $row;
            }   
        }       
    }

    // Hàm đếm tổng số hàng
    public function fetch_row($sql = null) 
    {
        if ($this->conn)
        {
            $query = mysqli_query($this->conn, $sql);
            if ($query)
            {
                $row = $query->fetch_row();
                return $row[0];
            }   
        }       
    }


    // Hàm lấy dữ liệu
    public function fetch_assoc($sql = null, $type)
    {
        if ($this->conn)
        {
            $query = mysqli_query($this->conn, $sql);
            if ($query)
            {
                if ($type == 0)
                {
                    // Lấy nhiều dữ liệu gán vào mảng
                    while ($row = mysqli_fetch_assoc($query))
                    {
                        $data[] = $row;
                    }
                    return $data;
                }
                else if ($type == 1)
                {
                    // Lấy một hàng dữ liệu gán vào biến
                    $data = mysqli_fetch_assoc($query);
                    return $data;
                }
            }       
        }
    }
        
 
    // Hàm lấy ID cao nhất
    public function insert_id()
    {
        if ($this->conn)
        {
            $count = mysqli_insert_id($this->conn);
            if ($count == '0')
            {
                $count = '1';
            }
            else
            {
                $count = $count;
            }
            return $count;
        }
    }
 
}
 
?>