<?php
     class Database {
        private $user;
        private $password;
        private $host;
        private $port;

        /**
         * En el constructor recibo los parametros de conexion a la BD
         */
        public function __construct($user, $password, $host, $port){
            $this->user = $user;
            $this->password = $password;
            $this->host = $host;
            $this->port = $port;
            // var_dump($this->$user);
            // var_dump($this->$password);
            // var_dump($this->$host);
            // var_dump($this->$port);
            // exit();
        }

        public function getUser() : String {
            return $this->user;
        }
        public function getPassword() : String{
            return $this->password;
        }
        public function getHost() : String {
            return $this->host;
        }
        public function getPort() : int {
            return $this->port;
        }
        /**
         * Realiza la conexion a la base de datos
         */
        public function conectar() : PDO{

            $db = new \PDO(
                "mysql:host=".$this->getHost().";port=".$this->getPort().";dbname=t2p1",
                $this->getUser(),
                $this->getPassword(),
                array(
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
             ));
            
             return $db;
        }

        /**
         * Realiza la desconexion a la base de datos
         */
        public static function desconectar(){
            return null;
        }
    }
