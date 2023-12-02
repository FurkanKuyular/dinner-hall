<?php

namespace App\Listeners;

use App\Events\GateFailed;
use App\Http\Requests\GateRequest;
use App\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;

class PingCallbackFail implements ShouldQueue
{
    public function __construct(protected GateRequest $request)
    {
    }

    public function __invoke(GateFailed $event): void
    {
        Activity::query()->create($this->request->validated() + ['is_success' => false]);

        //TODO Ask here because returning 403 Forbidden
        Http::contentType('application/json')
            ->post($this->request->get('callback_fail_url'), ['Hash' => $this->getHashedString()]);
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
