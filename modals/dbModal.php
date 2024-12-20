<?php
class DBModal
{
    protected static $connection;
    protected static $isConnectSuccess = false;

    public function __construct()
    {
        try {
            // Bật chế độ báo cáo lỗi và ngoại lệ cho mysqli
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            if (!self::$connection) {
                self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, PORT);

                if (self::$connection->connect_error) {
                    self::$isConnectSuccess = false;
                } else {
                    self::$connection->set_charset(DB_CHARSET);
                    self::$isConnectSuccess = true;
                }
            }
        } catch (Exception $e) {
            self::$isConnectSuccess = false;
        }
    }

    // Phương thức để kiểm tra trạng thái kết nối
    public function getConnectionStatus()
    {
        return self::$isConnectSuccess;
    }
}
