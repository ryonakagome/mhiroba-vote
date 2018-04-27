<?php
    namespace mhiroba;
    class Kabegami
    {
        private static $sqli;

        function __construct()
        {
            if(!($sqli = self::connectMySQL())) {
                throw new \Exception("mhiroba.Kabegami.__construct --> データベース接続エラー");
            } else {
                self::$sqli = $sqli;
            } 
        }

        /**
         * 全ての壁紙のIDを順位順に取得します
         * 
         * 引数 : なし
         * 返り : 壁紙ID
         */
        function getKabegamiList()
        {
            $sqli = new $this->connectMySQL();
            $data = [];
            if($result = self::$sqli->query("SELECT `KabegamiName`, `KabegamiAuthor`, `Voting` FROM `mvote_kabegami` ORDER BY `Voting` DESC"))
            {
                while($row = $result->fetch_assoc())
                {
                    $data[] += $row["KabegamiID"];
                }
            }
            else
            {
                throw new Exception("mhiroba.Kabegami.getKabegamiList --> データベースクエリ作成エラー");
            }
        }

        /**
         * 壁紙IDから壁紙の情報を返します
         * 
         * 引数 : 壁紙ID
         * 返り : 連想配列("name" => 壁紙名, "author" => 作成者, "voting" => 投票数)
         */
        function getKabegamiInfo($KabegamiID)
        {
            $sqli = new $this->connectMySQL();
            $data = [];
            if($stmt = self::$sqli->query("SELECT `KabegamiName`, `KabegamiAuthor`, `Voting` FROM `mvote_kabegami` WHERE `KabegamiID` = ? ORDER BY `Voting` DESC"))
            {
                $stmt->bind_param("i", $KabegamiID);
                $stmt->bind_result($KabegamiName, $KabegamiAuthor, $Voting);

                $data = [];

                while($stmt->fetch())
                {
                    $data = [
                        "name" => $KabegamiName,
                        "author" => $KabegamiAuthor,
                        "voting" => $Voting
                    ];
                }
                
            }
            else
            {
                throw new Exception("mhiroba.Kabegami.getKabegamiInfo --> データベースクエリ作成エラー");
            }

            $stmt->close();
            return $data;
        }

        function connectMySQL()
        {
            include __DIR__."/../config/config.php";
            $sqli = new \mysqli($db_host, $db_user, $db_pass, $db_name);
            
            if($sqli->connect_error)
            {
                echo $sqli->connect_error;
                exit();
            }
            else
            {
                $sqli->set_charset("utf8");
            }

            return $sqli;
        }
    }