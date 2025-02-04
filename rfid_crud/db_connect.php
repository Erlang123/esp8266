<?php
    class Database {
        private static $host = "127.0.0.1";  // Sesuaikan dengan host database
        private static $dbname = "rfid_system";  // Sesuaikan dengan nama database
        private static $username = "postgres";  // Sesuaikan dengan username PostgreSQL
        private static $password = "superuser";  // Ganti dengan password PostgreSQL Anda
        private static $port = "5432";  // Port default PostgreSQL
        private static $pdo = null;
    
        public static function connect() {
            if (self::$pdo == null) {
                try {
                    self::$pdo = new PDO("pgsql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname, self::$username, self::$password);
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Database Connection Failed: " . $e->getMessage());
                }
            }
            return self::$pdo;
        }
    
        public static function disconnect() {
            self::$pdo = null;
        }
    }
?> 
