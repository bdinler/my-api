<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait Caching
{
    use Responder;

    /**
     * Cache set data
     * @param string $key
     * @param $value
     * @param integer $time
     * @return bool
     */
    protected function setData(string $key, $value, int $time = 3600): bool
    {
        return Cache::put($key, $value, $time);
    }

    /**
     * Cache get data
     * @param string $key
     * @return mixed
     */
    protected function getData(string $key): bool
    {
        if (!Cache::has($key)) {
            return $this->errorMessage(trans('messages.notFound'), 401);
        }
        return Cache::get($key);
    }

    /**
     * @param string $key
     * @param $value
     * @param int|null $time
     * @return mixed
     */
    protected function setOrGetData(string $key, $value, ?int $time = 3600)
    {
        if (!Cache::has($key)) {
            $this->setData($key, $value, $time);
            return Cache::get($key);
        }
        return Cache::get($key);
    }
}
