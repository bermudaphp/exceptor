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
        $copy = clone $this;
        $copy->code = $code;

        return $copy;
    }

    public function withFile(string $file): self
    {
        $copy = clone $this;
        $copy->file = $file;

        return $copy;
    }

    public function withLine(int $line): self
    {
        $copy = clone $this;
        $copy->line = $line;

        return $copy;
    }

    public function withPrev(Throwable $throwable): self
    {
        return new static($this->message, $this->code, $throwable);
    }
}
