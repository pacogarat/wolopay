<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Component\HttpFoundation;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CsvResponse extends Response
{
    protected $data;
    protected $filename;

    public function __construct($data = array(), $status = 200, $headers = array(), $filename='data.csv')
    {
        parent::__construct('', $status, $headers);
        $this->filename=$filename;
        $this->setData($data);
    }
    public function setData(array $data)
    {
        $output = fopen('php://temp', 'r+');
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
        rewind($output);
        $this->data = '';
        while ($line = fgets($output)) {
            $this->data .= $line;
        }
        $this->data .= fgets($output);
        return $this->update();
    }

    protected function update()
    {
        $this->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $this->filename));
        if (!$this->headers->has('Content-Type')) {
            $this->headers->set('Content-Type', 'text/csv');
        }
        return $this->setContent($this->data);
    }
}