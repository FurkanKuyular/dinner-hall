<?php

namespace App\Listeners;

use App\Events\GateSucceed;
use App\Http\Requests\GateRequest;
use App\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;

class PingCallbackSuccess implements ShouldQueue
{
    public function __construct(protected GateRequest $request)
    {
    }

    public function __invoke(GateSucceed $event): void
    {
        Activity::query()->create($this->request->validated() + ['is_success' => true]);

        //TODO Ask here because returning 403 Forbidden
        Http::post($this->request->get('callback_success_url'), ['Hash' => $this->getHashedString()]);
    }

    private function getHashedString(): string
    {
        return str()->createHash(
            ...$this->request->collect(['callback_fail_url', 'callback_success_url', 'price',])
            ->prepend(config('callback.salt'))
            ->values()
        );
    }
}
