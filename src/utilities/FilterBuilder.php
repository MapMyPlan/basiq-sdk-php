<?php

namespace MMPBasiq\Utilities;

class FilterBuilder
{
    private $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function eq($field, $value): FilterBuilder
    {
        $this->filters[] = $field . ".eq('".$value."')";
        return $this;
    }

    public function gt($field, $value): FilterBuilder
    {
        $this->filters[] = $field . ".gt('".$value."')";
        return $this;
    }

    public function gteq($field, $value): FilterBuilder
    {
        $this->filters[] = $field . ".gteq('".$value."')";
        return $this;
    }

    public function lt($field, $value): FilterBuilder
    {
        $this->filters[] = $field . ".lt('".$value."')";
        return $this;
    }

    public function lteq($field, $value): FilterBuilder
    {
        $this->filters[] = $field . ".lteq('".$value."')";
        return $this;
    }

    public function bt($field, $valueOne, $valueTwo): FilterBuilder
    {
        $this->filters[] = $field . ".bt('".$valueOne."','".$valueTwo."')";
        return $this;
    }

    public function toString(): string
    {
        return implode(",", $this->filters);
    }

    public function getFilter(): string
    {
        return "filter=" . implode(",", $this->filters);
    }

    public function setFilter($filters): FilterBuilder
    {
        $this->filters = $filters;
        return $this;
    }
}
