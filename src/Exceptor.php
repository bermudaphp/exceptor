<?php

namespace Bermuda\Exceptor;

use Throwable;

trait Exceptor
{
    public static function make(string $format, string ...$values): self
    {
        return static::makeStatic(sprintf($format, ... $values));
    }

    protected static function makeStatic(... $ctrArgs): self
    {
        return new static(... $ctrArgs);
    }
    
    public function setCode(int $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function withPrev(Throwable $throwable): self
    {
        return (new static($this->message, $this->code, $throwable))->setFile($this->file)
            ->setLine($this->line);
    }

    public function setLine(int $line): self
    {
        $this->line = $line;
        return $this;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;
        return $this;
    }
}
