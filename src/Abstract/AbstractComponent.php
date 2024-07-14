<?php 
namespace OSW3\UrlManager\Abstract;

use OSW3\UrlManager\Helper;

abstract class AbstractComponent 
{
    private string $subject;
    private array $infos;

    public function __construct(string $subject)
    {
        $this->subject = $subject;
        $this->infos = $this->parser();
    }

    public function infos(bool $asArray = false): object|array
    {
        return $asArray ? $this->infos : json_decode(json_encode($this->infos));
    }

    public function get(string $param): ?string
    {
        $params = explode('.', $param);
        $data = null;

        foreach ($params as $name)
        {
            if (isset($this->infos[$name]))
            {
                $data = $this->infos[$name];
            }
            if (isset($data[$name]))
            {
                $data = $data[$name];
            }
        }
        return $data;
    }

    protected function getSubject(): string
    {
        return $this->subject;
    }

    protected function standardParser(string $subject, array $additional = array())
    {
        $standard               = Helper::RESPONSE;

        $standard['subject']    = $subject;
        $standard['hash']       = $this->hash($subject);
        $standard['length']     = strlen($subject);
        $standard['positions']  = $this->positions($this->subject, $subject);

        return array_merge($standard, $additional);
    }

    protected function hash(string $subject): array
    {
        $hash = [];

        if (empty(trim($subject))) return $hash;

        foreach (Helper::ALGORITHMS as $algorithm)
        {
            if (in_array($algorithm, hash_algos()))
            {
                $hash[$algorithm] = hash($algorithm, $subject);
            }
        }

        return $hash;
    }

    protected function positions(string $url, string $subject, int $offsetStart = 0, int $offsetEnd = 0): array
    {
        $length = strlen($subject);
        $start  = strpos($url, $subject);
        $end    = $start + $length;

        return array(
            'start' => ($start + $offsetStart),
            'end' => ($end + $offsetEnd),
        );
    }  

    protected function parseParameters(string $subject): array
    {
        parse_str($subject, $parameters);

        // $parameters = explode(Helper::QUERY_SEPARATOR, $subject);

        // foreach ($parameters as $key => $param)
        // {
        //     $param = explode("=", $param);
        //     $name = $param[0];
        //     $value = $param[1];

        //     $parameters[$key] = array(
        //         'name'  => $name,
        //         'value' => $value,
        //     );
        // }

        return $parameters;
    }

    protected function queryDelimiters(string $url, string $delimiter): array
    {
        $d1 = strpos($url, Helper::QUERY_IDENTIFIER);
        $d2 = strpos($url, Helper::FRAGMENT_IDENTIFIER);

        switch ($delimiter)
        {
            case Helper::QUERY_IDENTIFIER:
                $start = $d1;
                $end = $d2 - $start;
            break;

            case Helper::FRAGMENT_IDENTIFIER:
                $start = $d2;
                $end = $d1 - $start;
            break;
        }

        if ($start === false) {
            $start = 0;
            $end = 0;
        }

        if ($end < $start) {
            $end = strlen($url);
        }

        return[
            'start' => $start,
            'end' => $end,
        ];
    }
}