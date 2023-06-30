<?php

namespace User\DatabaseAbstraction;

interface DatabaseQueryResultContract
{

    public function fetch();

    public function fetchAll();

}