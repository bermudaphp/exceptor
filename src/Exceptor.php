<?php

namespace Bermuda\Exceptor;

use Throwable;

trait Exceptor
{
    public static function make(string $format, string ...$values): self
    {
        return static::makeStatic(sprintf($format, ... $values));
    }

    protected static function makeStatic(string $msg, int $code = 0, Throwable $prev = null): self
    {
        return new static($msg, $code, $prev);
    }
    
    public function withCode(int $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function withPrev(Throwable $throwable): self
    {
        return (new static($this->message, $this->code, $throwable))->withFile($this->file)
            ->withLine($this->line);
    }

    public function withLine(int $line): self
    {
        $this->line = $line;
        return $this;
    }

    public function withFile(string $file): self
    {
        $this->file = $file;
        return $this;
    }
}
