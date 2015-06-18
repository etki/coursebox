<?php

abstract class AbstractFilesystem
{
    abstract public function delete($path);
    abstract public function move($path, $newPath);
    public function replace($path, $replacementPath)
    {
        $this->delete($path);
        $this->move($replacementPath, $path);
    }
}