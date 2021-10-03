<?php

namespace Bermuda\Exceptor;

use Throwable;

trait Exceptor
{
    public static function create(string $message, string ...$tokens)
    {
        return new static(sprintf($message, ...$tokens));
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
    
    public function setMessage(string $message, string ...$tokens): self
    {
        $this->message = sprintf($message, ...$tokens);
        return $this;
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
