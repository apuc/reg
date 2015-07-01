<?php

    class Docs
    {
        const IP = 0;
        const OOO = 1;

        const russia = 0;
        const moldova = 1;
        const ukraine = 2;

        private $adminMail = '';

        private $word;
        private $tags;
        private $fullPathToFiles = [];
        private $folder;
        private $dir;

        private $moldova = [
            self::IP  => [],
            self::OOO => []
        ];
        private $russia = [
            self::IP  => ['gosposhlina-1.docx',],
            self::OOO => []
        ];
        private $ukraine = [
            self::IP  => [],
            self::OOO => []
        ];
        private $country;
        private $businessType;


        /**
         * @param string $dir адрес папки в которой лежат папки doc-templates и ready-docs
         * @param string $inn это индификационный пользователя
         * @param string $country moldova russia ukraine
         * @param string $businessType IP OOO
         */
        public function __construct($dir, $inn, $country, $businessType)
        {
            $this->word = new PHPWord();

            $this->country = $country;
            $this->businessType = $businessType;
            $this->folder = md5($inn);
            $this->dir = $dir;
        }

        public function setTag($key, $value)
        {
            $this->tags[$key] = $value;
        }

        public function saveDocs()
        {
            $readyPath = $this->dir . '/ready-docs/' . $this->folder;

            if (!file_exists($readyPath))
                mkdir($readyPath);

            $country = $this->getCountryName($this->country);
            $country = $this->$country; //вот тут ссылка вышла на массив наш со страной

            foreach ($country[$this->businessType] as $doc) {
                $document = $this->word->loadTemplate($this->dir . '/doc-templates/' . $doc);

                foreach ($this->tags as $key => $value)
                    $document->setValue($key, $value);

                $fullPathToFile = $readyPath . '/' . $doc;

                $this->fullPathToFiles[] = $fullPathToFile;

                $document->save($fullPathToFile);
            }

            return true;
        }

        public function saveDocsAndMail($mail)
        {
            $this->saveDocs();
            $this->mailTo($mail);
        }

        public function mailTo($mail)
        {
            $text = "Это сообщение из <br> двух строк.";
            $subj = 'me@localhost.ru';
            $to = "$mail, $this->adminMail";

            $un = strtoupper(uniqid(time()));
            $head = "From: sender@gmail.com\n";
            $head .= "To: $to\n";
            $head .= "Subject: $subj\n";
            $head .= "X-Mailer: PHPMail Tool\n";
            $head .= "Reply-To: no_reply\n";
            $head .= "Mime-Version: 1.0\n";
            $head .= "Content-Type:multipart/mixed;";
            $head .= "boundary=\"----------" . $un . "\"\n\n";
            $zag = "------------" . $un . "\nContent-Type:text/html;\n";
            $zag .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";

            if (empty($this->fullPathToFiles))
                $this->generateFullPathesToFiles();

            foreach ($this->fullPathToFiles as $value) {
                $filename = $value;

                $f = fopen($filename, "rb");

                $zag .= "------------" . $un . "\n";
                $zag .= "Content-Type: application/octet-stream;";
                $zag .= "name=\"" . basename($filename) . "\"\n";
                $zag .= "Content-Transfer-Encoding:base64\n";
                $zag .= "Content-Disposition:attachment;";
                $zag .= "filename=\"" . basename($filename) . "\"\n\n";
                $zag .= chunk_split(base64_encode(fread($f, filesize($filename)))) . "\n";

            }

            if (!@mail("$to", "$subj", $zag, $head))
                return 0;
            else
                return 1;
        }

        private function getCountryName($country)
        {
            switch ($country) {
                case self::russia:
                    return 'russia';
                case self::moldova:
                    return 'moldova';
                case self::ukraine:
                    return 'ukraine';
            }

            return false;
        }

        private function generateFullPathesToFiles()
        {
            $readyPath = $this->dir . '/ready-docs/' . $this->folder;

            $filelist = glob($readyPath . "/*.docx");

            foreach ($filelist as $doc)
                $this->fullPathToFiles[] = $readyPath . "/" . $doc;
        }
    }