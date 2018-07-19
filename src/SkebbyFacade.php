<?php
namespace jobayerccj\Skebby;
use Illuminate\Support\Facades\Facade;
class SkebbyFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'skebby';
    }
}